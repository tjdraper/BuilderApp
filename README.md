# BuilderApp 0.6.1

A simple static site generator.

## CAUTION: Still a work in progress!

## About

If you have occasion to build simple static HTML sites that just don't warrant the use of a big dynamic CMS — or are building portable, distributable pages for something like documentation where it must be static HTML files, but want to remain [DRY] and keep common parts of the site in template/layout/include files, this may be for you.

It’s a simple, bare-bones sort of thing that get’s the job done.

[DRY]: http://en.wikipedia.org/wiki/Don't_repeat_yourself

## More Caution

It is not recommended to have the public \_builder directory live on a live server. The idea is that you would use it in a local environment via [MAMP] or [EasyPHP] or some other local server on your computer, then deploy the generated content to your production server. There is no security in place at this time. At the very least, if you do commit and deploy it to a production server, use .htaccess to keep unwanted persons out of the public \_builder directory.

[MAMP]: http://www.mamp.info/
[EasyPHP]: http://www.easyphp.org/

## How It Works

When you load up http://yourlocalserver.dev/\_builder/, BuilderApp parses the contents of your pages directory (the one in the \_builderApp above webroot), mirroring its structure to the webroot), and parsing your layouts, includes, and variables along the way.

## Basic Concept and Usage

Here are the stages of rendering and how to use them:

- **Pages**
	- Your pages are retrieved from the pages directory (in \_builderApp). The directory hierarchy will be mirrored in your public_html directory.
- **Layouts**
	- In your layouts folder you should have a defaut.html. If no layout is specified, this is what BuilderApp will use.
	- Layouts can be specified in your page. It is recommended to specify this at the very top of the document. The syntax is: {{layout:myLayout}}.
	- All layouts should include the {{page:content}} tag somewhere. The contents of your page will be placed at this location in your layout.
- **Includes**
	- All {{include:myInclude}} tags are replaced with the specified include.
	- Includes live in the includes directory (in \_builderApp).
- **Single Variables**
	- Single Variables are specified in the settings.php file as a key => value array.
		- 'myVariableName' => 'myVariableContent'
	- To use these variables, use the name of the key in double curly braces anywhere in your pages, layouts, or includes like this: {{myVariable}}
- **Variable Pairs**
	- Variable pairs are a "set here, get there" retrieval system. They can be used on the same templating level, but their primary intent is to get content from a page into a layout, or a layout into an include, etc.
	- To set a variable pair, use the syntax: {{set:myVariable}}My Variable Content{{/set:myVariable}}
	- To retrieve a variable pair, use the syntax: {{get:myVariable}}
- **Minification**
	- If you would like to minify (remove extra spaces and line breaks) your final parsed output, set the $minify variable in settings.php to true (ships as true). If you do not want to minify the output, set $minify to false.
- **Delete Orphaned Files**
	- If $removeOrphaned is set to "true" in settings.php, BuilderApp will remove any orphaned files in the public HTML directory. This keeps you from needing to make deletions in two places. If you delete a file in the pages directory, it will be deleted from your public directory the next time you build.
	- Set $removeOrphaned to false to tell BuilderApp to leave any files and directories in your public directory that are not in your pages directory alone.
	- The $orphanedFileExlude array allows you to exlude specific files from being removed by BuilderApp.
	- The $orphanedDirectoryExclude array allows you to specify directories and their contents to exclude from being removed by BuilderApp.

## {{rootPath}}

The {{rootPath}} variable has to be given special treatment because it has to detect what level the page is. This is because it needs to generate something friendly to portable static sites. As such, anything past the first level needs to generate the path in the style of "../".

So, if the page is being generated on the root of the site, {{rootPath}} is blank. But if it is a level 2 or level 3 page (or deeper), then the correct path is generated as '../../', etc.

So for instance, in the header include, you could link to the stylesheet like so:

	<link rel="stylesheet" href="{{rootPath}}css/style.css">

## Feedback

This is a work in progressa and I welcome feedback. I’ve been primarily a front-end developer until recently and I certainly have not "mastered" PHP. So feel free to give me feed back, or contribute.

## License

Copyright 2014 TJ Draper.

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

	http://www.apache.org/licenses/LICENSE-2.0

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.