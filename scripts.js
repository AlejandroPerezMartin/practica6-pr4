/**
 *   Delete user from database
 */
$(".delete").on("click", function () {

    if (!confirm("Are you sure you want to delete this user?")) return;

    var username = $('#users-list').val();

    $.ajax({
        url: "delete_user.php",
        type: "POST",
        data: { 'user_to_delete': username },
        cache: false,
        success: function () {
            alert("User deleted successfully!");
            location.reload();
        },
        statusCode: {
            404: function () {
                alert("404 - Page not found!");
            }
        }
    });

});


/**
 *   Delete route from database
 */
$(".delete-route").on("click", function () {

    if (!confirm("Are you sure you want to delete this route?")) return;

    var route_id = $('#routes-list').val();
    alert(route_id);

    $.ajax({
        url: "delete_route.php",
        type: "POST",
        data: { 'route_id_to_delete': route_id },
        cache: false,
        success: function () {
            alert("Route deleted successfully!");
            location.reload();
        },
        statusCode: {
            404: function () {
                alert("404 - Page not found!");
            }
        }
    });

});
