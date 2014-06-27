<?php

function deleteOrphans($pagePattern) {

	// Set the pages and files array
	$pagesArray = array_unique(getPagesArray($pagePattern));
	$filesArray = array_unique(getFilesArray($GLOBALS['publicDir'] . DIRECTORY_SEPARATOR . '*'));

	// Remove builder directories from the files array
	$builderDirs = array(
		'_builder/build.php',
		'_builder/index.php'
	);
	foreach ($builderDirs as $value) {
		$value = array_search($value, $filesArray);
		unset($filesArray[$value]);
	}

	// Remove any page from the files array
	foreach ($GLOBALS['orphanedFileExlude'] as $value) {
		$value = array_search($value, $filesArray);
		unset($filesArray[$value]);
	}

	// Remove files in file exclude array
	foreach ($pagesArray as $value) {
		$value = array_search($value, $filesArray);
		unset($filesArray[$value]);
	}

	// Build an array of files to remove from the files array from the exclude directories
	foreach ($GLOBALS['orphanedDirectoryExclude'] as $dirName) {
		$orphanedDirExcludeArray = array_unique(getExcludeDirFiles($GLOBALS['publicDir'] . DIRECTORY_SEPARATOR . $dirName . DIRECTORY_SEPARATOR . '*'));
		foreach ($orphanedDirExcludeArray as $value) {
			$value = array_search($value, $filesArray);
			unset($filesArray[$value]);
		}
	}

	// Delete files in the files array
	foreach ($filesArray as $value) {
		unlink($GLOBALS['publicDir'] . DIRECTORY_SEPARATOR . $value);
	}

	// Delete Empty Directories
	$directoriesArray = array_unique(getDirectories($GLOBALS['publicDir'] . DIRECTORY_SEPARATOR . '*'));
	foreach ($directoriesArray as $value) {
		rmdir($value);
	}
}

function getPagesArray($pagePattern, $pagesArray) {
	// Get all pages
	foreach (glob($pagePattern) as $filename) {
		if (is_dir($filename) == 1) {
			$pagesArray = getPagesArray($filename . DIRECTORY_SEPARATOR . '*', $pagesArray);
		} else {
			$filename = preg_replace('^_builderApp' . DIRECTORY_SEPARATOR . 'pages' . DIRECTORY_SEPARATOR . '^', '', $filename);
			$pagesArray[] = $filename;
		}
	}
	return $pagesArray;
}

function getFilesArray($filesPattern, $filesArray) {
	// Get all files
	foreach (glob($filesPattern) as $filename) {
		if (is_dir($filename) == 1) {
			$filesArray = getFilesArray($filename . DIRECTORY_SEPARATOR . '*', $filesArray);
		} else {
			$filename = preg_replace('^' . $GLOBALS['publicDir'] . DIRECTORY_SEPARATOR . '^', '', $filename);
			$filesArray[] = $filename;
		}
	}
	return $filesArray;
}

function getExcludeDirFiles($dirName, $orphanedDirExcludeArray) {
	// Get specified directories and files
	foreach (glob($dirName) as $filename) {
		if (is_dir($filename) == 1) {
			$orphanedDirExcludeArray = getExcludeDirFiles($filename . DIRECTORY_SEPARATOR . '*', $orphanedDirExcludeArray);
		} else {
			$filename = preg_replace('^' . $GLOBALS['publicDir'] . DIRECTORY_SEPARATOR . '^', '', $filename);
			$orphanedDirExcludeArray[] = $filename;
		}
	}
	return $orphanedDirExcludeArray;
}

function getDirectories($path, $directoriesArray) {
	foreach (glob($path, GLOB_ONLYDIR) as $dirName) {
		$directoriesArray = getDirectories($dirName . DIRECTORY_SEPARATOR . '*', $directoriesArray);
		$directoriesArray[] = $dirName;
	}
	return $directoriesArray;
}

?>