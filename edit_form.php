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

class block_taskdisplay_edit_form extends block_edit_form {

    protected function specific_definition($mform) {
        global $COURSE;
        // Section header title according to language file.
        $mform->addElement('header', 'config_header', get_string('blocksettings', 'block_taskdisplay'));
        // $mform->addElement('submit', 'submit', get_string('addbutton', 'block_taskdisplay'));
        // $mform->addElement('button', 'intro', get_string('deletebutton', 'block_taskdisplay'));

        $options = array('multiple' => true, 'includefrontpage' => true);                                                           
        $mform->addElement('course', 'mappedcourses', get_string('chooseCourse', 'block_taskdisplay'), $options);         

    }
}