<?php 
    require_once "connection.php";

    if(isset($_POST['btn_save'])){
        $tour_name = $_POST['ph22361_exampp'];
        $intro = $_POST['intro'];
        $description = $_POST['description'];
        $number_date = $_POST['number_date'];
        $price = $_POST['price'];
        $cate_id = $_POST['cate_id'];

        $file = $_FILES['image'];
        $image = $file['name'];
        $errors = [];

        if($file['size'] > 0){
            $ext = pathinfo($image, PATHINFO_EXTENSION);
            if($ext != 'png' && $ext != 'jpg'){
                $errors['image'] = "Bạn cần chọn file ảnh";
            }elseif($file['size'] >= 2*1024*1024){
                $errors['image'] = "File vượt quá 2MB";
            }
        }

        if($number_date <= 0){
            $errors['number_date'] = "Bạn cần nhập số dương";
        }

        if($price <= 0){
            $errors['price'] = "Bạn cần nhập số dương";
        }

        if(!$errors){
            $sql = "INSERT INTO tours(tour_id, tour_name, image, intro, description, number_date, price, cate_id)
             VALUES('$tour_id', '$tour_name', '$image', '$intro', '$description', '$number_date', '$price', '$cate_id')";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            move_uploaded_file($file['tmp_name'], 'images/' . $file['name']);
            setcookie("sucsess", "Thêm dữ liệu thành công", time() + 1);
            header("location: index.php");
            exit;
        }
    }
    $sql = "SELECT * FROM categories";
        $stmt = $conn -> prepare($sql);
        $stmt -> execute();
        $casi = $stmt -> fetchAll(PDO::FETCH_ASSOC);
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
    <h1>ADD</h1>
    <a href="index.php">Quay lại</a>
    <form action="" method="post" enctype="multipart/form-data">
        Tour_name<input type="text" name="tour_name" id=""><br>

        Ảnh <input type="file" name="image" id="">
        <span style="color:red;">
        <?= isset($errors['image']) ? $errors['image'] : '' ?>
        </span>
        <br>
        Intro <textarea name="intro" id="" cols="20" rows="5"></textarea><br>

        Description <textarea name="description" id="" cols="20" rows="5"></textarea><br>

        Number_date <input type="number" name="number_date" id="">
        <span style="color:red">
        <?= isset($errors['number_date']) ? $errors['number_date'] : '' ?></span>
        
        <br>

        Price <input type="number" name="price" id="">
        <span style="color:red">
        <?= isset($errors['price']) ? $errors['price'] : '' ?></span>
        <br>
        
    id_casi:
    <select name="cate_id">
            <?php foreach ($categories as $cate) : ?>
                <option value="<?= $cate['cate_id'] ?>">
                    <?= $cate['cate_name'] ?>
                </option>
            <?php endforeach ?>
        </select>
        <br>
   

    <button type="submit" name="btn_save">Lưu</button>
    </form>
</body>
</html>