<?php

// Set Directories and initial variables
chdir('../');
$publicDir = basename(getcwd());
chdir('../');
$rootDirPath = getcwd();

// Include the settings
include '_builderApp' . DIRECTORY_SEPARATOR . 'settings.php';

// Set the includes for including before
foreach ($includesBefore as $includeBefore) {
	$finalIncludesBefore .= file_get_contents('_builderApp' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . $includeBefore . '.html');
}

// Set the includes for including after
foreach ($includesAfter as $includeAfter) {
	$finalIncludesAfter .= file_get_contents('_builderApp' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . $includeAfter . '.html');
}

// Set the initial pattern of the pages directory
$pattern = '_builderApp' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . '*';
$functions = '_builderApp' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . '*';

// Include Functions
foreach (glob($functions) as $filename) {
    include $filename;
}

// OUTPUT
// Header template elements
echo file_get_contents('_builderApp' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'html' . DIRECTORY_SEPARATOR . 'header1.html');
echo file_get_contents('_builderApp' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'builderOutputStyle.css');
echo file_get_contents('_builderApp' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'html' . DIRECTORY_SEPARATOR . 'header2.html');

// Start scanpages function with initial path
scanPages($pattern, $finalIncludesBefore, $finalIncludesAfter, $minify, $singleVariables, $variablePairs, $publicDir, $rootDirPath, $deleteOrphaned, $orphanedExclude);

// Footer template elements
echo file_get_contents('_builderApp' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'html' . DIRECTORY_SEPARATOR . 'footer.html');

?>
