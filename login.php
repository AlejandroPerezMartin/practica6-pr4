<?php

include_once './functions.php';

include_once './header.php';

if (isset($_SESSION['user']))
{
    header('Location:index.php');
}

$error = $user = $password = "";

if (isset($_POST['user']))
{
    $filters = array('user' => FILTER_SANITIZE_STRING, 'password' => FILTER_SANITIZE_ENCODED);

    $filtered_inputs = filter_input_array(INPUT_POST, $filters);

    $user = $filtered_inputs['user'];
    $password = $filtered_inputs['password'];

    if ($user == "" || $password == "")
    {
        $error = "<p class=\"error\">Not all fields were entered.</p>";
    }
    else
    {
        $user = $filtered_inputs['user'];
        $password = $filtered_inputs['password'];

        $db = new SQLiteConnection();

        if ($db->isUserRegistered($user, $password))
        {
            $_SESSION['user'] = $user;
            $_SESSION['password'] = $password;
            $_SESSION['role'] = $db->getUserRole($user);
            header('Location:index.php');
        }
        else
        {
            $error = "<p class=\"error\">Incorrect username or password.</p>";
        }

        $db->close();
    }
}

echo <<<_HTML
<h1>Log in</h1>

<form method="POST" action="login.php">$error
    <input type="text" name="user" maxlength="16" value="$user" placeholder="User name" size="30" autofocus required>
    <br>
    <input type="password" name="password" maxlength="16" value="$password" placeholder="Password" size="30" required>
    <br>
    <input type="submit" value="Sign in" class="button">
</form>
_HTML;

include_once('./footer.php');

?>


