
Introduction to Basic

The Basic theme was developed for internal use at Raincity Studios for client projects. The purpose here is to have a very minimal theme that only contains the functions that are used for all websites. This theme is not intended to have subthemes, or to be another version of Zen. Basic is only intended to provide an extremely clean and flexible start for a Drupal themer.

__________________________________________________________________________________________

Feature List (6.x)

- flexible and simple info file

- Body classes.

   1. front or not-front classes
   2. logged-in or not-logged-in classes
   3. node-type-CONTENT_TYPE class: for example, node-type-page, node-type-story and node-type-forum
   4. two-sidebars, one-sidebar sidebar-left, one-sidebar sidebar-right, or no-sidebars classes
   5. page-FULL-URL class
   6. section-FIRST-DIRECTORY class
   7. section-node-add, section-node-edit, or section-node-delete classes for node add, edit, and delete pages

- Node classes.
	
	1. admin
	2. sticky
	3. node-unpublished
	4. ntype-[node type]
	5. taxonomy
	
- Block Classes

	1. block-[block module]
	2. region-[region]
	3. odd / even
 
- Comment classes

	1. node-author
	2. zebra
	3. new
	4. mine

- Block editing links. Users with permission to edit blocks will see, when hovering over any block, links to edit that block. This is much more intuitive than first going to admin/build/blocks.

- Zen Tabs

- Minimal regions : Header / Footer / content / sidebar left / sidebar right

- Holy Grail layout

- 3/2/1 columns layout

- liquid or fixed layout

- folder architecture : css / images

__________________________________________________________________________________________

Installation

- Download Basic from http://drupal.org/project/basic
- Unpack the downloaded file and place the Basic folder in your Drupal installation under one of the following locations:

    * sites/all/themes
    * sites/default/themes
    * sites/example.com/themes 

- Log in as an administrator on your Drupal site and go to Administer > Site building > Themes (admin/build/themes) and make Basic the default theme.

If you want, you can rename the basic folder to your website name, but in version 5, remeber to also change the function basic_regions at the begining of the template.php file to [name of your theme]_regions. For Drupal 6, remember to edit the info file to change the name of the theme.


__________________________________________________________________________________________


Holy Grail Layout

The layout used in Basic, like in Zen, is the Holy Grail method. You can have a detailed information about this method here : http://www.alistapart.com/articles/holygrail

The purpose of this method is to have a minimal markup for an ideal display. For accessibility and search engine optimization, the best order to display a page is the following :

	1. header
	2. content
	3. sidebars
	4. footer

This is how the page template is buit in basic, and it works in fluid and fixed layout. 


__________________________________________________________________________________________                           
Introduction to Basic

The Basic theme was developed for internal use at Raincity Studios for client projects. The purpose here is to have a very minimal theme that only contains the functions that are used for all websites. This theme is not intended to have subthemes, or to be another version of Zen. Basic is only intended to provide an extremely clean and flexible start for a Drupal themer.

__________________________________________________________________________________________

Feature List (6.x)

- flexible and simple info file

- Body classes.

   1. front or not-front classes
   2. logged-in or not-logged-in classes
   3. node-type-CONTENT_TYPE class: for example, node-type-page, node-type-story and node-type-forum
   4. two-sidebars, one-sidebar sidebar-left, one-sidebar sidebar-right, or no-sidebars classes
   5. page-FULL-URL class
   6. section-FIRST-DIRECTORY class
   7. section-node-add, section-node-edit, or section-node-delete classes for node add, edit, and delete pages

- Node classes.
	
	1. admin
	2. sticky
	3. node-unpublished
	4. ntype-[node type]
	5. taxonomy
	
- Block Classes

	1. block-[block module]
	2. region-[region]
	3. odd / even
 
- Comment classes

	1. node-author
	2. zebra
	3. new
	4. mine

- Block editing links. Users with permission to edit blocks will see, when hovering over any block, links to edit that block. This is much more intuitive than first going to admin/build/blocks.

- Zen Tabs

- Minimal regions : Header / Footer / content / sidebar left / sidebar right

- Holy Grail layout

- 3/2/1 columns layout

- liquid or fixed layout

- folder architecture : css / images

__________________________________________________________________________________________

Installation

- Download Basic from http://drupal.org/project/basic
- Unpack the downloaded file and place the Basic folder in your Drupal installation under one of the following locations:

    * sites/all/themes
    * sites/default/themes
    * sites/example.com/themes 

- Log in as an administrator on your Drupal site and go to Administer > Site building > Themes (admin/build/themes) and make Basic the default theme.

If you want, you can rename the basic folder to your website name, but in version 5, remeber to also change the function basic_regions at the begining of the template.php file to [name of your theme]_regions. For Drupal 6, remember to edit the info file to change the name of the theme.


__________________________________________________________________________________________


Holy Grail Layout

The layout used in Basic, like in Zen, is the Holy Grail method. You can have a detailed information about this method here : http://www.alistapart.com/articles/holygrail

The purpose of this method is to have a minimal markup for an ideal display. For accessibility and search engine optimization, the best order to display a page is the following :

	1. header
	2. content
	3. sidebars
	4. footer

This is how the page template is buit in basic, and it works in fluid and fixed layout. 


__________________________________________________________________________________________