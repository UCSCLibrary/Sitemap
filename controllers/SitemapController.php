<?php
class Sitemap_SitemapController extends Omeka_Controller_AbstractActionController
{	
	public function showAction() {

        $this->getResponse()
             ->setHeader('Content-Type', 'application/xml');
	}	
}
?>