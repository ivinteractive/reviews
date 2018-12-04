<?php

require_once(__DIR__ . DS . 'lib' . DS . 'reviewsFunctions.php');

$page = page(c::get('reviews-dir', 'reviews'));
$db = defaultDB()->table('reviews');

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
if(!c::get('reviews-email-snippet')) {
	$kirby->set('snippet', 'reviews-email', __DIR__ . DS . 'assets' . DS . 'snippets' . DS . 'reviews-email.php');
}
$kirby->set('snippet', 'reviews-header', __DIR__ . DS . 'assets' . DS . 'snippets' . DS . 'reviews-header.php');
$kirby->set('snippet', 'reviews-footer', __DIR__ . DS . 'assets' . DS . 'snippets' . DS . 'reviews-footer.php');
$kirby->set('snippet', 'reviews-stars', __DIR__ . DS . 'assets' . DS . 'snippets' . DS . 'reviews-stars.php');
$kirby->set('snippet', 'reviews-feedback', __DIR__ . DS . 'assets' . DS . 'snippets' . DS . 'reviews-feedback.php');
$kirby->set('snippet', 'reviews-external', __DIR__ . DS . 'assets' . DS . 'snippets' . DS . 'reviews-external.php');
$kirby->set('snippet', 'reviews-mailer', __DIR__ . DS . 'assets' . DS . 'snippets' . DS . 'reviews-mailer.php');

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
