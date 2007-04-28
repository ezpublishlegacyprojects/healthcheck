<?php

$Module = array( 'name' => 'Healthcheck' );

$ViewList = array();

$ViewList['overview'] = array( "default_navigation_part" => "healthchecknavigationpart",
                                  "script" => "overview.php" );

$ViewList['inisettings'] = array( "default_navigation_part" => "healthchecknavigationpart",
                                  "script" => "inisettings.php" );

$ViewList['environment'] = array( "default_navigation_part" => "healthchecknavigationpart",
                                  "script" => "environment.php" );

$ViewList['menu'] = array(      
         'script' => 'setupmenu.php',
         'default_navigation_part' => 'ezsetupnavigationpart',
         'params' => array( ) );

?>
