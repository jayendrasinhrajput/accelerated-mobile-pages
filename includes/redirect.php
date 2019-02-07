<?php
// Redirection for Homepage and Archive Pages when Turned Off from options panel
function ampforwp_check_amp_page_status() {
  global $redux_builder_amp, $wp;
  $hide_cats_amp = $url = '';
  $hide_cats_amp = is_category_amp_disabled();
  if ( ampforwp_is_amp_endpoint() ) {
    if ( (is_archive() && 0 == $redux_builder_amp['ampforwp-archive-support']) || true == $hide_cats_amp || ((ampforwp_is_home() || ampforwp_is_front_page()) && 0 == $redux_builder_amp['ampforwp-homepage-on-off-support']) ) {
      $url = $wp->request;
      if( ampforwp_is_home() && get_query_var('amp') ) {
        $url = 'amp';
      } 
      $redirection_location = add_query_arg( '', '', home_url( $url ) );
      
      $redirection_location = trailingslashit($redirection_location );
      
      $redirection_location = dirname($redirection_location);
      wp_safe_redirect( $redirection_location );
      exit;
    }
  }
  // AMP Takeover
  if ( isset($redux_builder_amp['ampforwp-amp-takeover']) && $redux_builder_amp['ampforwp-amp-takeover'] && !ampforwp_is_non_amp() ) {
    $redirection_location = '';
    $current_location     = '';
    $home_url             = '';
    $blog_page_id         = '';
    $amp_on_off         = '';

    $current_location     = home_url( $wp->request);
    $home_url             = get_bloginfo('url');

    /*
     * If certain conditions does not match then return early and exit from redirection
     */

    // return if the current page is Feed page, as we don't need anything on feedpaged
    if ( is_feed() ) {
      return;
    }

    // Homepage
    if ( ( ampforwp_is_home() || $current_location == $home_url ) && ! $redux_builder_amp['ampforwp-homepage-on-off-support'] ) {
      return;
    }

    // Frontpage
    if ( is_front_page() && $current_location == $home_url ) {
      return;
    }

    // Archive
    if ( is_archive() && ! $redux_builder_amp['ampforwp-archive-support'] ) {
      return;
    }
   
    // AMP and non-amp Homepage
    if ( is_home() && ampforwp_is_front_page() && ! ampforwp_is_home() ) {
      return;
    }

    //blogpage
    if ( is_home() && $redux_builder_amp['amp-on-off-for-all-pages']==false ) {
      return;
    }

    // Enabling AMP Takeover only when selected in Custom Post Type 
    $supported_types_for_takeover = array();
    $supported_types_for_takeover = ampforwp_get_all_post_types();
    if( $supported_types_for_takeover ){
            $current_type = get_post_type(get_the_ID());
            if(!in_array($current_type, $supported_types_for_takeover)){ 
              return ;
            }
    }
    // Single and Pages
    if ( is_singular() ) {
      $amp_metas = json_decode(get_post_meta( get_the_ID(),'ampforwp-post-metas',true), true );
      if ( 'hide-amp' == $amp_metas['ampforwp-amp-on-off'] ) {
        $amp_on_off = true;
      }
    }
    if ( ( is_single() && !$redux_builder_amp['amp-on-off-for-all-posts'] ) || ( is_page() && !$redux_builder_amp['amp-on-off-for-all-pages'] ) || ($amp_on_off) ) {
      return;
    }

    // Blog page
    if ( ampforwp_is_blog() ) {
      $blog_page_id         = get_option('page_for_posts');
      $redirection_location = get_the_permalink($blog_page_id);
    }

    // if the current page is ampfrontpage or normal frontpage take it to homepage of site
    if ( ampforwp_is_front_page() || is_front_page() ) {
      $redirection_location = $home_url;
    }

    // Single.php and page.php
    if ( ( is_single() && $redux_builder_amp['amp-on-off-for-all-posts'] ) || ( is_page() && $redux_builder_amp['amp-on-off-for-all-pages'] ) ) {
      $redirection_location = get_the_permalink();
    }

    /* Fallback, if for any reason, $redirection_location is still NULL
     * then redirect it to homepage. 
     */
    if ( empty( $redirection_location ) ) {
      $redirection_location = $home_url;
    }

    // Removing the AMP on login register etc of Theme My Login plugin
    if (false === ampforwp_remove_login_tml() ){
    return;
  }
    wp_safe_redirect( $redirection_location );
    exit;
   
  }
}
add_action( 'template_redirect', 'ampforwp_check_amp_page_status', 10 );


