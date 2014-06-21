# 0.6.0

- **WARNING** This release adds a feature to delete any orphaned files and folders in the public HTML directory. It’s been set to true by default because that seems like the correct default. But if you've been using this app before now you may not be expecting this. Read on for how to use this feature.
- **Settings** - settings.php now contains the following:
	- **$removeOrphaned** - set this to true to remove any files and folders not present in the pages directory (default on initial download and use is true). Set to false for BuilderApp to leave all files and folders alone that are not in the pages directory.
	- **$orphanedFileExlude** - Use this array to exclude single files from being deleted by BuilderApp.
	- **$orphanedDirectoryExclude** - Use this array to exclude directories and the files and directories contined within from being deleted by BuilderApp.

# 0.5.0

- **MAJOR STRUCTURAL SHIFT** — Please note a default layout is now **REQUIRED** and there are **SYNTAX CHANGES** for **VARIABLE PAIRS** (remember, in the readme I warned that this is a work in progress :-) )!
- While a lot of code and code concepts were reused I re-thought and re-wrote large swaths of the generator.
- The concept of includes before and after have been replaced by {{include:myInclude}} tags.
- This generator was original written for a specific site. When writing another site with it, I realized a major feature had been left out: the possibility of multiple layouts. So now there is a new "layouts" directory and at least one layout named default.html is required.
- So parsing now goes like this:
	- **Page** - The page in your page directory is loaded.
	- **Layout** - The layout is loaded. If {{layout:myLayout}} has been specified in the page, that layout is loaded. If not, the default layout is loaded. The layout must include a {{page:content}} tag. The contents of your page is placed at this location.
	- **Includes** - All {{include:myInclude}} tags are replaced with the specified include.
	- **Single Variables** - All single variables are replaced with the specified variable content.
	- **Variable Pairs** - WARNING: syntax and behavior have changed. Variable pairs now no longer need to be specified in the settings.php. But all variable pairs need to be prefixed with "set:" like this: {{set:myVariable}}My Content{{/set:myVariable}}. Retrieval of variable pairs must now be prefixed with "get:" like this: {{get:myVariable}}.
	- **Minification** - Finally, as before, if minify has been set to true in settings.php, the parsed contents of the page are minified.
	- **File Writing** The last step is file writing. The files are written to the public html folder with the same directory structure that is used/set in the pages directory.
- Since Variable Pairs are now auto loaded on set, they have been removed from the settings file. Single Variables still need to be set somewhere so they still live in the settings file.
- Probably not going to get around to writing the auto-delete files functionality anytime soon, so the placeholder settings for that have been removed from the settings file for now.


# 0.4.1

- Move libraries/minification library inside the app folder (because I forgot to in the last release)
- Now have a meta php file for output of certain meta variables.
- Html output in the build.php file is now coming from template files and not directly in the php file. This also lead to a slight reorganization of the placement of things in the file.
- builder.php now uses its own minimal css file for html output.



# 0.4.0

- Complete restructure of the file system. Builder's primary files now live above webroot so they can be included and committed in a working repo but not be exposed to the public if included in a deploy. This lets all source files live in the repo and on the server in case the site needs to be rebuilt, reconstructed, or whatever.
- Starting to split functions out into files and includes.
- Clean up and change variable names. Not sure why I was using underscores instead of CamelCase since I like CamelCase better.
- Pretty up the builder "control panel" (if you can call it that)
- "Control panel" now no longer generates the site on load. Click the build button to generate the site.
- Add a sample gitignore file.
- Add info.txt to the app folder primarily so that the current version of BuilderApp can be easily ascertained.
- Add version info to the build.php file and the "control panel" for ease of determining which version is currently in use.

# 0.3.0

- Add custom single variable parsing (see Readme for use).
- Add custom variable pair parsing (see Readme for use).
- Moved primary application scripts into the "_libraries/app"" directory for easier future updating (just replace the whole _libraries folder, done). Index and build files in the root directory "probably" won't need updated very often (although a prettier build page is on the roadmap).
- Added demos of single and variable pair parsing in the index file.

# 0.2.1

- Output path on success/fail message now reflects from root instead of including "/pages/"

# 0.2.0

- Add parsing of {{meta_title}} variable.

# 0.1.1

- Fix a nasty bug where each subsequent page to be written would contain all the contents of the previous page.
- Move settings to settings.php so that base files can be replaced wholesale on update.


# 0.1.0

- Initial commit. App still in development. Let's see if anyone beats me up for this.