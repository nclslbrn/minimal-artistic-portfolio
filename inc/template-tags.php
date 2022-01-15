<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Minimal-Artistic-Portfolio
 */

if ( ! function_exists( 'map_posted_on' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     */
    function map_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr( get_the_date( DATE_W3C ) ),
            esc_html( get_the_date() ),
            esc_attr( get_the_modified_date( DATE_W3C ) ),
            esc_html( get_the_modified_date() )
        );

        $posted_on = sprintf(
            /* translators: %s: post date. */
            esc_html_x( 'Posted on %s', 'post date', 'Minimal-Artistic-Portfolio' ),
            '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
        );

        echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

    }
endif;

if ( ! function_exists( 'map_posted_by' ) ) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function map_posted_by() {
        $byline = sprintf(
            /* translators: %s: post author. */
            esc_html_x( 'by %s', 'post author', 'Minimal-Artistic-Portfolio' ),
            '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
        );

        echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

    }
endif;

if ( ! function_exists( 'map_entry_footer' ) ) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function map_entry_footer() {
        // Hide category and tag text for pages.
        if ( 'post' === get_post_type() ) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list( esc_html__( ', ', 'Minimal-Artistic-Portfolio' ) );
            if ( $categories_list && mapcategorized_blog() ) {
                /* translators: 1: list of categories. */
                printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'Minimal-Artistic-Portfolio' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list( '', esc_html__( ', ', 'Minimal-Artistic-Portfolio' ) );
            if ( $tags_list ) {
                /* translators: 1: list of tags. */
                printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'Minimal-Artistic-Portfolio' ) . '</span>', $tags_list );// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }
        }

        if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
            echo '<span class="comments-link">';
            /* translators: %s: post title */
            comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'Minimal-Artistic-Portfolio' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
            echo '</span>';
        }

        edit_post_link(
            sprintf(
            /* translators: %s: Name of current post */
                esc_html__( 'Edit %s', 'Minimal-Artistic-Portfolio' ),
                the_title( '<span class="screen-reader-text">"', '"</span>', false )
            ),
            '<span class="edit-link">',
            '</span>'
        );
    }
endif;

/**
 * Flush out the transients used in mapcategorized_blog.
 */
function map_category_transient_flusher() {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient( 'mapcategories' );
}
add_action( 'edit_category', 'map_category_transient_flusher' );
add_action( 'save_post', 'map_category_transient_flusher' );
/**
 * Add share butttons
 *
 * @param string $title the post title to share.
 * @param string $url the post permalink.
 * @param string $class optional module classname.
 */
function map_social_module( $title, $url, $class = '' ) {
    ?>
	<div class="social-sharing-module <?php echo esc_attr( $class ); ?>">	
		<p class="list-title"><?php echo esc_html( __( 'Share', 'Minimal-Artistic-Portfolio' ) ); ?></p>
		<ul>
			<li>
				<a href="https://www.facebook.com/sharer.php?u=<?php echo esc_url( $url ); ?>" target="_blank">
					<svg class="icon icon-facebook">
						<use xlink:href="#icon-facebook"></use>
					</svg>
					<span class="screen-reader-text">
						<?php echo esc_html( __( 'Share on Facebook', 'Minimal-Artistic-Portfolio' ) ); ?>
					</span>
				</a>
			</li>
			<li>
				<a href="https://twitter.com/intent/tweet?text=<?php echo esc_url( $url ); ?> via @Nicolas_Lebrun_" target="_blank">
					<svg class="icon icon-twitter">
						<use xlink:href="#icon-twitter"></use>
					</svg>
					<span class="screen-reader-text">
						<?php echo esc_html( __( 'Share on Twitter', 'Minimal-Artistic-Portfolio' ) ); ?>
					</span>
				</a>
			</li>
			<li>
				<a href="mailto:?&body=<?php echo esc_url( $url ); ?>" target="_blank">
					<svg class="icon icon-mail">
						<use xlink:href="#icon-mail"></use>
					</svg>
					<span class="screen-reader-text">
						<?php echo esc_html( __( 'Send Email', 'Minimal-Artistic-Portfolio' ) ); ?>
					</span>
				</a>
			</li>
		</ul>
	</div>
	<?php
}
/**
 * Replace Search text
 *
 * @return string $form The search form HTML output.
 */
function map_search_form_text() {

    $form = '<form action="' . esc_url( home_url( '/' ) ) . '" method="get" class="search-form">
								<input type="search" 
											 name="s" 
											 id="s" 
											 class="search-field" 
											 placeholder="' . esc_attr_x( 'Search', 'submit button', 'Minimal-Artistic-Portfolio' ) . '..." 
											 value="' . esc_attr( get_search_query() ) . '" 
								required>
								<button type="submit" class="search-submit">
									<svg class="icon icon-search">
										<use xlink:href="#icon-search"></use>
									</svg>
									<span class="screen-reader-text">' . esc_attr_x( 'Search', 'submit button', 'Minimal-Artistic-Portfolio' ) . '</span>
								</button>
						</form>';

    return $form;
}
add_filter( 'get_search_form', 'map_search_form_text' );

