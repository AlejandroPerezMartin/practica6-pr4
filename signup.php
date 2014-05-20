<?php

include_once './functions.php';

include_once './header.php';

if (isset($_SESSION['user'])) {
    header('Location:index.php');
}

$error = $user = $name = $email = $password = "";

if (isset($_POST['user'])) {

    $filters = array('user' => FILTER_SANITIZE_STRING, 'name' => FILTER_SANITIZE_STRING, 'email' => FILTER_SANITIZE_EMAIL, 'password' => FILTER_SANITIZE_ENCODED);

    $filtered_inputs = filter_input_array(INPUT_POST, $filters);

    foreach ($filtered_inputs as $value) {
        if ($value === "") {
            $error = TRUE;
            break;
        }
    }

    if ($error) {
        $error = "<p class=\"error\">There was an error processing your information.</p>";
    } else {
        $user = $filtered_inputs['user'];
        $name = $filtered_inputs['name'];
        $email = $filtered_inputs['email'];
        $password = $filtered_inputs['password'];

        $db = new SQLiteConnection();

        if ($db->isAvailableUsername($user)) {
            $query = "INSERT INTO users (USERNAME, PASSWORD, NAME, EMAIL, ROLE) VALUES ('" . strtolower($user) . "','" . md5($password) . "','" . $name . "','" . $email . "',0)";

            if ($db->execute_sql($query)) {
                $error = '<p class="valid">You\'re now registered!</p>';
            }
        } else {
            $error = "<p class=\"error\">Sorry, username already taken!</p>";
        }

        $db->close();
    }
}

echo <<<_HTML
<h1>Register account</h1>

<form method="POST" action="signup.php">$error
    <input type="text" name="user" maxlength="16" value="$user" placeholder="User name" size="30" required>
    <br>
    <input type="text" name="name" maxlength="50" value="$name" placeholder="Full name" size="30" required>
    <br>
    <input type="email" name="email" maxlength="50" value="$email" placeholder="Email" size="30" required>
    <br>
    <input type="password" name="password" maxlength="16" value="$password" placeholder="Password" size="30" required>
    <br>
    <input type="submit" value="Sign up" class="button">
</form>
_HTML;

include_once './footer.php';
?>