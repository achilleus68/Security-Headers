<?php
/*
Plugin Name: Cors
Version: 1.0.0
Description: Write CORS headers for security.
Plugin URI: 
Author: Achilleus
Has Settings: true
*/
if (!defined('PHPWG_ROOT_PATH')) die('Hacking attempt!');

define('CORS_ID',      basename(dirname(__FILE__)));
define('CORS_PATH' ,   PHPWG_PLUGINS_PATH . CORS_ID . '/');
define('CORS_ADMIN',get_root_url().'admin.php?page=plugin-'.CORS_ID);

/**
 * this is the core of this plugin:
 * write every header to the browser
*/

global $template, $headers, $conf;
if (isset($conf['Security-Headers'])) {
    $SecurityHeaders=unserialize($conf['Security-Headers']);
}
else {
    $SecurityHeaders='';
}
//var_dump($SecurityHeaders);

if (is_array($SecurityHeaders)) {
  foreach ($SecurityHeaders as $header => $value) {
    if(strlen($value)){
      header("$header:$value");
    }
  }
}

// Hook on to an event to show the administration page.
add_event_handler('get_admin_plugin_menu_links', 'CORS_admin_menu');

// Add an entry to the 'Plugins' menu.
function CORS_admin_menu($menu) {
 array_push(
   $menu,
   array(
     'NAME'  => 'Piwigo CORS',
     'URL'   => get_admin_plugin_menu_link(dirname(__FILE__)).'/admin.php'
   )
 );
 return $menu;
}

?>
