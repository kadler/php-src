--TEST--
Test popen() and pclose function: error conditions
--SKIPIF--
<?php
if(PHP_OS != 'AIX' && PHP_OS != 'OS400') {
  die("skip Only Valid for AIX and IBM i/PASE");
}
?>
--FILE--
<?php
/*
 * Prototype: resource popen ( string command, string mode )
 * Description: Opens process file pointer.

 * Prototype: int pclose ( resource handle );
 * Description: Closes process file pointer.
 */
$file_path = dirname(__FILE__);
echo "*** Testing for error conditions ***\n";
var_dump( popen() );  // Zero Arguments
var_dump( popen("abc.txt") );   // Single Argument
var_dump( popen("abc.txt", "rw") );   // Invalid mode Argument
var_dump( pclose() );
$file_handle = fopen($file_path."/popen.tmp", "w");
var_dump( pclose($file_handle, $file_handle) );
fclose($file_handle);
var_dump( pclose(1) );
echo "\n--- Done ---";
?>
--CLEAN--
<?php
$file_path = dirname(__FILE__);
unlink($file_path."/popen.tmp");
?>
--EXPECTF--
*** Testing for error conditions ***

Warning: popen() expects exactly 2 parameters, 0 given in %s on line %d
NULL

Warning: popen() expects exactly 2 parameters, 1 given in %s on line %d
NULL
resource(%d) of type (stream)
%r.*%rsh: abc.txt:%s

Warning: pclose() expects exactly 1 parameter, 0 given in %s on line %d
bool(false)

Warning: pclose() expects exactly 1 parameter, 2 given in %s on line %d
bool(false)

Warning: pclose() expects parameter 1 to be resource, int given in %s on line %d
bool(false)

--- Done ---
