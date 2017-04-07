<?php
$block_postions = array(
	'content_middle' => 'Content Middle',
	'content_left' => 'Content Left',
	'content_right' => 'Content Right',
	'all_page_right' => 'Right',
	'site_header' => 'Site Header',
	'site_footer' => 'Site Footer',
	'site_leftmenu' => 'Site Left Menu',
	'news_scroll' => 'News Scroll',
	'latestupdate' => 'Latest Update',
	'menus' => 'Menus',
	'site_latest' => 'Site Latest Menus',
	'site_header_desktop' => 'site_header_desktop',
	'site_copyright' => 'Site Copyright',
	'way_circle' => 'Way Of life circle',
	'content_newsletter' => 'Content Newsletter',
	
	'inner_top' =>'Inner Top',
	'inner_bottom' =>'Inner Bottom',
	'inner_left' =>'Inner Left',
	'inner_right' =>'Inner Right',
	
);

$pages['all'] = array(
	'title' => 'All',
	'positions' => 'all_page_right,site_header, site_header_desktop, site_footer,site_leftmenu, site_copyright, content_middle, menus, inner_top, inner_bottom, inner_right, inner_left, content_newsletter'
);
$pages['frontend/frontend/index'] = array(
	'title' => 'Home',
	'positions' => 'content_left, content_middle, way_circle, content_newsletter, site_latest'
);


$block_types = array(
	"textwidgets" => "Text Widget",
	"latestupdate" => "Latest Update",
	"slidernews" => "Slider News",
	"menus" => "Menus",
	"wayoflife" => "Way Of Life",
	"newsletter" => "News Letter",	
	"breadcrumbs" => "Breadcrumbs",
	"contactforms" => "Contact Forms",
	"chakra" => "Chakra",
	"gallery" => "Gallery",
	"blog" => "Blog",
	"photooftheday" => "Photo Of The Day",
);