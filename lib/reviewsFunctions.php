<?php

function customCss($page) {
	$customCss = '<style>';
	if($page->button_color() != '') {
	$customCss.= 'button, .button {';
	$customCss.= 'background-color: '.$page->button_color()->value().';';
	$customCss.= '}';
	};
	if($page->button_color() != '') {
	$customCss.= 'button:hover, .button:hover {';
	$customCss.= 'background-color: '.$page->button_hover()->value().';';
	$customCss.= '}';
	};
	if($page->icon_color() != '') {
	$customCss.= '.fa-smile-o, .fa-frown-o, .fa-heart-o'.r($page->star_use() == '1', ', star').' {';
	$customCss.= 'color: '.$page->icon_color()->value().';';
	$customCss.= '}';
	};
	$customCss.= '</style>';

	return $customCss;
}

function buttonTag($text, $link) {
	$content = '<table width="100%"><tbody>';
	$content.= brick('tr', clearSpace(false, false, 25, true));
	$content.= '<tr>';
	$content.= clearSpace(false, 20);
	$content.= '<td><table class="button" align="center"><tbody>';
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