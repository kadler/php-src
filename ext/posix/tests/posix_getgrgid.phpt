--TEST--
Test posix_getgrgid().
--CREDITS--
Till Klampaeckel, till@php.net
TestFest Berlin 2009
--SKIPIF--
<?php
if (!extension_loaded('posix')) {
    die('SKIP The posix extension is not loaded.');
}
?>
--FILE--
<?php
if (php_uname("s") != "OS400") {
    $gid = 0;
} else {
    // IBM i does ship with any built-in groups gid cannot be 0
    // You must create a group profile like so:
    // CRTUSRPRF USRPRF(PHPTESTGRP) GID(12648430)
    $gid = 12648430;
}
$grp = posix_getgrgid($gid);
if (!isset($grp['name'])) {
    die('Array index "name" does not exist.');
}
if (!isset($grp['passwd'])) {
    die('Array index "passwd" does not exist.');
}
if (!isset($grp['members'])) {
    die('Array index "members" does not exist.');
} elseif (!is_array($grp['members'])) {
    die('Array index "members" must be an array.');
} else {
    if (count($grp['members']) > 0) {
        foreach ($grp['members'] as $idx => $username) {
            if (!is_int($idx)) {
                die('Index in members Array is not an int.');
            }
            if (!is_string($username)) {
                die('Username in members Array is not of type string.');
            }
        }
    }
}
if (!isset($grp['gid'])) {
    die('Array index "gid" does not exist.');
}
var_dump($grp['gid']);
var_dump($grp['gid'] == $gid);
?>
===DONE===
--EXPECTF--
int(%d)
bool(true)
===DONE===
