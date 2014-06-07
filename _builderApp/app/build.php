<?php

// BuilderApp 0.4.0

// Set Directories and initial variables
chdir('../');
$publicDir = basename(getcwd());
chdir('../');
$rootDirPath = getcwd();

?>

<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BuilderApp</title>
<style type="text/css">
<?php echo file_get_contents('_builderApp' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'style.css'); ?>
</style>
</head>
<body>

<?php

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

// Start scanpages function with initial path
scanPages($pattern, $finalIncludesBefore, $finalIncludesAfter, $minify, $singleVariables, $variablePairs, $publicDir, $rootDirPath, $deleteOrphaned, $orphanedExclude);

?>

</body>
</html>
