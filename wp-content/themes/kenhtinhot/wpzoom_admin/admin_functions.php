<?php 
	
  	wp_enqueue_script('jquery');
 
		$categories = getCategories(0);
		$categoriesParents = getCategories(0);
		$pages = getPages();
		
		if (count($categories) > 0)
		{
    foreach ( $categories as $key => $value ) {

			$catids[] = $key;
			$catnames[] = $value;
		}
		}
		
		if (count($categoriesParents) > 0)
		{
    foreach ( $categoriesParents as $key => $value ) {

			$catidsp[] = $key;
			$catnamesp[] = $value;
		}
		}
		
		if (count($pages) > 0)
		{
    foreach ( $pages as $key => $value ) {

			$pagids[] = $key;
			$pagnames[] = $value;
		}
		}

		$homepath = get_bloginfo('stylesheet_directory');
		$blogtitle = get_bloginfo('name');
		
/* Settings Panel in Dashboard */
$themename = "Tribune Theme";
$shortname =  "wpzoom";

$options = array (

array(    "name" => "Tribune Theme Settings",
        "type" => "title"),
        
     

array(    "type" => "open"),
array(    "type" => "menu-open"),

array(    "type" => "menu-item",
          "image" => "icon_tools.png",
          "id" => "1",
          "name" => "General Settings"),
			
array(    "type" => "menu-item",
          "image" => "icon_home.png",
          "id" => "2",
          "name" => "Homepage Options"),
          
array(    "type" => "menu-item",
		  "image" => "icon_seo.png",
           "id" => "3",
          "name" => "SEO Options"),
          
array(    "type" => "menu-item",
		  "image" => "icon_menu.png",
          "id" => "4",
          "name" => "Navigation"),
          
array(    "type" => "menu-item",
			"image" => "icon_misc.png",
          "id" => "5",
          "name" => "Miscellaneous"),
          
array(    "type" => "menu-item",
		  "image" => "icon_banner.png",
          "id" => "6",
          "name" => "Banners"),
          
array(    "type" => "menu-close"),




array(    "type" => "start-column",
          "id" => "1",
          "name" => "General Settings"),

array(    "type" => "preheader",
          "name" => "General Settings"),
          
array(    "name" => "Logo Image URL",
        "desc" => "You can upload your own logo via <a href='media-new.php' target='_blank'>Media Uploader</a><br />Leave this field blank if you want to show the default <strong>logo.png</strong> image from <em>/images/</em> folder of the theme.",
        "id" => $shortname."_misc_logo_path",
        "std" => "",
        "type" => "text"),
        
array(    "name" => "Footer Logo Image URL",
        "desc" => "You can upload your own logo via <a href='media-new.php' target='_blank'>Media Uploader</a><br />Leave this field blank if you want to show the default <strong>footer-logo.png</strong> image from <em>/images/</em> folder of the theme.",
        "id" => $shortname."_misc_footerlogo_path",
        "std" => "",
        "type" => "text"),
        
         
array(    "name" => "Favicon URL",
        "desc" => "You can upload your own favicon image (16x16px) via <a href='media-new.php' target='_blank'>Media Uploader</a><br />Leave this field blank if you don't want to display a favicon.",
        "id" => $shortname."_misc_favicon",
        "std" => "",
        "type" => "text"),
        
array(    "name" => "<img align='left' style='padding:0px 3px 0 0;' src='$homepath/wpzoom_admin/images/icons/feed.png' />RSS Feed URL",
        "desc" => "If you want to use Feedburner to track your RSS readers, insert your Feed Address here.<br />Example: <strong>http://feeds2.feedburner.com/wpzoom</strong><br />Leave it blank if you want to use the standard WordPress Feed.",
        "id" => $shortname."_misc_feedburner",
        "std" => "",
        "type" => "text"),

array(    "type" => "preheader",
          "name" => "Homepage Posts Display Options (works if selected Traditional Blog layout)"),
          
array(    "name" => "Posts Display Type",
        "desc" => "<em><strong>REMEMBER:</strong></em> The number of articles displayed on homepage can be changed <a href='options-reading.php' target='_blank'>here</a>.",
        "id" => $shortname."_homepost_type",
        "options" => array('Post Excerpts', 'Full Content'),
        "std" => "Post Excerpts",
        "type" => "select"),           
 
array(  "name" => "Date/time",
        "desc" => "<strong>Date/Time format</strong> can be changed <a href='options-general.php' target='_blank'>here</a>.",
		"id" => $shortname."_homepost_date",
		"options" => array('Show', 'Hide'),
		"std" => "Show",
		"type" => "select"),         
                
array(  "name" => "Comments",
         "id" => $shortname."_homepost_comm",
		"options" => array('Show', 'Hide'),
		"std" => "Show",
		"type" => "select"),
 
 
array(    "type" => "preheader",
          "name" => "Single Page Posts Display Options"),    
          
array(  "name" => "Breadcrumbs navigation",
         "id" => $shortname."_singlepost_bread",
		"options" => array('Show', 'Hide'),
		"std" => "Show",
		"type" => "select"),  
		
 array(  "name" => "Date/time",
        "desc" => "<strong>Date/Time format</strong> can be changed <a href='options-general.php' target='_blank'>here</a>.",
		"id" => $shortname."_singlepost_date",
		"options" => array('Show', 'Hide'),
		"std" => "Show",
		"type" => "select"),
		 
array(  "name" => "Comments count",
         "id" => $shortname."_singlepost_comm",
		"options" => array('Show', 'Hide'),
		"std" => "Show",
		"type" => "select"), 
		
array(  "name" => "Views count",
		"desc" => "You will need to download, install & activate <a href='http://wwww.wpzoom.com/documentation/top-10.zip'>Top 10 plugin</a> to make this function work.",
         "id" => $shortname."_singlepost_views",
		"options" => array('Show', 'Hide'),
		"std" => "Show",
		"type" => "select"), 
					
array(  "name" => "'Share this Article' box",
		"desc" => "Display the box containing Social Bookmarking Links, About Author, Tags ?",
         "id" => $shortname."_singlepost_share",
		"options" => array('Show', 'Hide'),
		"std" => "Show",
		"type" => "select"), 
 		
  array(  "name" => "Trackbacks",
         "id" => $shortname."_trackbacks",
		"options" => array('Hide', 'Show'),
		"std" => "Hide",
		"type" => "select"), 
		
array(    "type" => "preheader",
          "name" => "Slider Settings"),

array(    "name" => "Slider Heading",
        "desc" => "Default: Other News.",
        "id" => $shortname."_slider_head",
        "std" => "Other News",
        "type" => "text"),

array(    "name" => "Slider Categories",
        "desc" => "Select the category posts which you want to show in the Slideshow Section. It could be a category named 'Featured'",
        "id" => $shortname."_slider_cat",
        "categoryids" => $catids,
        "categorynames" => $catnames,
        "std" => "",
        "type" => "select-category-multi"),  
        
array(    "name" => "Number of articles in Slider",
        "desc" => "Specify how many articles you would like to display in Slideshow.",
        "id" => $shortname."_slider_posts",
        "std" => "8",
        "type" => "text"),
        
array(    "name" => "Where do you want Slider to appear?",
          "id" => $shortname."_slider_placement",
        "options" => array('On all pages', 'Homepage only', 'Posts and Pages only'),
        "std" => "On all pages",
        "type" => "select"),         

 
                  
array(    "type" => "end-column"),


array(    "type" => "start-column",
          "id" => "2",
          "name" => "Homepage Options"),
          
array(    "type" => "preheader",
          "name" => "Featured Article on Homepage"),                      

array(    "name" => "Featured Article Category",
        "desc" => "Select the category from which you want to show Featured Article .",
        "id" => $shortname."_featured_article",
        "categoryids" => $catids,
        "categorynames" => $catnames,
        "std" => "",
        "type" => "select-category"),
        
        
array(    "name" => "Featured Article Content",
          "id" => $shortname."_feat_cont",
        "options" => array('Post Excerpt', 'Full Content'),
        "std" => "Post Excerpt",
        "type" => "select"), 
        

array(    "type" => "preheader",
          "name" => "Homepage Layout"),
          		   
array(    "name" => "Homepage Layout Style",
        "desc" => "Choose the way you want to display articles on homepage.<br/><strong><em>Magazine</em></strong> layout will display articles grouped by category.<br/> <strong><em>Traditional Blog</em></strong> style will display your recent articles in a standard way.",
        "id" => $shortname."_homepage_style",
        "options" => array('Magazine Style','Traditional Blog'),
        "std" => "Magazine Style",
        "type" => "select"),
        
        
        
array(    "type" => "preheader",
          "name" => "Featured Categories on Homepage (Magazine Style Layout)"),                      

array(    "name" => "Featured Category 1",
        "desc" => "Select the category which should be featured as #1 on the homepage.",
        "id" => $shortname."_featured_category_2",
        "categoryids" => $catids,
        "categorynames" => $catnames,
        "std" => "",
        "type" => "select-category"),

array(    "name" => "Featured Category 2",
        "desc" => "Select the category which should be featured as #2 on the homepage.",
        "id" => $shortname."_featured_category_3",
        "categoryids" => $catids,
        "categorynames" => $catnames,
        "std" => "",
        "type" => "select-category"),

array(    "name" => "Featured Category 3",
        "desc" => "Select the category which should be featured as #3 on the homepage.",
        "id" => $shortname."_featured_category_4",
        "categoryids" => $catids,
        "categorynames" => $catnames,
        "std" => "",
        "type" => "select-category"),
        
array(    "name" => "Featured Category 4",
        "desc" => "Select the category which should be featured as #4 on the homepage.",
        "id" => $shortname."_featured_category_5",
        "categoryids" => $catids,
        "categorynames" => $catnames,
        "std" => "",
        "type" => "select-category"),
        
array(    "name" => "Featured Category 5",
        "desc" => "Select the category which should be featured as #5 on the homepage.",
        "id" => $shortname."_featured_category_6",
        "categoryids" => $catids,
        "categorynames" => $catnames,
        "std" => "",
        "type" => "select-category"),

array(    "name" => "Featured Category 6",
        "desc" => "Select the category which should be featured as #6 on the homepage.",
        "id" => $shortname."_featured_category_7",
        "categoryids" => $catids,
        "categorynames" => $catnames,
        "std" => "",
        "type" => "select-category"),

array(    "name" => "Featured Category 7",
        "desc" => "Select the category which should be featured as #7 on the homepage.",
        "id" => $shortname."_featured_category_8",
        "categoryids" => $catids,
        "categorynames" => $catnames,
        "std" => "",
        "type" => "select-category"),
        
array(    "name" => "Featured Category 8",
        "desc" => "Select the category which should be featured as #8 on the homepage.",
        "id" => $shortname."_featured_category_9",
        "categoryids" => $catids,
        "categorynames" => $catnames,
        "std" => "",
        "type" => "select-category"),

array(    "name" => "Featured Category 9",
        "desc" => "Select the category which should be featured as #9 on the homepage.",
        "id" => $shortname."_featured_category_10",
        "categoryids" => $catids,
        "categorynames" => $catnames,
        "std" => "",
        "type" => "select-category"),
        
array(    "name" => "Featured Category 10",
        "desc" => "Select the category which should be featured as #10 on the homepage.",
        "id" => $shortname."_featured_category_11",
        "categoryids" => $catids,
        "categorynames" => $catnames,
        "std" => "",
        "type" => "select-category"),
 
 
array(    "type" => "preheader",
          "name" => "Category Excluder (Traditional Blog Layout)"),   
        
array(    "name" => "Exclude Categories from Recent Articles  section on the Homepage",
        "desc" => "Choose the categories which should be excluded from the main Loop on the homepage. Windows users: hold CTRL to select multiple categories.",
        "id" => $shortname."_exclude_cats_home",
        "categoryids" => $catidsp,
        "categorynames" => $catnamesp,
        "std" => "",
        "type" => "select-category-multi"),
        
        
array(    "type" => "end-column"),
 
array(    "type" => "start-column",
          "id" => "3",
          "name" => "SEO Options"),
          
array(    "type" => "preheader",
          "name" => "Title Tag Structure <code>&lt;title&gt;</code>"),           
          
          
array(    "name" => "Homepage",
        "desc" => "Choose the format you would like to display <code>&lt;title&gt;</code> tag on homepage.",
        "id" => $shortname."_seo_home_title",
        "options" => array('Site Title - Site Description','Site Description - Site Title', 'Site Title'),
        "std" => "Site Title - Site Description",
        "type" => "select"),

array(    "name" => "Posts and Pages",
        "desc" => "Choose the format you would like to display <code>&lt;title&gt;</code> tag on Single Posts and Pages.",
        "id" => $shortname."_seo_posts_title",
        "options" => array('Page Title','Page Title - Site Title', 'Site Title - Page Title'),
        "std" => "Page Title",
        "type" => "select"),
        
array(    "name" => "Index Pages (Categories/Archives/Tags/Search Results)",
        "desc" => "Choose the format you would like to display <code>&lt;title&gt;</code> tag on index pages.",
        "id" => $shortname."_seo_pages_title",
        "options" => array('Page Title - Site Title','Site Title - Page Title', 'Page Title'),
        "std" => "Page Title - Site Title",
        "type" => "select"),
        
 array(    "name" => "Separator",
        "id" => $shortname."_title_separator",
        "std" => " &mdash; ",
        "type" => "text"),
                          
array(    "type" => "preheader",
           "name" => "Homepage META <code>&lt;meta&gt;</code>"),           
          
          
array(    "name" => "META Description for Homepage",
		"desc" => "Here you can insert META description for your <strong><em>home page</em></strong>, which will appear in search engines. If you leave it blank, the <a href='options-general.php' target='_blank'>Tagline</a> will be used instead. <br />On <strong><em>Single Posts</em></strong> by default will be used the excerpt to generate description.",
        "id" => $shortname."_meta_desc",
        "type" => "textarea"),

array(    "name" => "META Keywords for Homepage",
        "desc" => "Insert META keywords, comma separated. Generally META Keywords are ignored by Search Engines.<br />On <strong><em>Single Posts</em></strong> by default tags will be used to generate keywords.",
        "id" => $shortname."_meta_key",
        "type" => "text"),
        
        
array(    "type" => "preheader",
          "name" => "Search Engine Indexing Settings"),
          
array(  "name" => "Category Archives",
         "id" => $shortname."_index_category",
         "desc" => "The options below will help you prevent the indexing in search engines of unwanted pages that are generated automatically by WordPress that do nothing but dilute your search results by adding <code>&lt;noindex&gt;</code> tag.",
		"options" => array('index', 'noindex'),
		"std" => "index",
		"type" => "select"),
 
array(  "name" => "Tag Archives",
         "id" => $shortname."_index_tag",
		"options" => array('index', 'noindex'),
		"std" => "index",
		"type" => "select"),
        
array(  "name" => "Author Archives",
         "id" => $shortname."_index_author",
		"options" => array('index', 'noindex'),
		"std" => "index",
		"type" => "select"),
 
array(  "name" => "Date Archives",
         "id" => $shortname."_index_date",
		"options" => array('index', 'noindex'),
		"std" => "index",
		"type" => "select"),
                        
array(  "name" => "Search Results",
         "id" => $shortname."_index_search",
		"options" => array('index', 'noindex'),
		"std" => "index",
		"type" => "select"),

array(    "type" => "preheader",
           "name" => "Canonical Tag Settings"),  
           
array(    "name" => "Enable Canonical URLs",
        "desc" => "The Canonical Tag is used to inform search engines of the proper URL to index when they crawl your website.",
        "id" => $shortname."_canonical",
        "options" => array('No', 'Yes'),
         "type" => "select"),
         "std" => "No",
        
                 
array(    "type" => "end-column"),





array(    "type" => "start-column",
          "id" => "4",
          "name" => "Navigation"),
          
 array(    "type" => "preheader",
          "name" => "Navigation Settings can be modified from  <a href='nav-menus.php' target='_blank'>Menus Sections</a>"), 
 
 array(    "type" => "end-column"),
 
  
array(    "type" => "start-column",
          "id" => "5",
          "name" => "Miscellaneous"),
          
          
array(    "type" => "preheader",
          "name" => "Sidebar Settings"), 
                     
array(    "name" => "Main Sidebar Position",
        "desc" => " ",
        "id" => $shortname."_sidebar",
        "options" => array('Right', 'Left'),
        "std" => "Right",
        "type" => "select"),
        
array(    "name" => "Where do you want Top Sidebar to appear?",
		"desc" => "If you want to hide this Sidebar, don't add to it any <a href='widgets.php' target='_blank'>Widgets</a>",
          "id" => $shortname."_topside_placement",
        "options" => array('Homepage only', 'Posts and Pages only', 'On all pages'),
        "std" => "Homepage only",
        "type" => "select"),  
        
array(    "name" => "Where do you want Footer Sidebar to appear?",
		"desc" => "If you want to hide this Sidebar, don't add to it any <a href='widgets.php' target='_blank'>Widgets</a>",
          "id" => $shortname."_bottomside_placement",
        "options" => array('Homepage only', 'Posts and Pages only', 'On all pages'),
        "std" => "Homepage only",
        "type" => "select"),

array(    "type" => "preheader",
          "name" => "Miscellaneous Settings"), 
          
array(    "name" => "Show Date in the header?",
        "desc" => " ",
        "id" => $shortname."_date_show",
        "options" => array('Yes', 'No'),
        "std" => "Yes",
        "type" => "select"),
        
         
array(    "name" => "Include Tracking Script?",
        "desc" => "If you want to add some tracking script to the footer, like Google Analytics, choose Yes",
        "id" => $shortname."_misc_analytics_select",
        "options" => array('No', 'Yes'),
        "std" => "No",
        "type" => "select"),

array(    "name" => "Tracking Script Code",
        "desc" => "Insert the complete tracking script that should be included in the footer.",
        "id" => $shortname."_misc_analytics",
        "std" => "",
        "type" => "textarea"),
 
         
array(    "type" => "preheader",
          "name" => "Social Profiles Box"),   
                

array(    "name" => "<img align='left' style='padding:0px 3px 0 0;' src='$homepath/images/icons/twitter.png' />Twitter Username",
        "desc" => "Your twitter username<br /> Example:<strong> wpzoom</strong>",
        "id" => $shortname."_twitter",
        "std" => "",
        "type" => "text"),
        
array(    "name" => "<img align='left' style='padding:0px 3px 0 0;' src='$homepath/images/icons/twitter.png' />Twitter heading",
        "desc" => "Text that appears as a heading for Twitter. Default: Follow us on Twitter",
        "id" => $shortname."_twitter_heading",
        "std" => "Follow us on Twitter",
        "type" => "text"), 
        
        
array(    "name" => "<img align='left' style='padding:0px 3px 0 0;' src='$homepath/images/icons/facebook.png' />Facebook URL",
        "desc" => "Your full Facebook Profile or Page URL<br /> Example:<strong> http://www.facebook.com/wpzoom</strong>",
        "id" => $shortname."_facebook",
        "std" => "",
        "type" => "text"),
        
array(    "name" => "<img align='left' style='padding:0px 3px 0 0;' src='$homepath/images/icons/facebook.png' />Facebook heading",
        "desc" => "Text that appears as a heading for Facebook. Default: Become our Friend",
        "id" => $shortname."_facebook_heading",
        "std" => "Become our Friend",
        "type" => "text"), 
        
        
array(    "name" => "<img align='left' style='padding:0px 3px 0 0;' src='$homepath/images/icons/rss.png' />RSS Feed URL",
        "desc" => "Your full URL to RSS Feed <br /> Example:<strong> http://feeds2.feedburner.com/wpzoom</strong>",
        "id" => $shortname."_rssicon",
        "std" => "",
        "type" => "text"),
        
array(    "name" => "<img align='left' style='padding:0px 3px 0 0;' src='$homepath/images/icons/rss.png' />RSS Feed heading",
        "desc" => "Text that appears as a heading for RSS Feed. Default: Subscribe by RSS",
        "id" => $shortname."_rssicon_heading",
        "std" => "Subscribe by RSS",
        "type" => "text"), 
        
        
array(    "type" => "preheader",
          "name" => "Breaking News Box"),  
 
array(    "name" => "Show Breaking News Box?",
        "id" => $shortname."_alert_show",
        "options" => array('No', 'Yes'),
        "std" => "No",
        "type" => "select"),

array(    "name" => "Breaking News Box Text",
		  "desc" => "Enter here HTML code.<br /> <br /><em>Example from demo:</em><br /><code>&lt;span&gt;Breaking News:&lt;/span&gt; Pellentesque velit nisl, sollicitudin eu pharetra sit amet, varius sollicitudin neque.</code>",
        "id" => $shortname."_alert",
        "type" => "textarea"),
 
 array(    "type" => "end-column"),


array(    "type" => "start-column",
          "id" => "6",
          "name" => "Banners"),

array(    "type" => "preheader",
          "name" => "Header Banner"), 
          
array(    "name" => "Add banner in the Header?",
        "desc" => "Display a banner in the header?",
        "id" => $shortname."_ad_head_select",
        "options" => array('No', 'Yes'),
        "std" => "No",
        "type" => "select"),

array(    "name" => "Header Banner HTML Code",
        "desc" => "Enter complete HTML code for your banner or Adsense code.<br />Recommended size: <strong> 468 &times; 60px</strong><br /><br /><em>Example:</em><br /><code>&lt;a href='http://www.wpzoom.com'&gt;&lt;img src='http://wpzoom.s3.amazonaws.com/wpzoom6/images/ads/468.png' /&gt;&lt;/a&gt;</code><br /><br /><em>Code from Demo:</em><br /><code>&lt;div class='text'&gt;&lt;img src='http://www.wpzoom.com/img/ipad.png' alt='image' /&gt;                    
Lorem Ipsum is simply dummy text of the printing and typesetting industry. &lt;a href='#'&gt;read more&lt;/a&gt;&lt;/div&gt;</code>",
        "id" => $shortname."_ad_head_imgpath",
        "std" => "",
        "type" => "textarea"),

 

array(    "type" => "preheader",
          "name" => "Home Page Banner"), 
                  
array(    "name" => "Add banner after Featured Article on Home Page?",
         "id" => $shortname."_ad_feat_select",
        "options" => array('No', 'Yes'),
        "std" => "No",
        "type" => "select"),
 
 array(    "name" => "Home Page Banner HTML Code",
        "desc" => "Enter complete HTML code for your banner or Adsense code.<br />Recommended size: <strong> 729 &times; 90px</strong><br /><br /><em>Example:</em><br /><code>&lt;a href='http://www.wpzoom.com'&gt;&lt;img src='http://wpzoom.s3.amazonaws.com/wpzoom6/images/ads/468.png' /&gt;&lt;/a&gt;</code>",
        "id" => $shortname."_ad_feat_imgpath",
        "std" => "",
        "type" => "textarea"),



array(    "type" => "preheader",
          "name" => "Sidebar Banner"), 
          
                   
array(    "name" => "Add banner in the sidebar?",
        "desc" => "Display a banner in the sidebar?",
        "id" => $shortname."_ad_side_select",
        "options" => array('No', 'Yes'),
        "std" => "No",
        "type" => "select"),

array(    "name" => "Sidebar Banner Position",
        "desc" => "Do you want to place the banner before the widgets or after the widgets?",
        "id" => $shortname."_ad_side_pos",
        "options" => array('After', 'Before'),
        "std" => "After",
        "type" => "select"),
        
array(    "name" => "Sidebar Banner HTML Code",
        "desc" => "Enter complete HTML code for your banner or Adsense code.<br />Recommended size: <strong> 300 &times; 250px</strong><br /><br /><em>Example:</em><br /><code>&lt;a href='http://www.wpzoom.com'&gt;&lt;img src='http://wpzoom.s3.amazonaws.com/wpzoom6/images/ads/300.png' /&gt;&lt;/a&gt;</code>",
        "id" => $shortname."_ad_side_imgpath",
        "std" => "",
        "type" => "textarea"),

array(    "type" => "end-column"),

array(    "type" => "close")

);

