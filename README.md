# BuilderApp — Static Site Generator 0.3.0

## CAUTION: Still a work in progress!

## About

If you have occasion to build simple static HTML sites that just don't warrant the use of a full blown CMS — or are building portable, distributable pages for something like documentation where it must be static HTML files, but want to remain [DRY] and keep common parts of the site in template/include files, this may be for you.

It’s a simple, bare-bones sort of thing, but it get’s the job done.

[DRY]: http://en.wikipedia.org/wiki/Don't_repeat_yourself

## More Caution

It is not recommended to have the \_builder directory live on a live server. The idea is that you would use it in a local environment via [MAMP] or [EasyPHP] or some other local server on your computer, then deploy the generated content to your production server. There is no security in place at this time. At the very least, if you do commit and deploy it to a production server, use .htaccess to keep unwanted persons out of the \_builder directory.

[MAMP]: http://www.mamp.info/
[EasyPHP]: http://www.easyphp.org/

## How It Works

When you load up http://yourlocalserver.dev/_builder/, BuilderApp parses the contents of your pages directory, mirroring its structure to the webroot ()assumed as the parent folder), parsing your includes and variables.

## Variable parsing

### {{root_path}}

The {{root_path}} variable has to be given special treatment because it has to detect what level the page is. This is because it needs to generate something friendly to portable static sites. As such, anything past the first level needs to generate the path in the style of "../".

So, if the page is being generated on the root of the site, {{root_path}} is blank. But if it is a level 2 or level 3 page (or deeper), then the correct path is generated as '../../', etc.

So for instance, in the header include, you could link to the stylesheet like so:

	<link rel="stylesheet" href="{{root_path}}css/style.css">

## Single Variables

These variables are defined in the "settings.php" file in the $single_variables array. You'll see two samples in the file that you may or may not wish to keep.

Here is one of the sample variable in the array:

	'site_name' => 'BuilderApp'

In this case, "site_name" is the key, and "BuilderApp"" is the value. So you can put {{site_name}} anywhere in your templates and it will be replaced with "BuilderApp" whenever you build — just like a CMS such as ExpressionEngine, Craft, or Statamic.

Single Variables are great for never changing variables. But what if you need to set variables per template? I’m glad you asked about that.

## Variable Pairs

These are also defined in the "settings.php" file — or at least the keys are. The settings file ships with two samples of these as well. One of the samples is:

	'meta_title'

It works like this. In your template, you can set any defined variable pair key like this:

	{{meta_title}}My Page Title{{/meta_title}}

Now wherever you put the single variable {{meta_title}}, the contents between the opening and closing key pair will be substituted for that single variable. And of course, the variable pair and contents will not be printed out in the place where they are set.

### Minify (true|false)

To minify the parsed output, set this $minify variable to true in "settings.php". If you would not like to minify the output, set variable to false.

### Includes

There are two arrays for includes: includes_before and includes_after. The names of the arrays are pretty self explanatory. includes_before will include the content of the files listed in the array before the page content. includes_after will include the content of the files listed in the array after the page content.

Builder looks for includes in the "includes" directory. ".html"" is appended automatically so do not include the html file extension in the array.

## Feedback

Obviously, this is a work in progress, but I welcome feedback. I’ve been primarily a front-end developer until recently so I certainly have not "mastered" PHP. So feel free to give me feed back, or contribute, or whatever else.

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