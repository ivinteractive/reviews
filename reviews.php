<?php

require_once(__DIR__ . DS . 'lib' . DS . 'reviewsFunctions.php');

$page = page(c::get('reviews-uri', 'reviews'));
$db = defaultDB()->table('reviews');

if(!c::get('reviews-template')) {
	$kirby->set('blueprint', 'reviews', __DIR__ . DS . 'assets' . DS . 'blueprints' . DS . 'reviews.yaml');
}
if(!c::get('reviews-tag')) {
	$kirby->set('tag', 'reviews', [
		'html' => function($tag) use($db) {
			$content = '';
			$reviews = $db->where(['display' => '1'])->all();
			foreach($reviews as $review) {
		        $stars = '';
		        for($i=1; $i<=5; $i++) {
		          $stars.= brick('i', false, ['class' => 'fa fa-star'.r($i > $review->rating, '-o')]);
		        }

				$content.= brick('div', brick('div', $stars, ['class' => 'star-container']).brick('div', $review->message), ['class' => 'review']);
			}
			return $content;
		}
	]);
}
if(!c::get('reviews-email-snippet')) {
	$kirby->set('snippet', 'reviews-email', __DIR__ . DS . 'assets' . DS . 'snippets' . DS . 'reviews-email.php');
}
if(!c::get('review-button')) {
	$kirby->set('tag', 'review-button', [
		'attr' => [
			'link'
		],
		'html' => function($tag) use($page) {
			$link = r($tag->attr('link', false), $tag->attr('link', false), $page->url());
			return buttonTag($tag->attr('review-button'), $link);
		}
	]);
}
if(c::get('reviews-widget', true)) {
	$kirby->set('widget', 'reviews', __DIR__ . DS . 'widgets' . DS . 'reviews');
}

$css = css('https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700');
$css.= css('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');
$css.= '<style>'.file_get_contents(__DIR__ . DS . 'assets' . DS . 'css' . DS . 'reviews.css').'</style>';

$customCss = customCss($page);

$js = '<script src="https://cdnjs.cloudflare.com/ajax/libs/reqwest/2.0.5/reqwest.min.js"></script>';
$js.= '<script>'.file_get_contents(__DIR__ . DS . 'assets' . DS . 'js' . DS . 'reviews.js').'</script>';

