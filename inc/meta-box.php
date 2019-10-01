<?php
/*----------------BACKEND----------------*/
function register_new_metabox( ) {
    
    $event_meta_key = array( 'BEGINDATE', 'ENDDATE', 'PLACE', 'LATT', 'LONG' );

    for( $m = 0; $m < count( $event_meta_key); $m++ ) {

        register_meta(
            'post', 
            $event_meta_key[$m],
            array(
              'show_in_rest' => true,
              'type' => 'string',
              'single' => true,
              'sanitize_callback' => 'sanitize_text_field',
              'auth_callback' => function() { 
                  return current_user_can('edit_posts');
              }
        ));
    
    }
    
}
add_action('init', 'register_new_metabox');


add_action( 'add_meta_boxes', 'adding_new_metabox' );

function adding_new_metabox( ) {

  // event

  add_meta_box(
    'date_section',
    'Date',
    'date_function',
    'event',
    'normal',
    'high',
    array(
      '__back_compat_meta_box' => true
    )
  );

  add_meta_box(
    'my-map',
    'Google Map',
    'map_iframe',
    'event',
    'normal',
    'high',
    array(
      '__back_compat_meta_box' => true
    )
  );

  // projects
   add_meta_box(
    'cartel_section',
    'Cartel',
    'cartel_function',
    'project',
    'normal',
    'high'
  );

  add_meta_box(
    'event',
    __('Event', 'Minimal-Artistic-Portfolio'),
    'event_link',
    'project',
    'side',
    'high',
    array(
      '__back_compat_meta_box' => true
    )
  );

  add_meta_box(
    'cover_options',
    __('Cover option', 'Minimal-Artistic-Portfolio'),
    'cover_options',
    'project',
    'side',
    'high',
    array(
      '__back_compat_meta_box' => true
    )
  );

  /*
  // pages
  add_meta_box(
    'page-section',
    'Page Section',
    'page_section',
    'page',
    'normal',
    'high'
  );
  */
}

function cartel_function( $post ) {
  //so, dont ned to use esc_attr in front of get_post_meta
  $cartel=  get_post_meta( $post->ID, 'CARTEL' , true ) ;
  wp_editor( 
    htmlspecialchars_decode($cartel), 
    'mettaabox_ID_stylee', 
    $settings = array('textarea_name'=>'Cartel')
  );
}
function date_function( $post ) {

    $beginDate =  get_post_meta( $post->ID, 'BEGINDATE' , true );
    $endDate =  get_post_meta( $post->ID, 'ENDDATE' , true );
    ?>
    <input type="date" name="InputBeginDate" id="beginDate" value="<?= $beginDate ?>">
    <input type="date" name="InputEndDate" id="endDate" value="<?= $endDate ?>">
    <?php
}

function event_link() {

    global $post;
    $custom  = get_post_custom( $post->ID );
    $savedEventId  = get_post_meta( $post->ID, 'event', true);
    $count   = 0;
    echo '<div class="link_header">';
    $query_event_args = array(
            'post_type' => 'event',
            'posts_per_page' => -1,
            );

    $query_event = new WP_Query( $query_event_args );
    $events = array();

    foreach ( $query_event->posts as $event) {

        $id = $event->ID;
        $title = apply_filters( 'the_title', $event->post_title );

       if(is_array($savedEventId) && in_array($id, $savedEventId)){

          echo '<input type="checkbox" name="event[]" value="'.$id.'" checked>'.$title.'<br>';

        } else {

          echo '<input type="checkbox" name="event[]" value="'.$id.'">'.$title.'<br>';

        }
        $count++;
    }
    echo '</div>';
    echo '<div class="event_count"><span>Total:</span> <b>'.$count.'</b></div>';
}

function map_iframe( $post ) {

    $place = get_post_meta( $post->ID, 'PLACE' , true );
    $latt = get_post_meta( $post->ID, 'LATT' , true );
    $long = get_post_meta( $post->ID, 'LONG' , true );

    ?>
    <label> <?php _e('Place', 'Minimal-Artistic-Portfolio'); ?></label>
    <input type="text" name="InputPlace" id="place" value="<?= $place ?>"/>
    <label>Lattitude</label>
    <input type="text" name="InputLatt" id="latt" value="<?= $latt ?>"/>
    <label>Longitude</label>
    <input type="text" name="InputLong" id="long" value="<?= $long ?>"/>
    <?php
}

