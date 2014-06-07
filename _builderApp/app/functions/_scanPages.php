<?php

function scanPages($pattern, $finalIncludesBefore, $finalIncludesAfter, $minify, $singleVariables, $variablePairs, $publicDir, $rootDirPath, $deleteOrphaned, $orphanedExclude) {
	writePages($pattern, $finalIncludesBefore, $finalIncludesAfter, $minify, $singleVariables, $variablePairs, $publicDir, $rootDirPath);
	if ($deleteOrphaned == true) {
		deletePages($orphanedExclude);
	}
}

?>
