<?php

$minify = true;
// This isn't working yet so leave set to false
$deleteOrphaned = false;

// Items to Exclude from Deletion (not working, see above)
$orphanedExclude = array(
	'example',
	'example2'
);

// Includes Before
$includesBefore = array(
	'header'
);

// Includes After
$includesAfter = array(
	'footer'
);

// Single Variables
$singleVariables = array(
	// Sample Variables
	'siteName' => 'BuilderApp',
	'authorUrl' => 'http://buzzingpixel.com'
);

// Variable Pairs
$variablePairs = array(
	// Sample Variables
	'metaTitle',
	'metaDescription'
);

?>
