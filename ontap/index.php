<?php
    require_once "connection.php";

    $sql = "SELECT * FROM tours";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $tours = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Bảng</h1>
    <?php if(isset($_COOKIE['sucsess'])) : ?>
        <h2><?= $_COOKIE['sucsess'] ?></h2>
        <?php endif ?>
       
    <table border="1">
    
        <tr>
            <th>Tour_ID</th>
            <th>Tour_name</th>
            <th>image</th>
            <th>Intro</th>
            <th>Description</th>
            <th>Number_date</th>
            <th>Price</th>
            <th>cate_id</th>
            <th>
                <a href="add.php">ADD</a>
            </th>
        </tr>

        <?php foreach($tours as $tour) : ?>
            <tr>
                <td><?=$tour['tour_id'] ?></td>
                <td><?=$tour['tour_name'] ?></td>
                <td> <img src="images/<?= $tour['image'] ?>" width="100px" alt=""> </td>
                <td><?=$tour['intro'] ?></td>
                <td><?=$tour['description'] ?></td>
                <td><?=$tour['number_date'] ?></td>
                <td><?=$tour['price'] ?></td>
                <td><?= $tour['cate_id'] ?></td>
                <td>
                    <a href="edit.php?tour_id=<?=$tour['tour_id'] ?>">Sửa</a>
                    <a onclick="return confirm('Bạn có muốn xóa không?')" href="delete.php?tour_id=<?=$tour['tour_id'] ?>">Xóa</a>
                </td>
            </tr>
                
        <?php endforeach?>
    </table>
</body>
</html>