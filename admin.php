<?php

include_once './functions.php';

include_once './header.php';

// If user is admin
if (isset($role) && $role == 1)
{
    echo '<h2>Administration area</h2>';
    echo '<a class="button" href="manage_routes.php">Manage Routes</a>';
    echo '<a class="button" href="manage_users.php">Manage Users</a>';
}
else
{
    header('Location:index.php');
}

include_once './footer.php';
?>