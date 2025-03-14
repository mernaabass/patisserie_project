<?php
    include 'includes/db_conn.php';
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['phone']) && !empty($_POST['order_name'])) {
        
        $name = strip_tags(htmlentities($_POST['name']));
        $email = strip_tags(htmlentities($_POST['email']));
        $phone = strip_tags(htmlentities($_POST['phone']));
        $order_name = strip_tags(htmlentities($_POST['order_name']));
        $created_at = date("Y-m-d H:i:s");

        $sql = "INSERT INTO `orders` (`name`, `email`, `phone`, `order_name`,`created_at`) VALUES ('$name','$email','$phone','$order_name', '$created_at')";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        
        // check if ok then send email
        if ($stmt) {
            echo "Thanks!";
        } else {
            echo "Error!";
        }
    }
?>