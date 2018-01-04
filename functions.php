<?php
/**
 * Conduent functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Conduent
 */

function conduent_functions_init() 
{
    // If there are any specific includes that must load first or in a specific order then add them here,
    // for example
    require_once get_template_directory() . '/inc/extras.php';

    // path to includes
    $incPath = get_template_directory() . '/inc/';

    // Find all .php files in inc/ directory
    $dirIterator = new RecursiveDirectoryIterator($incPath);
    $iterator = new RecursiveIteratorIterator($dirIterator, RecursiveIteratorIterator::SELF_FIRST);
    $regexIterator = new RegexIterator($iterator, '/^.+\.php$/i', RecursiveRegexIterator::GET_MATCH);

    // Loop each file and include once
    foreach($regexIterator as $name => $object) {
        // We require once in case at has been included above already
        require_once $name;
    }
}
conduent_functions_init();