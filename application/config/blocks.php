<?php
$block_postions = array(
	'content_middle' => 'Content Middle',
	'content_left' => 'Content Left',
	'content_right' => 'Content Right',
	'all_page_right' => 'Right',
	'site_header' => 'Site Header',
	'site_footer' => 'Site Footer',
	'site_leftmenu' => 'Site Left Menu',
	'news_scroll' => 'News Scroll'
	
);
$pages['all'] = array(
	'title' => 'All',
	'positions' => 'all_page_right,site_header,site_footer,site_leftmenu, content_middle'
);
$pages['frontend/frontend/index'] = array(
	'title' => 'Home',
	'positions' => 'content_left, content_middle, content_right, content_middle'
);




$block_types = array(
	"textwidgets" => "Text Widget",
	"slidernews" => "Slider News",
	"menus" => "Menus",
	"newsletter" => "News Letter",	
);