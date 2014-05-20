<?php

include_once('./functions.php');

include_once('./header.php');

// If user is admin
if (isset($role) && $role == 1)
{
    $db = new SQLiteConnection();

    $results = $db->execute_sql("SELECT * FROM users WHERE ROLE=0");

    $results = $results->fetchAll();

    if ($results)
    {
        echo '<h2>Manage users</h2>';
        echo '<p>All users: <select name="users" id="users-list">';

        foreach ($results as $value)
        {
            echo '<option value="' . $value['USERNAME'] . '">' . $value['USERNAME'] . '</option>';
        }
        
        echo '</select>';
        echo ' <button value="Delete" class="delete">Delete</button></p>';
    }
    else
    {
        echo "<p>No users to display ;(</p>";
    }

    echo '<script src="libs/jquery-1.11.1.min.js"></script>';
    echo '<script src="scripts.js"></script>';

    $db->close();

    echo '<a class="button" href="admin.php">&#8592; Back to admin area</a>';
}
else
{
    header('Location:index.php');
}

include_once('./footer.php');

?>