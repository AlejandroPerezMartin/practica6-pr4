<?php

include_once('./functions.php');

include_once('./header.php');

// If user is admin
if (isset($role) && $role == 1)
{

    echo '<h2>Manage routes</h2>';
    echo '<h3>Add new route</h3>';

    echo <<<_HTML
        <p class="route-form">
            <input type"text" name="title" placeholder="Route name..." rows="30" cols="20" required>
            <br>
            <textarea name="description" placeholder="Route description" required></textarea>
            <br>
            <input type"date" name="date" placeholder="DD/MM/YYYY" required>
            <br>
            <input type"url" name="url" placeholder="http://link-to-route.com">
            <br>
            <button value="add" class="add">Add route</button>
        </p>
_HTML;

    echo '<p><h3>Delete route</h3></p>';
    $db = new SQLiteConnection();

    $results = $db->execute_sql("SELECT * FROM activities");

    $results = $results->fetchAll();

    if ($results)
    {
        echo '<p>Current routes: <select name="routes" id="routes-list">';
        foreach ($results as $value)
        {
            echo '<option value="' . $value['ID'] . '">' . $value['NAME'] . '</option>';
        }
        echo '</select>';
        echo ' <button value="delete" class="delete-route">Delete</button></p>';
    }
    else
    {
        echo "<p>There are no routes</p>";
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