kirby()->routes([
	[
		'pattern' => c::get('reviews-uri', 'reviews'),
		'action'  => function() use($page, $css, $customCss, $js) {
			$content = '<!DOCTYPE html>';
			$content.= '<html lang="en" class="no-js">';
			$content.= '<head>';
			$content.= '<meta charset="utf-8" />';
			$content.= '<meta name="viewport" content="width=device-width,initial-scale=1.0">';
			$content.= brick('title', $page->metaTitle());
			$content.= $css.$customCss;
			$content.= '</head>';
			$content.= '<body id="reviews">';
			$content.= '<header>';
			$content.= '<div class="logo"><a href="'.url().'">'.$page->image($page->logo()).'</a></div>';
			$content.= '</header>';
			$content.= '<main>';
			$content.= '<div class="container">';
			$content.= $page->text()->kt();
			$content.= '<form action="'.url('reviews-process').'" method="post" id="reviews-form">';
			$content.= '<div id="wrapper">';
			$content.= $page->review_text()->kt();
			$content.= '<div id="star-ratings">';
			for($i=1; $i<=5; $i++) { $content.= brick('star'); };
			$content.= '</div>';
			$content.= '<div id="selected-rating">You selected a rating of <span>0</span> out of 5 stars</div>';
			$content.= '<button type="submit" name="_submit" id="_submit">Submit rating</button>';
			$content.= '</div>';
			$content.= '<input type="hidden" id="rating" name="rating" value="0">';
			$content.= '<input type="hidden" id="min-rating" name="min-rating" value="'.$page->min_rating()->value().'">';
			$content.= '<input type="hidden" id="token" name="token">';
			$content.= '<input type="hidden" id="source" name="source" value="'.get('utm_source', url()).'">';
			$content.= '<input type="hidden" id="link_id" name="link_id" value="'.get('link_id').'">';
			$content.= '<label for="website" class="uniform__potty">Please leave this field blank.</label>';
			$content.= '<input type="text" name="website" id="website" class="uniform__potty" />';
			$content.= '</form>';
			$content.= '</div>';
			$content.= '</main>';
			$content.= '<footer><div>';
			$content.= $page->footer_text()->kt();
			$content.= '</div></footer>';
			$content.= $js;
			$content.= '</body>';
			$content.= '</html>';

			return new Response($content);
		}
	],

	[
		'pattern' => 'reviews-process',
		'method'  => 'POST',
		'ajax'	  => true,
		'action'  => function() use($page, $db) {
			try {
				foreach($page->review_links()->toStructure() as $reviewLink) {
					if($reviewLink->link_id()->value() == get('link_id') || ($reviewLink->use() == '1' && !get('link_id')))
						$externalReview = $reviewLink;
				}

				$high_rating = $page->high_text()->kt();
				$high_rating.= '<a class="button" href="'.$externalReview->link()->value().'" target="_blank" onclick="externalClicked()">Review us on '.$externalReview->name()->value().'</a>';
				$high_rating.= '<input type="hidden" id="link" name="link" value="'.$externalReview->link()->value().'">';
				$high_rating.= '<input type="hidden" id="clicked" name="clicked">';

				$low_rating = $page->low_text()->kt();
				$low_rating.= '<div class="field name">';
				$low_rating.= '<label for="name">Name</label>';
				$low_rating.= '<input type="text" id="name" name="name">';
				$low_rating.= '</div>';
				$low_rating.= '<div class="field email">';
				$low_rating.= '<label for="email">Email</label>';
				$low_rating.= '<input type="email" id="email" name="email">';
				$low_rating.= '</div>';
				$low_rating.= '<div class="field">';
				$low_rating.= '<label for="message">Comments</label>';
				$low_rating.= '<textarea name="message" id="message"></textarea>';
				$low_rating.= '</div>';
				$low_rating.= '<button type="submit" name="_submit" id="_submit" value="'.get('_submit').'">Submit Feedback</button>';

				$success = kirbytext($page->success_text());

				$rating = get('rating');
				$min_rating = get('min-rating');

				$existingReview = $db->findBy('token', get('token'));

				$actions = [
					[
						'_action' => !$existingReview ? 'db_insert' : 'db_update',
						'table'	  => 'reviews',
						'nonSerts' => ['website','submit','min-rating','link_id'],
						'spamLog' => r(get('website'), r::data(), false),
						'where' => $existingReview ? ['id' => $existingReview->id] : null
					],
					[
						'_action' => 'mailgun',
						'subject' => EnvHelper::env('REVIEWS_SUBJECT'),
						'snippet' => 'reviews-email',
						'to' => ['name'=>EnvHelper::env('REVIEWS_RECIPIENT_NAME'), 'email'=>EnvHelper::env('REVIEWS_RECIPIENT_EMAIL')],
						'sender' => ['name'=>EnvHelper::env('REVIEWS_SENDER_NAME'), 'email'=>EnvHelper::env('REVIEWS_SENDER_EMAIL')]
					]
				];

				// if(!$existingReview) {
				// 	$actions[] = [
				// 		'_action' => 'mailgun',
				// 		'subject' => EnvHelper::env('REVIEWS_SUBJECT', 'New Review'),
				// 		'snippet' => 'reviews-email',
				// 		'to' => ['name'=>EnvHelper::env('REVIEWS_RECIPIENT_NAME'), 'email'=>EnvHelper::env('REVIEWS_RECIPIENT_EMAIL')],
				// 		'sender' => ['name'=>EnvHelper::env('REVIEWS_SENDER_NAME'), 'email'=>EnvHelper::env('REVIEWS_SENDER_EMAIL')]
				// 	];
				// }

				$form = ivform('reviews', [
					'actions' => $actions,
					'ignores' => ['/'.url::path()]
				]);

				$return = [
					'success' => 1,
					'message'  => !$existingReview ? ($rating > $min_rating ? $high_rating : $low_rating) : ($rating < $min_rating ? $success : null),
					'high_low' => !$existingReview ? 1 : null,
					'form' => $form
				];

				return new Response($return, 'json');

			} catch (Exception $e) {

				return new Response([
					'success' => 0,
					'message' => $e->getMessage()
				], 'json');	

			}
		}
	],

	[
		'pattern' => 'reviews-list',
		'action'  => function() use($page, $css, $js, $db) {
			if(!site()->user() || !site()->user()->hasPanelAccess())
				header::redirect(url('panel/login'));

    		$tz = new DateTimeZone(c::get('timezone', 'America/New_York'));

			$reviews = $db->order('created_at DESC')->all();

			$content = '<!DOCTYPE html>';
			$content.= '<html lang="en" class="no-js"><head>';
			$content.= brick('title', site()->title());
			$content.= $css;
			$content.= '</head><body id="reviews-list">';
			$content.= brick('h1', 'Reviews');
			$content.= '<ul>';

			foreach($reviews as $review) {
		        $stars = '';
		        for($i=1; $i<=5; $i++) {
		          $stars.= brick('star', false, ['class' => r($i <= $review->rating, 'active')]);
		        }

		        $datetime = new DateTime($review->created_at);
		        $datetime->setTimezone($tz);

				$content.= '<li>';
				$content.= '<div class="details-container">';
				$content.= brick('div', $stars, ['class' => 'star-container']);
				$content.= brick('div', $datetime->format('n/j/Y g:iA'), ['class' => 'date']);
				$content.= '<div class="wrap">';
				$content.= r($review->name, brick('div', $review->name, ['class' => 'name']));
				$content.= r($review->email, brick('a', $review->email, ['href' => 'mailto:'.$review->email, 'class' => 'email']));
				$content.= r($review->rating <= $page->min_rating()->value() && $review->name == '' && $review->email == '' && $review->message == '', brick('div', 'Abandoned form submission', ['class' => 'abandon']));
				$content.= r($review->rating > $page->min_rating()->value(), brick('div', '<span>Review link clicked?</span> '.r($review->clicked, 'Yes', 'No'), ['class' => 'clicked']));
				$content.= '</div>';
				$content.= '<form action="'.url('display-process').'" method="post" class="display-form">';
				$content.= brick('button', false, ['type' => 'submit', 'name' => 'display-submit', 'class' => r($review->display == 1, 'added', false)]);
				$content.= '<input type="hidden" name="display" value="'.$review->display.'">';
				$content.= '<input type="hidden" name="id" value="'.$review->id.'">';
				$content.= '</form>';
				$content.= '</div>';
				$content.= r($review->message, brick('blockquote', $review->message));
				$content.= '</li>';
			}
			$content.= '</ul>';
			$content.= $js;
			$content.='</body></html>';

			return new Response($content);
		}
	],

	[
		'pattern' => 'display-process',
		'method'  => 'POST',
		'ajax'	  => true,
		'action'  => function() use($db) {
			try {

				$actions = [
					[
						'_action' => 'db_update',
						'table'	  => 'reviews',
						'nonSerts' => ['id'],
						'spamLog' => r::data(),
						'where' => ['id' => get('id')]
					]
				];

				$form = ivform('reviews', [
					'actions' => $actions,
					'ignores' => ['/'.url::path()]
				]);

				$return = [
					'success' => 1,
					'display' => true,
				];

				return new Response($return, 'json');

			} catch (Exception $e) {

				return new Response([
					'success' => 0,
					'message' => $e->getMessage()
				], 'json');	
				
			}
		}
	],

	[
		'pattern' => 'leave-a-review',
		'action'  => function() use($page, $customCss) {
			c::set('kirbytext.snippets.post',[
			  '{' => '[',
			  '}' => ']'
			]);

			$content = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"';
			$content.= '<html xmlns="http://www.w3.org/1999/xhtml" lang="en">';
			$content.= '<head>';
			$content.= '<title>Leave a Review</title>';
			$content.= '<style>'.file_get_contents(__DIR__ . DS . 'assets' . DS . 'css' . DS . 'email.css').'</style>';
			$content.= $customCss;
			$content.= '</head><body>';
			$content.= '<table width="100%" align="center" style="max-width: 616px"><tbody>';
			$content.= brick('tr', clearSpace(3, false, 80, true));
			$content.= '<tr><td colspan="3"><a href="'.url().'">'.$page->image($page->logo()).'</a></td></tr>';
			$content.= brick('tr', clearSpace(3, false, 48, true));
			$content.= '<tr><td colspan="3" style="background-color: #FFFFFF; border: 1px solid #EEEEEE;"><table align="center"><tbody>';
			$content.= brick('tr', clearSpace(3, false, 80, true));
			$content.= '<td>'.clearSpace(false, 20);
			$content.= '<td style="max-width: 475px">'.$page->email_text()->kt().'</td>';
			$content.= clearSpace(false, 20).'</td>';
			$content.= brick('tr', clearSpace(3, false, 80, true));
			$content.= '</tbody></table></td></tr>';
			$content.= '<tr><td colspan="3" height="80" style="line-height: 80px; font-size: 80px; border-bottom: 1px solid #EEEEEE;"></td></tr>';
			$content.= '<tr><td colspan="3" height="100" style="color: #999999;" class="footer"><forwardtoafriend>Forward to a Friend</forwardtoafriend></td></tr>';
			$content.= '<tr><td width="203" style="color: #999999;">'.$page->email_company()->value().'</td>';
			$content.= '<td width="203" style="border-left: 1px solid #BCBCBC; border-right: 1px solid #BCBCBC;" class="footer"><a href="'.url().'" style="color: #999999!important;">Visit our Website</a></td>';
			$content.= '<td width="203" class="footer"><a href="'.$page->social_link()->value().'" style="color: #999999!important;">'.$page->email_social()->value().'</a></td></tr>';
			$content.= '<tr><td colspan="3" style="color: #999999;" class="footer">'.$page->email_footer()->kt().'</td></tr>';
			$content.= '<tr><td colspan="3" height="65" style="color: #999999 !important;" class="footer"><unsubscribe>Unsubscribe</unsubscribe></td></tr>';
			$content.= brick('tr', clearSpace(3, false, 80, true));
			$content.= '</tbody></table>';
			$content.= '</body></html>';

			return new Response($content);
		}
	]
]);