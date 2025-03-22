<?php

// Prevent function redeclaration
if (!function_exists('check_if_added_to_cart')) {

    // This function checks if the product is added to the cart
    function check_if_added_to_cart($item_id) {
        if (!isset($_SESSION['user_id'])) {
            return 0; // User is not logged in, so item can't be added
        }

        $user_id = $_SESSION['user_id']; // Get user_id from session
        require("common.php"); // Connecting to the database

        // Secure query using prepared statement
        $query = "SELECT id FROM user_item WHERE item_id = ? AND user_id = ? AND order_status = 'Pending'";
        $stmt = mysqli_prepare($con, $query);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ii", $item_id, $user_id);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);

            // If the item exists in the cart, return 1, otherwise return 0
            $is_added = mysqli_stmt_num_rows($stmt) > 0 ? 1 : 0;
            
            mysqli_stmt_close($stmt);
            return $is_added;
        }

        return 0; // If query fails, assume item is not added
    }
}
?>