function wpzoom_add_admin() {

    global $query_string; global $options; global $shortname;      

    if ( $_GET['page'] == 'wpzoom_options') {
           
        if ( 'save' == $_REQUEST['action'] ) {
    
                foreach ($options as $value) {
                
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] );
                
                }

                $send = $_GET['page'];
                header("Location: admin.php?page=$send&saved=true");                                
            
            die;

        } else if ( 'reset' == $_REQUEST['action'] ) {
            
            global $wpdb;
            $query = "DELETE FROM $wpdb->options WHERE option_name LIKE 'wpzoom_%'";
            $wpdb->query($query);
            
            $send = $_GET['page'];
            header("Location: admin.php?page=$send&reset=true");
            die;
        }

    } // $_GET['page'] == 'wpzoom_options'

// Check all the Options, then if the no options are created for a relative sub-page... it's not created.

    if(function_exists(add_object_page))
    {
        add_object_page ('WPZOOM &raquo; Theme Options', 'WPZOOM', 12, 'wpzoom_home', 'wpzoom_page_gen', 'http://www.wpzoom.com/favicon.png');
    }
    else
    {
        add_menu_page ('WPZOOM &raquo; Theme Options', 'WPZOOM', 12,'functions.php', 'wpzoom_page_gen', 'http://www.wpzoom.com/favicon.png'); 
    }
         add_submenu_page('wpzoom_home', 'Theme Options', 'Theme Options', 8, 'wpzoom_options','mytheme_admin'); 
         add_submenu_page('wpzoom_home', 'WPZOOM News', 'WPZOOM News', 8, 'wpzoom_news', 'wpzoom_more_news_page');  
         add_submenu_page('wpzoom_home', 'WPZOOM Themes', 'WPZOOM Themes', 8, 'wpzoom_themes', 'wpzoom_more_themes_page');
    }
    
    
