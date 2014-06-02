<?php

// SETTINGS

$minify = true;

// Includes Before
$includes_before = array(
	'header'
);

// Includes After
$includes_after = array(
	'footer'
);

// END SETTINGS

////////////////////////////////////////////

// Set the includes for including before
foreach ($includes_before as $include_before) {
	$final_includes_before .= file_get_contents('includes/' . $include_before . '.html');
}

// Set the includes for including after
foreach ($includes_after as $include_after) {
	$final_includes_after .= file_get_contents('includes/' . $include_after . '.html');
}

function scanpages($pattern, $final_includes_before, $final_includes_after, $minify) {
	// For each file or directory in pages directory
	foreach (glob($pattern) as $filename) {
		// Set the correct directory path to generate to by removing "pages"
		$dir = preg_replace('/pages/', '', $filename);
		
		// If it's a directory, we need to create the directory then call the function again to run on the files and directories inside
		// Otherwise it's a file so we need to write the file
		if (is_dir($filename) == 1) {
			mkdir('../' . $dir);
			scanpages($filename . '/*', $final_includes_before, $final_includes_after, $minify);
		} else {			
			// Set the file
			$file = fopen('../' . $dir,'w');

			// Set the before includes
			$content .= $final_includes_before;

			// Get our page contents
			$content .= file_get_contents($filename);

			// Set the after includes
			$content .= $final_includes_after;

			// PARSE ROOT PATH VARIABLE
			// Figure out what leve we are at
			$level = substr_count($filename, '/');
			// Set the root path based on the level
			$root_path = str_repeat('../', ($level - 1));
			// Then do the replacement
			$content =  preg_replace('{{{root_path}}}', $root_path, $content);

			// Check if minify is set to true
			if ($minify == true) {
				require_once('_libraries/Minify/HTML.php');
				$content = Minify_HTML::minify($content);
			}

			// Write the final contents to the file
			$write = fwrite($file, $content);

			// Close the file
			fclose($file);

			// Determine if writing the file succeeded or failed and print out the appropritate status
			if ($write != '') {
				echo 'success - /' . $filename . '<br>';
			} else {
				echo 'fail - /' . $filename . '<br>';
			}
		}
	}
}

// Start scanpages function with initial path
scanpages('pages/*', $final_includes_before, $final_includes_after, $minify);

?>