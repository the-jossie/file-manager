<?php

session_start();

require_once('config/functions.php');
require_once('config/DatabaseClass.php');

$database = new DatabaseClass();

if (isset($_SESSION['user_id']))
{
    header('Location: index.php');
    exit;
}
else if (isset($_COOKIE['remember']))
{
    $userid = decryptCookie($_COOKIE['rememberme']);

    $sql = "SELECT COUNT(*) AS cntUser FROM users WHERE id=:id";
    $stmt = $database->Read($sql, ['id' => $userid]);
    $count = $stmt[0]['cntUser'];

    if($count > 0)
    {
        $_SESSION['user_id'] = $userid;
        header('Location: index.php');
        exit;
    }
}

$err = "";
$username = $password = "";

if ($_SERVER["REQUEST_METHOD"] =="POST")
{
    if (empty(trim($_POST['username'])))
    {
        $err = "Please enter username.";
    }
    else
    {
        $username = trim($_POST['username']);
    }
    
    if (empty(trim($_POST['password'])))
    {
        $err = "Please enter password.";
    }
    else
    {
        $password = trim($_POST['password']);
    }

    $statement = "SELECT * FROM users WHERE username = :username";
    $user = $database->Read($statement, ['username' => $username]);

    // Check if username exists and corressponds with password
    if(isset($user[0]))
    {
        // Password is correct
        if (password_verify($password, $user[0]['password']))
        {
            $userid = $user[0]['id'];
            if (isset($_POST['remember']))
            {
                $days = 30;
                $value = encryptCookie($userid);

                setcookie('rememberme', $value, time() + ($days * 24 * 60 * 60 * 1000));
            }
            
            // start a new session
            session_start();

            // Store data in session
            $_SESSION["user_id"] = $userid;
            // Redirect user to home page
            header("location: index.php");
        }
        else
        {
            $err = "Invalid Username / Password";
        }
    }
    else
    {
        $err = "Invalid Username / Password";
    }
}
?>
<?php
    include_once('shared/header.php');
?>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-8 col-lg-6" style="margin: 100px auto;">
            <?php
                if ($err)
                {
            ?>
            <div class="alert alert-danger"><?php echo $err; ?></div>
            <?php
                }
            ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" value="<?php echo $username; ?>" />
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" value="<?php echo $password; ?>" />
                </div>
                <div class="form-group mb-5">
                    <div class="pull-left">
                        <input type="checkbox" name="remember" />
                        <label for="password">Remember me</label>
                    </div>
                    <div class="pull-right">
                        <a href="recover_password.php">Forgot password?</a>
                    </div>
                </div>
                <div class="form-group">
                    <div class="pull-left">
                        <input type="submit" class="btn btn-outline-primary my-2 my-sm-0" value="Login" />
                    </div>
                    <div class="pull-right">
                        <a href="signup.php" class="btn btn-outline-success my-2 my-sm-0">Signup</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    include_once('shared/footer.php');
?>