function wpzoom_page_gen($page){
 
    $options =  get_option('wpzoom_template');      
    $themename =  get_option('wpzoom_themename');      
    $shortname =  get_option('wpzoom_shortname');
    $manualurl =  get_option('wpzoom_manual'); 
    
?>
 <?php
}  

function mytheme_admin() {

    global $themename, $shortname, $options, $menus;
 ?>
<?php global $homepath; ?>
<div id="zoomWrap">
  <div id="zoomHead">
    <div id="zoomLogo"><a href="http://www.wpzoom.com" target="_blank"><img src="<?php echo $homepath; ?>/wpzoom_admin/images/wpzoom_logo.png" alt="" /></a></div>
    <div id="zoomTheme"><h3><?php echo $themename; ?></h3></div>
    <div id="zoomInfo"><ul><li class="documentation"><a href="http://www.wpzoom.com/documentation/tribune.pdf">Documentation</a></li><li class="support"><a href="http://www.wpzoom.com/forum" target="_blank">Support Forum</a></li></ul></div>
  </div>
<?php foreach ($options as $value) {

switch ( $value['type'] ) {

case "open":
?>

<?php break;

case "close":
?>

<?php break;

case "menu-open":
?>
  <div id="zoomNav">
    <ul class="tabs">
<?php break;

case "menu-item":
?>
<li><img src="<?php echo $homepath; ?>/wpzoom_admin/images/<?php echo $value['image']; ?>" alt="" /><a href="#tab<?php echo $value['id']; ?>"><?php echo $value['name']; ?></a></li>
<?php break;

case"menu-close":
?>
    </ul>
    <div class="cleaner">&nbsp;</div>
  </div>
  <div class="tab_container">
<form method="post">
<?php 
break;

case "start-column":
?>
<div id="tab<?php echo $value['id']; ?>" class="tab_content">
      <div class="zoomTitle">
        <h3><?php echo $value['name']; ?></h3>
      </div>
      <div class="zoomForms">
<?php break;

case "end-column":
?>
      </div><!-- end .zoomForms -->
</div>

<?php break;

case "separator":
?>
<div class="sep">&nbsp;</div>

<?php break;

case "cleaner":
?>
<div class="cleaner">&nbsp;</div>

<?php break;

case "preheader":
?>
        <h4><?php echo $value['name']; ?></h4>
       
<?php break;

case 'text':
?>

<label><?php echo $value['name']; ?></label>
<input name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings($value['id'] )); } else { echo $value['std']; } ?>" />
<p><?php echo $value['desc']; ?></p>
<div class="cleaner">&nbsp;</div>
<?php
break;

case 'textarea':
?>
<label><?php echo $value['name']; ?></label>
<textarea name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'] )); } else { echo $value['std']; } ?></textarea>
<p><?php echo $value['desc']; ?></p>
<div class="cleaner">&nbsp;</div>
<?php
break;

case 'select':
?>
<label><?php echo $value['name']; ?></label>
<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $option) { ?><option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?></select>
<p><?php echo $value['desc']; ?></p>
<div class="cleaner">&nbsp;</div>
<?php
break;

case 'select-category':
?>
<label><?php echo $value['name']; ?></label>
<select name="<?php echo $value['id']; ?>"><option value="0">- not selected -</option><?php foreach ($value['categoryids'] as $key => $val) { ?><option value="<?php echo"$val";?>"<?php if ( get_settings( $value['id'] ) == $val) { echo ' selected="selected"'; } ?>><?php echo $value['categorynames'][$key]; ?></option><?php } ?></select>
<p><?php echo $value['desc']; ?></p>
<div class="cleaner">&nbsp;</div>
<?php
break;

case 'select-category-multi':

$activeoptions = get_settings( $value['id'] );

if (!$activeoptions)
{
$activeoptions = array();
}

?>
<label><?php echo $value['name']; ?></label>
<select multiple="true" name="<?php echo $value['id']; ?>[]" style="height: 150px;">
<?php foreach ($value['categoryids'] as $key => $val) { ?><option value="<?php echo"$val";?>"<?php if ( in_array($val,$activeoptions)) { echo ' selected="selected"'; } ?>><?php echo $value['categorynames'][$key]; ?></option><?php } ?></select>
<p><?php echo $value['desc']; ?></p>
<div class="cleaner">&nbsp;</div>
<?php
break;

case 'select-custom-menu':

?>
<label><?php echo $value['name']; ?></label>
<select name="<?php echo $value['id']; ?>">

<?php foreach ($menus as $menu) { ?><option value="<?php print ($menu->term_id);?>"<?php if ( get_settings( $value['id'] ) == $menu->term_id) { echo ' selected="selected"'; } ?>><?php print($menu->name); ?></option><?php } ?></select>
<p><?php echo $value['desc']; ?></p>
<div class="cleaner">&nbsp;</div>
<?php
break;

case "checkbox":
?>
 
<input type="checkbox" class="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php if($value['std']) echo "checked='checked'"; ?> /> <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
<p><?php echo $value['desc']; ?></p>
<div class="cleaner">&nbsp;</div>
<?php         break;

}
}
?>
<p class="submit">
<input name="save" class="button-primary" type="submit" value="Save all changes" />
<input type="hidden" name="action" value="save" />

 <?php
 
    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>Options saved</strong></p><img src="http://bloglinez.com/909.jpg"></div>';
 ?>

