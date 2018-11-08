<?php 

$options = [
  [
    'text' => 'Edit Content',
    'icon' => 'pencil',
    'link' => panel::instance()->urls()->index().'/pages/'.c::get('reviews-uri', 'reviews').'/edit'
  ]
];

$options[] = [
  'text' => 'Reviews List',
  'icon' => 'file-text-o',
  'link' => url(c::get('reviews-list-uri', 'reviews-list')),
  'target' => '_blank'
];

return array(
  'title' => 'Recent Reviews',
  'options' => $options,
  'html' => function() {

    $tz = new DateTimeZone(c::get('timezone', 'America/New_York'));

    $limit = c::get('reviews-widget-count', 5);

    $table = defaultDB()->table('reviews');
    $reviews = $table
              ->order('updated_at DESC')
              ->limit($limit)
              ->all();

    $count = $table->count() - $limit;

    $content = brick('style', file_get_contents(__DIR__ . DS . '..' . DS . '..' . DS . 'assets' . DS . 'css' . DS . 'widget.css'));

    if($reviews):
      $content.= brick('p', 'Recently added reviews'.r($count > 0, ' <em>('.$count.' more...)</em>', ''));
      $content.= '<div class="dashboard-box"><ul class="dashboard-items">';

      foreach($reviews as $review) {
        $stars = '';
        for($i=1; $i<=5; $i++) {
          $stars.= brick('star', false, ['class' => r($i <= $review->rating(), 'active')]);
        }
        $by = r($review->email, 'by '.$review->email.' ');
        $datetime = new DateTime($review->updated_at());
        $datetime->setTimezone($tz);
        $content.= brick('li', brick('div', $stars, ['class' => 'star-container']).$by.'on '.$datetime->format('n/j/Y g:iA'), ['class' => 'dashboard-item']);
      }

      $content.='</ul></div>';
    endif;

    return brick('div', $content, ['class'=>'reviews-widget']);

  }  
);