<?php

// Minification
$minify = true;

// Single Variables
$singleVariables = array(
	// Sample Variables
	'siteName' => 'BuilderApp',
	'authorUrl' => 'http://buzzingpixel.com'
);

// Remove Orphaned Files
$removeOrphaned = true;

// Exclude single files from orphan deletion
$orphanedFileExlude = array(
	// Sample Orphaned Excludes
	'sample.htaccess',
	'myfile.txt',
	'mydir/myfile.txt'
);

// Exlude directories from orphaned deletion
$orphanedDirectoryExclude = array(
	// Sample Orphaned Directory Excludes
	'mydir',
	'myotherdir/mysubdir'
);

?>
