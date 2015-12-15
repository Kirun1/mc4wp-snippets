<?php

/**
 * Create a user whenever a form is created with success
 *
 * @param MC4WP_Form $form
 */
add_action( 'mc4wp_form_subscribed', function( MC4WP_Form $form ) {

	// do nothing if current user is logged in
	if( is_user_logged_in() ) {
		return;
	}

	$username = $form->data['EMAIL'];
	$password = wp_generate_password();

	// try to create the user (or error when user already exists)
	$user_id = wp_create_user( $username, $password );

	// send email notification with password reset
	if( $user_id ) {
		wp_new_user_notification( $user_id );
	}
});