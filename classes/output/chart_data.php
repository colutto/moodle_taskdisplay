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
namespace block_taskdisplay\output;

use core\session\exception;

defined('MOODLE_INTERNAL') || die();

class chart_data{
    public static $ARECHARTMULTISERIES = 'areaChartMultiSeries';
    public static $BARCHARTVERTICAL = 'barChartVertical';
    public static $BUBBLECHART = 'bubbleChart';
    public static $PARTICLEPLOT = 'particlePlot';
    public static $SCATTERPLOT = 'scatterPlot';
    public static $SURFACEPLOT = 'surfacePlot';
    public static $RIBBONCHARTMULTISERIES = 'ribbonChartMultiSeries';
    public static $BARCHARTMULTISERIES = 'barChartMultiSeries';
    private $page;

    function __construct($page){
        $this->page = $page;
}
    public function initialiseChart(){
        global $USER;
        global $DB;
        $user_courses = enrol_get_my_courses();
        $data = array();
        foreach ($user_courses as $course){
            /*creating the $data nested array to pass it to the JavaScript function for defining the charts.
            in the first foreach loop we are going through all of the users courses*/
            $course_id = $course->id;
            $course_name = $course->fullname;
            $data[$course_name] = array();
            $course_condition['course'] = $course_id;
            $assignments = $DB->get_records('assign', $course_condition);
            $number_assignemnts = 0;
            $submitted_assignments = 0;
            foreach ($assignments as $assignment){
                /*In the second foreach loop we are going through all the assignments of the different
                courses from the user and getting the total number of assignments for a course and the number
                of already submitted assignments as well as the status of each assignment*/
                $number_assignemnts +=1;
                $assignment_name = $assignment->name;
                $assignment_id = $assignment->id;
                $data[$course_name][$assignment_name] = array();
                $assignment_condition = array('userid'=>$USER->id, 'assignment'=>$assignment_id);
                $assignment_submission = $DB->get_record('assign_submission', $assignment_condition);
                $data[$course_name][$assignment_name] = array('status'=>$assignment_submission->status);
                if ($assignment_submission->status=='submitted'){
                    $submitted_assignments +=1;
                }
            }
            $data[$course_name]['number_of_assignments'] = $number_assignemnts;
            $data[$course_name]['submitted_assignments'] = $submitted_assignments;
        }

        $this->page->requires->js_call_amd('block_taskdisplay/main', 'initialise', $data);

    }
}