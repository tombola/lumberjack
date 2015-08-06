<?php
/**
 * Archive Views
 *
 * Usage:
 * Calls a function based on the archive of a page, in the style of `[archive]_view`
 * Hyphens are converted into underscores automatically,
 * e.g. case-studies -> case_studies_view
 *
 * Global context changes should be made either after Initial Set Up in
 * this file, or in the `functions.php` file.
 *
 * Page specific context goes in the its `_view` function below.
 *
 * You have access to the $context and the $post ($context['post']).
 *
 */

function generic_view ($context) {
    $context['archive_title'] = get_the_archive_title();
	Timber::render('archive/generic.twig', $context);
}


function project_view ($context) {
    // $context['sidebar'] = get_dynamic_sidebar('sidebar-1');
    // Use Archives for Custom Post Types plugin
    // $args = array(
    //     'post_type' => 'project',
    //     'type' => 'yearly',
    //     'before' => "<p>",
    //     'after' => "</p> \n",
    //     'echo' => FALSE
    // );
    // // $context['sidebar'] = wp_get_archives_cpt($args);
    // $context['types'] = get_taxonomy_list('type');
    // $context['materials'] = get_taxonomy_list('material');

    $context['sidebar'] = Timber::get_sidebar('sidebar.php', $context);
    $context['archive_title'] = get_the_archive_title();
    
    Timber::render('archive/project.twig', $context);
}


add_filter( 'get_the_archive_title', function ( $title ) {
    if(($pos = strpos($title, ':')) !== false)
    {
       $title = substr($title, $pos + 1);
    }
    else
    {
       $title = get_last_word($title);
    }
    return $title;
});


// DO NOT DO ANYTHING AFTER THIS!

$view = str_replace('-', '_',strtolower(get_query_var('post_type')).'_view');
if (function_exists ($view)) {
	call_user_func($view, $context);
}
else {
	call_user_func('generic_view', $context);
}
