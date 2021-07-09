<?php
defined('MOODLE_INTERNAL') || die();

$observers = array(
    array(
        'eventname' => '\mod_assign\event\submission_graded',
        'callback' => '\block_taskdisplay\observer::course_graded',
    ),
);