function cover_options( $post ) {
  $is_video = get_post_meta( $post->ID, 'IS_VIDEO', true); // o = image 1 = video
  $video_id = get_post_meta( $post->ID, 'VIDEO_ID', true);
  $video_provider = get_post_meta( $post->ID, 'VIDEO_PROVIDER', true);

  ?>
  <label><?php _e('Cover is an image or a video ?', 'Minimal-Artistic-Portfolio'); ?></label><br/>
  <input id="not_a_video" type="radio" name="is_video" value="0" <?php echo $is_video == '0' ? ' checked' : ''; ?>/>
  <label for="not_a_video"><?php _e('Image', 'Minimal-Artistic-Portfolio'); ?></label> <br/>
  <input id="its_a_video" type="radio" name="is_video" value="1" <?php echo $is_video == '1' ? ' checked' : ''; ?>/>
  <label><?php _e('Video', 'Minimal-Artistic-Portfolio'); ?></label><br/>

  <label><?php _e('Video ID', 'Minimal-Artistic-Portfolio'); ?></label><br/>
  <input type="text" name="video_id" value="<?php echo $video_id; ?>" /><br/>

  <label><?php _e('Video provider', 'Minimal-Artistic-Portfolio'); ?></label><br/>
  <input id="provider_vimeo" type="radio" name="video_provider" value="vimeo" <?php echo $video_provider == 'vimeo' ? ' checked' : ''; ?>/>
  <label for="provider_vimeo"><?php _e('Vimeo', 'Minimal-Artistic-Portfolio'); ?></label><br/>
  <input id="provider_youtube" type="radio" name="video_provider" value="youtube" <?php echo $video_provider == 'youtube' ? ' checked' : ''; ?>/>
  <label for="provider_youtube"><?php _e('YouTube', 'Minimal-Artistic-Portfolio'); ?></label><br/>

  <?php
}
/*
function page_section( $post ) {

    $sections_data = get_post_meta($post->ID, 'page_section', true);
    $titleEditor_options = array(
      'wpautop'       =>  true,
      'textarea_name' =>  'section_title[]',
      'editor_class'  =>  'section-title',
      'media_buttons' => false,
      'teeny' 		    => true
    );
    $textEditor_options = array(
      'wpautop'       =>  true,
      'textarea_name' =>  'section_text[]',
      'editor_class'  =>  'section-text',
      'media_buttons' => true,
      'teeny' 		    => true
    );

    wp_nonce_field( 'section_data_meta_box_nonce', 'section_data_nonce' ); ?>


  <ul id="sections-data-fields">
    <?php if ( $sections_data ) : ?>

    	<?php foreach ( $sections_data as $i => $section) : ?>
        <li class="active-section">
          <label for="title<? $i ?>]">
            <?php _e('Section title','Minimal-Artistic-Portfolio'); ?>
          </label>
          <?php $titleEditorID = 'title'.$i; ?>
          <?php wp_editor( unserialize(base64_decode($section['title'])), $titleEditorID, $titleEditor_options ); ?>


          <label for="text<? $i ?>">
            <?php _e('Section text','Minimal-Artistic-Portfolio'); ?>
          </label>
          <?php $textEditorID = 'text'.$i; ?>
          <?php wp_editor( unserialize(base64_decode($section['text'])), $textEditorID, $textEditor_options ); ?>

          <button type="button" class="button remove-section button-large deletion">
            <?php _e('Remove section', 'Minimal-Artistic-Portfolio'); ?>
          </button>
        </li>

      <?php endforeach; ?>
    <?php endif;  ?>
  </ul><!-- #sections-data-fields -->
  <button id="add-section" type="button" class="button button-large button-primary">
    <?php _e('Add section', 'Minimal-Artistic-Portfolio'); ?>
  </button>
  <script type="text/javascript">
	  // <![CDATA[
    jQuery(document).ready(function( $ ){

      $( '#add-section' ).on('click', function(e) {

          e.preventDefault;

          var i = $( 'ul#sections-data-fields li.active-section' ).length + 1;

			 var titleEditorID = 'title' + i;
			 var textEditorID = 'text' + i;

          var sectionFields = '<li class="active-section">';
			 sectionFields += '<label for="section_title[]"><?php _e('Section title','Minimal-Artistic-Portfolio'); ?></label>';
			 sectionFields += '<textarea name="section_text[]" id="' + titleEditorID + '"></textarea>';
			 sectionFields += '<label for="section_text[]"><?php _e('Section text','Minimal-Artistic-Portfolio'); ?></label>';
			 sectionFields += '<textarea name="section_text[]" id="' + textEditorID + '"></textarea>';
			 sectionFields += '</li>';

			 $("ul#sections-data-fields").append( sectionFields );
          tinymce.init({ selector: '#' + titleEditorID });
          tinymce.init({ selector: '#' + textEditorID });

      });

      $( '.remove-section' ).on('click', function(e) {

        e.preventDefault;
        $(this).parents('li').remove();
        return false;
      });

    });
  		// ]]>
	 </script>
  <?php
}
*/
function save_my_postdata( $post_id ) {

   if ( (!empty($_POST['InputBeginDate'])) && (!empty($_POST['InputEndDate'])) )  {
        $beginDateData=htmlspecialchars($_POST['InputBeginDate']);
        $endDateData=htmlspecialchars($_POST['InputEndDate']);

        update_post_meta($post_id, 'BEGINDATE', $beginDateData );
        update_post_meta($post_id, 'ENDDATE', $endDateData );
   }

   if ( (!empty($_POST['InputLatt'])) && (!empty($_POST['InputLong'])) ) {
        $cityMapData=htmlspecialchars($_POST['InputPlace']);
        $lattMapData=htmlspecialchars($_POST['InputLatt']);
        $longMapData=htmlspecialchars($_POST['InputLong']);
        update_post_meta($post_id, 'PLACE', $cityMapData );
        update_post_meta($post_id, 'LATT', $lattMapData );
        update_post_meta($post_id, 'LONG', $longMapData );
   }


   global $post;

   if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
       return $post->ID;
   }

} // end save_custom_meta_data
add_action( 'save_post_event', 'save_my_postdata' );

