<?php
// namespace block_taskdisplay;
// defined('MOODLE_INTERNAL') || die();

use external_function_parameters;
use external_api;
use external_multiple_structure;
use external_single_structure;
use external_value;
use block_taskdisplay\output\chart_data as chart_data;
require_once("$CFG->libdir/externallib.php");

class block_taskdisplay_external extends external_api {

    public static function loaddata_parameters(){
        return new external_function_parameters(
            array(

            )
        );
    }

    public static function loaddata_returns(){
        
        // return new external_single_structure(
        //     array(
        //         'courses' => new external_multiple_structure(
        //             new external_single_structure(
        //                 array(
        //                     'course_name' => new external_multiple_structure(
        //                         new external_single_structure(
        //                             array(
        //                                 'assignment_name' => new external_value(PARAM_TEXT),
        //                                 'number_of_assignments' => new external_value(PARAM_INT),
        //                                 'submitted_assignments' => new external_value(PARAM_INT),
        //                             )
        //                         )
        //                     )
        //                 )
        //             )
        //         )
        //     )
        // );
            // new external_single_structure(
            //     array(
            //         'first' =>  new external_value(PARAM_TEXT),
            //         'second' => new external_value(PARAM_INT),
            //     )
            // );
        
        return new external_multiple_structure(
            new external_single_structure(
                array(
                    'course_name' =>  new external_value(PARAM_TEXT),
                    'number_of_assignments' => new external_value(PARAM_INT),
                    'submitted_assignments' => new external_value(PARAM_INT),
                    'noAssignments' => new external_value(PARAM_BOOL),
                    'assignments' => new external_multiple_structure(
                        new external_single_structure(
                            array(
                                'assignment_name' => new external_value(PARAM_TEXT),
                                'is_submitted' => new external_value(PARAM_TEXT),
                            )
                        )
                    )
                )
            )
        );
    }

    public static function loaddata(){
        $data = chart_data::getChartData();
        $transformedData = array();
        foreach($data['courses'] as $key=>$course){
            $courseObject = new stdClass;
            $courseObject->course_name = $key;
            $courseObject->number_of_assignments = $course['number_of_assignments'];
            $courseObject->submitted_assignments = $course['submitted_assignments'];
            $courseObject->noAssignments = $course['noAssignments'];
            $assignmentArray = array();
            foreach($course as $key_assignment=>$assignment){
                    if($key_assignment!='number_of_assignments' && $key_assignment!='submitted_assignments' && 
                    $key_assignment!='noAssignments'){
                    $assignmentObject = new stdClass;
                    $assignmentObject->assignment_name = $key_assignment;
                    $assignmentObject->is_submitted = $assignment;
                    $assignmentArray[] = $assignmentObject;
                }
            }
            $courseObject->assignments = $assignmentArray;
            $transformedData[] = $courseObject;
        }


        // $object = new stdClass;
        // $object->course_name = 'first course';
        // $object->number_of_assignments = 7;
        // $object->submitted_assignments = 5;
        // $object->noAssignments = false;

        // $nestedObject = new stdClass;
        // $nestedObject->assignment_name = 'first assignment';
        // $nestedObject->is_submitted = 'submitted';
        // $nestedArray[] = $nestedObject;

        // $object->assignments = $nestedArray;
        // $test[] = $object;
        return $transformedData;
    }
}