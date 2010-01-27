<?php
function spamcheck($field) {
	//filter_var() sanitizes the e-mail 
	//address using FILTER_SANITIZE_EMAIL
	$field=filter_var($field, FILTER_SANITIZE_EMAIL);
  
	//filter_var() validates the e-mail
	//address using FILTER_VALIDATE_EMAIL
	if(filter_var($field, FILTER_VALIDATE_EMAIL)) {
    	return TRUE;
    }
	else {
    	return FALSE;
	}
}


if (($_POST['spamCheck'] != "cold")) {
 echo "NO bots";
}
elseif (empty($_POST['name']) || empty($_POST['email']) || ($_POST['subject']=="x") || empty($_POST['spamCheck']) || empty($_POST['message'])) {
	echo('<p>Please fill in all required fields.</p><p>Please use your browsers back button to complete the form.</p>');
} 

else if (isset($_POST['email'])) { //if "email" and fields is filled out, proceed
  
	//check if the email address is invalid
	$mailcheck = spamcheck($_POST['email']);
	if ($mailcheck==FALSE) {
		echo "Email is not correctly formatted or is invalid.";
	}
	else { //send email
		$name = $_POST['name'] ;
		$email = $_POST['email'] ;
		$subject = $_POST['subject'] ; 
		$message = $_POST['message'] ;
		$logs = $_POST['logs'] ;
		$message = ($message);
		$full = wordwrap($message, 70);
		mail("cairoteam@cairoshell.com", $subject,
		$full, "From: $name <$email>");
		header("Location: thanks.html");
    }
}
else { //if "email" is not filled out, display the form
	echo ('<p>Please fill in your email and all required fields.</p><p>Please use your browsers back button to complete the form.</p>');
	}
?>