<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang</title>
    <style>
       <style>
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(135deg, #007bff, #0056b3);
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
    }

    .container {
        text-align: center;
        background-color: #ffffff;
        padding: 30px;
        border-radius: 12px;
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        max-width: 400px;
        width: 100%;
        animation: fadeIn 0.5s ease-in-out;
    }

    h1 {
        color: #343a40;
        font-size: 26px;
        margin-bottom: 20px;
        font-weight: bold;
    }

    p {
        font-size: 16px;
        color: #6c757d;
    }

    a {
        display: inline-block;
        margin-top: 20px;
        padding: 10px 20px;
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: #ffffff;
        text-decoration: none;
        border-radius: 8px;
        font-size: 16px;
        font-weight: bold;
        transition: transform 0.2s, box-shadow 0.3s ease;
    }

    a:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0, 0,)
    }
    </style>
</head>
<body>
    <div class="container">
        <h1>Selamat Datang!</h1>
        <p>Anda berhasil masuk ke sistem.</p>
        <a href="profile.php">Logout</a>
    </div>
</body>
</html>