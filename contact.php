<?php
/*
Template Name: Contact
*/

/**
 * The template for contact.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Minimal-Artistic-Portfolio
 */

 $response = "";

   //function to generate response
 function my_contact_form_generate_response($type, $message)
 {

     global $response;

     if($type == "success") $response = "<div class='success'>{$message}<a href='#' class='close'></a></div>";
     else $response = "<div class='warning'>{$message}<a href='#' class='close'></a></div>";

     //echo $response;
 }


function generate_human_verification_number()
{
  $term_number = intval( rand(0, 9) );
  return $term_number;
}


 //response messages

 $not_human       = __('Human verification incorrect.', 'Minimal-Artistic-Portfolio');
 $missing_content = __('Please supply all information.', 'Minimal-Artistic-Portfolio');
 $email_invalid   = __('Email Address Invalid.', 'Minimal-Artistic-Portfolio');
 $message_unsent  = __('Message was not sent. Try Again.', 'Minimal-Artistic-Portfolio');
 $message_sent    = __('Thanks! Your message has been sent.', 'Minimal-Artistic-Portfolio');

//user posted variables

$fullName = ( isset( $_POST['message_name'] ) ) ? $_POST['message_name'] : null;
$email = ( isset( $_POST['message_email'] ) ) ? $_POST['message_email'] : null;
$message = ( isset( $_POST['message_text'] ) )? $_POST['message_text'] . "\r\n" . $fullName  : null;
$human = ( isset(  $_POST['message_human'] ) )? intval( $_POST['message_human']) : null;

if( isset($_POST['submit'] ) ){
  $submitted = "";
  $term_number = intval( $_POST['term_number'] );
}
else {
  $submitted = 1;
  $term_number = "";
  $term_number = generate_human_verification_number();
}

 //php mailer variables
 $subjectText = __('Someone sent a message from ', 'Minimal-Artistic-Portfolio' );

 $to = get_option('admin_email');
 $subject = $subjectText . get_bloginfo('name');
 $headers = 'From: '. $email . "\r\n" . 'Reply-To: ' . $email . "\r\n";

 if(!$human == 0 && isset( $_POST['submit'] ) &&  !$submitted == 1){
   $solution = 10 - $term_number;
 		if($human != $solution) my_contact_form_generate_response("error", $not_human); //not human!
 		else {

 			//validate email
 				if(!filter_var($email, FILTER_VALIDATE_EMAIL)) my_contact_form_generate_response("error", $email_invalid);
 				else //email is valid
 				{
 				//validate presence of name and message
 						if(empty($fullName) || empty($message))
 						{
 								my_contact_form_generate_response("error", $missing_content);
 						}
 						else //ready to go!
 						{

 							$sent = wp_mail($to, $subject, strip_tags($message), $headers);

 								if($sent) my_contact_form_generate_response("success", $message_sent); //message sent!

 								else my_contact_form_generate_response("error", $message_unsent); //message wasn't sent

 						}
 				}
 		}
 }
 else if ( $submitted && isset( $_POST['submit'] ) ) my_contact_form_generate_response("error", $missing_content);

 get_header(); ?>


	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post(); ?>
      <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <header class="entry-header">
          <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </header><!-- .entry-header -->

				<div id="respond">
					<div class="contact-header">
						<?php echo $response; ?>
					</div>
					<div class="col-12 column contact-body">

						 <form action="<?php echo get_permalink(); ?>" method="post"  class="contact">
							<span class="input col-6 column">
  							<input type="text" class="input__field"
                       name="message_name" id="message_name"
                       placeholder="<?php _e('Name *', 'Minimal-Artistic-Portfolio'); ?>"
                       value="<?php if ( isset( $_POST['message_name']) ) echo $_POST['message_name'];  ?>">
							</span>

							<span class="input col-6 column">
                <input type="text" class="input__field"
                       name="message_email" id="message_email"
                       placeholder="<?php _e( 'Email *', 'Minimal-Artistic-Portfolio'); ?>"
                       value="<?php if ( isset( $_POST['message_email']) ) echo $_POST['message_email']; ?>">
							</span>

							<span class="input textarea-input col-12 column">
								<textarea type="text" name="message_text" id="message_text"  class="input__field" rows="7" placeholder="<?php _e('Message *', 'Minimal-Artistic-Portfolio'); ?>"><?php if ( isset( $_POST['message_text']) ) echo $_POST['message_text']; ?></textarea>
							</span>

							<div class="input col-8 column">
                <label for="message_human" class="input__label"><?php _e('Human Verification *', 'Minimal-Artistic-Portfolio'); ?></label>
                <span class="security-check">
                  <input type="text" class="input__field"
                         id="message_human" style="width: 60px;"
                         name="message_human" value="<?php if ( isset( $_POST['message_human']) ) echo $_POST['message_human']; ?>">
                  <span>+ <?php echo $term_number;?> = 10</span>
                </span>
              </div>

							<div class="input col-4 colunm">
								<label class="input__label"><br /><br /><?php _e('* : require field', 'Minimal-Artistic-Portfolio'); ?></label>
                <br /><br />
								<input type="hidden" name="submitted" value="<?php echo $submitted; ?>">
                <input type="hidden" name="term_number" value="<?php echo $term_number; ?>">
								<button type="submit" name="submit" class="button"><?php _e('send', 'Minimal-Artistic-Portfolio'); ?></button>
							</div>
						</form>
					</div>

				<?php

			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
