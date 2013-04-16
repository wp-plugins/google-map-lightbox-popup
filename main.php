<?php
/*
Plugin Name:Google Map Lightbox
Plugin URI: http://www.wpfruits.com/
Description: This plugin will show Google Map in Lightbox.
Author: Gunjan Rai, Megha, rahulbrilliant2004, tikendramaitry
Version: 1.0.0
Author URI: http://www.wpfruits.com
*/
// ----------------------------------------------------------------------------------

// ADD Styles and Script in head section
add_action('admin_init', 'gfullmap_backend_scripts');
add_action('wp_enqueue_scripts', 'gfullmap_frontend_scripts');

include_once('admin/admin.php');

function gfullmap_backend_scripts() {
	if(is_admin()){
		wp_enqueue_script ('jquery');		
		wp_enqueue_style( 'gfullmap_backend_style',plugins_url('admin/gfullmap_admin.css',__FILE__), false, '1.0.0' );	
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_register_script('my-upload', plugins_url('js/my-script.js',__FILE__), array('jquery','media-upload','thickbox'));
		wp_enqueue_script('my-upload');
		wp_enqueue_style('thickbox');
		}
}

function gfullmap_frontend_scripts() {	
	if(!is_admin()){
		wp_enqueue_script('jquery');
		wp_enqueue_script('gfullmap',plugins_url('js/gfullmap.js',__FILE__), array('jquery'),'1.0.0',true);		
		wp_enqueue_style('gfullmap_front_style',plugins_url('css/gfullmap.css',__FILE__));
	}
}
//-------------------------------------------------------------------------------------
// Hook for adding admin menus
add_action('admin_menu', 'gfullmap_plugin_admin_menu');
function gfullmap_plugin_admin_menu() {
     add_menu_page('gfullmap', 'GoogleMap lightbox','administrator', 'gfullmap', 'gfullmap_backend_menu',plugins_url('images/map-icon.png',__FILE__));
	 add_submenu_page('gfullmap', 'Edit Map','', 'administrator','edit-map','edit_details');
}
//This function will create new database fields with default values
function gfullmap_defaults(){
	    $default = array(
		'g_image_path'=>'',
		'g_thumb_address' => 'New York, USA',
		'g_thumb_width' => 250,
		'g_thumb_height' => 250,
		'g_map_type' => 'roadmap',
		'g_zoom_val' => '15',
		'glightbox_width' => 450,
        'glightbox_height' => 450,
        'glightbox_map_type' => 'roadmap',
        'glightbox_zoom_val' => '15',
        'glightbox_bubble' => '1'
		
    );
	return $default;
}

function create_fwgm_table(){
    global $wpdb;
	$table_name = $wpdb->prefix . "fullwidthgooglemap"; 
		$sql = "CREATE TABLE " . $table_name . " (
		  id mediumint(9) NOT NULL AUTO_INCREMENT,
		  option_name VARCHAR(255) NOT NULL DEFAULT  'gfullmap_options',
		  active tinyint(1) NOT NULL DEFAULT  '0',
		  PRIMARY KEY (`id`),
          UNIQUE (
                    `option_name`
            )
		);";
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}
// Runs when plugin is activated and creates new database field

function gfullmap_plugin_install(){

	$gfullmap_options = get_option('gfullmap_options');

	if(!$gfullmap_options){}
	add_option('gfullmap_options', gfullmap_defaults());
	
	global $wpdb;
	$table_name = $wpdb->prefix . "fullwidthgooglemap"; 

	if($wpdb->get_var("show tables like '$table_name'") == $table_name){}
	else{
		create_fwgm_table();
		$table_name = $wpdb->prefix . "fullwidthgooglemap"; 
		$sql = "INSERT INTO " . $table_name . " values ('','gfullmap_options','1');";
		$wpdb->query( $sql );
	}
}
register_activation_hook(__FILE__,'gfullmap_plugin_install');

// update the gfullmap options
if(isset($_POST['gfullmap_update'])){
	update_option('gfullmap_options', gfullmap_updates());
}

