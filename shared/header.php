<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FILE MANAGER</title>
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/font-awesome.min.css" />
    <link rel="stylesheet" href="css/style.css" />
</head>

<body>
    <header class="my-2">
        <nav class="navbar navbar-expand-lg navbar-toggleable-md double-nav navabr-light bg-light">
            <h4><a href="index.php" class="navabr-brand text-secondary nav-link">FILE MANAGER</a></h4>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <!-- <span class="navbar-toggler-icon"></span> -->
                <div class="text-black animated-icon1"><span></span><span></span><span></span></div>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="index.php" class="nav-link text-secondary">Home</a>
                    </li>
                    <?php
                        if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != '')
                        {
                    ?>
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link text-secondary">Log Out</a>
                    </li>
                    <?php
                    }
                    else
                    {
                    ?>
                    <li class="nav-item">
                        <a href="signup.php" class="nav-link text-secondary">Sign Up</a>
                    </li>
                    <li class="nav-item">
                        <a href="login.php" class="nav-link text-secondary">Sign In</a>
                    </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </nav>
    </header>