<?php
/**
 * Sitemap plugin
 *
 * @package     Sitemap
 * @copyright Copyright 2014 UCSC Library Digital Initiatives
 * @license http://www.gnu.org/licenses/gpl-3.0.txt GNU GPLv3
 */

/**
 * Sitemap plugin class
 * 
 * @package Sitemap
 */
class SitemapPlugin extends Omeka_plugin_AbstractPlugin
{
    public function __toString() 
    {
        return $this->name;
    }
    
    /**
     * @var array Hooks for the plugin.
     */
    protected $_hooks = array('define_routes','install','uninstall','config_form','config');

    public function hookConfigForm(){
        $serverUrlHelper = new Zend_View_Helper_ServerUrl;
        $serverUrl = $serverUrlHelper->serverUrl();
        echo '<p>A dynamic xml sitemap has been installed and populated with the public navigation links on your site, and robots.txt should have been updated to reflect this file\'s location. However, if your robots.txt file was not writable by the web server, you may have to update it manually.</p><p>If you would like like to register your sitemap with search engines, the url is:</p><h3> '.$serverUrl.public_url('sitemap.xml').'</h3><p> Thank you for using the sitemap plugin!</p>';
    }

    public function hookConfig(){
    }

    public function hookInstall() {
        $this->_update_robots();
    }


    public function hookUninstall() {
        $this->_remove_robots();
    }

    private function _remove_robots() {
        // remove reference to sitemap from robots.txt upon uninstall
        $robotspath = BASE_DIR . "/robots.txt";
        if (is_writeable($robotspath))
            {	
                $lines = file($robotspath);
                $savelines = "";
                
                foreach ($lines as $line) {
                    //echo $line;
                    $start = strpos($line, "#START XML");
                    $map = strpos($line, "Sitemap:");
                    $end = strpos($line, "#END XML");
                    if($start !== false) {
				
                    } 
                    elseif($map !== false) {
                        
                    }
                    elseif($end !== false) {
                        
                    }
                    else 
                        { 
                            $savelines .= $line; 
                        }
                    
                }
                
                $robotsfile = fopen($robotspath, 'w+');
                // write lines that were kept to the file
                fwrite($robotsfile, $savelines);
                //close file	
                fclose($robotsfile);
            }
        else { echo "Robots.txt file is not writeable"; }
    }
    
    private function _update_robots()
    {

        $serverUrlHelper = new Zend_View_Helper_ServerUrl;
        $serverUrl = $serverUrlHelper->serverUrl();
        $sitemap_uri = $serverUrl.public_url('sitemap.xml');
        //update the site robots.txt file so it lists the sitemap
        
        // options for robots file 
        $mapdef = "\n#START XML-SITEMAP-PLUGIN\n";
        $mapdef .= "Sitemap: " . $sitemap_uri . "\n";
        $mapdef .= "#END XML-SITEMAP-PLUGIN\n";
        // open file
        $robotspath = BASE_DIR . "/robots.txt";
        if (is_writeable($robotspath))
            {	
                $robotsfile = fopen($robotspath, 'a');
                //write to file
                fwrite($robotsfile, $mapdef);
                //close file	
                fclose($robotsfile);
            }
        else { 
            echo "Robots.txt file is not writeable"; 
        }
    }


    function hookDefineRoutes($args)
    {
        // Don't add these routes on the admin side to avoid conflicts.
        if (is_admin_theme()) {
            return;
        }

        $router = $args['router'];

        // Add custom routes based on the page slug.
        $router->addRoute(
            'sitemap',
            new Zend_Controller_Router_Route(
                'sitemap.xml',
                array(
                    'module'       => 'sitemap',
                    'controller'   => 'sitemap',
                    'action'       => 'show'
                )
            )
        );
    }
}
