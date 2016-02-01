
=====================
Introduction to Basic
=====================

Basic boasts a clean HTML5 structure with extensible CSS classes and IDs for
unlimited theming possibilities as well as a top-down load order for improved
SEO. It is fully responsive out-of-the-box and provides an adaptive, elegant,
SASS-based grid system (Bourbon Neat).

Basic's goal is to provide themers the building blocks needed to get their
designs up and running quickly and simply.

Basic is perfect if you want a simple, smart, and flexible theme starter.

Less code spam, more ham.


============
Installation
============

Basic utilizes SASS for adaptive grids and layouts and general structure of the
site. It's recommended to use SASS for building out your theme. The following
packages are included via 'npm install'
  - SASS (http://sass-lang.com/)
  - Bourbon (http://bourbon.io/)
  - Bourbon Neat (http://neat.bourbon.io/)

Basic is meant to be YOUR theme. To change the name of the theme from 'basic' to
another name like 'mytheme', follow these steps BEFORE enabling the theme:

  - Rename the theme folder to 'mytheme'
  - Rename basic.info.yml to mytheme.info.yml
  - edit basic.info.yml and change the name, description, project (can be
    deleted), and change all other instances of 'basic' to 'mytheme'
  - Rename basic.theme to mytheme.theme
  - in basic.theme, change each instance of 'basic' to 'mytheme'
  - Rename config/schema/basic.schema.yml to mytheme.schema.yml
  - Rename each file in config/install from block.block.basic_tools.yml (for
    example) to block.block.mytheme_tools.yml
  - Every file in config/install, change each instance of 'basic' to
    'mytheme'
  - In js/source/scripts.js, change each instance of 'basic' to 'mytheme'
  - In theme-settings.php, change each instance of 'basic' to 'mytheme'
  - In templates/html.html.twig, change each instance of 'basic' to 'mytheme'
  - In templates/menu-local-tasks.html.twig, change each instance of 'basic' to
    'mytheme'
  - In templates/status-messages.html.twig, change each instance of 'basic' to
    'mytheme'

When renaming, remember the following:

  - Do not simply replace every instance of 'basic' in every file in the theme.
    Most of Basic's dependencies use the word 'basic' somewhere and renaming
    these instances will cause Basic to break in unpredictable ways.

  - If you don't rename all these files, you may get a vague and unhelpful error
    message when attempting to enable your theme: "The website encountered an
    unexpected error. Please try again later." Turn on a higher level of error
    logging in your server's php.ini to help determine what you've missed.

  - If you don't bother renaming Basic in the above locations, be advised that
    you will run into conflicts with other versions of Basic on your site. If
    your site uses more than one theme based on Basic, make sure at least one of
    the themes has been renamed properly!


============================
How to compile SASS in Basic
============================

To use SASS and automatically compile it within your theme, please refer to "How
to Use Grunt with Basic" in the documentation below.

If you don't like Grunt, or would just prefer to use SASS' internal watch
functionality, simply cd into your theme directory and run:

  sass --style expanded --watch sass:css


=======================
What are the files for?
=======================

- basic.info.yml
  Provide informations about the theme, like regions and libraries.
- block.html.twig
  Template to edit the blocks.
- comment.html.twig
  Template to edit the comments.
- node.html.twig
  Template to edit the nodes (in content).
- page.html.twig
  Template to edit the page.
- basic.theme
  Used to modify Drupal's default behavior before outputting HTML through the
  templates.
- theme-settings.php
  Provides additional settings in the theme settings page.


============
In /sass
============

- layout/layout.sass
  Defines the layout of the theme (compiles to css/layout/layout.css)
- theme/print.sass
  Defines the way the theme looks when printed (compiles to css/theme/print.css)
- components/tabs.sass
  Styles for the admin tabs (compiles to css/components/tabs.css)


===================
Changing the Layout
===================

The layout used in Basic is fairly similar to the Holy Grail method. It has been
tested on all major browsers including IE (5 to >10), Opera, Firefox, Safari,
and Chrome. The purpose of this method is to have a minimal markup for an ideal
display. For accessibility and search engine optimization, the best order to
display a page is the following:

1. Header
2. Content
3. Sidebars
4. Footer

This is how the page template is buit in Basic, and it works in fluid and fixed
layout. Refer to the notes in layout.sass to see how to modify the layout.


===========================
How to Use Grunt with Basic
===========================

Grunt (http://gruntjs.com/) requires Node.JS to be installed on your machine.
There are various package managers that can handle this for you.

https://nodejs.org/download/

Once Node.JS is installed, go to the root folder of Basic and install your Grunt
packages:

  npm install

This will install the neccessary node_modules to run Grunt. In order for Grunt
to work from the command line we are going to need the Grunt CLI. Open a new
Terminal window and type:

  npm install -g grunt-cli

This will install the CLI globally. Restart terminal when that is complete and
you will now be able to use Grunt commands.

Once installed, cd to the root folder of Basic and run Grunt via the command
line:

  grunt

This will initialize Grunt and start watching changes to your SASS files. Voilà!


==============
Updating Basic
==============

Once you start using Basic, you will massively change it until you reach the
point where it has nothing to do with Basic anymore. Unlike Zen, Basic is not
intended to be use as a base theme for a sub-theme (even though it is possible
to do so). Because of this, it is not necessary to update your theme when a new
version of Basic comes out. Always see Basic as a STARTER, and as soon as you
start using it, it is not Basic anymore, but your own theme.

If you didn't rename your theme, but you don't want to be notified when Basic
has a new version by the update module, simply delete "project = "basic" in
basic.info.yml.


================
Bugs & Questions
================

Thanks for using Basic, and remember to use the issue queue in drupal.org for
any questions or bug reports:

http://drupal.org/project/issues/basic


====================
Current maintainers:
====================
* Steve Krueger (SteveK)   - https://www.drupal.org/u/stevek
* Leah Marsh (leahtard)    - https://www.drupal.org/u/leahtard
* Joël Pittet (joelpittet) - https://www.drupal.org/u/joelpittet
