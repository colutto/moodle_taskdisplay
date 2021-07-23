<?php
$services = array(
    'block_taskdisplay_loaddata' => array(
        'classname' => 'block_taskdisplay_external',
        'methodname' => 'loaddata',
        'description' => 'Load data via AJAX to update the client.',
        'type' => 'read',
        'ajax' => true,
        'loginrequired' => true,
    )
);