<?php
require './config/db.php';

// Mendapatkan ID produk dari parameter URL
$id = $_GET['id'];

// Ambil data produk berdasarkan ID
$product = mysqli_query($db_connect, "SELECT * FROM products WHERE id = $id");
$row = mysqli_fetch_assoc($product);

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $newImage = $_FILES['image']['name'];
    $tempImage = $_FILES['image']['tmp_name'];

    if ($newImage) {
        // Proses upload gambar baru
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        $fileExtension = strtolower(pathinfo($newImage, PATHINFO_EXTENSION));

        if (!in_array($fileExtension, $allowedExtensions)) {
            echo "Format file tidak valid. Hanya JPG, JPEG, PNG, dan GIF yang diperbolehkan.";
            die;
        }

        $randomFilename = time() . '-' . md5(rand()) . '.' . $fileExtension;
        $uploadPath = $_SERVER['DOCUMENT_ROOT'] . '/pertemuan-6/upload/' . $randomFilename;

        // Hapus gambar lama jika ada
        if (!empty($row['image']) && file_exists($_SERVER['DOCUMENT_ROOT'] . $row['image'])) {
            unlink($_SERVER['DOCUMENT_ROOT'] . $row['image']);
        }

        move_uploaded_file($tempImage, $uploadPath);
        $imagePath = '../upload/' . $randomFilename; // Path gambar baru
    } else {
        $imagePath = $row['image']; // Gunakan gambar lama jika tidak ada input baru
    }

    // Update data produk di database
    mysqli_query($db_connect, "UPDATE products SET name='$name', price='$price', image='$imagePath' WHERE id=$id");

    // Redirect ke halaman data produk
    header("Location: index.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }

        h1 {
            font-size: 24px;
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            font-size: 14px;
            font-weight: bold;
            color: #555;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"], input[type="file"] {
            width: calc(100% - 20px);
            padding: 8px 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            color: #333;
        }

        button {
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        a {
            display: inline-block;
            margin-top: 10px;
            color: #007bff;
            text-decoration: none;
            text-align: center;
            font-size: 14px;
            width: 100%;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Edit Produk</h1>
    <form method="post" enctype="multipart/form-data">
        <label>Nama Produk:</label>
        <input type="text" name="name" value="<?= $row['name']; ?>" required><br><br>

        <label>Harga:</label>
        <input type="text" name="price" value="<?= $row['price']; ?>" required><br><br>

        <label>Gambar Baru:</label>
        <input type="file" name="image"><br>
        <small>* Biarkan kosong jika tidak ingin mengubah gambar</small><br><br>

        <button type="submit" name="update">Update</button>
    </form>
    <a href="index.php">Kembali ke Data Produk</a>
</body>
</html>