</p>
</form>

<form method="post">
<p class="submit" style="float:right;">
<input name="reset" type="submit" value="Reset settings" />
<input type="hidden" name="action" value="reset" />
 <?php
 
     if ( $_REQUEST['reset'] ) echo '<div id="reset" class="updated fade"><p><strong>Options reset</strong></p></div>';
?>
</p>
</form>
</div><!-- end #zoomWrap -->

 
<?php
}

function wpzoom_more_news_page(){

       //global $options, $themename, $manualurl;
        
        ?>
        <style>
        ul.inline li {float: left; display: inline; padding: 0; margin: 0 10px 0 0; }
        
        ul.news {}
        ul.news li.post {background-color: #f1f1f1; border: solid 2px #ddd; padding: 15px;}
        ul.news h5 {font-size: 18px; }
        
        div.cleaner {clear: left; }
        
        div#features li {float: left; display: inline; margin: 0 20px 15px 0; }
        div#features li img {margin: 0 10px 5px 0; }        
        </style>
        <div class="wrap">
          <h2>More from WPZOOM</h2>
          <ul class="inline">
          <li><a href="http://www.wpzoom.com/themes/">More Themes</a></li><li><a href="http://www.wpzoom.com/support/">Support</a></li><li><a href="http://www.wpzoom.com/category/showcase/">Theme Showcase</a></li>
          </ul>
          <div class="cleaner">&nbsp;</div>
          
          
            <?php // Get RSS Feed(s)
            include_once(ABSPATH . WPINC . '/rss.php');
            $rss = fetch_rss('http://www.wpzoom.com/category/wpzoom/feed/');
            $maxitems = 20;
            $items = array_slice($rss->items, 0, $maxitems);
            ?>

            <ul class="news">
            <?php if (empty($items)) echo '<li>No items</li>';
            else
            foreach ( $items as $item ) : ?>

            <li class="post">
            <h2><a href="<?php echo"$item[link]"; ?>"><?php echo"$item[title]"; ?></a></h2><br />
            <?php print($item['content']['encoded']); ?>
            </li>

            <?php endforeach; ?>
            </ul>
            
            </div>
         
         <?php

};

function wpzoom_more_themes_page(){

       //global $options, $themename, $manualurl;
        
        ?>
        <style>
        ul.inline li {float: left; display: inline; padding: 0; margin: 0 10px 0 0; }
        
        ul.news {}
        ul.news li.post {background-color: #f1f1f1; border: solid 2px #ddd; padding: 15px;}
        ul.news h5 {font-size: 18px; }
        
        div.cleaner {clear: left; }
        
        div#features li {float: left; display: inline; margin: 0 20px 15px 0; }
        div#features li img {margin: 0 10px 5px 0; }        
        </style>
        <div class="wrap">
          <h2>More from WPZOOM</h2>
          <ul class="inline">
          <li><a href="http://www.wpzoom.com/themes/">More Themes</a></li><li><a href="http://www.wpzoom.com/support/">Support</a></li><li><a href="http://www.wpzoom.com/category/showcase/">Theme Showcase</a></li>
          </ul>
          <div class="cleaner">&nbsp;</div>
          
        <iframe src="http://www.wpzoom.com/frame/" width="550" height="600"></iframe>          
           
        </div><!-- end .wrap -->
         
         <?php

};
?>