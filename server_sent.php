<?php
require_once(__DIR__.'/../../config.php');
//require_login();
//require_sesskey();
//global $CFG;
//global $SESSION;
//global $PAGE;
//require_once($CFG->dirroot . '/blocks/taskdisplay/server_sent.php');
use block_taskdisplay\observer as observer;
//require_once($CFG->dirroot . '/server-sent.php');
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');

$data = observer::hasEventOcurred();
//$cache = \cache::make('block_taskdisplay', 'databaseEvent');
//$data = $SESSION->sesskey();
echo "data: ".$data."\n\n";
//echo "data: hallo test\n\n";