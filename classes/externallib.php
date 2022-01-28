<?php
use external_function_parameters;
use external_api;
use external_multiple_structure;
use external_single_structure;
use external_value;
require_once("$CFG->libdir/externallib.php");
/**
 * The block_taskdisplay_external class is needed for the AJAX data transfer between the server and the client.
 * The documentation for this class can be found in the moodle Web services API 
 * (https://docs.moodle.org/dev/Web_services_API).
 */
class block_taskdisplay_external extends external_api {
    /**
     * The loaddata_parameters is usually used if there are parameters to transfer when the loaddata method
     * is called at the client side. In this case there aren't any parameters to transfer.
     */
    public static function loaddata_parameters(){
        return new external_function_parameters(
            array(

            )
        );
    }
    /** 
     * The loaddata_return function is used to return the data to the client if a loaddate call occurred 
     * at the client side. There is just one return paramater which gets defined in the loaddata method.
    */
    public static function loaddata_returns(){
        return new external_multiple_structure(
            new external_single_structure(
                array(
                    'course_name' =>  new external_value(PARAM_TEXT),
                    'number_of_users' => new external_value(PARAM_INT),
                    'assignments' => new external_multiple_structure(
                        new external_single_structure(
                            array(
                                'assignment_name' => new external_value(PARAM_TEXT),
                                'is_submitted' => new external_value(PARAM_INT),
                                'totalSubmissions' => new external_value(PARAM_INT),
                            )
                        )
                    )
                )
            )
        );
    }
    /** 
     * The loaddata function creates an JSON conform return object which will then get transferred to the client
     * via AJAX. The return statement includes all the needed information for the client to create the charts.
    */
    public static function loaddata(){
        global $USER;
        global $DB;
        $returnData = array();
        $user_courses = enrol_get_my_courses();
        foreach ($user_courses as $course){
            /** the variable courseObject represents the information of the course */
            $courseObject = new \stdClass;
            /**the numberUsers variable describes the number of users for the calculation of the second chart */
            $context = \context_course::instance($course->id);
            $users = get_role_users(5, $context);
            $numberUsers = count($users);
            $courseObject->number_of_users = $numberUsers;
            /** the course name for the chart gets transferred */
            $courseObject->course_name = $course->fullname;
            /** the DB request to get the assignments related to the course without the already deleted assignments 
             * and only assignments.
            */
            $dBRequest['course'] = $course->id;
            $dBRequest['deletioninprogress'] = 0;
            $dBRequest['module'] = 1;
            $assignments = $DB->get_recordset('course_modules', $dBRequest);
            $assignmentObjectArray = array();
            /** the foreach loop iterates through all the valid assignments in the course_modules database; 
             * looks then for assignment result related to the user and puts them into the return statement;
             * in addition to that we also get the number of already submitted assignments; 
            */
            foreach($assignments as $assignment){
                $courseModuleId = $assignment->id;
                $dBRequestSubmittedUsers['coursemoduleid'] = $courseModuleId;
                $dBRequestSubmittedUsers['completionstate'] = 1;
                $submittedUsers = $DB->count_records('course_modules_completion', $dBRequestSubmittedUsers);

                $dBRequestCompletionState['coursemoduleid'] = $courseModuleId;
                $dBRequestCompletionState['userid'] = $USER->id;
                $completionState = $DB->get_field('course_modules_completion', 'completionstate', $dBRequestCompletionState);

                $dBRequestAssignmentName['id'] = $assignment->instance;
                $assignmentName = $DB->get_field('assign', 'name', $dBRequestAssignmentName);
                $assignmentObject = new \stdClass();
                if($completionState>0){
                    $assignmentObject->assignment_name = $assignmentName;
                    $assignmentObject->is_submitted = 100;
                    $assignmentObject->totalSubmissions = $submittedUsers;
                    $assignmentObjectArray[] = $assignmentObject;
                } else {
                    $assignmentObject->assignment_name = $assignmentName;
                    $assignmentObject->is_submitted = 0;
                    $assignmentObject->totalSubmissions = $submittedUsers;
                    $assignmentObjectArray[] = $assignmentObject;
                }
            }
            $courseObject->assignments = $assignmentObjectArray;
            $returnData[] = $courseObject;
        }
        return $returnData;
    }
}