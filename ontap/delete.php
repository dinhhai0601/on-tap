<?php
require_once "connection.php";
if(isset($_GET['tour_id'])){
    $tour_id = $_GET['tour_id'];
    $sql = "DELETE FROM tours where tour_id=$tour_id";
    $stmt = $conn-> prepare($sql);
    $stmt -> execute();
    setcookie("sucsess", "Xoa dữ liệu thành công", time() + 1);
    header("location: index.php");
    exit;
}