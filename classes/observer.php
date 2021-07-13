<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Task Display - keeps track of student assignments and displays it in charts.
 *
 * @package     block_taskdisplay
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 * @author      Stefan Colutto
 */
namespace block_taskdisplay;
defined('MOODLE_INTERNAL') || die();

class observer{
    public static $events = array(); // stores the event when someone got graded

    /**
     * @param \mod_assign\event\submission_graded $event Includes all the information which
     * we need to assign the event to the related user.
     */
    public static function course_graded(\mod_assign\event\assessable_submitted $event){
        global $DB;
        $user_id = array();
        $user_id->user_id = $event->userid;
        if (!$DB->record_exists('block_taskdisplay', $user_id)){
            $data = new \stdClass();
            $data->user_id = $event->userid;
            $data->course_id = $event->courseid;
            $DB->insert_record('block_taskdisplay', $data);
        }
    }
}