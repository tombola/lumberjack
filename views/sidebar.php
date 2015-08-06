<?php
# sidebar
// $context = array();
$args = array(
    'post_type' => 'project',
    'type' => 'yearly',
    // 'before' => "<p>",
    // 'after' => "</p> \n",
    'echo' => FALSE
);
$context['years'] = wp_get_archives_cpt($args);
$context['types'] = get_taxonomy_list('type');
$context['materials'] = get_taxonomy_list('material');

Timber::render('partials/common/sidebar.twig', $context);
