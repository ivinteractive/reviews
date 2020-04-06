<?php

require_once(__DIR__ . DS . 'reviewsFunctions.php');

$css = css('https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700');
$css.= css('https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css');
$css.= '<style>'.file_get_contents(__DIR__ . DS . '..' . DS .'assets' . DS . 'css' . DS . 'reviews.css').'</style>';

$customCss = customCss($page, $page);

$js = '<script src="https://cdnjs.cloudflare.com/ajax/libs/reqwest/2.0.5/reqwest.min.js"></script>';
$js.= '<script>'.file_get_contents(__DIR__ . DS . '..' . DS . 'assets' . DS . 'js' . DS . 'reviews.js').'</script>';

kirby()->routes([
	[
		'pattern' => c::get('reviews-uri', 'reviews').'/(:any)',
		'action'  => function($campaign) use($page, $css, $js) {

			$campaign_page = page(c::get('reviews-dir', 'reviews').'/'.$campaign);

			$customCss = customCss($page, $campaign_page);

			$logo = getCampaignImage('logo',$campaign_page,$page, ['width' => '118', 'alt' => 'Logo','class'=>'campaign-logo']);

			$hero = getCampaignImage('hero',$campaign_page,$page);

			$min_rating = getCampaignField('min_rating',$campaign_page,$page);
			$min_rating = $min_rating?$min_rating->value():'0';

			$utm_source = get('utm_source', url());
			$link_id = get('link_id');

			$snippet_values = [
				'page' => $page,
				'campaign_page' => $campaign_page,
				'logo' => $logo,
				'css' => $css.$customCss,
				'js' => $js,
				'min_rating' => $min_rating,
				'utm_source' => $utm_source,
				'link_id' => $link_id,
				'hero' => $hero
			];

			$content = snippet('reviews-stars', $snippet_values, true);

			return new Response($content);
		}
	],

	[
		'pattern' => c::get('reviews-uri', 'reviews'),
		'action'  => function() use($page, $css, $customCss, $js) {

			$logo = getCampaignImage('logo',$page,$page, ['width' => '118', 'alt' => 'Logo','class'=>'campaign-logo']);

			$hero = getCampaignImage('hero',$page,$page);

			$min_rating = getCampaignField('min_rating',$page,$page);
			$min_rating = $min_rating?$min_rating:'0';

			$utm_source = get('utm_source', url());
			$link_id = get('link_id');

			$snippet_values = [
				'page' => $page,
				'campaign_page' => $page,
				'logo' => $logo,
				'css' => $css.$customCss,
				'js' => $js,
				'min_rating' => $min_rating,
				'utm_source' => $utm_source,
				'link_id' => $link_id,
				'hero' => $hero
			];

			$content = snippet('reviews-stars', $snippet_values, true);

			return new Response($content);
		}
	],

	[
		'pattern' => 'reviews-process/(:any)',
		'method'  => 'POST',
		'ajax'	  => true,
		'action'  => function($campaign) use($page, $db) {

			$campaign_page = page(c::get('reviews-dir', 'reviews').'/'.$campaign);

			try {
				foreach(getCampaignField('review_links',$campaign_page,$page)->toStructure() as $reviewLink) {
					if($reviewLink->link_id()->value() == get('link_id') || ($reviewLink->default()->isTrue() && !get('link_id')))
						$externalReview = $reviewLink;
				}

				$success = kirbytext($campaign_page->success_text());

				$page_type = get('rating-type');

				$rating = get('rating');
				$min_rating = 100;

				if($page_type === 'stars') {
					$min_rating = get('min-rating');
				}

				$existingReview = $db->findBy('token', get('token'));

				$subject = getCampaignField('feedback_subject',$campaign_page,$page);
				$recip_name = getCampaignField('feedback_recipient_name',$campaign_page,$page);
				$recip_email = getCampaignField('feedback_recipient',$campaign_page,$page);
				$sender_name = getCampaignField('feedback_sender_name',$campaign_page,$page);
				$sender_email = getCampaignField('feedback_sender',$campaign_page,$page);

				if($campaign_page->saves_in()->value()==='portal')
					$saveAction = [
						'_action' => 'crm',
					];
				else
					$saveAction = [
						'_action' => 'db_insert',
						'table'	  => 'reviews',
						'nonSerts' => ['website','submit','min-rating','link_id'],
						'spamLog' => r(get('website'), r::data(), false),
						'where' => $existingReview ? ['id' => $existingReview->id] : null
					];

				$actions = [
					$saveAction,
					[
						'_action' => 'email',
						'subject' => $subject->value(),
						'snippet' => 'reviews-email',
						'sender' => $sender_name->value().' <'.$sender_email->value().'>',
						'to' => $recip_name->value().' <'.$recip_email->value().'>',
						'replyTo' => get('name').' <'.get('email').'>',
					]
				];

				$required = [
					'name' => '',
					'email' => 'email',
					'message' => ''
				];

				$form = ivform('reviews', [
					'actions' => $actions,
					'required' => $required,
					'ignores' => ['/'.url::path()]
				]);

				$errors = $form->showErrors();
				$form_output = $form->message();

				if(count($errors)) {
					$message = brick('div', 'Please correct the following errors:', ['id'=>'form-message','class'=>'error']);
				} else {
					$message = brick('div', kirbytext($success), ['id'=>'form-message','class'=>'success']);
				}

				$return = [
					'success' => 1,
					'errors' => $errors,
					'message'  => html($message),
					'high_low' => !$existingReview ? 1 : null,
					'form' => $form,
					'form_output' => $form_output
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
				// $content.= brick('button', false, ['type' => 'submit', 'name' => 'display-submit', 'class' => r($review->display == 1, 'added', false)]);
				// $content.= '<input type="hidden" name="display" value="'.$review->display.'">';
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
		'pattern' => c::get('reviews-uri', 'reviews').'/(:any)/mailer',
		'action'  => function($campaign) use($page, $customCss) {
			c::set('kirbytext.snippets.post',[
			  '{' => '[',
			  '}' => ']'
			]);

			$campaign_page = page(c::get('reviews-dir', 'reviews').'/'.$campaign);

			$hero_alt = getCampaignField('hero_alt',$campaign_page,$page);
			$logo_alt = getCampaignField('logo_alt',$campaign_page,$page);

			$mailer_values = [
				'page' => $campaign_page,
				'logo' => getCampaignImage('logo',$campaign_page,$page,['width'=>'118','alt'=>$logo_alt,'class'=>'campaign-logo']),
				'hero' => getCampaignImage('hero',$campaign_page,$page,['width'=>'616','alt'=>$hero_alt,'style'=>'display:block;width:100%']),
				'customCss' => $customCss
			];

			$content = snippet('reviews-mailer', $mailer_values, true);

			return new Response($content);
		}
	],

  [
    'pattern' => c::get('reviews-uri', 'reviews').'/(:any)/feedback',
    'action'  => function($campaign) use($page, $customCss, $css, $js) {
      c::set('kirbytext.snippets.post',[
        '{' => '[',
        '}' => ']'
      ]);

      $campaign_page = page(c::get('reviews-dir', 'reviews').'/'.$campaign);

			$customCss = customCss($page, $campaign_page);

			$logo = getCampaignImage('logo',$campaign_page,$page, ['width' => '118', 'alt' => 'Logo', 'class'=>'campaign-logo']);

			$hero = getCampaignImage('hero',$campaign_page,$page);

			$min_rating = getCampaignField('min_rating',$campaign_page,$page);
			$min_rating = $min_rating?$min_rating:'0';

			$utm_source = get('utm_source', url());
			$link_id = get('link_id');

			$snippet_values = [
				'page' => $page,
				'campaign_page' => $campaign_page,
				'logo' => $logo,
				'css' => $css.$customCss,
				'js' => $js,
				'min_rating' => $min_rating,
				'utm_source' => $utm_source,
				'link_id' => $link_id,
				'hero' => $hero
			];

      $content = snippet('reviews-feedback', $snippet_values, true);

      return new Response($content);
    }
  ],

  [
    'pattern' => c::get('reviews-uri', 'reviews').'/(:any)/leave-a-review',
    'action'  => function($campaign) use($page, $customCss, $css, $js) {
      c::set('kirbytext.snippets.post',[
        '{' => '[',
        '}' => ']'
      ]);

      $campaign_page = page(c::get('reviews-dir', 'reviews').'/'.$campaign);

			$review_links = $page->review_links()->toStructure();

      foreach($review_links as $reviewLink) {
        if($reviewLink->link_id()->value() === get('link_id') || ($reviewLink->default_link()->isTrue() && !get('link_id'))) {
          $externalReview = $reviewLink;
        } elseif($reviewLink->default_link()->isTrue() && !isset($externalReview)) {
					$externalReview = $reviewLink;
				}
      }

      $customCss = customCss($page, $campaign_page);

      $logo = getCampaignImage('logo',$campaign_page,$page, ['width' => '118', 'alt' => 'Logo','class'=>'campaign-logo']);

      $hero = getCampaignImage('hero',$campaign_page,$page);

      $min_rating = getCampaignField('min_rating',$campaign_page,$page);
      $min_rating = $min_rating?$min_rating->value():'0';

      $utm_source = get('utm_source', url());
      $link_id = get('link_id');

      $snippet_values = [
        'page' => $page,
        'campaign_page' => $campaign_page,
        'logo' => $logo,
        'css' => $css.$customCss,
        'js' => $js,
        'min_rating' => $min_rating,
        'utm_source' => $utm_source,
        'link_id' => $link_id,
        'hero' => $hero,
        'externalReview' => $externalReview
      ];

      $content = snippet('reviews-external', $snippet_values, true);

      return new Response($content);
    }
  ]
]);
