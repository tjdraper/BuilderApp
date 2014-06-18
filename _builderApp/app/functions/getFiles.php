<?php

function getFiles($path) {
	$files = array();

	foreach (glob($path) as $filename) {
		$files[basename(preg_replace('/.html/', '', $filename))] = file_get_contents($filename);
	}

	return $files;
}

?>