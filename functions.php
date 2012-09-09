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
                'url' => '%s/header/default.jpg',
                'thumbnail_url' => '%s/header/thumbnails/pb-thumbnail.jpg',
                'description' => __( 'Perfect Beach', 'customisetheme' )
            ),
                //Image 2
                'tiger' => array (
                'url' => '%s/header/tiger.jpg',
                'thumbnail_url' => '%s/header/thumbnails/tiger-thumbnail.jpg',
                'description' => __( 'Tiger', 'customisetheme' )
            ),
                //Image 3
                'lunar' => array (
                'url' => '%s/header/lunar.jpg',
                'thumbnail_url' => '%s/header/thumbnails/lunar-thumbnail.jpg',
                'description' => __( 'Lunar', 'customisetheme' )
            )
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
?>