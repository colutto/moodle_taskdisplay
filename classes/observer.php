<?php
namespace block_taskdisplay;
use core\session\exception;
defined('MOODLE_INTERNAL') || die();

class observer{
    public static $events = array();

    public static function course_graded(\mod_assign\event\submission_graded $event){
        

    }
    public static function hasEventOcurred(){
        return "erster test der funktion";
    }
}

//header('Content-Type: text/event-stream');
//header('Cache-Control: no-cache');
//echo "data: first test \n\n";

//echo "data: before while ";
//while(true){
//    if (observer::hasEventOcurred()){
//    echo "data: first test 3 \n\n";
//    ob_end_flush();
//    flush();
//    if (connection_aborted()){
//        break;
//    }
//    sleep(3);
//    }
//}
//echo "after while\n\n";
//flush();