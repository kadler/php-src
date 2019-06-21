--TEST--
chmod() basic functionality
--SKIPIF--
<?php
if (substr(PHP_OS, 0, 3) == 'WIN') {
    die('skip non-windows only test');
}
if (!getenv("PASE_RUN_ALL_TESTS")) die("skip known PASE test failures");
?>
--FILE--
<?php

define("MODE_MASK", 07777);

$filename = __FILE__ . ".tmp";

$fd = fopen($filename, "w+");
fclose($fd);

for ($perms_to_set = 07777; $perms_to_set >= 0; $perms_to_set--) {
	chmod($filename, $perms_to_set);
	$set_perms = (fileperms($filename) & MODE_MASK);
	clearstatcache();
	if ($set_perms != $perms_to_set) {
		printf("Error: %o does not match %o\n", $set_perms, $perms_to_set);
	}
}
var_dump(chmod($filename, 0777));

unlink($filename);
echo "done";

?>
--EXPECT--
bool(true)
done
