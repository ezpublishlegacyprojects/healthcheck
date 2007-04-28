<?php
include_once( 'lib/ezutils/classes/ezfunctionhandler.php' );
include_once( 'kernel/common/template.php' );
include_once( 'lib/ezutils/classes/ezini.php' );
include_once( 'kernel/classes/ezpreferences.php' );
include_once( 'extension/healthcheck/classes/healthcheckfunctioncollection.php' );

$http = eZHTTPTool::instance();
$module =& $Params['Module'];

$siteAccess = $module->actionParameter( 'SiteAccess' );
if( !$siteAccess ) {
    $siteAccess = 'global';
}
eZPreferences::setValue( 'admin_healthcheck_siteaccess', $siteAccess );

$checkResults = HealthCheckFunctionCollection::runeZINIChecks( $siteAccess );

$tpl =& templateInit();
$tpl->setVariable( 'results', $checkResults );

$Result['path'] = array( array( 'url' => '/healthcheck/overview', 'text' => "System Health Check" ),
                         array( 'url' => false, 'text' => 'INI Settings' ) );
$Result['content'] = $tpl->fetch( 'design:healthcheck/inisettings.tpl' );
$Result['left_menu'] = 'design:healthcheck/menu.tpl';
?>
