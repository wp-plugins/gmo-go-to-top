<?php
/*
Plugin Name: GMO Go to Top
Plugin URI: http://wpshop.com
Description: GMO Go to Top is simple plugin and it will add a simple button which allows users to easily scroll back to the top of the page.
Version: 1.2
Author: WP Shop byGMO
Author URI: http://wpshop.com
*/


$gmo_go_to_top = new gmo_go_to_top();

class gmo_go_to_top{

private $default_img_color = '#bfbfbf';
private $default_type ='icon_select';
private $default_icon_fontstyle = 'gmo-icon-arrow-up2';
private $gmogototop = array();
private $default_direction ='right';
private $default_iconsize ='30';
private $default_marginlr ='30';
private $default_marginbottom ='30';


	
	function __construct(){
		add_action('wp_footer', array($this, 'go_to_top_tag'));
		add_action('admin_menu', array($this,'go_to_top_manu'));
		add_action('wp_enqueue_scripts',array($this,'go_top_scripts'));
		add_action('admin_init', array($this, 'admin_init'));
	}

	public function admin_init(){
			if(isset($_POST['img_color'])) {
				update_option('gmogototop[img_color]', $_POST['img_color']);
			} else if(!get_option('gmogototop[img_color]')) {
				update_option('gmogototop[img_color]', $this->default_img_color);
			} 
			if(isset($_POST['icon_fontstyle'])) {
				update_option('gmogototop[icon_fontstyle]', $_POST['icon_fontstyle']);
			} else if(!get_option('gmogototop[icon_fontstyle]')) {
				update_option('gmogototop[icon_fontstyle]', $this->default_icon_fontstyle);
			}
			if(isset($_POST['type'])) {
				update_option('gmogototop[type]', $_POST['type']);
			} else if(!get_option('gmogototop[type]')) {
				update_option('gmogototop[type]', $this->default_type);
			}
			if(isset($_POST['direction'])) {
				update_option('gmogototop[direction]', $_POST['direction']);
			} else if(!get_option('gmogototop[direction]')) {
				update_option('gmogototop[direction]', $this->default_direction);
			}
			if(isset($_POST['uploadimg'])) {
				update_option('gmogototop[uploadimg]', $_POST['uploadimg']);
			}
			if(isset($_POST['iconsize'])) {
				update_option('gmogototop[iconsize]', $_POST['iconsize']);
			} else if(!get_option('gmogototop[iconsize]')) {
				update_option('gmogototop[iconsize]', $this->default_iconsize);
			}
			if(isset($_POST['marginlr'])) {
				update_option('gmogototop[marginlr]', $_POST['marginlr']);
			} else if(!get_option('gmogototop[marginlr]')) {
				update_option('gmogototop[marginlr]', $this->default_marginlr);
			}
			if(isset($_POST['marginbottom'])) {
				update_option('gmogototop[marginbottom]', $_POST['marginbottom']);
			} else if(!get_option('gmogototop[marginbottom]')) {
				update_option('gmogototop[marginbottom]', $this->default_marginbottom);
			}
	}

	public function go_to_top_tag(){
		echo '<div id="gmo_go_top" style="position:fixed;cursor: pointer;z-index:999999;display:none;"></div>';
	}

	public function go_top_scripts() {
		wp_enqueue_script('jquery');
		wp_enqueue_script( 'gmo_go_top_script', plugin_dir_url( __FILE__ ) .'script.js' );
		wp_enqueue_style('iconvault-preview',plugins_url('iconvault/iconvault-preview.css', __FILE__));
	    wp_enqueue_style('gene',plugins_url('genericons/genericons.css', __FILE__));
		if(get_option('gmogototop[type]') == 'icon_select'){
			$gmo_go_to_top_array = array(
				'types' => get_option('gmogototop[type]'),
				'fontsytle' => get_option('gmogototop[icon_fontstyle]'),
				'color' => get_option('gmogototop[img_color]'),
				'direction' => get_option('gmogototop[direction]'),
				'iconsize' => get_option('gmogototop[iconsize]'),
				'marginlr' => get_option('gmogototop[marginlr]'),
				'marginbottom' => get_option('gmogototop[marginbottom]')
			);
		}
		if(get_option('gmogototop[type]') == 'images_select'){
			$gmo_go_to_top_array = array(
				'types' => get_option('gmogototop[type]'),
				'image' => get_option('gmogototop[uploadimg]'),
				'direction' => get_option('gmogototop[direction]'),
				'marginlr' => get_option('gmogototop[marginlr]'),
				'marginbottom' => get_option('gmogototop[marginbottom]')
			);
		}
		wp_localize_script( 'gmo_go_top_script', 'gmo_go_to_top', $gmo_go_to_top_array );
	}

