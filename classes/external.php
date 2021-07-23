<?php
namespace block_taskdisplay;

use external_function_parameters;
use external_api;
use external_multiple_structure;
use external_single_structure;
use external_value;

// require_once("$CFG->libdir/externallib.php");

class block_taskdisplay_external extends external_api {

    public static function loaddata_parameters(){
        return new external_function_parameters(
            array(

            )
        );
    }

    public static function loaddata_returns(){
        return new external_multiple_structure(
            new external_single_structure(
                array(
                    'course' => new external_value(PARAM_TEXT, 'name of the course'),
                )
            )
        );
    }

    public static function loaddata(){
        return 'new course to return';
    }
}