<?php
/*
 * Plugin Name:       CTA Shortcodes in Post
 * Description:       This plugin This plugin adds shortcodes to posts.
 * Version:           1.0.0
 * Requires at least: 6.0.0
 * Requires PHP:      7.2
 * Author:            Igor Majan
 * Author URI:        https://www.impresiv.sk
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wp-cta-shortcodes
 * Domain Path:       /wp-cta-shortcodes
 */



add_action( 'init', 'cta_shortcodes_load_textdomain' );
 
/**
 * Load plugin textdomain.
 */
function cta_shortcodes_load_textdomain() {
  load_plugin_textdomain( 'wp-cta-shortcodes', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}



function cta_shortcodes_load_plugin_css() {
    $plugin_url = plugin_dir_url( __FILE__ );

    wp_enqueue_style( 'cta_shortcodes', $plugin_url . 'css/cta-shortcodes.css' );

}
add_action( 'wp_enqueue_scripts', 'cta_shortcodes_load_plugin_css' );




function cta_shortcodes_admin_enqueue_scripts() {

    
    wp_enqueue_script( 'alpha-color-picker', plugins_url( '/js/alpha-color-picker.js',  __FILE__ ), array( 'wp-color-picker' ), '3.0.0', true );
    
    wp_enqueue_style( 'alpha-color-picker', plugins_url( '/css/alpha-color-picker.css',  __FILE__ ), array( 'wp-color-picker' ));
    
    wp_enqueue_script('xxx-admin-js', array( 'alpha-color-picker' ), null, true);

}
add_action( 'admin_enqueue_scripts', 'cta_shortcodes_admin_enqueue_scripts' );




function cta_shortcodes_plugin_setting_page() {
 
 
add_options_page('CTA Shortcodes', 'CTA Shortcodes Settings', 'manage_options', 'cta-settings', 'cta_shortcodes_page_html_form');
 

}
add_action('admin_menu', 'cta_shortcodes_plugin_setting_page');




function cta_shortcodes_plugin_register_settings() {
 
register_setting('cta_shortcodes_plugin_options_group', 'background_color_cta');
register_setting('cta_shortcodes_plugin_options_group', 'shadow_cta');
register_setting('cta_shortcodes_plugin_options_group', 'background_button_cta');
register_setting('cta_shortcodes_plugin_options_group', 'color_button_cta');
register_setting('cta_shortcodes_plugin_options_group', 'border_radius_button_cta');
register_setting('cta_shortcodes_plugin_options_group', 'border_radius_cta');
register_setting('cta_shortcodes_plugin_options_group', 'demo-select');

add_settings_section("section", "Section", null, "demo");
add_settings_field("demo-select", "Aligment", "cta_shortcodes_select_display", "demo", "section"); 

}
add_action('admin_init', 'cta_shortcodes_plugin_register_settings');



function cta_shortcodes_select_display()
{
   ?>
        <select name="demo-select">
          <option value="vedla" <?php selected(get_option('demo-select'), "vedla"); ?>><?php _e( 'Next to me', 'wp-cta-shortcodes' ); ?></option>
          <option value="pod" <?php selected(get_option('demo-select'), "pod"); ?>><?php _e( 'Under myself', 'wp-cta-shortcodes' ); ?></option>
        </select>
   <?php
}


function cta_shortcodes_page_html_form() { ?>
    <div class="wrap">
        <h2> <?php _e( 'Call To Action Shortcode in Post Settings', 'wp-cta-shortcodes' ); ?></h2>
        <form method="post" action="options.php">
            <?php settings_fields('cta_shortcodes_plugin_options_group');
               do_settings_sections("demo");
             ?>
            
            
            
 
        <table class="form-table">
 
            <tr>
                <th><label for="background_color_cta"><?php _e('Background color', 'wp-cta-shortcodes');?></label></th>
 
                <td>
<input type = 'text' class="regular-text alpha-color-picker" id="background_color_cta" color="rgba(255,255,255,0.85)" data-alpha-enabled="true" data-default-color="rgba(255,255,255,0.85)" name="background_color_cta" value="<?php echo esc_html(get_option('background_color_cta')); ?>">
                </td>
            </tr>
 
            <tr>
                <th><label for="shadow_cta"><?php _e( 'Shadow', 'wp-cta-shortcodes' ); ?></label></th>
                <td>
<input type = 'text' class="regular-text alpha-color-picker" id="shadow_cta" color="rgba(0,0,0,0.85)" data-alpha-enabled="true" data-default-color="rgba(0,0,0,0.85)" name="shadow_cta" value="<?php echo esc_html(get_option('shadow_cta')); ?>">
                </td>
            </tr>
 
            <tr>
                <th><label for="background_button_cta"><?php _e( 'Background button', 'wp-cta-shortcodes' ); ?></label></th>
<td>
<input type = 'text' class="regular-text alpha-color-picker" id="background_button_cta" color="rgba(0,0,0,0.85)" data-alpha-enabled="true" data-default-color="rgba(0,0,0,0.85)" name="background_button_cta" value="<?php echo esc_html(get_option('background_button_cta')); ?>">
                </td>
            </tr>
            
           <tr>
                <th><label for="color_button_cta"><?php _e( 'Color button', 'wp-cta-shortcodes' ); ?></label></th>
<td>
<input type = 'text' class="regular-text alpha-color-picker" id="color_button_cta" color="rgba(255,255,255,255.85)" data-alpha-enabled="true" data-default-color="rgba(255,255,255,0.85)" name="color_button_cta" value="<?php echo esc_html(get_option('color_button_cta')); ?>">
                </td>
            </tr> 
            
            
            <tr>
                <th><label for="border_radius_button_cta"><?php _e( 'Border radius button', 'wp-cta-shortcodes' ); ?></label></th>
<td>
<input type = 'text' class="regular-text" id="border_radius_button_cta"  name="border_radius_button_cta" value="<?php echo esc_html(get_option('border_radius_button_cta')); ?>">
                </td>
            </tr> 
            
            
            <tr>
                <th><label for="border_radius_cta"><?php _e( 'Border radius', 'wp-cta-shortcodes' ); ?></label></th>
                 <td>
                   <input type = 'text' class="regular-text" id="border_radius_cta"  name="border_radius_cta" value="<?php echo esc_html(get_option('border_radius_cta')); ?>">
                </td>
            </tr> 
            
    
            
        </table>
 
        <?php submit_button(); ?>
<script> 
jQuery( document ).ready( function( $ ) {
	$( 'input.alpha-color-picker' ).alphaColorPicker();
});
</script>  
 
    </div>
<?php } 




add_shortcode( 'cta_shortcodes', 'add_shortcodes_cta' );


function add_shortcodes_cta($atts) {
   
if(!empty($atts['title'])) {
$titulok =  $atts['title'];
} else {
$titulok =  '';
}


if(!empty($atts['text-button'])) {
$popis_tlacidlo =  $atts['text-button'];
} else {
$popis_tlacidlo =  '';
}

if(!empty($atts['url-button'])) {
$url_tlacidlo =  $atts['url-button'];
} else {
$url_tlacidlo =  '';
}

$background_color_cta_settings = get_option( 'background_color_cta' );

if(!empty($background_color_cta_settings)) {
$farba_pozadia = get_option( 'background_color_cta' );
} else {
$farba_pozadia = '#ffffff;';
}


$shadow_cta_settings = get_option( 'shadow_cta' );

if(!empty($shadow_cta_settings)) {
$shadow = get_option( 'shadow_cta' );
} else {
$shadow = '#00000;';
}

$background_button_cta_settings = get_option( 'background_button_cta' );

if(!empty($background_button_cta_settings)) {
$background_button = get_option( 'background_button_cta' );
} else {
$background_button = '#00000;';
}

$color_button_cta_settings = get_option( 'color_button_cta' );

if(!empty($color_button_cta_settings)) {
$color_button = get_option( 'color_button_cta' );
} else {
$color_button = '#ffffff;';
}

$border_radius_button_cta = get_option( 'border_radius_button_cta' );

if(!empty($border_radius_button_cta)) {
$border_radius_button = get_option( 'border_radius_button_cta' );
} else {
$border_radius_button = '20px';
}

$border_radius_cta = get_option( 'border_radius_cta' );

if(!empty($border_radius_cta)) {
$border_radius = get_option( 'border_radius_cta' );
} else {
$border_radius = '20px';
}


$aligment_cta = get_option( 'demo-select' );

if(!empty($aligment_cta)) {
$align = get_option( 'demo-select' );
} else {
$align = 'vedla';
}


 
$obsah = '
<a href="'. esc_url($url_tlacidlo) .'">
<div class="cta-box '.esc_attr($align).'" style="background:'.esc_attr($farba_pozadia).'; box-shadow: 0px 0px 50px 0px '.esc_attr($shadow).'; border-radius:'.esc_attr($border_radius).';">
<div class="sirka-60">
<h2>'.$titulok.'</h2>		
<p>'.$popis.'</p>
</div>

<div class="sirka-30" >

<a class="tlacidlo-new" style="background:'.esc_attr($background_button_cta_settings).'; color:'.esc_attr($color_button).'; border-radius:'.esc_attr($border_radius_button_cta).'; " href="'. esc_url($url_tlacidlo) .'">
<span data-text="'.esc_attr($popis_tlacidlo).'">'.esc_html($popis_tlacidlo).'</span>
</a>

</div>
</div>
</a>
';

return $obsah;

}




?>