<?php
include_once( 'lib/ezutils/classes/ezfunctionhandler.php' );
include_once( 'kernel/common/template.php' );
include_once( 'lib/ezutils/classes/ezini.php' );

$module = $Params['Module'];

$myIni =& eZINI::instance( 'healthcheck.ini' );
$tests = $myIni->variableArray( "AvailableTests", "Tests" );

$testArray = array();
foreach( $tests as $test ) {
    $testArray[] = array( "view_name" => $test[0],
                          "friendly_name" => $myIni->variable( $test[0], "Name" ),
    );
}

$tpl =& templateInit();
$tpl->setVariable( 'tests', $testArray );
$tpl->setVariable( 'module_name', 'healthcheck' );

$Result['path'] = array( array( 'url' => '/healthcheck/overview', 'text' => "System Health Check" ),
                         array( 'url' => false, 'text' => 'Overview' ) );
$Result['content'] = $tpl->fetch( 'design:healthcheck/overview.tpl' );
$Result['left_menu'] = 'design:healthcheck/menu.tpl';
?>
