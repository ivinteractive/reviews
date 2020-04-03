<?php

require_once(__DIR__ . DS . 'lib' . DS . 'reviewsFunctions.php');

$page = page(c::get('reviews-dir', 'reviews'));
$db = defaultDB()->table('reviews');
// $iv_logo_path = getcwd().'/../site/plugins/reviews/assets/images/ivi-logo.png';
//
// if (!file_exists('../public/assets/images/ivi-reviews-logo.png')){
// 	copy($iv_logo_path, '../public/assets/images/ivi-reviews-logo.png');
// }

// Set up blueprints
if(!c::get('reviews-blueprint') && !c::get('reviews-config-blueprint')) {
	if (c::get('reviews-blueprint-plain')) {
		$kirby->set('blueprint', 'reviews', __DIR__ . DS . 'assets' . DS . 'blueprints' . DS . 'reviews-plain.yaml');
		$kirby->set('blueprint', 'reviews-config', __DIR__ . DS . 'assets' . DS . 'blueprints' . DS . 'reviews-config-plain.yaml');
	} else {
		$kirby->set('blueprint', 'reviews', __DIR__ . DS . 'assets' . DS . 'blueprints' . DS . 'reviews.yaml');
		$kirby->set('blueprint', 'reviews-config', __DIR__ . DS . 'assets' . DS . 'blueprints' . DS . 'reviews-config.yaml');
	}
} elseif (!c::get('reviews-config-blueprint') && c::get('reviews-blueprint')) {
	$kirby->set('blueprint', 'reviews', kirby()->roots()->blueprints() . DS . c::get('reviews-config-blueprint').'.yaml');
} elseif (!c::get('reviews-blueprint') && c::get('reviews-config-blueprint')) {
	$kirby->set('blueprint', 'reviews', kirby()->roots()->blueprints() . DS . c::get('reviews-blueprint').'.yaml');
} else {
	$kirby->set('blueprint', 'reviews', kirby()->roots()->blueprints() . DS . c::get('reviews-blueprint').'.yaml');
	$kirby->set('blueprint', 'reviews', kirby()->roots()->blueprints() . DS . c::get('reviews-config-blueprint').'.yaml');
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

// Set up snippets
$snippets_dir = __DIR__ . DS . 'assets' . DS . 'snippets';
$snippets = scandir($snippets_dir);
foreach ($snippets as $snippet):
	$snippet_details = pathinfo($snippets_dir . DS . $snippet);
	if($snippet_details['extension'] === 'php') {
		$kirby->set('snippet', $snippet_details['filename'], $snippets_dir . DS . $snippet);
	}
endforeach;

if(c::get('reviews-email-snippet')) {
	$kirby->set('snippet', 'reviews-email', c::get('reviews-email-snippet'));
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

require_once(__DIR__ . DS . 'lib' . DS . 'routes.php');
