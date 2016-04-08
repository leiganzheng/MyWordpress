<?php
$theme = get_current_theme();
$themename = "Weekly";
$modsname = 'theme_mods_'.$theme;
$theme_data = get_theme_data( TEMPLATEPATH . '/style.css' );

$cat_array = get_categories('parent=0&hide_empty=0');
$page_array = get_pages('parent=0&hide_empty=0');
$pages_number = count($page_array);
$site_pages = array();
$site_cats = array();
$is_enabled = get_option('wumii_is_enabled');
foreach ($page_array as $pagg) {
	$site_pages[$pagg->ID] = htmlspecialchars($pagg->post_title);
	$page_ids[] = $pagg->ID;
}

foreach ($cat_array as $categs) {
	$site_cats[$categs->cat_ID] = $categs->cat_name;
	$cat_ids[] = $categs->cat_ID;
}


$options = array (
// Begin Primary Metabox Holder
	array( 	"type" => "box-container-open"),

	// General Settings
	array(  "name" => __( 'General Settings', 'themejunkie' ),
			"type" => "box-open"),
	array(  "name" => __( 'Logo Type', 'themejunkie' ),
            "id" => "logo",
            "type" => "select",
            "std" => "Image Logo",
            "options" => array("Image Logo", "Text Logo")),
	array(  "name" => __( 'Image Logo URL', 'themejunkie' ),
            "id" => "logo_url",
            "type" => "text",
            "std" => get_bloginfo('template_url').'/images/logo.png'),
	array(  "name" => __( 'Thumbnail Key', 'themejunkie' ),
            "id" => "thumb_key",
            "type" => "text",
            "std" => "thumb"),
	array(  "name" => __( 'Thumbnail Width', 'themejunkie' ),
            "id" => "thumb_width",
			"class" => "small-text",
			"desc" => "px",
            "type" => "text",
            "std" => 80),
	array(  "name" => __( 'Thumbnail Height', 'themejunkie' ),
            "id" => "thumb_height",
			"class" => "small-text",
			"desc" => "px",
			"type" => "text",
            "std" => 80),
	array( 	"type" => "box-close"),
	
	// Home Settings - Featured Posts
	array(  "name" => __( 'Featured Content Slider', 'themejunkie'),
			"type" => "box-open"),
	array(  "name" => __( '<b>Featured Posts</b> From', 'themejunkie'),
            "id" => "home_featured_from",
            "type" => "select",
            "std" => "A Category",
            "options" => array("Sticky Posts", "A Category")),	
	array(  "name" => __( 'Category for <b>Featured Posts</b>', 'themejunkie'),
			"desc" => "<br/>If you choose display featured posts from \"A Category\", please select a category for it.",
            "id" => "home_featured_cat",
            "type" => "dropcat"),	
	array(  "name" => __( '	Number of <b>Featured Posts</b>', 'themejunkie'),
            "id" => "home_featured_num",
			"std" => 8,
			"type" => "select",
			"options" => array(1,2,3,4,5,6,7,8,9,10)),
	array(  "name" => __( 'Thumbnail Height', 'themejunkie'),
            "id" => "home_featured_thumb_height",
			"class" => "small-text",
			"desc" => "px (fixed thumbnail width: 288px)",
			"type" => "text",
            "std" => 250),
	array(  "type" => "box-close"),
	
	// Home Settings - Latest Posts
	array(  "name" => __( 'Homepage - Latest News', 'themejunkie'),
			"type" => "box-open"),
	array(  "name" => __( '<b>Latest News</b> From', 'themejunkie'),
            "id" => "home_latest_from",
            "type" => "select",
            "std" => "All Categories",
            "options" => array("All Categories", "A Category")),	
	array(  "name" => __( 'Category for <b>Latest News</b>', 'themejunkie'),
			"desc" => "<br/>If you choosed display latest news from \"A Category\", please select a category for it.",
            "id" => "home_latest_cat",
            "type" => "dropcat"),	
	array(  "name" => __( '	Number of <b>Latest Posts</b>', 'themejunkie'),
            "id" => "home_latest_num",
			"std" => 9,
			"type" => "select",
			"options" => array(1,2,3,4,5,6,7,8,9,10,11,12,13,14,15)),
	array(  "type" => "box-close"),
	
	// Home Settings - Carousel Posts
	array(  "name" => __( 'Homepage - Carousel Posts', 'themejunkie'),
			"type" => "box-open"),
	array(  "name" => __( 'Enable this area', 'themejunkie'),
            "id" => "home_carousel_status",
            "type" => "select",
			"options" => array("Yes","No"),
			"std" => "Yes"),
	array(  "name" => __( 'Carousel title', 'themejunkie'),
            "id" => "home_carousel_title",
            "type" => "text",
			"std" => "Carousel",
			"desc" => "<br/>If you choosed display carousel posts from \"A Category\" and leave this blank, title will be a Category title."),	
	array(  "name" => __( '<b>Carousel Posts</b> From', 'themejunkie'),
            "id" => "home_carousel_from",
            "type" => "select",
            "std" => "All Categories",
            "options" => array("All Categories", "A Category")),	
	array(  "name" => __( 'Category for <b>Carousel Posts</b>', 'themejunkie'),
			"desc" => "<br/>If you choosed display carousel posts from \"A Category\", please select a category for it.",
            "id" => "home_carousel_cat",
            "type" => "dropcat"),	
	array(  "name" => __( '	Number of <b>Carousel Posts</b>', 'themejunkie'),
            "id" => "home_carousel_num",
			"std" => 8,
			"type" => "select",
			"options" => array(8,12,16,20)),
	array(  "name" => __( 'Thumbnail Height', 'themejunkie'),
            "id" => "home_carousel_thumb_height",
			"class" => "small-text",
			"desc" => "px (fixed thumbnail width: 128px)",
			"type" => "text",
            "std" => 80),
	array(  "type" => "box-close"),
	
	// Home Settings - One Column Category Posts
	array(  "name" => __( 'Homepage - One Column Boxes', 'themejunkie'),
			"type" => "box-open"),
	array(  "name" => __( 'Enable this area', 'themejunkie'),
            "id" => "home_onecol_status",
			"std" => "Yes",
            "type" => "select",
			"options" => array("Yes","No")),
	array(  "name" => __( 'Categories', 'themejunkie'),
            "id" => "home_onecol_cats",
            "type" => "checkbox",
			"wptype" => "cat",
            "std" => "",
            "options" => $cat_ids),	
	array(  "name" => __( '	Number of each category', 'themejunkie'),
            "id" => "home_onecol_num",
			"std" => 3,
			"type" => "select",
			"options" => array(1,2,3,4,5,6,7,8,9,10)),
	array(  "name" => __( 'Display Category RSS Feed Link', 'themejunkie'),
            "id" => "home_onecol_feedlink",
			"std" => "Yes",
            "type" => "select",
			"options" => array("Yes","No")),
	array(  "name" => __( 'Thumbnail Width', 'themejunkie' ),
            "id" => "onecol_thumb_width",
			"class" => "small-text",
			"desc" => "px",
            "type" => "text",
            "std" => 80),
	array(  "name" => __( 'Thumbnail Height', 'themejunkie' ),
            "id" => "onecol_thumb_height",
			"class" => "small-text",
			"desc" => "px",
			"type" => "text",
            "std" => 80),
	array(  "type" => "box-close"),
	
	// Home Settings - Two Column Category Posts
	array(  "name" => __( 'Homepage - Two Column Boxes', 'themejunkie'),
			"type" => "box-open"),
	array(  "name" => __( 'Enable this area', 'themejunkie'),
            "id" => "home_twocol_status",
			"std" => "Yes",
            "type" => "select",
			"options" => array("Yes","No")),	
	array(  "name" => __( 'Categories', 'themejunkie'),
            "id" => "home_twocol_cats",
            "type" => "checkbox",
			"wptype" => "cat",
            "std" => "",
            "options" => $cat_ids),
	array(  "name" => __( '	Number of posts to show on each category', 'themejunkie'),
            "id" => "home_twocol_num",
			"std" => 4,
			"type" => "select",
			"options" => array(3,4,5,6,7,8,9,10)),
	array(  "name" => __( 'Display Category RSS Feed Link', 'themejunkie'),
            "id" => "home_twocol_feedlink",
			"std" => "Yes",
            "type" => "select",
			"options" => array("Yes","No")),
	array(  "name" => __( 'Thumbnail Width', 'themejunkie' ),
            "id" => "twocol_thumb_width",
			"class" => "small-text",
			"desc" => "px",
            "type" => "text",
            "std" => 80),
	array(  "name" => __( 'Thumbnail Height', 'themejunkie' ),
            "id" => "twocol_thumb_height",
			"class" => "small-text",
			"desc" => "px",
			"type" => "text",
            "std" => 80),
	array( 	"type" => "box-close"),
	
		
	
	array( 	"type" => "box-container-close"), 
// End Primary Metabox Holder

// Begin Secondary Metabox Holder
	array( 	"type" => "box-container-open"),
	
	// Social Links
	array(  "name" => __('Social Links', 'themejunkie'),
			"type" => "box-open"),
	array(  "name" => __( 'Enable social links on top bar', 'themejunkie'),
            "id" => "social_status",
			"std" => "Yes",
            "type" => "select",
			"options" => array("Yes","No")),
	array(  "name" => "Feedburner ID",
            "id" => "feedburner_id",
            "std" => "themejunkie",
            "type" => "text"),
	array(  "name" => "Twitter ID",
            "id" => "twitter_id",
            "std" => "themejunkie",
			"type" => "text"),
	array(  "name" => "Facebook ID",
            "id" => "facebook_id",
            "std" => "themejunkie",
            "type" => "text"),
	array( 	"type" => "box-close"),
	
	// Sidebar Tabber
	array(  "name" => __( 'Sidebar Tabber', 'themejunkie'),
			"type" => "box-open"),
			
	array(  "name" => __( 'Enable sidebar tabber area', 'themejunkie'),
            "id" => "tabber_status",
			"std" => "Yes",
            "type" => "select",
			"options" => array("Yes","No")),
	
	array(  "name" => __( 'Number of popular posts to show', 'themejunkie'),
            "id" => "tabber_popular_num",
			"std" => 5,
			"type" => "select",
			"options" => array(1,2,3,4,5,6,7,8,9,10,11,12)),
			
	array(  "name" => __( 'Number of latest posts to show', 'themejunkie'),
            "id" => "tabber_latest_num",
			"std" => 5,
			"type" => "select",
			"options" => array(1,2,3,4,5,6,7,8,9,10,11,12)),
			
	array(  "name" => __( 'Number of recent comments to show', 'themejunkie'),
            "id" => "tabber_comments_num",
			"std" => 5,
			"type" => "select",
			"options" => array(1,2,3,4,5,6,7,8,9,10,11,12)),
			
	array(  "name" => __( 'Avatar & Thumbnail size <br /><br />(<span class="description">Width = Height</span>)', 'themejunkie'),
            "id" => "tabber_thumb",
            "type" => "text",
            "std" => "40"),
			
	array( 	"type" => "box-close"),
	
	
	// Single Settings - Display Author Info
	array(  "name" => __( 'Single Posts', 'themejunkie'),
			"type" => "box-open"),
	array(  "name" => __( 'Display author Bio box', 'themejunkie'),
            "id" => "display_author_info",
			"std" => "Yes",
            "type" => "select",
			"options" => array("Yes","No")),
	array(  "type" => "box-close"),

// Advertisement
	array(  "name" => __( 'Advertisement', 'themejunkie'),
			"type" => "box-open"),
			
	array(  "name" => __( 'Enable header ad area', 'themejunkie'),
            "id" => "header_ad_status",
			"std" => "No",
            "type" => "select",
			"options" => array("Yes","No")),
	array(  "name" => __( 'Enter your ad code. <br /><br /> <span class="description">(468x60)</span>', 'themejunkie'),
            "id" => "header_ad_area",
            "type" => "textarea",
            "std" => "<img src=\"".get_bloginfo('template_url')."/images/ad_468x60.gif\" alt=\"\"/>"),
	
	array(  "name" => __( 'Enable home ad#1 area', 'themejunkie'),
            "id" => "home_ad1_status",
			"std" => "No",
            "type" => "select",
			"options" => array("Yes","No")),
	array(  "name" => __( 'Enter your ad code. <br /><br /> <span class="description">(468x60)</span>', 'themejunkie'),
            "id" => "home_ad1_area",
            "type" => "textarea",
            "std" => "<img src=\"".get_bloginfo('template_url')."/images/ad_468x60.gif\" alt=\"\"/>"),

	array(  "name" => __( 'Enable home ad#2 area', 'themejunkie'),
            "id" => "home_ad2_status",
			"std" => "No",
            "type" => "select",
			"options" => array("Yes","No")),
	array(  "name" => __( 'Enter your ad code. <br /><br /> <span class="description">(468x60)</span>', 'themejunkie'),
            "id" => "home_ad2_area",
            "type" => "textarea",
            "std" => "<img src=\"".get_bloginfo('template_url')."/images/ad_468x60.gif\" alt=\"\"/>"),
	
	array(  "name" => __( 'Enable sidebar ad#1 area', 'themejunkie'),
            "id" => "sidebar_ad1_status",
			"std" => "No",
            "type" => "select",
			"options" => array("Yes","No")),
	array(  "name" => __( 'Enter your ad code. <br /><br /> <span class="description">(300x250)</span>', 'themejunkie'),
            "id" => "sidebar_ad1_area",
            "type" => "textarea",
            "std" => "<img src=\"".get_bloginfo('template_url')."/images/ad_300x250.jpg\" alt=\"\"/>"),
			
	array(  "name" => __( 'Enable Sidebar ad#2 area', 'themejunkie'),
            "id" => "sidebar_ad2_status",
			"std" => "No",
            "type" => "select",
			"options" => array("Yes","No")),
	array(  "name" => __( 'Enter your ad code. <br /><br /> <span class="description">(120x600)</span>', 'themejunkie'),
            "id" => "sidebar_ad2_area",
            "type" => "textarea",
            "std" => "<img src=\"".get_bloginfo('template_url')."/images/ad_120x600.gif\" alt=\"\"/>"),

	array(  "name" => __( 'Enable Sidebar ad#3 area', 'themejunkie'),
            "id" => "sidebar_ad3_status",
			"std" => "No",
            "type" => "select",
			"options" => array("Yes","No")),
	array(  "name" => __( 'Enter your ad code. <br /><br /> <span class="description">(300x250)</span>', 'themejunkie'),
            "id" => "sidebar_ad3_area",
            "type" => "textarea",
            "std" => "<img src=\"".get_bloginfo('template_url')."/images/ad_300x250.jpg\" alt=\"\"/>"),
	
	array(  "type" => "box-close"),

	
	// Integration Settings
	array(  "name" => __( 'Code Integration', 'themejunkie'),
			"type" => "box-open"),
			
	array(  "name" => __( 'Enable head code', 'themejunkie'),
            "id" => "head_code_status",
			"std" => "No",
            "type" => "select",
			"options" => array("Yes","No")),
	array(  "name" => __( '<span class="description">Add code to the < head > of your site</span>', 'themejunkie'),
            "id" => "head_code",
            "type" => "textarea",
            "std" => ""),

	array(  "name" => __( 'Enable body code', 'themejunkie'),
            "id" => "body_code_status",
			"std" => "No",
            "type" => "select",
			"options" => array("Yes","No")),            	
	array(  "name" => __( '<span class="description">Add code to the < body > (good tracking codes such as google analytics)</span>', 'themejunkie'),
            "id" => "body_code",
            "type" => "textarea",
            "std" => ""),
	array( 	"type" => "box-close"),
	
	array( 	"type" => "box-container-close"),
// End Secondary Metabox Holder

/**
 * Default Theme Options, include common form elements.
	array( 	"type" => "box-container-open"),
	array(  "name" => "Default Theme Options",
			"type" => "box-open"),
    array(  "name" => "Radio Selection Set",
			"desc" => "This is a descriptions",
            "id" => "radio",
            "type" => "radio",
            "std" => "3",
            "options" => array("3", "2", "1")),
    array(  "name" => "Text Box",
			"desc" => "This is a descriptions",
            "id" => "text",
            "std" => "Some Default Text",
            "type" => "text"),
    array(  "name" => "Bigger Text Box",
			"desc" => "This is a descriptions",
            "id" => "textarea",
            "std" => "Default Text",
            "type" => "textarea"),
    array(  "name" => "Dropdown Selection Menu",
			"desc" => "This is a descriptions",
            "id" => "select",
            "type" => "select",
            "std" => "Default",
            "options" => array("Default", "Option 1", "Option 2")),
    array(  "name" => "Checkbox selection set",
			"desc" => "This is a descriptions",
            "id" => "checkbox",
            "type" => "checkbox",
            "std" => "Default",
            "options" => array("Default", "Option 1", "Option 2")),
    array(  "name" => "Multiple selection box",
			"desc" => "This is a descriptions",
            "id" => "multiselect",
            "type" => "multiselect",
            "std" => "Default",
            "options" => array("Defaults", "Option 1s", "Option 2s")),
	array( 	"type" => "box-close"),
	array( 	"type" => "box-container-close")
*/
);

