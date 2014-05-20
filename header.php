<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Rutas Gran Canaria</title>
    <link rel="stylesheet" href="style.css"/>
</head>
<body>

<section>
    <header>

        <?php
        session_start();

        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];

            if (isset($_SESSION['role'])) {
                $role = $_SESSION['role'];
            }
            $loggedin = TRUE;
        } else {
            $loggedin = FALSE;
        }

        if ($loggedin) {
            // Logged user is admin
            if (isset($role) && $role == 1) {
                echo('<nav><a href="index.php" title="Go home">Home</a> | <a href="routes.php" title="View routes">Routes</a> | <a href="admin.php" title="Admin Area">Admin</a> | Welcome back <em>' . $user . '</em>! <a class="logout" href="logout.php" title="Sign out">Sign out</a></nav>');
            } // Logged user is not admin
            else {
                echo('<nav><a href="index.php" title="Go home">Home</a> | <a href="routes.php" title="View routes">Routes</a> | Welcome back <em>' . $user . '</em>! <a class="logout" href="logout.php" title="Sign out">Sign out</a></nav>');
            }
        } else {
            echo('<nav><a href="index.php" title="Go home">Home</a> | <a href="routes.php" title="View routes">Routes</a> | <a href="signup.php" title="Sign up">Sign up</a> | <a href="login.php" title="Log in">Log in</a> | Welcome <em>Guest</em>!</nav>');
        }
        ?>

        <h1><a href="index.php" title="Senderos de Gran Canaria">Senderos de Gran Canaria</a></h1>

    </header>
