<?php

require_once('config/DatabaseClass.php');

$err = $msg = "";
$firstname = $lastname = $email = $username = $password = $confirm_password = "";

if ($_SERVER["REQUEST_METHOD"] =="POST")
{
    $signup = new DatabaseClass();
    
    // $signup->validateConfirmPassword($_POST['confirm_password']);
    $signup->validatePassword($_POST['password']);
    $signup->validateUsername($_POST['username']);
    $signup->validateEmail($_POST['email']);
    $signup->validateLastname($_POST['lastname']);
    $signup->validateFirstname($_POST['firstname']);

    $firstname = $signup->firstname;
    $lastname = $signup->lastname;
    $email = $signup->email;
    $username = $signup->username;
    $password = $signup->password;
    // $confirm_password = $signup->confirm_password;
    
    if ($signup->err)
        $err = $signup->err;
    else
    {
        $signup->Name();
        $signup->CheckUsername();
        if ($signup->err)
            $err = $signup->err;
        else
            $msg = $signup->msg;
    }
}

?>

<?php
    include_once('shared/header.php');
?>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-8 col-lg-6" style="margin: auto;">
            <?php
                if ($err) {
            ?>
            <div class="alert alert-danger"><?php echo $err; ?></div>
            <?php
                }
                if ($msg) {
            ?>
            <div class="alert alert-success"><?php echo $msg; ?></div>
            <?php
                }
            ?>
            <div id="err">
            </div>
            <form action="signup.php" method="post" name="signupForm" onsubmit="return check();">
                <fieldset>
                    <h1 class="mb-4">Register With Us</h1>
                </fieldset>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="firstname">Firstname</label>
                            <input type="text" class="form-control" value="<?php echo $firstname; ?>"
                                name="firstname" />
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group">
                            <label for="lastname">Lastname</label>
                            <input type="text" class="form-control" name="lastname" value="<?php echo $lastname; ?>" />
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>" />
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" value="<?php echo $username; ?>" />
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" value="<?php echo $password; ?>" />
                </div>
                <!--<div class="form-group">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" class="form-control" name="confirm_password" value="<?php echo $confirm_password; ?>"/>
                    </div>-->
                <div class="row">
                    <div class="form-group col-md-10">
                        <input type="submit" class="btn btn-outline-success my-2 my-sm-0" value="Signup" />
                    </div>
                    <div class="form-group col-md-2">
                        <a href="login.php" class="btn btn-outline-primary my-2 my-sm-0">Login</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    include_once('shared/footer.php');
?>