<?php

function customCss($page, $campaign_page) {

	$customCss = '<style>';

	if ($page) {
		if(getCampaignField('hero_border_color',$campaign_page,$page)->isNotEmpty()) {
			$customCss.= '#hero {';
			$customCss.= 'border-bottom: 0.35rem solid '.getCampaignField('hero_border_color',$campaign_page,$page)->value().';';
			$customCss.= '}';
		};
		if(getCampaignField('button_color',$campaign_page,$page)->isNotEmpty()) {
			$customCss.= 'button, .button {';
			$customCss.= 'background-color: '.getCampaignField('button_color',$campaign_page,$page)->value().';';
			$customCss.= '}';
		};
		if(getCampaignField('button_hover',$campaign_page,$page)->isNotEmpty()) {
			$customCss.= 'button:hover, .button:hover {';
			$customCss.= 'background-color: '.getCampaignField('button_hover',$campaign_page,$page)->value().';';
			$customCss.= '}';
		};
		if(getCampaignField('icon_color',$campaign_page,$page)->isNotEmpty()) {
			$customCss.= '.fa-smile-o, .fa-frown-o, .fa-heart-o'.r($page->star_use() == '1', ', star').' {';
			$customCss.= 'color: '.getCampaignField('icon_color',$campaign_page,$page)->value().';';
			$customCss.= '}';
		};
	}

	$customCss.= '</style>';
	return $customCss;
}

function buttonTag($text, $link, $bg = '#9A9A9A') {
	$content = '<table width="100%"><tbody>';
	$content.= brick('tr', clearSpace(false, false, 25, true));
	$content.= '<tr>';
	$content.= clearSpace(false, 20);
	$content.= '<td><table class="button" align="center" bgcolor="'.$bg.'"><tbody>';
	$content.= brick('tr', clearSpace(3, false, 15, true));
	$content.= '<tr>';
	$content.= clearSpace(false, 25);
	$content.= brick('td', '<a href="'.$link.'" style="color: #FFFFFF!important;">'.$text.'</a>');
	$content.= clearSpace(false, 25);
	$content.= '</tr>';
	$content.= brick('tr', clearSpace(3, false, 15, true));
	$content.= '</tbody></table></td>';
	$content.= clearSpace(false, 20);
	$content.= '</tr></tbody></table>';

	return $content;
}

function clearSpace($colspan=false, $width=false, $height=false, $style=false) {
	return '<td'.r($colspan, ' colspan="'.$colspan.'"').r($width, ' width="'.$width.'"').r($height, ' height="'.$height.'"').r($style, ' style="line-height: '.$height.'px; font-size: '.$height.'px;"').'>&nbsp;</td>';
}

/**
 * Get the value of a field from the campaign page or the appropriate fallback from reviews config if availible
 * @param  string $name     [The name of the field to return]
 * @param  object $campaign [The campaign page]
 * @param  object $config   [The reviews config page]
 * @return object $field    [A kirby field object, or false]
 */
function getCampaignField($name, $campaign, $config) {
	$field = false;

	if($campaign) {
		$field = $campaign->{$name}();
	} else if($config && !$campaign) {
		$field = $config->{$name}();
	}

	return $field;
}

/**
 * Get an image from the campaign page or a fallback from the config
 * @param  string $name     [The name of the image to return]
 * @param  object $campaign [The campaign page]
 * @param  object $config   [The reviews config page]
 * @return object $img      [An image, or false]
 */
function getCampaignImage($name, $campaign, $config) {
	$img = false;

	if($campaign) {
		$image = $campaign->{$name}();
		$img = $campaign?$campaign->image($image):'';
	} else if($config && !$campaign) {
		$image = $config->{$name}();
		$img = $config?$config->image($image):'';
	}

	return $img;
}
