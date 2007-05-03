<?php
include_once( 'lib/ezutils/classes/ezfunctionhandler.php' );
include_once( 'kernel/common/template.php' );
include_once( 'lib/ezutils/classes/ezini.php' );

$module = $Params['Module'];

$tpl =& templateInit();
$tpl->setVariable( 'module_name', 'healthcheck' );

$Result['path'] = array( array( 'url' => '/healthcheck/overview', 'text' => "System Health Check" ),
                         array( 'url' => false, 'text' => 'Overview' ) );
$Result['content'] = $tpl->fetch( 'design:healthcheck/overview.tpl' );
$Result['left_menu'] = 'design:healthcheck/menu.tpl';
?>
