=== Firmidable Plugin ===

Contributors: ferkungamabooboo
Tags: seo, site speed, metadata, forms, lead tracking, analytics, a/b testing, social code
Requires at least: 4.7
Tested up to: 4.9
Requires PHP: 5.4
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

An extendable plugin to help development of WordPress sites for Firmidable. This inclues SEO, lead tracking, forms, SMTP, and analytics.

== Description ==

This is a plugin to help the team at [Firmidable](https://firmidable.com/) to help with various tasks. Without changes, it can do the following:
* Load jQuery from the official CDN, with an SHA check
* Clean out unneeded code from the header
* Noindex a subdomain for cloned installs of the site
* Rewrite title tags and meta descriptions
* Install Facebook Open Graph meta tags
* Install Twitter Card meta tags
* Install a robust and lightweight form client with source tracking
* Run the form client via SMTP
* Save form submissions in the database
* Install the [CallRail](https://www.callrail.com/agency/) Dynamic Number Insertion code
* Install the [nGage](https://www.ngagelive.com/legal/) Live Chat code
* Install Google Analytics
* Install the Facebook Pixel
* Set up an A/B test using Google Analytics and site cookies (you still need to add code to the theme to do something with the cookies)
* Add the LinkedIn embed codes

== Installation ==
1. [Download](https://github.com/ferkungamaboobo/firmidable-wordpress/archive/master.zip) the master file
1. Unzip it and upload the "tmc" folder to your plugins directory.
1. Activate the plugin from the Plugins tab.

== Frequently Asked Questions ==

= What if I need a feature not in the plugin? =

Take a look at the current feature

= What is in the pipeline to be created, fixed, or changed in the main plugin files? = 

Check the (GitHub Issues)[https://github.com/ferkungamaboobo/firmidable-wordpress/issues] for the plugin to see if it's being addressed. Feel free to add to the issues or make a pull request to work on it yourself!

= Where would I learn about a given feature? =
Check the (GitHub Wiki)[https://github.com/ferkungamaboobo/firmidable-wordpress/wiki] for the plugin.

== Changelog ==
The full changelog without version numbers can be seen at the (GitHub History)[https://github.com/ferkungamaboobo/firmidable-wordpress/commits/master/tmc] for the plugin.

= .05 =
*Feb 2, 2018*
* Updated title tag handling on archive and author pages

= .04 =
*May 30, 2017*
* Made some fixes to the Analytics tracking of forms
* Added styles to the Forms Submissions pages

= .03 =
*May 26, 2017*
* Initial Commit

== Upgrade Notice ==

= .05 =
This update fixes issues with sites using a traditional blog setuo. If the site uses a blog,this is a necessary upgrade.
