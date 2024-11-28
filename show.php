<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f8f9fa;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        a:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <h1>Data Produk</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Gambar Produk</th>
                <th>Opsi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            require './config/db.php';

            $products = mysqli_query($db_connect, "SELECT * FROM products");

            if (!$products) {
                echo "<tr><td colspan='5'>Gagal memuat data produk.</td></tr>";
            } else {
                $no = 1;
                while ($row = mysqli_fetch_assoc($products)) {
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($no++); ?></td>
                        <td><?= htmlspecialchars($row['name']); ?></td>
                        <td>Rp <?= number_format($row['price'], 0, ',', '.'); ?></td>
                        <td>
                            <?php if (!empty($row['image'])) { ?>
                                <a href="<?= htmlspecialchars($row['image']); ?>" target="_blank">Unduh</a>
                            <?php } else { ?>
                                Tidak ada gambar
                            <?php } ?>
                        </td>
                        <td>
                            <a href="edit.php?id=<?= htmlspecialchars($row['id']); ?>">Edit</a> | 
                            <a href="delete.php?id=<?= htmlspecialchars($row['id']); ?>" onclick="return confirm('Yakin ingin menghapus produk ini?');">Hapus</a>
                        </td>
                    </tr>
                <?php }
            } ?>
        </tbody>
    </table>
</body>
</html>
