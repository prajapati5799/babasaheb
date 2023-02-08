<?php

/**
 * Form Plugin
 *
 * Plugin Name: SEO Friendly
 * Version:     1.0.0
 * Text Domain: Seo Friendly
 * Domain Path: /languages
 * Requires PHP: 5.2.4
 */
/**
 * Register the "book" custom post type
 */

// cass and js enqueue
function enqueue_scripts()
{
  wp_enqueue_style('style1', plugin_dir_url(__FILE__) . '/css/style1.css');
  wp_enqueue_style('style2', plugin_dir_url(__FILE__) . '/css/style2.css');
  wp_enqueue_style('bootstrap.min', plugin_dir_url(__FILE__) . '/css/bootstrap.min.css');
  wp_enqueue_script('bootstrap-min', plugin_dir_url(__FILE__) . 'js/bootstrap.min.js', array('jquery'), '', true);
  wp_enqueue_script('bootstrap-bundle-min', plugin_dir_url(__FILE__) . 'js/bootstrap.bundle.min.js', array('jquery'), '', true);
  wp_enqueue_script('custom-js', plugin_dir_url(__FILE__) . 'js/custom.js', array('jquery'), '', true);
  wp_localize_script('custom-js', 'localajax', array('ajaxurl' => admin_url('admin-ajax.php'),));
  wp_enqueue_script('jquery', plugin_dir_url(__FILE__) . 'js/jquery.min.js', array('jquery'), '', true);
}
add_action('admin_enqueue_scripts', 'enqueue_scripts');

//  add custome Option page
add_action('init', 'replace_alt_title_myplugin');
add_action('admin_menu', 'replace_alt_title_options_page');
function replace_alt_title_options_page()
{
  add_options_page(
    'My Page Title', // page <title>Title</title>
    'SEO Friendly', // menu link text
    'manage_options', // capability to access the page
    'replace_alt_title-slug', // page URL slug
    'replace_alt_title_page_content', // callback function with content
    2 // priority
  );
}

function replace_alt_title_flush_rewrites()
{
  replace_alt_title_myplugin();
  flush_rewrite_rules();
}
function replace_alt_title_uninstall()
{
  // Uninstallation stuff here
  unregister_post_type('replace_alt_title');
}

//plugin inside form
function replace_alt_title_page_content()
{
?>
  <div>
    <?php screen_icon(); ?>
    <h2>Replace Alt Text Title </h2>
    <?php settings_fields('myplugin_options_group'); ?>
    <h3>Click The Button And See The Magic !</h3>
    <button type="button" data-action="find" onClick="get_data_ajax(event)" class="btn btn-success find">Find</button>
    <div class="data_class"></div>
    <button type="button" data-action="update" onClick="get_data_ajax(event)" class="btn btn-success find_thumbnail">Update</button>
  </div>
<?php
}
//update thumbnail
add_action('wp_ajax_data_fetch', 'thumbnail_fetch');
add_action('wp_ajax_nopriv_data_fetch', 'thumbnail_fetch');
function thumbnail_fetch()
{
  // exit;
  $response = array();
  $response['success'] = '';
  $response['data'] = '';

  $box_data = $_POST['box_data'];


  // echo '<pre>';
  // print_r($box_data);exit;

  // echo '</pre>';

  $button_action = $_POST['btn_action'];
  $query_images_args = array(
    'post_type'      => 'attachment',
    'post_mime_type' => 'image',
    'post_status'    => 'inherit',
    'posts_per_page' => -1,
  );


  $query_images = new WP_Query($query_images_args);
  $images = array();
  $atididi = array();
  while ($query_images->have_posts()) {
    $query_images->the_post();
    global $post;
    $attachmentid = $post->ID;

    $atididi['atddd'] = $attachmentid;

    $image_title = get_post_field('post_title', $attachmentid, true);
    $alt_text = get_post_field('_wp_attachment_image_alt', $attachmentid, true);
    $image_url = wp_get_attachment_url($attachmentid);
    $my_image_meta = array(
      'ID'    => $attachmentid,      // Specify the image (ID) to be updated
      'post_title'  => $image_title,    // Set image Title to sanitized title
      'post_alt'  => $alt_text,    // Set image Caption (Excerpt) to sanitized title

    );
    $response = '';

    if ($button_action == '1') {
      if (empty($alt_text) || empty($image_title)) {
        $response .= '<div class="col-md-6 box_data_input" data-attid="' . $attachmentid . '">
                        <div class="news-box">
                          <div class="img"><img src="' . $image_url . '" alt="' . $alt_text . '"></div>
                          <div class="info" >
                          <div class="news-title">Title :  <input type="text" class="cTitle"  name="cTitle" value="' . $image_title . '"></div>
                          <div class="post-col">Alter Text :  <input type="text"  class="cAlt" name="cAlt" value="' . $alt_text . '"></div>
                          
                          </div>
                        </div>
                      </div>';
        echo $response;
      }
    }

    if ($button_action == '2') {
      

      foreach ($box_data as $box_data_list) {
        $newAlt = '';
        $img_title = get_post_field('post_title', $box_data_list['attid'], true);
        $newURL = wp_get_attachment_url($box_data_list['attid']);
        $path_parts = pathinfo($newURL);
        $image_name = $path_parts['filename'];
        if (!empty($box_data_list['cAlt'])) {
          // echo "if ok";exit;
          update_post_meta($box_data_list['attid'], '_wp_attachment_image_alt', $box_data_list['cAlt']);
        } else {
          // echo $image_title1;
          if ($img_title) {
            $newAlt = $img_title;
          } else {
            $newAlt = $image_name;
          }
          update_post_meta($box_data_list['attid'], '_wp_attachment_image_alt', $newAlt);
        }


        if (!empty($box_data_list['cTitle'])) {
          $data = array(
            'ID' => $box_data_list['attid'],
            'post_title' => $box_data_list['cTitle'],
          );
          wp_update_post($data);
        } else {
          $data = array(
            'ID' => $box_data_list['attid'],
            'post_title' => $image_name,
          );
          wp_update_post($data);
        }
        // }
      }
      // if (empty($alt_text)) {
      //   if ($image_title) {
      //      $newAlt = $image_title;
      //    }
      //   else {
      //      $newAlt = $image_name;
      //    }
      //    update_post_meta($attachmentid, '_wp_attachment_image_alt', $newAlt);
      //  }
      //  if (empty($image_title)) {
      //    $title_name = $image_name;
      //    $data = array(
      //      'ID' => $attachmentid,
      //      'post_title' => $title_name,
      //    );
      //    wp_update_post($data);
      //  }

    }
  }

  // $response['success'] = '';
  // $response['data'] = '';
  // echo "<pre>";print_r($atididi);exit;
  // wp_send_json($response);
  wp_die();
}
