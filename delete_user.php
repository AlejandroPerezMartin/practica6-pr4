<?php

include_once './functions.php';

include_once './header.php';

// If user is admin
if (isset($role) && $role == 1)
{
    if ($_SERVER['REQUEST_METHOD'] == "POST")
    {
        if (isset($_POST['user_to_delete']))
        {
            $filter = array('user_to_delete' => FILTER_SANITIZE_STRING);

            $filtered_input = filter_input_array(INPUT_POST, $filter);

            $db = new SQLiteConnection();

            $db->execute_sql("DELETE FROM users WHERE USERNAME='" . $filtered_input['user_to_delete'] . "'");

            $DB->close();
        }
    }
}

header('Location:index.php');

include_once './footer.php';

?>