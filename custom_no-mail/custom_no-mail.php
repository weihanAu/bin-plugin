<?php

// Hook into the wp_mail_smtp_before_send filter to modify email recipients
add_filter('wp_mail_smtp_before_send', 'no_email_filter', 10, 2);

function no_email_filter($args, $mailer) {
    // Get the recipient's email address
    $recipient_email = $args['to'];

    // Get the user ID from the recipient's email
    $user = get_user_by('email', $recipient_email);
    $user_id = $user ? $user->ID : false;

    // Check if the user ID is 20
    if ($user_id == 20) {
        // User ID is 20, so prevent the email from being sent
        $args['to'] = ''; // Set the recipient to an empty string
        $args['message'] = ''; // Set the email message to an empty string
        $args['subject'] = ''; // Set the email subject to an empty string
    }

    return $args;
}