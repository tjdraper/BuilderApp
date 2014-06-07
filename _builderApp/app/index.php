<!DOCTYPE html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>BuilderApp 0.4.0</title>
<style type="text/css">
<?php chdir('../../'); echo file_get_contents('_builderApp' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'css' . DIRECTORY_SEPARATOR . 'style.css'); ?>
</style>
</head>
<body>

<h1>BuilderApp 0.4.0</h1>

<!-- <button class="continuous">Begin Generating</button>
<br><br> -->

<div id="iframe-center">
	<div id="frame-container">
		<iframe name="generator" id="generator" src=""></iframe>
		<button class="once">Build</button>
	</div>
</div>

<script>
<?php echo file_get_contents('_builderApp' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'jquery-2.1.1.min.js'); ?>
</script>
<script>
<?php echo file_get_contents('_builderApp' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'js' . DIRECTORY_SEPARATOR . 'script.js'); ?>
</script>
</body>
</html>
