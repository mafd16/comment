<?php
/**
 * Configuration file for view container.
 */
return [

    // Paths to look for views, without ending slash.
    // Add "/vendor/mafd16/comment/view" in your anax/config/view.php:
    "path" => [
        ANAX_APP_PATH . "/view",
        ANAX_INSTALL_PATH . "/view",
        ANAX_INSTALL_PATH . "/vendor/anax/view/view",
        ANAX_INSTALL_PATH . "/vendor/mafd16/comment/view",
    ],

    // This below is for testing purposes only
    "suffix" => ".php",

    // Include files before including the view template file.
    // Use this to expose helper functions for the view.
    "include" => [
        //ANAX_APP_PATH . "/view/function/helper.php",
        ANAX_INSTALL_PATH . "/vendor/anax/view/src/View/ViewHelperFunctions.php",
    ]
];
