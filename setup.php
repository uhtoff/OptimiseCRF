<?php
if(count(get_included_files()) ==1) exit("Direct access not permitted.");
if ( php_sapi_name() === 'cli' ) {
	$path = '.';
} else {
	$path = $_SERVER['DOCUMENT_ROOT'];
}
require( $path . '/libs/serverconfig.php');
require( $path . '/libs/trialconfig.php');

addIncludePath('/classes');
addIncludePath('/addons');

if ( !DB::setDB($db) ) {
    exit( 'Unable to set database' );
}
require( 'ecrflib.php' );
require( 'mainlib.php' );
?>
