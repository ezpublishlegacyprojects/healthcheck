<?php
include_once( 'lib/ezutils/classes/ezfunctionhandler.php' );
include_once( 'kernel/common/template.php' );
include_once( 'lib/ezutils/classes/ezini.php' );
include_once( 'extension/healthcheck/classes/healthcheckfunctioncollection.php' );

$checkResults = HealthCheckFunctionCollection::runPHPChecks();

$tpl =& templateInit();
$tpl->setVariable( 'results', $checkResults );

$Result['path'] = array( array( 'url' => '/healthcheck/environment', 'text' => "System Health Check" ),
    array( 'url' => false, 'text' => 'Overview' ) );
$Result['content'] = $tpl->fetch( 'design:healthcheck/environment.tpl' );
$Result['left_menu'] = 'design:healthcheck/menu.tpl';
?>
