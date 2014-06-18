<?php

// Set Directories and initial variables
chdir('../');
$GLOBALS['publicDir'] = basename(getcwd());
chdir('../');
$GLOBALS['rootDirPath'] = getcwd();
$GLOBALS['minifyLibrary'] = $GLOBALS['rootDirPath'] . DIRECTORY_SEPARATOR . '_builderApp' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'libraries' . DIRECTORY_SEPARATOR . 'Minify' . DIRECTORY_SEPARATOR . 'HTML.php';
$settingsPath = '_builderApp' . DIRECTORY_SEPARATOR . 'settings.php';
$functionsPath = '_builderApp' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'functions' . DIRECTORY_SEPARATOR . '*';
$layoutsPath = '_builderApp' . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR . '*';
$includesPath = '_builderApp' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . '*';
$pagePattern = '_builderApp' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . '*';

// Include the settings
include $settingsPath;

// Set Single Variables
$GLOBALS['singleVariables'] = $singleVariables;

// Set Minify
$GLOBALS['minify'] = $minify;

// Include Functions
foreach (glob($functionsPath) as $include) {
    include $include;
}

// Get layouts
$GLOBALS['layouts'] = getFiles($layoutsPath);

// Get Includes
$GLOBALS['includes'] = getFiles($includesPath);

// Build Pages
buildPages($pagePattern);

// Get header template elements
$output .= file_get_contents('_builderApp' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'html' . DIRECTORY_SEPARATOR . 'header1.html');
$output .= file_get_contents('_builderApp' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'builderOutputStyle.css');
$output .= file_get_contents('_builderApp' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'html' . DIRECTORY_SEPARATOR . 'header2.html');

// Insert the output of the build
$output .= $GLOBALS['buildOutput'];

// Get footer template elements
$output .= file_get_contents('_builderApp' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'html' . DIRECTORY_SEPARATOR . 'footer.html');

?>