/**
 * Generate contact form message
 *
 * @param string $type success|error type of message.
 * @param string $message_id an id to get the right text.
 * @return string $out HTML message
 */
function map_form_generate_response( $type, $message_id ) {

    $out      = '';
    $messages = array(
        'not_human'       => __( 'Human verification incorrect.', 'Minimal-Artistic-Portfolio' ),
        'missing_content' => __( 'Please supply all information.', 'Minimal-Artistic-Portfolio' ),
        'email_invalid'   => __( 'Email Address Invalid.', 'Minimal-Artistic-Portfolio' ),
        'message_unsent'  => __( 'Message was not sent. Try Again.', 'Minimal-Artistic-Portfolio' ),
        'message_sent'    => __( 'Thanks! Your message has been sent.', 'Minimal-Artistic-Portfolio' ),
    );

    if ( isset( $messages[ $message_id ] ) ) {
        if ( 'success' === $type ) {
            $out .= "<div class='success'>{$messages[ $message_id ]}<a href='#' class='close'></a></div>";
        } else {
            $out .= "<div class='warning'>{$messages[ $message_id ]}<a href='#' class='close'></a></div>";
        }
    }
    return $out;
}
/**
 * Get contact form user input and send email
 */
function map_form_process_mail() {
    $data              = array();
    $response          = [];
    $data['name']      = ( isset( $_POST['message_name'] ) ) ? sanitize_user( wp_unslash( $_POST['message_name'] ) ) : null;
    $data['email']     = ( isset( $_POST['message_email'] ) ) ? sanitize_user( wp_unslash( $_POST['message_email'] ) ) : null;
    $data['message']   = ( isset( $_POST['message_text'] ) ) ? sanitize_user( wp_unslash( $_POST['message_text'] ) ) : null;
    $data['add_first'] = ( isset( $_POST['add_first'] ) ) ? intval($_POST['add_first']) : false;
    $data['add_secnd'] = ( isset( $_POST['add_secnd'] ) ) ? intval($_POST['add_secnd']) : false;


    $subject = __( 'Someone sent a message from ', 'Minimal-Artistic-Portfolio' );
    $to      = get_option( 'admin_email' );
    $subject = $subject . get_bloginfo( 'name' );
    $message = $data['message'] . "\r\n" . $data['name'];
    $headers = 'From: ' . $data['email'] . "\r\n" . 'Reply-To: ' . $data['email'] . "\r\n";

    if ( isset( $_POST['map_form_process_mail_nonce'] ) &&
        wp_verify_nonce( sanitize_user( wp_unslash( $_POST['map_form_process_mail_nonce'] ) ), 'map_form_process_mail' ) &&
        isset( $_POST['submit'] ) &&
        empty( $_POST['name'] ) &&
        empty( $_POST['email'] ) &&
        empty( $_POST['website'] )
    ) {
        if ( ! filter_var( $data['email'], FILTER_VALIDATE_EMAIL ) ) {
            
            $response[] = [ 'type' => 'error', 'id' => 'email_invalid'];

        } else {

            if( $data['add_first'] + $data['add_secnd'] !== 10 ) {

                $response[] = [ 'type' => 'error', 'id' => 'not_human'];
            } else {
                if (empty($data['name']) || empty($data['message'])) {
                    $response[] = [ 'type' => 'error', 'id' => 'missing_content'];
                } else {
                    $sent = wp_mail($to, $subject, wp_strip_all_tags($message), $headers);
                    $sent = true;
                    if ($sent) {
                        $response[] = [ 'type' => 'success', 'id' => 'message_sent'];
                    } else {
                        $response[] = [ 'type' => 'error', 'id' => 'message_unsent'];
                    }
                }
            }
        }
    } elseif ( isset( $_POST['submit'] ) ) {
        $response[] = [ 'type' => 'error',  'id' => 'missing_content' ];
    }
    return array(
        'data'     => $data,
        'response' => $response,
    );
}
/**
 * Fire contact form
 *
 * @param string $url
 */
