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

require_once(__DIR__.'/../../config.php');

/**
 * Server-sent messaging system to trigger the clients if the data of the user
 * has changed.
 */
use block_taskdisplay\observer as observer;
header('Content-Type: text/event-stream');
header('Cache-Control: no-cache');
global $USER;
global $DB;
while(true){
    $conditions = array();
    $conditions->user_id = [$USER->id];
    $occurences = $DB->count_records('block_taskdisplay', $conditions);
    if($occurences != 0){
        echo "data: event occured\n\n";
        $DB->delete_records('block_taskdisplay', $conditions);
    }
}

