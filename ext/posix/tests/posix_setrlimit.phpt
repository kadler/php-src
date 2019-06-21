--TEST--
posix_setrlimit(): Basic tests
--SKIPIF--
<?php
if (!extension_loaded('posix')) die('skip - POSIX extension not loaded');
if (!function_exists('posix_setrlimit')) die('skip posix_setrlimit() not found');
if (!getenv("PASE_RUN_ALL_TESTS")) die("skip known PASE test failures");
?>
--FILE--
<?php

var_dump(posix_setrlimit(POSIX_RLIMIT_NOFILE, 128, 128));
var_dump(posix_setrlimit(POSIX_RLIMIT_NOFILE, 129, 128));

?>
--EXPECT--
bool(true)
bool(false)