// Redirection code
function ampforwp_page_template_redirect() {
  global $redux_builder_amp, $post, $wp;
  $post_type                  = '';
  $supported_types            = '';
  $supported_amp_post_types   = array();
  $url_to_redirect            = '';

  $supported_types            = ampforwp_get_all_post_types();
  $supported_types            = apply_filters('get_amp_supported_post_types',$supported_types);
  $post_type                  = get_post_type();
  
  if(is_home() || is_front_page()){
      if(isset($redux_builder_amp['ampforwp-homepage-on-off-support']) 
          && $redux_builder_amp['ampforwp-homepage-on-off-support'] == 1 
          && isset($redux_builder_amp['amp-on-off-for-all-posts']) 
          && $redux_builder_amp['amp-on-off-for-all-posts'] == 0 
          && isset($redux_builder_amp['amp-on-off-for-all-pages']) 
          && $redux_builder_amp['amp-on-off-for-all-pages'] == 0 ){

                  $supported_types['post'] = 'post';
      }
    }
  
  $supported_amp_post_types   = in_array( $post_type , $supported_types );
  $url_to_redirect            = ampforwp_amphtml_generator();

  if ( isset($redux_builder_amp['amp-mobile-redirection']) && $redux_builder_amp['amp-mobile-redirection'] ) {
    $mobile_detect = $isTablet = '';
    require_once AMPFORWP_PLUGIN_DIR.'/includes/vendor/Mobile_Detect.php';
    // instantiate the Mobile detect class
    $mobile_detect = new AMPforWP_Mobile_Detect;
    $isTablet = $mobile_detect->isTablet();
    if ( false == ampforwp_get_setting('amp-mobile-redirection-tabs') ) {
      $isTablet = ! $mobile_detect->isTablet();
    }
    // No mobile redirection on oembeds #2003
    if ( function_exists('is_embed') && is_embed() ){
      return;
    }
    // Return if Dev mode is enabled
    if ( isset($redux_builder_amp['ampforwp-development-mode']) && $redux_builder_amp['ampforwp-development-mode'] ) {
      return;
    }
    // Return if the set value is not met and do not start redirection
    if ( 'disable' == ampforwp_meta_redirection_status() ) {
        return;
    }
    if ( false == $supported_amp_post_types ) {
      return;
    }
    if ( is_archive() && 0 == $redux_builder_amp['ampforwp-archive-support'] ) {
      return;
    }
    if ( is_feed() ) { 
      return; 
    }
    // #1192 Password Protected posts exclusion
    if ( post_password_required( $post ) ) { 
      return; 
    }

    // Return if some categories are selected as Hide #999
    if ( is_category_amp_disabled() ) {
      return;
    }

    // If we are in AMP mode then retrun and dont start redirection
    if ( ampforwp_is_amp_endpoint() ) {
        return;
    } 

    if ( is_page() && 0 == $redux_builder_amp['amp-on-off-for-all-pages'] ) {
        return;
    }

    if ( is_home() && is_front_page() && 0 == $redux_builder_amp['ampforwp-homepage-on-off-support'] ) {
        return;
    }
    if ( is_front_page() && 0 == $redux_builder_amp['ampforwp-homepage-on-off-support'] ) {
        return;
    }

    if ( ! session_id() ) {
        session_start();
    }

    if ( isset( $_SESSION['ampforwp_mobile'] ) && 'mobile-on' == $_SESSION['ampforwp_amp_mode'] && 'exit' == $_SESSION['ampforwp_mobile'] ) {
        return;
    }

    if ( $mobile_detect->isMobile() && 'mobile-on' == $_SESSION['ampforwp_amp_mode'] && 1 == $_GET['nonamp'] ) {
        // non mobile session variable creation
        session_start();
        $_SESSION['ampforwp_mobile'] = 'exit';
        if ( ampforwp_is_amp_endpoint() ) {
            session_destroy();
        }
    }

    if ( function_exists('weglot_plugin_loaded') ) {
      $url_to_redirect = ampforwp_get_weglot_url();
      $url_to_redirect = ampforwp_url_controller($url_to_redirect); 
    }
    // Check if we are on Mobile phones then start redirection process
    if ( $mobile_detect->isMobile() && $isTablet ) {

        if ( ! isset($_SESSION['ampforwp_amp_mode']) || ! isset($_GET['nonamp']) ) {

          $_SESSION['ampforwp_amp_mode'] = 'mobile-on';

          if ( $url_to_redirect ) {
            wp_redirect( $url_to_redirect , 301 );
            exit();
          }
          
          // if nothing matches then return back
          return;
        }
    }
  }
}
add_action( 'template_redirect', 'ampforwp_page_template_redirect', 10 );


add_action( 'template_redirect', 'ampforwp_page_template_redirect_archive', 10 );
function ampforwp_page_template_redirect_archive() {

  if ( is_404() ) {
        return;
    if ( ampforwp_is_amp_endpoint() ) {
      global $wp;
      $ampforwp_404_url   = add_query_arg( '', '', home_url( $wp->request ) );
      $ampforwp_404_url = trailingslashit($ampforwp_404_url );
      $ampforwp_404_url = dirname($ampforwp_404_url);
      wp_redirect( esc_url( $ampforwp_404_url )  , 301 );
      exit();
    }
  }
}

// #1947 when nonamp=1 it should redirect to original link so that google
add_action( 'template_redirect', 'ampforwp_redirect_to_orginal_url' );
function ampforwp_redirect_to_orginal_url(){
  $go_to_url  = "";
  $url        = "";
  $url = ampforwp_amphtml_generator();
  if($url){
    if(isset($_REQUEST['nonamp']) && $_REQUEST['nonamp'] == '1'){
        $go_to_url = remove_query_arg('nonamp', $url);
        $go_to_url = explode('/', $go_to_url);
        $go_to_url = array_flip($go_to_url);
          unset($go_to_url['amp']);
        $go_to_url = array_flip($go_to_url);     
        $go_to_url  = implode('/', $go_to_url);
 
      wp_safe_redirect( $go_to_url, 301 );
      exit;
    }
    else{
      return;
    }
  }
  return;
}
//Auto redirect /amp to ?amp when 'Change End Point to ?amp' option is enabled #2480
add_action('template_redirect', 'ampforwp_redirect_proper_qendpoint' );
function ampforwp_redirect_proper_qendpoint($current_url){
 
if ( true == ampforwp_get_setting('amp-core-end-point') ){ 

  $current_url = $_SERVER['REQUEST_URI'];
  $current_url = explode('/', $current_url);
  $check    =  AMPFORWP_AMP_QUERY_VAR;
   if (in_array( $check  , $current_url ) ) {
      $check = array($check);
      $current_url = array_flip($current_url);
      unset($current_url['amp']);
      $current_url = array_flip($current_url);
      $current_url = implode('/', $current_url);
      $current_url = add_query_arg( 'amp', '1', $current_url);
      wp_safe_redirect( $current_url );
      exit;
    }

}
}