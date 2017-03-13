<?php
function woffice_child_scripts() {
	if ( ! is_admin() && ! in_array( $GLOBALS['pagenow'], array( 'wp-login.php', 'wp-register.php' ) ) ) {
		$theme_info = wp_get_theme();
		wp_enqueue_style( 'woffice-child-stylesheet', get_stylesheet_uri(), array(), $theme_info->get( 'Version' ) );
	}
}
add_action('wp_enqueue_scripts', 'woffice_child_scripts', 30);

 require_once(get_stylesheet_directory().'/custom/branding.php');
  require_once(get_stylesheet_directory().'/custom/language.php');

 // add menu within content - testing.
function print_menu_shortcode($atts, $content = null) {
		extract(shortcode_atts(array( 'name' => '', 'class' => '', 'title' => '' ), $atts));
		$good = true;
		$html_out = "";
		//$html_out .= "<p>here with name:{".$name."} and class={}".$class."}</p>";
		if (!name) {
			$good = false;
		}
		if ($good) {
			$menu_out = wp_nav_menu( array( 'menu' => $name, 'menu_class' => $class, 'echo' => false,'fallback_cb' => false ) );
			//echo "<pre>"; var_dump($menu_out); echo "</pre>";
			if ( ($menu_out == false) || ($menu_out == void) ){
				$good = false;
			}
		}
		if ($good) {
				if ($title) {
					$html_out .= "<p class='zig-menu'>".$title."</p>";
				}
				$html_out .= $menu_out;
		}
		if ($good){
		} else {
			//$html_out .= "nope!";
		}
		return $html_out;

}
 add_shortcode('zigmenu', 'print_menu_shortcode');

 // add some widget areas to theme.
 function reach_widgets_init() {
		if ( function_exists('register_sidebar') ){
			register_sidebar(array(
									 'name' => __('Nav Widgets', 'woffice'),
									 'id' => 'sidenav-widgets',
									 'description' => __('Appears Under the nav menu', 'woffice'),
									 'before_widget' => '<div id="%1$s" class="widget box %2$s"><div class="intern-padding">',
									 'after_widget' => '</div></div>',
									 'before_title' => '<div class="intern-box box-title"><h3>',
									 'after_title' => '</h3></div>',
							 ));
		}

	 	register_sidebar(array(
								 'name' => __('Below Blog', 'woffice'),
								 'id' => 'blog-bottom-extra',
								 'description' => __('Appears Under the blog', 'woffice'),
								 'before_widget' => '<div id="%1$s" class="widget box %2$s"><div class="intern-padding">',
								 'after_widget' => '</div></div>',
								 'before_title' => '<div class="intern-box box-title"><h3>',
								 'after_title' => '</h3></div>',
						 ));
}
	add_action( 'widgets_init', 'reach_widgets_init' );
