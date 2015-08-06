<?php
/**
 * Post Views
 *
 * Usage:
 * Calls a function based on the type of the post, in the style of `[type]_view`
 * Hyphens are converted into underscores automatically,
 * e.g. case-study -> case_study_view
 *
 * Global context changes should be made either after Initial Set Up in
 * this file, or in the `functions.php` file.
 *
 * Post specific context goes in the its `_view` function below.
 *
 * You have access to the $context and the $post ($context['post'])
 *
 */

// Generic Post View, e.g. blog posts
function post_view ($context) {
	Timber::render('single/post.twig', $context);
}

function project_view ($context) {
    $context['sidebar'] = Timber::get_sidebar('sidebar.php', $context);
    Timber::render('single/project.twig', $context);
}

function generic_view ($context) {
  $context['sidebar_widgets'] = Timber::get_widgets('sidebar-1');
	Timber::render('single/generic.twig', $context);
}




// DO NOT DO ANYTHING AFTER THIS!
$view = str_replace('-', '_',$post->post_type.'_view');
if (function_exists ($view)) {
	call_user_func($view, $context);
}
else {
	call_user_func('generic_view', $context);
}
