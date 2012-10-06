<?php
if (function_exists('add_theme_support')) {
    add_theme_support('menus');//Add custom menu support
    add_theme_support('custom-background');//add custom background support maybe this will break the other background color chooser!!!
}
register_nav_menu( 'primary', __( 'Hovedmenu Menu', 'lilleraev' ) );
//Check see if the customisetheme_setup exists
if ( !function_exists('customisetheme_setup') ):
    //Any theme customisations contained in this function
    function customisetheme_setup() {
        //Define default header image
        define( 'HEADER_IMAGE', '%s/header/default.jpg' );
       
        //Define the width and height of our header image
        define( 'HEADER_IMAGE_WIDTH', apply_filters( 'customisetheme_header_image_width', 1024 ) );
        define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'customisetheme_header_image_height', 200 ) );
       
        //Turn off text inside the header image
        define( 'NO_HEADER_TEXT', true );
       
        //Don't forget this, it adds the functionality to the admin menu
        add_custom_image_header( '', 'customisetheme_admin_header_style' );
       
        //Set some custom header images, add as many as you like
        //%s is a placeholder for your theme directory
        $customHeaders = array (
                //Image 1
                'perfectbeach' => array (
                'url' => '%s/header/default.png',
                'thumbnail_url' => '%s/header/thumbnails/default_thumb.png',
                'description' => __( 'Lille ræv', 'customisetheme' )
            ),
         );
        //Register the images with WordPress
        register_default_headers($customHeaders);
    }
endif;

if ( ! function_exists( 'customisetheme_admin_header_style' ) ) :
    //Function fired and inline styles added to the admin panel
    //Customise as required
    function customisetheme_admin_header_style() {
    ?>
        <style type="text/css">
            #wpbody-content #headimg {
                height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
                width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
                border: 1px solid #333;
            }
        </style>
    <?php
    }
endif;

// color chooser setup and opacity controler

    function listablehg_customize_register($wp_customize){
      $colors = array();
      $colors[] = array( 'slug'=>'main_background_color', 'default' => '#ffffff', 'label' => __( 'Page Color', 'Lilleraev' ) );
      //$colors[] = array( 'slug'=>'background_color', 'default' => '#777777', 'label' => __( 'Background color', 'THEME_NAME' ) );

      foreach($colors as $color)
      {
        // SETTINGS
        $wp_customize->add_setting( $color['slug'], array( 'default' => $color['default'], 'type' => 'option', 'capability' => 'edit_theme_options' ));

        // CONTROLS
        $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $color['slug'], array( 'label' => $color['label'], 'section' => 'colors', 'settings' => $color['slug'] )));
      }

    }


    function themename_customize_register($wp_customize) {
    $wp_customize->add_section('themename_color_scheme', array(
        'title'    => __('Opacity', 'themename'),
        'priority' => 120,
    ));
/*
    //  =============================
    //  = Text Input                =
    //  =============================
    $wp_customize->add_setting('themename_theme_options[text_test]', array(
        'default'        => 'Arse!',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));


$wp_customize->add_control('themename_text_test', array(
    'label'      => __('Text Test', 'themename'),
     'section'    => 'themename_color_scheme',
     'settings'   => 'themename_theme_options[text_test]',
 ));

//custom control

    class Example_Customize_Textarea_Control extends WP_Customize_Control {
    public $type = 'textarea';

    public function render_content() {
        ?>
        <label>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
        <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
        </label>
        <?php
            }
        }
    $wp_customize->add_setting( 'textarea_setting', array(
        'default'        => 'Some default text for the textarea',
    ) );

    $wp_customize->add_control( new Example_Customize_Textarea_Control( $wp_customize, 'textarea_setting', array(
        'label'   => 'Textarea Setting',
        'section' => 'themename_color_scheme',
        'settings'   => 'textarea_setting',
    ) ) );
*/
/*
---SLIDER TEST---
<textarea rows="5" style="width:100%;" <?php $this->link();?>><?php echo esc_textarea( $this->value() ); ?></textarea>
*/

class Slider_Control extends WP_Customize_Control {
    public $type = 'slider1';
    public function render_content() {
        ?>
        <label>
        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>    
        <input style="width:100%;" id="slider" type="range" min="0" max="100" step="1"<?php $this->link(); ?>> <?php echo $this->value(); ?> </input>
        </label>
        <?php
        }
    }

$wp_customize->add_setting( 'header_opacity_setting', array(
    'default'        => 100,
) );

$wp_customize->add_setting( 'menu_opacity_setting', array(
    'default'        => 100,
) );

$wp_customize->add_setting( 'main_opacity_setting', array(
    'default'        => 100,
) );

$wp_customize->add_setting( 'footer_opacity_setting', array(
    'default'        => 100,
) );

$wp_customize->add_control( new Slider_Control( $wp_customize, 'header_opacity_setting', array(
    'label'   => 'Header Opacity',
    'section' => 'themename_color_scheme',
    'settings'   => 'header_opacity_setting',
) ) );

$wp_customize->add_control( new Slider_Control( $wp_customize, 'menu_opacity_setting', array(
    'label'   => 'Menu Opacity',
    'section' => 'themename_color_scheme',
    'settings'   => 'menu_opacity_setting',
) ) );

$wp_customize->add_control( new Slider_Control( $wp_customize, 'main_opacity_setting', array(
    'label'   => 'Main Area Opacity',
    'section' => 'themename_color_scheme',
    'settings'   => 'main_opacity_setting',
) ) );

$wp_customize->add_control( new Slider_Control( $wp_customize, 'footer_opacity_setting', array(
    'label'   => 'Footer Opacity',
    'section' => 'themename_color_scheme',
    'settings'   => 'footer_opacity_setting',
) ) );

}

