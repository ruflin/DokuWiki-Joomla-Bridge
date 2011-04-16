DokuWiki Joomla Bridge
======================

All additional informations for the bridge can be found in the old [blog entries](http://ruflin.com/en/hints/161-joomla-dokuwiki-bridge).

Setup
-----

Copy the file `dokuwiki/inc/auth/joomla.class.php` to your dokuwiki installation

Change the following line in your `dokuwiki/config/dokuwiki.php` file
	
	$conf['authtype'] = 'plain';

replace by
	
	$conf['authtype'] = 'joomla';
	
If your joomla admin has a different name then admin, change the following line and replace admin by the specific username
	
  	$conf['superuser'] = 'admin';

Adjust the path to the joomla configuration file. The assumption is made, that dokuwiki installed inside the joomla folder.
	
	include_once '../configuration.php';

Done. Login with your joomla users into dokuwiki.