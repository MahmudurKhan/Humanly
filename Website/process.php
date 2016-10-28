<?php
// process.php

$errors         = array();      // array to hold validation errors
$data           = array();      // array to pass back data

// validate the variables ======================================================
// if any of these variables don't exist, add an error to our $errors array

if (empty($_POST['name']))
    $errors['name'] = 'Name is required.';

if (empty($_POST['email']))
    $errors['email'] = 'Email is required.';

if (empty($_POST['suggestion']))
    $errors['suggestion'] = 'Suggestion alias is required.';

// return a response ===========================================================

// if there are any errors in our errors array, return a success boolean of false
if ( ! empty($errors)) {

    // if there are items in our errors array, return those errors
    $data['success'] = false;
    $data['errors']  = $errors;
} else {

    // if there are no errors process our form, then return a message

    // DO ALL YOUR FORM PROCESSING HERE
    // THIS CAN BE WHATEVER YOU WANT TO DO (LOGIN, SAVE, UPDATE, WHATEVER)

    $to = "help@luminaries.com"; // this is your Email address
    $from = $_POST['email']; // this is the sender's Email address
    $name = $_POST['name'];

    $subject = "Form submission";

    $message = $name . " wrote the following:" . "\n\n" . $_POST['suggestion'];


    $headers = "From:" . $from;

    mail($to,$subject,$message,$headers);



    // show a message of success and provide a true success variable
    $data['success'] = true;
    $data['message'] = 'Thank you for your suggestion!';

}

// return all our data to an AJAX call
echo json_encode($data);