add_action( 'customize_register', 'themename_customize_register' );
add_action( 'customize_register', 'listablehg_customize_register' );
//Execute our custom theme functionality
add_action( 'after_setup_theme', 'customisetheme_setup' );


function gallery_first_image(){     

    global $post;

    $args = array(
        'post_type'   => 'attachment',
        'numberposts' => 1,
        'post_parent' => $post->ID,
        'order' => 'ASC',
        'orderby' => 'menu_order',
        'post_mime_type' => 'image'
        );

    $attachments = get_posts( $args );

    if ( $attachments )
    {
        foreach ( $attachments as $attachment )
        {                   
            return wp_get_attachment_url( $attachment->ID ); 
        }
    }       
    return false;   
}
add_filter( 'gallery_style', 'my_gallery_style', 99 );

function my_gallery_style() {
    return "<div class='gallery'>";
}

remove_shortcode( 'gallery' );
add_shortcode( 'gallery' , 'my_own_gallary' );
function my_own_gallary($attr) {
    global $post;

    static $instance = 0;
    $instance++;

    // Allow plugins/themes to override the default gallery template.
    $output = apply_filters('post_gallery', '', $attr);
    if ( $output != '' )
        return $output;

    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }

    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => 'dl',
        'icontag'    => 'dt',
        'captiontag' => 'dd',
        'columns'    => 3,
        'size'       => 'thumbnail',
        'include'    => '',
        'exclude'    => ''
    ), $attr));

    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';

    if ( !empty($include) ) {
        $include = preg_replace( '/[^0-9,]+/', '', $include );
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }

    if ( empty($attachments) )
        return '';

    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }

    $itemtag = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);
    $columns = intval($columns);
    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
    $float = is_rtl() ? 'right' : 'left';

    $selector = "gallery-{$instance}";

    $gallery_style = $gallery_div = '';
    if ( apply_filters( 'use_default_gallery_style', true ) )
        $gallery_style = "
        <style type='text/css'>
            #{$selector} {
                margin: auto;
            }
            #{$selector} .gallery-item {
                float: {$float};
                margin-top: 10px;
                text-align: center;
                width: {$itemwidth}%;
            }
            #{$selector} img {
                border: 2px solid #cfcfcf;
            }
            #{$selector} .gallery-caption {
                margin-left: 0;
            }
        </style>
        <!-- see gallery_shortcode() in wp-includes/media.php -->";
    $size_class = sanitize_html_class( $size );
    $gallery_div = "<div id='$selector' class='gallery galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'>";
    $output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

    $i = 0;
    foreach ( $attachments as $id => $attachment ) {
        $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);

        $output .= "<{$itemtag} class='gallery-item'>";
        $output .= "
            <{$icontag} class='gallery-icon'>
                $link
            </{$icontag}>";
        if ( $captiontag && trim($attachment->post_excerpt) ) {
            $output .= "
                <{$captiontag} class='wp-caption-text gallery-caption'>
                " . wptexturize($attachment->post_excerpt) . "
                </{$captiontag}>";
        }
        else{
            $output .= "
                <{$captiontag} class='wp-caption-text gallery-caption'>
                " . "Default Caption" . "
                </{$captiontag}>";    
        }
        $output .= "</{$itemtag}>";
        if ( $columns > 0 && ++$i % $columns == 0 )
            $output .= '<br style="clear: both" />';
    }

    $output .= "
            <br style='clear: both;' />
        </div>\n";

    return $output;
}
?>