	public function go_to_top_manu(){
		add_options_page(
			'GMO Go To Top',
			'GMO Go To Top',
			'administrator',
			'go_to_top',
			array($this,gmo_go_to_top)
		);
	}
	
	public function gmo_go_to_top(){
	    wp_enqueue_style('gmo-go-to-top-style',plugins_url('css/gmo-plugins.min.css', __FILE__));
	    wp_enqueue_style('go-to-top-style',plugins_url('css/go-to-top-style.css', __FILE__));
	    wp_enqueue_style('iconvault-preview',plugins_url('iconvault/iconvault-preview.css', __FILE__));
	    wp_enqueue_style('gene',plugins_url('genericons/genericons.css', __FILE__));
		$plugin_file_url = plugins_url() . '/';
		$image_url1 = $plugin_file_url.'gmo-go-to-top/images/'.'wpshop_logo.png';
		$image_url2 = $plugin_file_url.'gmo-go-to-top/images/'.'wpshop_bnr_themes.png';
		$image_url3 = $plugin_file_url.'gmo-go-to-top/images/'.'wpshop_bnr_plugins.png';
		wp_enqueue_media();
		wp_enqueue_style( 'farbtastic' );
		wp_enqueue_script('gmo-go-to-top-uploader',plugin_dir_url( __FILE__ ).'uploader.js');
		wp_enqueue_script('gmo-go-to-top-colorpic',plugin_dir_url( __FILE__ ).'colorpic.js');	
		wp_enqueue_script( 'farbtastic' );
		$icon_array = array(
		'gmo-icon-arrow-up2',
		'gmo-icon-smiley',
		'gmo-icon-airplane',
		'gmo-icon-arrow-up',
		'gmo-icon-rocket',
		'gmo-icon-thumbs-up',
		'gmo-icon-pacman',
		'gmo-icon-eject',
		'gmo-icon-arrow-up3',
		'gmo-icon-point-up',
		'gene genericon-digg',
		'gene genericon-collapse',
		'gene genericon-top',
		'gene genericon-uparrow'
		);

?>
		<div id="gmoplugins" class="wrap">
			<h2>GMO Go To Top</h2>
				
		<!-- #gmoplugLeft -->
			<div id="gmoplugLeft">
			<h3>settings</h3>			
			<form action="<?php echo admin_url(); ?>options-general.php?page=go_to_top" method="post">
				<table>
					<tr>
						<td>Select Icon or images</td>
						<td>
							<ul class="type_select">
								<li<?php if(get_option('gmogototop[type]') == 'icon_select') echo ' class="select_icon" '; ?>><div class="icon_select">icon select</div></li>
								<li<?php if(get_option('gmogototop[type]') == 'images_select') echo ' class="select_icon" '; ?>><div class="images_select">images select</div></li>
							</ul>
						</td>
					</tr>
					<tbody id="icon_table">
					<tr>
						<td>Select Icon</td>
						<td>
							<ul class="icon_font">
							<?php
							$font_count = count($icon_array);
 							for($i=0; $i<$font_count; $i++){
							?>
								<li<?php if(get_option('gmogototop[icon_fontstyle]') == $icon_array[$i]) echo ' class="select_icon" '; ?>><i class="<?php echo $icon_array[$i]; ?>"></i></li>
							<?php
							}	
							?>
							</ul>
						</td>
					</tr>
					<tr>
						<td>Color</td>
						<td>
							<div id="color_picker"> </div>
		            		<p><input type="text" id="img_color" name="img_color" value="<?php echo esc_attr( get_option('gmogototop[img_color]') ); ?>" /></p>
						</td>
					</tr>
					<tr>
						<td>Size</td>
						<td>
		            		<p><input type="number" name="iconsize" value="<?php echo esc_attr(get_option('gmogototop[iconsize]')) ?>" min="10" max="1000">px</p>
						</td>
					</tr>
					</tbody>
					<tr id="images_table">
						<td>Select Image</td>
						<td>
							<button id="up_botan">image select</button>
							<input type="text" value="<?php echo esc_attr(get_option('gmogototop[uploadimg]')); ?>" id="images_url" name="uploadimg">
						</td>
					</tr>
					<tr>
						<td>Horizontal Distance from Edge</td>
						<td>
		            		<p><input type="number" name="marginlr" value="<?php echo esc_attr(get_option('gmogototop[marginlr]')) ?>" min="10" max="1000">px margin</p>
						</td>
					</tr>
					<tr>
						<td>Vertical Distance from Edge</td>
						<td>
		            		<p><input type="number" name="marginbottom" value="<?php echo esc_attr(get_option('gmogototop[marginbottom]')) ?>" min="10" max="1000">px margin</p>
						</td>
					</tr>
					<tr>
						<td>position</td>
						<td>
							<input type="radio" name="direction" value="left"<?php if(get_option('gmogototop[direction]') == 'left') echo ' checked="checked"'; ?>>left
							<input type="radio" name="direction" value="right"<?php if(get_option('gmogototop[direction]') == 'right') echo ' checked="checked"'; ?>>right
						</td>
					</tr>
			</table>
			<input type="hidden" name="type" value="<?php echo esc_attr(get_option('gmogototop[type]')) ?>">
			<input type="hidden" name="icon_fontstyle" value="<?php echo esc_attr(get_option('gmogototop[icon_fontstyle]')); ?>">
			<input type="submit" value="Save Changes" id="submit" class="button button-primary">
			</form>
				
				
			</div>
		<!-- #gmoplugLeft -->

		<!-- #gmoplugRight -->
		<div id="gmoplugRight">
		<h3>WordPress Themes</h3>
		<ul>
		<li><a href="https://wordpress.org/themes/kotenhanagara" target="_blank">Kotehanagara</a></li>
		<li><a href="https://wordpress.org/themes/madeini" target="_blank">Madeini</a></li>
		<li><a href="https://wordpress.org/themes/azabu-juban" target="_blank">Azabu Juban</a></li>
		<li><a href="http://wordpress.org/themes/de-naani" target="_blank">de naani</a></li>
		</ul>
		<a href="http://wpshop.com/themes?=vn_wps_gototop" target="_blank"><img src="<?php echo $image_url2; ?>" alt="WPShop by GMO WordPress Themes for Everyone!"></a>
		<ul><li class="bnrlink"><a href="http://wpshop.com/themes?=wps_gototop" target="_blank">Visit WP Shop Themes</a></li></ul>
		<h3>WordPress Plugins</h3>
		<ul>
		<li><a href="http://wordpress.org/plugins/gmo-showtime/" target="_blank">GMO Showtime</a></li>
		<li><a href="http://wordpress.org/plugins/gmo-font-agent/" target="_blank">GMO Font Agent</a></li>
		<li><a href="http://wordpress.org/plugins/gmo-share-connection/" target="_blank">GMO Share Connection</a></li>
		<li><a href="http://wordpress.org/plugins/gmo-ads-master/" target="_blank">GMO Ads Master</a></li>
		<li><a href="http://wordpress.org/plugins/gmo-page-transitions/" target="_blank">GMO Page Trasitions</a></li>
		<li><a href="http://wordpress.org/plugins/gmo-go-to-top/" target="_blank">GMO Go to Top</a></li>
		</ul>
		<a href="http://wpshop.com/plugins?=vn_wps_gototop" target="_blank"><img src="<?php echo $image_url3; ?>" alt="WPShop by GMO WordPress Plugins for Everyone!"></a>
		<ul><li class="bnrlink"><a href="http://wpshop.com/plugins?=wps_gototop" target="_blank">Visit WP Shop Plugins</a></li></ul>
		<h3>Contact Us</h3>
		<a href="http://support.wpshop.com/?page_id=15" target="_blank"><img src="<?php echo $image_url1; ?>" alt="WPShop by GMO"></a>
		</div>
		<!-- #gmoplugRight -->

		</div>
		<!-- #gmoplugins -->
<?php
	}
	
}