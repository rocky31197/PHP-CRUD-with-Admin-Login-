<?php 
if (!empty($_GET['id'])) {
    // require connection
    include ('conn.php');

    $p_id = $_GET['id'];
    $del_query = "DELETE FROM `shop_products` WHERE id = '" . $p_id . "'";
    $result = mysqli_query($conn, $del_query);

    if ($result) {
        header('location:/Login/index.php');
    }
}
?>