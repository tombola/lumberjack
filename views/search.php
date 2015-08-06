<?php

function search_view ($context) {
    Timber::render('category/search.twig', $context);
}

call_user_func('search_view', $context);