function map_get_form_markup( $url ) {

    $returned       = map_form_process_mail();
    $data           = $returned['data'];
    $response       = $returned['response'];
    $add_first_elem = intval( rand(0, 9) );

    if ( ! empty( $response ) ) {
        foreach ( $response as $notification ) {
            if ( isset( $notification['type'], $notification['id'] ) ) {
                echo wp_kses_post( map_form_generate_response( $notification['type'], $notification['id'] ) );
            }
        }
    }
    if ( empty( $response[0] ) || $response[0]['id'] !== 'message_sent' ) : ?>
		<form action="<?php echo esc_url($url); ?>" method="post"  class="contact">

			<?php wp_nonce_field( 'map_form_process_mail', 'map_form_process_mail_nonce', true, true ); ?>

			<?php /** Honey pot field  */ ?>
			<label class="pot" for="name">Name (please leave this field empty)</label>
			<input class="pot" id="name" type="text" name="name"	autocomplete="off" value="" placeholder="Your name here">

			<label class="pot" for="email">Name (please leave this field empty)</label>
			<input class="pot" id="email" type="email" name="email" autocomplete="off" value="" placeholder="Your email here">

			<label class="pot" for="website">Name (please leave this field empty)</label>
			<input class="pot" id="website" type="url" name="website" autocomplete="off" value="" placeholder="Your website here">

			<span class="input">
				<input 
					type="text" class="input__field"
					name="message_name" id="message_name"
					placeholder="<?php echo esc_html__( 'Name *', 'Minimal-Artistic-Portfolio' ); ?>"
					value="<?php echo isset( $data['name'] ) ? esc_html( $data['name'] ) : ''; ?>" required>
			</span>

			<span class="input">
				<input 
					type="text" class="input__field"
					name="message_email" id="message_email"
					placeholder="<?php echo esc_html__( 'Email *', 'Minimal-Artistic-Portfolio' ); ?>"
					value="<?php echo isset( $data['email'] ) ? esc_html( $data['email'] ) : ''; ?>" required>
			</span>

			<span class="input textarea-input">
				<textarea 
					type="text" 
					name="message_text" 
					id="message_text"  
					class="input__field" 
					rows="7" 
					placeholder="<?php echo esc_html__( 'Message *', 'Minimal-Artistic-Portfolio' ); ?>"
                    required
				><?php echo isset( $data['message'] ) ? esc_html( $data['message'] ) : ''; ?></textarea>
			</span>

            <span class="input anti-spambot-input">
                <input type="hidden" name="add_first" value="<?php echo $add_first_elem; ?>">
                <p>
                    <?php echo $add_first_elem; ?>
                    +
                    <input type="number" name="add_secnd" value="" placeholder="*" required>
                    = 
                    10
                </p>
            </span>

			<span class="input">
				<label class="input__label">
					<?php echo esc_html__( '* : require field', 'Minimal-Artistic-Portfolio' ); ?>
				</label>

				<button type="submit" name="submit" class="button">
					<?php echo esc_html__( 'send', 'Minimal-Artistic-Portfolio' ); ?>
				</button>
			</span>

		</form>


    <?php endif;

}

/**
 * Create date string by removing redudant information
 *
 * @param object $begin_date the first date of the string.
 * @param object $end_date the last date of the string.
 *
 * @return string the cleaned date string
 **/
function map_friendly_date( $begin_date, $end_date ) {
    $keep_month = intval( date_i18n( 'm', $begin_date ) ) !== intval( date_i18n( 'm', $end_date ) );
    $keep_year  = intval( date_i18n( 'Y', $begin_date ) ) !== intval( date_i18n( 'Y', $end_date ) );
    $output     = '';

    // default full string date.

    $output = sprintf(
        // translators: %1$s = first date month name (F) %2$s = first date day num (j)  %3$s = first date year (Y) %4$s = second date month name (F) %5$s = second date day num (j) %6$s = second date year (Y).
        __( 'From %1$s %2$s %3$s to %4$s %5$s %6$s', 'Minimal-Artistic-Portfolio' ),
        date_i18n( 'F', $begin_date ),
        date_i18n( 'j', $begin_date ),
        date_i18n( 'Y', $begin_date ),
        date_i18n( 'F', $end_date ),
        date_i18n( 'j', $end_date ),
        date_i18n( 'Y', $end_date )
    );
    // string date without first year.
    if ( ! $keep_year ) {
        $output = sprintf(
            // translators: From date to date with same year  %1$s = first date month name (F) %2$s = first date day num (j) %3$s = second date month name (F) %4$s = second date day num (j) %5$s = second date year (Y).
            __( 'From %1$s %2$s to %3$s %4$s %5$s', 'Minimal-Artistic-Portfolio' ),
            date_i18n( 'F', $begin_date ),
            date_i18n( 'j', $begin_date ),
            date_i18n( 'F', $end_date ),
            date_i18n( 'j', $end_date ),
            date_i18n( 'Y', $end_date )
        );
    }

    // string date without first month.
    if ( ! $keep_year && ! $keep_month ) {
        $output = sprintf(
            // translators: From date to date with same year & the same month %1$s = first date day num (j)  %2$s = second date day num (j) %3$s = second date month name (F) %4$s = second date year (Y).
            __( 'From %1$s to %2$s %3$s %4$s', 'Minimal-Artistic-Portfolio' ),
            date_i18n( 'j', $begin_date ),
            date_i18n( 'j', $end_date ),
            date_i18n( 'F', $end_date ),
            date_i18n( 'Y', $end_date )
        );
    }

    return  $output;
}
