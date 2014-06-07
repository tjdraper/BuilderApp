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