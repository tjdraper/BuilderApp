<?php

function writePages($pattern, $finalIncludesBefore, $finalIncludesAfter, $minify, $singleVariables, $variablePairs, $publicDir, $rootDirPath) {
	// For each file or directory in pages directory
	foreach (glob($pattern) as $filename) {

		// Set the correct directory path to generate to by removing "pages"
		$dir = explode(DIRECTORY_SEPARATOR, $filename);
		unset($dir[0]);
		unset($dir[1]);
		$dirFinal = '';
		foreach ($dir as $key) {
			$dirFinal .= DIRECTORY_SEPARATOR . $key;
		}

		// If it's a directory, we need to create the directory then call the function again to run on the files and directories inside
		// Otherwise it's a file so we need to write the file
		if (is_dir($filename) == 1) {
			mkdir($rootDirPath . DIRECTORY_SEPARATOR . $publicDir . $dirFinal);
			scanPages($filename . DIRECTORY_SEPARATOR . '*', $finalIncludesBefore, $finalIncludesAfter, $minify, $singleVariables, $variablePairs, $publicDir, $rootDirPath);
		} else {
			// Set the file
			$file = fopen($rootDirPath . DIRECTORY_SEPARATOR . $publicDir . $dirFinal,'w');

			// Set the before includes
			$content = $finalIncludesBefore;

			// Get our page contents
			$content .= file_get_contents($filename);

			// Set the after includes
			$content .= $finalIncludesAfter;

			// PARSE ROOT PATH VARIABLE
			// Figure out what level we are at
			$level = substr_count($dirFinal, DIRECTORY_SEPARATOR);
			// Set the root path based on the level
			$rootPath = str_repeat('../', ($level - 1));
			// Then do the replacement
			$content =  preg_replace('{{{rootPath}}}', $rootPath, $content);

			// Parse Single Variables
			foreach ($singleVariables as $variableKey => $variableValue) {
				$content =  preg_replace('{{{' . $variableKey . '}}}', $variableValue, $content);
			}

			// Parse Variable Pairs
			foreach ($variablePairs as $variableKey) {
				preg_match('^{{' . $variableKey . '}}(.*){{/' . $variableKey . '}}^', $content, $variableValue);
				$content =  preg_replace('^{{' . $variableKey . '}}(.*){{/' . $variableKey . '}}^', '', $content);
				$content = preg_replace('{{{' . $variableKey . '}}}', $variableValue[1], $content);
			}

			// Check if minify is set to true
			if ($minify == true) {
				require_once($rootDirPath . DIRECTORY_SEPARATOR . '_builderApp' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'libraries' . DIRECTORY_SEPARATOR . 'Minify' . DIRECTORY_SEPARATOR . 'HTML.php');
				$content = Minify_HTML::minify($content);
			}

			// Write the final contents to the file
			$write = fwrite($file, $content);

			// Close the file
			fclose($file);

			// Determine if writing the file succeeded or failed and print out the appropritate status
			if ($write != '') {
				echo 'success - ' . $dirFinal . '<br>';
			} else {
				echo 'fail - ' . $dirFinal . '<br>';
			}
		}
	}
}

?>
