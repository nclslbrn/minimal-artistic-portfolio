<?php
/*----------------BACKEND----------------*/
add_action( 'add_meta_boxes', 'adding_new_metabox' );
function adding_new_metabox()
{
  $eventMetaboxName = __('Event', 'Minimal-Artistic-Portfolio');

  add_meta_box('cartel_section', 'Cartel', 'cartel_function', 'project', 'normal', 'high');
  add_meta_box('date_section', 'Date', 'date_function', 'event', 'normal', 'high');
  add_meta_box('event', $eventMetaboxName, 'event_link', 'project', 'side', 'high');
  add_meta_box('my-map', 'Google Map', 'map_iframe', 'event', 'normal', 'high');
}
function cartel_function( $post )
{
  //so, dont ned to use esc_attr in front of get_post_meta
  $cartel=  get_post_meta($_GET['post'], 'CARTEL' , true ) ;
  wp_editor( htmlspecialchars_decode($cartel), 'mettaabox_ID_stylee', $settings = array('textarea_name'=>'Cartel') );
}
function date_function( $post )
{
    //so, dont ned to use esc_attr in front of get_post_meta
    $beginDate =  get_post_meta($_GET['post'], 'BEGINDATE' , true );
    $endDate =  get_post_meta($_GET['post'], 'ENDDATE' , true );
    //wp_editor( htmlspecialchars_decode($date), 'metabox_date', $settings = array('textarea_name'=>'InputDate') );
    ?>
    <input type="date" name="InputBeginDate" id="beginDate" value="<?= $beginDate ?>">
    <input type="date" name="InputEndDate" id="endDate" value="<?= $endDate ?>">
    <?php
}

function event_link() {
    global $post;
    $custom  = get_post_custom($post->ID);
    $savedEventId  = get_post_meta($_GET['post'], 'event', true);
    $count   = 0;
    echo '<div class="link_header">';
    $query_event_args = array(
            'post_type' => 'event',
            'posts_per_page' => -1,
            );

    $savedEventId = explode(',', $savedEventId);
    $query_event = new WP_Query( $query_event_args );
    $events = array();

    foreach ( $query_event->posts as $event)
    {
        $id = $event->ID;
        $title = $event->post_title;


       if(in_array($id, $savedEventId))
       {
          echo '<input type="checkbox" name="event[]" value="'.$id.'" checked>'.$title.'<br>';
        }
        else
        {
          echo '<input type="checkbox" name="event[]" value="'.$id.'">'.$title.'<br>';
        }
        $count++;
    }
    echo '</div>';
    echo '<div class="event_count"><span>Total:</span> <b>'.$count.'</b></div>';
}

function map_iframe( $post )
{
    $place =  get_post_meta($_GET['post'], 'PLACE' , true );
    $latt =  get_post_meta($_GET['post'], 'LATT' , true );
    $long =  get_post_meta($_GET['post'], 'LONG' , true );

    ?>
    <label> <?php _e('Place', 'Minimal-Artistic-Portfolio'); ?></label>
    <input type="text" name="InputPlace" id="place" value="<?= $place ?>"/>
    <label>Lattitude</label>
    <input type="text" name="InputLatt" id="latt" value="<?= $latt ?>"/>
    <label>Longitude</label>
    <input type="text" name="InputLong" id="long" value="<?= $long ?>"/>
    <?php
}
function save_my_postdata( $post_id )
{
   if ( (!empty($_POST['InputBeginDate'])) && (!empty($_POST['InputEndDate'])) )
   {
        $beginDateData=htmlspecialchars($_POST['InputBeginDate']);
        $endDateData=htmlspecialchars($_POST['InputEndDate']);

        update_post_meta($post_id, 'BEGINDATE', $beginDateData );
        update_post_meta($post_id, 'ENDDATE', $endDateData );
   }

   if ( (!empty($_POST['InputLatt'])) && (!empty($_POST['InputLong'])) )
   {
        $cityMapData=htmlspecialchars($_POST['InputPlace']);
        $lattMapData=htmlspecialchars($_POST['InputLatt']);
        $longMapData=htmlspecialchars($_POST['InputLong']);
        update_post_meta($post_id, 'PLACE', $cityMapData );
        update_post_meta($post_id, 'LATT', $lattMapData );
        update_post_meta($post_id, 'LONG', $longMapData );
   }


   global $post;

   if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
   {
       return $post->ID;
   }



} // end save_custom_meta_data
add_action( 'save_post_event', 'save_my_postdata' );

function save_project( $post_id )
{
  if (!empty($_POST['Cartel']))
  {
       $cartel=htmlspecialchars($_POST['Cartel']);
       update_post_meta($post_id, 'CARTEL', $cartel );
  }
  if ( isset( $_POST["event"] ) )
  {
    $update = implode(',', $_POST["event"]);
    update_post_meta( $post_id, "event", $update);
  }
}

add_action( 'save_post_project', 'save_project' );

function event_table_head( $defaults )
{
  unset($defaults['categories']);
  unset($defaults['date']);
  $defaults['event_date']  = __('Date', 'Minimal-Artistic-Portfolio');
  $defaults['place']   = __('Place', 'Minimal-Artistic-Portfolio');
  return $defaults;
}
add_filter('manage_event_posts_columns', 'event_table_head');


function event_table_content( $column_name, $post_id )
{
    if ($column_name == 'event_date')
    {
      echo  date_i18n('j F Y', strtotime(get_post_meta( $post_id, 'BEGINDATE', 'true') ) );
    }
    if ($column_name == 'place')
    {
      $place = get_post_meta( $post_id, 'PLACE' , true );
      echo $place;
    }
}
add_action( 'manage_event_posts_custom_column', 'event_table_content', 10, 2 );


/*----------------FRONTEND----------------*/


function get_metabox($post_id, $key, $single)
{
    $meta_values = get_post_meta( $post_id, $key, $single );

    if(!empty($meta_values)):
        ?>

        <?php
        if(!is_array($meta_values))
        {
            ?><div class="<?= strtolower($key) ?>"><?php
            echo $meta_values;
            ?></div><?php
        }
        elseif(is_array($meta_values))
        {
            ?><div class="<?= strtolower($key) ?>"><?php
            $values ="";
            foreach($meta_values as $value)
            {
                echo html_entity_decode($value)   ;
            }
            ?></div><?php
        }
    endif;
}
function isset_metabox($post_id, $key, $single)
{
    $meta_values = get_post_meta( $post_id, $key, $single );

    $data = array();

    if(!empty($meta_values)){

        $data[$key] = $meta_values;

        //echo $key ." ". $data[$key] . "\n";
    }
    return $data;
}
?>
