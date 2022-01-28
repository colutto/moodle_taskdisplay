<?php
defined('MOODLE_INTERNAL') || die();
$services = array(
    'mypluginservice' => array(                      //the name of the web service
        'functions' => array ('block_taskdisplay_loaddata'), //web service functions of this service
        'requiredcapability' => '',                //if set, the web service user need this capability to access 
                                                     //any function of this service. For example: 'some/capability:specified'                 
        'restrictedusers' =>0,                      //if enabled, the Moodle administrator must link some user to this service
                                                      //into the administration
        'enabled'=>1,                               //if enabled, the service can be reachable on a default installation
        'shortname'=>'block_taskdisplay_service' //the short name used to refer to this service from elsewhere including when fetching a token
    )
);

$functions = array(
    'block_taskdisplay_loaddata' => array(
        'classname' => 'block_taskdisplay_external',
        'methodname' => 'loaddata',
        'classpath' => 'blocks/taskdisplay/classes/externallib.php',
        'description' => 'Load data via AJAX to update the client.',
        'type' => 'read',
        'ajax' => true,
        'loginrequired' => true,
    )
);