<?php

// create a form for metadata browsing configuration options 
echo '<div id="xml_sitemap_config_form">';
echo '<h3>Decide What Omeka Content to Include:</h3>';
echo '<div class="field">';
echo '<label for="xml_sitemap_include_simple_pages">Include Public Simple Pages:</label>';
echo __v()->formCheckbox('xml_sitemap_include_simple_pages', true, 
    array('checked'=>(boolean)get_option('xml_sitemap_include_simple_pages')));
echo "</div>";
echo '<div class="field">';
echo '<label for="xml_sitemap_include_tags">Include Tags:</label>';
echo __v()->formCheckbox('xml_sitemap_include_tags', true, 
    array('checked'=>(boolean)get_option('xml_sitemap_include_tags')));
echo "</div>";
echo '<div class="field">';
echo '<label for="xml_sitemap_include_category_browser">Include Browsing Categories:</label>';
echo __v()->formCheckbox('xml_sitemap_include_category_browser', true, 
    array('checked'=>(boolean)get_option('xml_sitemap_include_category_browser')));
echo "</div>";
echo '<div class="field">';    
echo '<label for="xml_sitemap_include_exhibits">Include Exhibits:</label>';
echo __v()->formCheckbox('xml_sitemap_include_exhibits', true, 
    array('checked'=>(boolean)get_option('xml_sitemap_include_exhibits')));
echo "</div>";

echo "<h3>Assign Sitemap Ranking Priority for Content (0.1-1.0):</h3>";
echo xml_sitemap_set_rank('xml_sitemap_home_ranking','Homepage');
echo xml_sitemap_set_rank('xml_sitemap_main_ranking','Main Navigational Choices and Simple Pages');
echo xml_sitemap_set_rank('xml_sitemap_item_ranking','Items');
echo xml_sitemap_set_rank('xml_sitemap_exhibit_ranking','Exhibits');
echo xml_sitemap_set_rank('xml_sitemap_collection_ranking','Collections');
echo xml_sitemap_set_rank('xml_sitemap_catsandtags_ranking','Categories and Tags');

echo "<h3>Assign Expected Update Frequency for Content:</h3>";
// for the change frequencies 
echo xml_sitemap_set_freq('xml_sitemap_change_home_freq', 'Home Page');
echo xml_sitemap_set_freq('xml_sitemap_change_main_freq', 'Main Navigation Choices and Simple Pages');
echo xml_sitemap_set_freq('xml_sitemap_change_item_freq', 'Items');
echo xml_sitemap_set_freq('xml_sitemap_change_exhibit_freq', 'Exhibits');
echo xml_sitemap_set_freq('xml_sitemap_change_collection_freq', 'Collections');
echo xml_sitemap_set_freq('xml_sitemap_change_catsandtags_freq', 'Categories and Tags');


?>