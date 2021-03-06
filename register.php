<!--    PHP Code    -->
<?php 

require 'vendor/autoload.php';
$logger = new Custer\CLogger\Logger(__DIR__.'/logs');

include("includes/config.php"); 
#   PHP Classes Links
include("includes/classes/Account.php"); 
include("includes/classes/Constants.php"); 
$account = new Account($con);
#   PHP Handlers Links
include("includes/handlers/register-handler.php");
include("includes/handlers/login-handler.php"); 
function getInputValue($name) {
    if(isset($_POST[$name])) {
        echo $_POST[$name];
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custer Digital Wallet</title>

    <!--    Add Bootstrap links (Bootstrap / Jquery / Popper.js)-->
    <?php include("includes/bootstrap.php"); ?>

    <!--    Adds CSS links      -->
    <link rel="stylesheet" href="assets/css/register.css">

    <!--    Adds JS links      -->
    <script src="assets/js/register.js"></script>

</head>

<body>
    <!--    Show/Hide Form Handler    -->
    <?php
        if(isset($_POST['registerButton'])) {
            echo '<script>
                    $(document).ready(function(){
                        $("#walletLoginForm").hide();
                        $("#walletRegisterForm").show();
                    });
                </script>';
        } else {
            echo '<script>
                    $(document).ready(function(){
                        $("#walletLoginForm").show();
                        $("#walletRegisterForm").hide();
                    });
                </script>';
        }
    ?>
    <!--    Show/Hide Form Handler End    -->
    <!--    Website View    -->
    <div class="from-group loginFormHeading my-5">
        <h1 class="display-4"><strong><em>Custer Digital Wallets</em></strong></h1>
    </div>
    <div id="loginContainer">

        <!--    Login Form  -->
        <div class="row justify-content-center h-50 align-items-center">
            <div class="col-6">
                <form id="walletLoginForm" action="register.php" method="POST">
                    <div class="jumbotron ">
                        <div class="offset-1 col-10">
                            <div class="from-group loginFormHeading">
                                <h2 class="display-5">Login to your account</h2>
                            </div>
                            <div class="form-group">
                                <label for="loginEmail">Enter Email id:</label><br>
                                <input id="loginEmail" name="loginEmail" class="form-control" type="email"
                                    placeholder="ndivhuwomurwamuila@gmail.com" required>
                                <?php echo $account->getError(Constants::$loginFailed); ?>
                            </div>
                            <button type="submit" name="loginButton" class="btn btn-primary btn-lg btn-block">LOGIN</button>
                            <div class="hasAccountText mt-3">
                                <span id="hideLogin">Don&apos;t have an account yet? Sign-Up here</span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!--    Login Form End      -->

        <!--    Register Form   -->
        <div class="row justify-content-center h-50 align-items-center">
            <div class="col-6">

                <form id="walletRegisterForm" action="register.php" method="POST">
                    <div class="jumbotron ">
                        <div class="offset-1 col-10">
                            <div class="from-group loginFormHeading">
                                <h2 class="display-5">Register a new account</h2>
                            </div>

                            <div class="form-group">
                                <label for="username">Enter Username:</label><br>
                                <input id="username" name="username" class="form-control" type="text"
                                    value="<?php getInputValue('username') ?>" placeholder="johnDoe" required>
                                <?php echo $account->getError(Constants::$usernameTaken); ?>
                                <?php echo $account->getError(Constants::$UsernameCharecters); ?>

                                <div class="row">
                                    <div class="col">
                                        <label for="email">Enter Email id:</label><br>
                                        <input id="email" name="email" class="form-control" type="email"
                                            value="<?php getInputValue('email') ?>" placeholder="ndivhuwomurwamuila@gmail.com"
                                            required>
                                    </div>
                                    <div class="col">
                                        <label for="email2">Confirm Email id:</label><br>
                                        <input id="email2" name="email2" class="form-control" type="email"
                                            value="<?php getInputValue('email2') ?>" placeholder="ndivhuwomurwamuila@gmail.com"
                                            required>
                                    </div>
                                </div>
                                <?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
                                <?php echo $account->getError(Constants::$emailsNotValid); ?>
                                <?php echo $account->getError(Constants::$emailTaken); ?>

                                <label for="mobile">Enter Mobile Number:</label><br>
                                <input id="mobile" name="mobile" class="form-control" type="tel"
                                    value="<?php getInputValue('mobile') ?>" placeholder="+27735229177" required>
                                <?php echo $account->getError(Constants::$MobileNotValid); ?>
                                <?php echo $account->getError(Constants::$MobileTaken); ?>
                            </div>
                            <button type="submit" name="registerButton" class="btn btn-primary btn-lg btn-block">SIGN UP</button>

                            <div class="hasAccountText mt-3">
                                <span id="hideRegister">Already have an account? Login here.</span>
                            </div>
                        </div>
                </form>
            </div>
        </div>
        <!--    Register Form End   -->
    </div>
    <!--    Website View End    -->

    <!--    Stops form from resubmitting    -->
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <!--    Stops form from resubmitting    -->
</body>

</html>
