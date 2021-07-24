<?php
// namespace block_taskdisplay;
// defined('MOODLE_INTERNAL') || die();

use external_function_parameters;
use external_api;
use external_multiple_structure;
use external_single_structure;
use external_value;

require_once("$CFG->libdir/externallib.php");

class block_taskdisplay_external extends external_api {

    public static function loaddata_parameters(){
        return new external_function_parameters(
            array(

            )
        );
    }

    public static function loaddata_returns(){
        return new external_value(PARAM_TEXT);
    }

    public static function loaddata(){
        // $obj = new stdClass;
        // $obj->course = 'new response text';
        // return $obj;
        return 'new response text';
    }
}