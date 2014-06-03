# BuilderApp — Static Site Generator 0.1.0

## CAUTION: Still a work in progress!

## About

If you have occasion to build simple static HTML sites that just don't warrant the use of a full blown CMS — or are building portable, distributable pages for something like documentation where it must be static HTML files, but want to remain [DRY] and keep common parts of the site in template/include files, this may be for you.

It’s a simple, bare-bones sort of thing, but it get’s the job done.

[DRY]: http://en.wikipedia.org/wiki/Don't_repeat_yourself

## More Caution

I do not recommend letting the \_builder directory live on a live server. I built this with the idea that you would use it in a local environment via [MAMP] or [EasyPHP] or some other local server on your computer, then deploy the generated content to your production server. I have put no security in place at this time. At the very least, if you do commit and deploy it to a production server, use .htaccess to keep unwanted persons out of the \_builder directory.

[MAMP]: http://www.mamp.info/
[EasyPHP]: http://www.easyphp.org/

## How It Works

When you load up http://yourlocalserver.dev/_builder/, Builder parses and duplicates to the webroot (which is assumed to be the parent folder) the file and directory structure that you put in the "pages" directory.

## Variable parsing

I intend to add the ability to parse custom variable replacements in the future, but for now, because it required special treatment anyway, I have added one variable replacement. I envision future variable replacements to be set up in an array. Something like:

	$variables = array(
		'my_var' => 'my replacement',
		'another_var' => 'another replacement'
	)

But I have not implemented it yet because I haven't needed it. What I did need was a special variable, and it is...

### {{root_path}}

I had to give {{root_path}} special treatment because it has to detect what level it is on. I wanted it to generate something friendly to portable static sites. As such, anything past the first level needs to generate the path in the style of "../".

So, if the page is being generated on the root of the site, {{root_path}} is blank. But if it is a level 2 or level 3 page (or deeper), then the correct path is generated as '../../', etc.

So for instance, in the header include, you could link to the stylesheet like so:

	<link rel="stylesheet" href="{{root_path}}css/style.css">

## Variable Set

At this time there is one hard-coded variable set. And that is:

### {{meta_title}}

In your page template, set your meta title like this:

	{{meta_title}}My Page Title{{/meta_title}}

And then make sure in your header include that you set the variable {{meta_title}}.

The {{meta_title}} set will be removed from your final output.

## Settings

There are just a couple of settings available at the top of the build.php file and they are as follows.

### Minify (true|false)

To minify the parsed output, set this variable to true. If you would not like to minify the output, set variable to false.

### Includes

There are two arrays for includes: includes_before and includes_after. The names of the arrays are pretty self explanatory. includes_before will include the content of the files listed in the array before the page content. includes_after will include the content of the files listed in the array after the page content.

Builder looks for includes in the "includes" directory. .html is appended automatically so do not include the html file extension.

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