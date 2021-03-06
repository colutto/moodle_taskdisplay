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

// $settings->add(new admin_setting_heading(
//     'headerconfig',
//     get_string('headerconfig', 'block_taskdisplay'),
//     get_string('descconfig', 'block_taskdisplay')
// ));

// $settings->add(new admin_setting_configcheckbox(
//     'simplehtml/Allow_HTML',
//     get_string('labelallowhtml', 'block_taskdisplay'),
//     get_string('descallowhtml', 'block_taskdisplay'),
//     '0'
// ));