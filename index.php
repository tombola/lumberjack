<?php
/*
This glossary will tell you where to see/put a view:

views/single.php    - a single post of any type
views/page.php      - a page
views/category.php  - a category
views/404.php       - 404 error page

You can find page templates, layouts, and partials in the templates/ directory.
*/

// Initial Set Up
$timberTimer = TimberHelper::start_timer();
$context = Timber::get_context();
$post = $context['post'] = new TimberPost();
$view = 'index';

// Make Global Context/Post changes here
// Preferrably make these changes using filters in the function.php file

// Load specific views
if (is_single()) require_once 'views/single.php';
if (is_page()) require_once 'views/page.php';
if (is_404()) require_once 'views/404.php';
if (is_archive()) {
	if (is_tax()) {
		require_once 'views/tax.php';
	}
	elseif (is_category()) {
		require_once 'views/category.php';
	}
	else {
		require_once 'views/archive.php';
	}
}
if (is_search()) {
    require_once 'views/search.php';
}

// echo '<br/>Rendering '.$view.' took '.TimberHelper::stop_timer($timberTimer);
