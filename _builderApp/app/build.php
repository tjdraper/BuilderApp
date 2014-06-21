<?php

// Set Directories and initial variables

// Set the directory to the public directory first. We need to get the name of this directory
chdir('../');

// Set the name of the public directory in a Global
$GLOBALS['publicDir'] = basename(getcwd());

// Then back up to right above webroot
chdir('../');

// We need the path to this directory in a Global
$GLOBALS['rootDirPath'] = getcwd();

// Set the path to the minify library in a Global
$GLOBALS['minifyLibrary'] = $GLOBALS['rootDirPath'] . DIRECTORY_SEPARATOR . '_builderApp' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'libraries' . DIRECTORY_SEPARATOR . 'Minify' . DIRECTORY_SEPARATOR . 'HTML.php';

// Set path variables
$settingsPath = '_builderApp' . DIRECTORY_SEPARATOR . 'settings.php';
$functionsPath = '_builderApp' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . '*';
$layoutsPath = '_builderApp' . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR . '*';
$includesPath = '_builderApp' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . '*';
$pagePattern = '_builderApp' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . '*';

// Include the settings
include $settingsPath;

// Set Single Variables in a Global
$GLOBALS['singleVariables'] = $singleVariables;

// Set Minify in a Global
$GLOBALS['minify'] = $minify;

// Set orphaned preferences in Globals
$GLOBALS['orphanedFileExlude'] = $orphanedFileExlude;
$GLOBALS['orphanedDirectoryExclude'] = $orphanedDirectoryExclude;

// Include Functions in the functions directory
foreach (glob($functionsPath) as $include) {
    include $include;
}

// Get layouts and put them in a Global
$GLOBALS['layouts'] = getFiles($layoutsPath);

// Get Includes and put them in a Global
$GLOBALS['includes'] = getFiles($includesPath);

// Call the Build Pages function
buildPages($pagePattern);

// Call the Delete Orphans function if remove orphaned is set to true in settings
if ($removeOrphaned == true) {
	deleteOrphans($pagePattern);
}

// Get header template elements
$output .= file_get_contents('_builderApp' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'html' . DIRECTORY_SEPARATOR . 'header1.html');
$output .= file_get_contents('_builderApp' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'builderOutputStyle.css');
$output .= file_get_contents('_builderApp' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'html' . DIRECTORY_SEPARATOR . 'header2.html');

// Insert the output of the build
$output .= $GLOBALS['buildOutput'];

// Get footer template elements
$output .= file_get_contents('_builderApp' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'html' . DIRECTORY_SEPARATOR . 'footer.html');

?>