function gfullmap_updates() {
	$options = $_POST['gfullmap_options'];
	    $update_val = array(       		
		'g_image_path'=>$options['g_image_path'],		
		'g_thumb_address' => $options['g_thumb_address'],
		'g_thumb_width' => $options['g_thumb_width'],
		'g_thumb_height' => $options['g_thumb_height'],
		'g_map_type' => $options['g_map_type'],
		'g_zoom_val' => $options['g_zoom_val'],
		'glightbox_width' => $options['glightbox_width'],
        'glightbox_height' => $options['glightbox_height'],
        'glightbox_map_type' => $options['glightbox_map_type'],
        'glightbox_zoom_val' => $options['glightbox_zoom_val'],
        'glightbox_bubble' => $options['glightbox_bubble']
    );
	return $update_val;
}

// get gfullmap version
function gfullmap_get_version(){
	if ( ! function_exists( 'get_plugins' ) )
	require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	$plugin_folder = get_plugins( '/' . plugin_basename( dirname( __FILE__ ) ) );
	$plugin_file = basename( ( __FILE__ ) );
	return $plugin_folder[$plugin_file]['Version'];
	}
	
	

add_action('activated_plugin','save_error');
function save_error(){
    update_option('plugin_error',  ob_get_contents());
}
	
	
function gfullmap_backend_menu(){
wp_nonce_field('update-options'); $options = get_option('gfullmap_options'); 
echo get_option('plugin_error');
?>

<div class="wrap"> <!--wrap div start-->
	<div id="icon-themes" class="icon32"></div>
	<h2> <?php _e('GoogleMap LightBox '.gfullmap_get_version().' Setting\'s','gfullmap'); ?> </h2>
</div>	<!--wrap div end-->
<div id="poststuff">
   <?php global $fwbm;
       if(isset($_REQUEST['gfullmap_add_btn'])){
			add_map_details();
			}
			
		if(isset($_GET['deactivate'])){		
		 	echo "<div class='gmapfrnt-show-message'>"; 
			_e('Map Has been Deactivated','gfullmap');
			echo "</div>";
		}
		
		if(isset($_GET['activate'])){	
			echo "<div class='gmapfrnt-show-message'>"; 
			_e('Map Has been Activated','gfullmap');
			echo "</div>";
		}
		
		if(isset($_GET['delete'])){	
			echo "<div class='gmapfrnt-show-message'>"; 
			_e('Map Has been Deleted','contactform');
			echo "</div>";	
		}
		
	?>			
			
	<div class="postbox" id="gfullmap_admin"> <!-- postbox start -->
		<h3 class="hndle"><span style="font-family: verdana;"> <?php _e("Table Of Lightbox Google Map",'gfullmap'); ?> </span></h3>
		<div class="inside" style="padding: 0px; float:left;margin:0px;width:100%;">	<!-- inside div start -->				
		    <table style = "text-align:center; font-weight:bold; font-size:12px;">
				<tr>
					 <td style=" color:#04569A;width:112px;"> ID </td>
					 <td style="color:#04569A; "> Map Name</td>
					 <td style="width:157px;color:#04569A; "> Shortcode</td> 
					 <td style="text-align:right;color:#04569A;"> Edit Map</td> 
					 <td style="text-align:right;width:150px;color:#04569A;">Activate Map</td> 
					 <td style="width:176px;color:#04569A;">Delete Map</td> 
					  
				</tr>
			</table>			
			<?php  if(!(isset($_GET['add']) && $_GET['add']==1)) {
					fwgm_get_map_details();		
			} ?>
			
			<?php  if((isset($_GET['add']) && $_GET['add']==1)) { 				
				display_map_info();
			} ?>
			
			
			<div class="form_cont">
				<form method="post" action="?page=gfullmap&add=1"> <!-- Add new Map Form start -->
					<table>
						<tr>
						 <td><input style=" border: 1px solid #AAAAAA;" type="text" id="fullmap_option_name" name="fullmap_option_name" size="50" /></td>
						 <td> <span><?php _e('*Please Do not use spaces and special characters in map name','gfullmap'); ?></span> </td>
						 <td><input type="submit" value=" <?php _e('Add Map','gfullmap'); ?> " class="button-primary" id="gfullmap_add_btn" name="gfullmap_add_btn"></td>
						</tr>				
					</table>			
				</form>	 <!-- Add new Map Form end-->  
			</div>	
		
		</div><!-- inside div end -->	
	</div> <!-- postbox div end -->
</div> <!-- poststuff end -->
<?php } ?>