function save_project( $post_id ) {

  if (!empty($_POST['Cartel']))  {
    $cartel = htmlspecialchars($_POST['Cartel']);
    update_post_meta($post_id, 'CARTEL', $cartel );
  }
  if ( !empty( $_POST["event"] ) )  {
    //$update = implode(',', $_POST["event"]);
    $events_id = $_POST["event"];
    update_post_meta( $post_id, "event", $events_id);

    //wp_die( var_dump( $_POST["event"] )  );
  }
  if( !empty( $_POST["is_video"] && is_numeric( $_POST["is_video"] ) ) ) {
    $is_video = htmlspecialchars($_POST['is_video']);
    update_post_meta( $post_id, 'IS_VIDEO', $is_video);
  }
  
  if( !empty( $_POST["video_id"]) ) {
    $video_id = htmlspecialchars($_POST['video_id']);
    update_post_meta( $post_id, "VIDEO_ID", $video_id );
  }
  
  if( 
    !empty( $_POST["video_provider"] ) 
    && in_array( $_POST["video_provider"], array( 'vimeo', 'youtube') ) 
  ) {
    
    $video_provider = htmlspecialchars( $_POST["video_provider"] );
    update_post_meta( $post_id, "VIDEO_PROVIDER", $video_provider );
  }
}

add_action( 'save_post_project', 'save_project' );
/*
function save_page_section( $post_id ) {

  if ( !isset( $_POST['section_data_nonce'] ) ) return;
  if ( !wp_verify_nonce( $_POST['section_data_nonce'], 'section_data_meta_box_nonce' ) ) {
		return $post->ID;
	}
  if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) return;
  if ( ! current_user_can( 'edit_page', $post_id ) ) return;

  $old_section = get_post_meta( $post_id, 'page_section', true);

  $new_section = array();
  $titles = $_POST['section_title'];
  $texts = $_POST['section_text'];
  $count = count( $texts );

  for ( $i = 0; $i < $count; $i++ ) {

    if ( $texts[$i] != '' ) :
      $new_section[$i]['text'] = base64_encode( serialize( $texts[$i] ) );

    if ( $titles[$i] == '' )
      $new_section[$i]['title'] = '';

    else
      $new_section[$i]['title'] = base64_encode( serialize( $titles[$i] ) );
    endif;
  }
  if ( !empty( $new_section ) && $new_section != $old_section )
    update_post_meta( $post_id, 'page_section', $new_section );

  elseif ( empty($new_section) && $old_section )
    delete_post_meta( $post_id, 'page_section', $old_section );

}
add_action( 'save_post', 'save_page_section');
*/

function event_table_head( $defaults ) {
  unset($defaults['categories']);
  unset($defaults['date']);
  $defaults['event_date']  = __('Date', 'Minimal-Artistic-Portfolio');
  $defaults['place']   = __('Place', 'Minimal-Artistic-Portfolio');
  return $defaults;
}
add_filter('manage_event_posts_columns', 'event_table_head');


function event_table_content( $column_name, $post_id ) {

    if ($column_name == 'event_date') {
      echo  date_i18n('j F Y', strtotime(get_post_meta( $post_id, 'BEGINDATE', 'true') ) );
    }

    if ($column_name == 'place') {
      $place = get_post_meta( $post_id, 'PLACE' , true );
      echo $place;
    }
}
add_action( 'manage_event_posts_custom_column', 'event_table_content', 10, 2 );


/*----------------FRONTEND----------------*/

function get_metabox($post_id, $key, $single) {

    $meta_values = get_post_meta( $post_id, $key, $single );

    if(!empty($meta_values)):
        ?>

        <?php
        if(!is_array($meta_values)) {
            echo '<div class="' . strtolower($key) .'">';
            echo $meta_values;
            echo '</div>';

        } elseif(is_array($meta_values)) {
            echo '<div class="' . strtolower($key) .'">';
            $values ="";
            foreach($meta_values as $value) {
                echo html_entity_decode($value);
            }
            echo '</div>';
        }
    endif;
}
function isset_metabox($post_id, $key, $single) {

    $meta_values = get_post_meta( $post_id, $key, $single );

    $data = array();

    if(!empty($meta_values)){

        $data[$key] = $meta_values;

        //echo $key ." ". $data[$key] . "\n";
    }
    return $data;
}
?>
