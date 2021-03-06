<?php

    
    #   when login button is pressed
    if (isset($_POST['loginButton'])) {
        $email = $_POST['loginEmail'];
        $logger->info('Login Button was pressed...');
  
    $email = sanatizeFormString($email);
    $loginSuccessful = $account->login($email);

    #   Adding one to login counter
    $stmt = $con->prepare('UPDATE user_details SET counter = counter+1 WHERE email_id = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();

    if($loginSuccessful) {
        
        // Session Variables are created 
        $_SESSION['userLoggedIn'] = $email;

        // Login time is stored in a session variable 
        $_SESSION["login_time_stamp"] = time();   
        $logger->info('User variable set to'. $email);
        $logger->info('login_time_stamp Set');
        $logger->info('User session variable will distory itself in 10 Minutes');
        $logger->info('User Login Successfull...');

        header("Location: index.php");
    }else{
        $logger->error('User Login Failed...Redirecting to register/login page');
    }
}
?>

    