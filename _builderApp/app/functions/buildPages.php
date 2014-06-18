<?php

function buildPages($pagePattern) {
	// For each file or directory in the pages directory
	foreach (glob($pagePattern) as $filename) {
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
			mkdir($GLOBALS['rootDirPath'] . DIRECTORY_SEPARATOR . $GLOBALS['publicDir'] . $dirFinal);
			buildPages($filename . DIRECTORY_SEPARATOR . '*');
		} else {
			// Set the file
			$file = fopen($GLOBALS['rootDirPath'] . DIRECTORY_SEPARATOR . $GLOBALS['publicDir'] . $dirFinal,'w');

			// Get Initial Content
			$content = file_get_contents($filename);

			// PARSE LAYOUT
			// Determine if layout is set in page
			preg_match('^{{layout:(.*)}}^', $content, $layout);

			// If not, set it to default
			if (empty($layout) == true) {
				$layout = array('','default');
			}

			// Remove the layout tag from the page
			$content = preg_replace('^{{layout:(.*)}}^', '', $content);

			// Set the correct layout
			$layout = $GLOBALS['layouts'][$layout[1]];

			// Place the content into the layout
			$content = preg_replace('^{{page:content}}^', $content, $layout);
			// END PARSE LAYOUT

			// Parse includes
			preg_match_all('^{{include:(.*)}}^', $content, $includes);
			foreach ($includes[1] as $include) {
				$content = preg_replace('^{{include:' . $include .'}}^', $GLOBALS['includes'][$include], $content);
			}

			// PARSE ROOT PATH
			// Figure out what level we are at
			$level = substr_count($dirFinal, DIRECTORY_SEPARATOR);

			// Set the root path based on the level
			$rootPath = str_repeat('../', ($level - 1));

			// Then do the replacement
			$content =  preg_replace('{{{rootPath}}}', $rootPath, $content);
			// END PARSE ROOT PATH

			// Parse Single Variables
			foreach ($GLOBALS['singleVariables'] as $variableKey => $variableValue) {
				$content =  preg_replace('{{{' . $variableKey . '}}}', $variableValue, $content);
			}

			// PARSE VARIABLE PAIRS
			// Find the variable pairs
			preg_match_all('^{{set:(.*)}}(.*){{/set:(.*)}}^', $content, $variablePairs);

			// Set the initial index
			$variableIndex = 0;

			// For each one of the variable pairs
			foreach ($variablePairs[1] as $variablePairName) {
				// Remove the set from the page
				$content = preg_replace('^{{set:' . $variablePairName . '}}(.*){{/set:' . $variablePairName .'}}^', '', $content);

				// Replace the get tags with the set content
				$content = preg_replace('^{{get:' . $variablePairName .'}}^', $variablePairs[2][$variableIndex], $content);

				// Increment the variable index
				$variableIndex++;
			}

			// Remove any {{get:varible}} tags that do not have a set
			preg_match_all('^{{get:(.*)}}^', $content, $orphanedGets);
			foreach ($orphanedGets[0] as $get) {
				$content = preg_replace('^' . $get . '^', '', $content);
			}
			// END PARSE VARIABLE PAIRS

			// Check if minify is set to true
			if ($GLOBALS['minify'] == true) {
				require_once($GLOBALS['minifyLibrary']);
				$content = Minify_HTML::minify($content);
			}

			// Write the final contents to the file
			$write = fwrite($file, $content);

			// Close the file
			fclose($file);

			// Determine if writing the file succeeded or failed and print out the appropritate status
			if ($write != '') {
				$GLOBALS['buildOutput'] .= 'success - ' . $dirFinal . '<br>';
			} else {
				$GLOBALS['buildOutput'] .= 'fail - ' . $dirFinal . '<br>';
			}
		}
	}
}

?>