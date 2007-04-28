<?php

/*! 
 * Contains functions used to execute checks on the system
 */

class HealthCheckFunctionCollection {

    /*!
     * Run a particular type of test as selected in healthcheck.ini
     */
    function getCheckResult( $type = false, $expected = false, $actual = false ) {
        switch( $type ) {
        case 'gt':
            return ( (int) $actual > (int) $expected );
            break;
        case 'lt':
            return ( (int) $actual < (int) $expected );
            break;
        case 'eq':
            return ( $actual == $expected );
            break;
        case 'ne':
            return ( $actual != $expected );
            break;
        case 'ge':
            return ( (int) $actual >= (int) $expected );
            break;
        case 'le':
            return ( (int) $actual <= (int) $expected );
            break;
        default:
            return false;
            break;
        }
    }

    /*!
     * Execute tests on the system INI files as defined by the 
     * [inisettings] block in healthcheck.ini
     */
    function runeZINIChecks() {

        $myIni =& eZINI::instance( 'healthcheck.ini' );
        if ( get_class( $myIni ) != "ezini" ) {
            eZDebug::writeError( 'healthcheck.ini can not be found.', 'HealthCheckFunctionCollection::runSystemINIChecks()' );
            return false;
        }

        $checks = $myIni->variableArray( 'inisettings', 'SystemINIChecks' );
        if( !is_array( $checks ) or count( $checks ) == 0 ){
            eZDebug::writeError( 'No checks in healthcheck.ini defined.', 'HealthCheckFunctionCollection::runSystemINIChecks()' );
            return false;
        }

        $checkResults = array();

        foreach( $checks as $check ) {
            $testIni =& eZINI::instance( $check[1] );
            $currentValue = $testIni->variable( $check[2], $check[3] );
            if( HealthCheckFunctionCollection::getCheckResult( $check[0], $check[4], $currentValue ) ) {
                $checkResult = array ( 
                    "result" => "pass",
                    "file_name" => $check[1],
                    "block_name" => $check[2],
                    "setting_name" => $check[3],
                    "test_type" => $check[0],
                    "expected_value" => $check[4],
                    "actual_value" => $currentValue,
                    "friendly_name" => $check[5],
                );
            } else {
                $checkResult = array ( 
                    "result" => "fail",
                    "file_name" => $check[1],
                    "block_name" => $check[2],
                    "setting_name" => $check[3],
                    "test_type" => $check[0],
                    "expected_value" => $check[4],
                    "actual_value" => $currentValue,
                    "friendly_name" => $check[5],
                );
            }

            $checkResults[] = $checkResult;
        } 

        return $checkResults;
    }

    /*!
     * Execute tests on the server environment as defined by the 
     * [environment] block in healthcheck.ini
     */
    function runPHPChecks() {

        $myIni =& eZINI::instance( 'healthcheck.ini' );
        if ( get_class( $myIni ) != "ezini" ) {
            eZDebug::writeError( 'healthcheck.ini can not be found.', 'HealthCheckFunctionCollection::runEnvironmentChecks()' );
            return false;
        }

        $checks = $myIni->variableArray( 'environment', 'PHPSettings' );
        if( !is_array( $checks ) or count( $checks ) == 0 ){
            eZDebug::writeError( 'No checks in healthcheck.ini defined.', 'HealthCheckFunctionCollection::runEnvironmentChecks()' );
            return false;
        }

        $checkResults = array();

        foreach( $checks as $check ) {
            $actual = ini_get( $check[1] );
            if ( empty( $actual ) ) {
                # ini_get can give empty strings in some cases
                $actual = '0';
            }
            if( HealthCheckFunctionCollection::getCheckResult( $check[0], $check[2], $actual ) ) {
                $checkResult = array ( 
                    "result" => "pass",
                    "setting_name" => $check[1],
                    "test_type" => $check[0],
                    "expected_value" => $check[2],
                    "actual_value" => $actual,
                    "friendly_name" => $check[3],
                );
            } else {
                $checkResult = array ( 
                    "result" => "fail",
                    "setting_name" => $check[1],
                    "test_type" => $check[0],
                    "expected_value" => $check[2],
                    "actual_value" => $actual,
                    "friendly_name" => $check[3],
                );
            }

            $checkResults[] = $checkResult;
        } 

        return $checkResults;
    }

}