function hello_options() {
	global $themename, $modsname, $options;
	foreach ($options as $value) {
		$key = $value['id'];
		$val = $value['std'];
		$new_options[$key] = $val; 
	}
	add_option($modsname, $new_options );
}
add_action('wp_head', 'hello_options');
add_action('admin_head', 'hello_options');

function mytheme_add_admin() {
    global $themename, $modsname, $options;
	$settings = get_option($modsname);
    if ( $_GET['page'] == basename(__FILE__) ) {
        if ( 'save' == $_REQUEST['action'] ) {
			foreach ($options as $value) {
				if(($value['type'] === "checkbox" or $value['type'] === "multiselect" ) and is_array($_REQUEST[ $value['id'] ]))
					{ $_REQUEST[ $value['id'] ]=implode(',',$_REQUEST[ $value['id'] ]);
					}
				$key = $value['id']; 
				$val = $_REQUEST[$key];
				$settings[$key] = $val;
			}
			update_option($modsname, $settings);                   
			header("Location: themes.php?page=theme-options.php&saved=true");
            die;
        } else if( 'reset' == $_REQUEST['action'] ) {
			foreach ($options as $value) {
				$key = $value['id'];
				$std = $value['std'];
				$new_options[$key] = $std;
			}
			update_option($modsname, $new_options );
            header("Location: themes.php?page=theme-options.php&reset=true");
            die;
        }
    }
    add_theme_page($themename." Theme Options", $themename. " Theme Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');
}

function mytheme_admin() {
    
	global $themename, $modsname, $options;
	$theme_data = get_theme_data( TEMPLATEPATH . '/style.css' );
	
    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' '.__('settings saved.', 'themejunkie').'</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' '.__('settings reset.', 'themejunkie').'</strong></p></div>'; ?>
	
	<div class="wrap">
		<div class="icon32" id="icon-themes"><br></div>
		<h2><?php echo $themename; ?> <?php _e('Theme Options','themejunkie'); ?></h2>
		<div id="poststuff">
			

			<form method="post">
			<div class="metabox-holder">
				<?php 
					$settings = get_option($modsname);
					foreach ($options as $value) { 
						$id = $value['id'];
						$std = $value['std'];
						if (($value['type'] == "text") || ($value['type'] == "textarea") || ($value['type'] == "select") || ($value['type'] == "multiselect") || ($value['type'] == "checkbox") || ($value['type'] == "radio") || ($value['type'] == "dropcat")) { ?>
							<tr>
								<th><label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?>:</label></th>
								<td>
						<?php } ?>
						
						<?php if ($value['type'] == "box-container-open") { ?>
							<div class="postbox-container" style="width:49%;">
								<div id="normal-sortables" class="meta-box-sortables ui-sortable">
						<?php } elseif ($value['type'] == "box-container-close") { ?>
								</div><!-- end .meta-box-sortables -->
							</div><!-- end .post-box-container -->
						<?php } elseif ($value['type'] == "box-open") { ?>
							<div class="postbox ">
								<div class="handlediv" title="<?php _e('Show/Hide','themejunkie'); ?>"><br></div>
								<h3 class="hndle"><span><?php echo $value['name']; ?></span></h3>
								<div class="inside">
								<table class="form-table">
						<?php } elseif ($value['type'] == "box-close") { ?>
								</table><!-- end .form-table -->
								</div><!-- end .inside -->
							</div><!-- end .postbox -->
						<?php } elseif ($value['type'] == "about") { ?>
							<tr>
								<th><?php _e( 'Theme:', $domain ); ?></th>
								<td><a href="<?php echo $theme_data['URI']; ?>" title="<?php echo $theme_data['Title']; ?>"><?php echo $theme_data['Title']; ?> <?php echo $theme_data['Version']; ?></a></td>
							</tr>
							<tr>
								<th><?php _e( 'Author:', $domain ); ?></th>
								<td><?php echo $theme_data['Author']; ?></td>
							</tr>
							<tr>
								<th><?php _e( 'Description:', $domain ); ?></th>
								<td><?php echo $theme_data['Description']; ?></td>
							</tr>
						<?php } elseif ($value['type'] == "text") { ?>
							<input <?php if($value['class'] == 'small-text') echo 'class="small-text"'; else echo 'class="regular-text"';?>name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php echo $settings[$id]; ?>" size="40" />
							
						<?php } elseif ($value['type'] == "textarea") { ?>
							<textarea name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" cols="40" rows="5"/><?php echo stripslashes($settings[$id]); ?></textarea>
						<?php } elseif ($value['type'] == "select") { ?>
							<select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
								<?php foreach ($value['options'] as $option) { ?>
								<option<?php if ( $settings[$id] == $option) { echo ' selected="selected"'; }?>><?php echo $option; ?></option>
								<?php } ?>
							</select>
						<?php } elseif ($value['type'] == "multiselect") { ?>
							<select  multiple="multiple" size="3" name="<?php echo $value['id']; ?>[]" id="<?php echo $value['id']; ?>" style="height:100px;">
								<?php $ch_values=explode(',',$settings[$id] ); foreach ($value['options'] as $option) { ?>
								<option<?php if ( in_array($option,$ch_values)) { echo ' selected="selected"'; }?> value="<?php echo $option; ?>"><?php echo $option; ?></option>
								<?php } ?>
							</select>
						<?php } elseif ($value['type'] == "radio") { ?>
							<?php foreach ($value['options'] as $option) { ?>
									<?php echo $option; ?><input name="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php echo $option; ?>" 									<?php if ( $settings[$id] == $option) { echo 'checked'; } ?>/>
							<?php } ?>
						<?php } elseif ($value['type'] == "checkbox") { ?>
							<?php 
								$ch_values=explode(',',$settings[$id]);
								foreach ($value['options'] as $option) { ?>
									<input name="<?php echo $value['id']; ?>[]" type="<?php echo $value['type']; ?>" value="<?php echo $option; ?>" <?php if ( in_array($option,$ch_values)) { echo ' checked="checked"'; } ?> />
									<?php
									if($value['wptype'] == "cat") {
										echo get_cat_name($option); 
									} elseif($value['wptype'] == "page") {
										$page_data = get_page($option); 
										echo $page_data->post_title;
									} else {
										echo $option; 
									} ?>
									<br/>
									
<?php 		} ?>
						<?php } elseif ($value['type'] == "dropcat") { ?>
							<?php wp_dropdown_categories(array('selected' => get_theme_mod($value['id']), 'name' => $value['id'], 'orderby' => 'Name' , 'hierarchical' => 1, 'hide_empty' => '0' )); ?>
						<?php } ?>
						
						<?php if(isset($value['desc'])){ ?><span class="description"><?php echo $value['desc']?></span><?php } ?>
								</td>
							</tr>
					<?php } ?>
             
				</div><!-- end .metabox-holder -->
				
				<p id="submit-saved" class="submit">
					<input id="submit-saved" class="button-primary" name="save" type="submit" value="<?php _e('Save Changes','themejunkie') ;?>" />    
					<input type="hidden" name="action" value="save" />
				</p>
			</form>
			
			<form method="post">
				<p id="submit-reset" class="submit">
					<input id="submit-reset" name="reset" type="submit" value="<?php _e('Reset to Defaults','themejunkie') ;?>" />
					<input type="hidden" name="action" value="reset" />
				</p>
			</form>
	</div><!-- end #wrap -->
<?php } ?>
<?php add_action('admin_menu', 'mytheme_add_admin');

function tj_theme_options_css_js() {
	if ( $_GET['page'] == basename(__FILE__) ) {
	// wp_enqueue_script( 'common' );
	// wp_enqueue_script( 'wp-lists' );
	wp_enqueue_script( 'postbox' ); ?>
	<script type="text/javascript">
		jQuery(document).ready(function(){ // Toglle .postbox
			jQuery(".postbox").addClass("closed");
				jQuery(".handlediv").click(function(){
				jQuery(this).parent(".postbox").toggleClass("closed");
			});
		});
	</script>
	<style type="text/css">
		#submit-saved{clear:left;}
		.submit{float:left;margin:0 10px 0 0;}
	</style>
	
	<?php
	
}}
add_action('admin_head','tj_theme_options_css_js');
 $is_enabled = get_option('wumii_is_enabled');
 ?>
