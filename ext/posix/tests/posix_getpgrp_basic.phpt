--TEST--
Test posix_getpgrp() function : basic functionality
--SKIPIF--
<?php
	if (!extension_loaded('posix')) die('skip - POSIX extension not loaded');
if (!getenv("PASE_RUN_ALL_TESTS")) die("skip known PASE test failures");
?>
--FILE--
<?php
  echo "Basic test of POSIX getpgrp function\n";

  $pgrp = posix_getpgrp();

  var_dump($pgrp);

?>
===DONE====
--EXPECTF--
Basic test of POSIX getpgrp function
int(%d)
===DONE====
  
