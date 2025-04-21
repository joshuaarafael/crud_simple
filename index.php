<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
include 'config.php';

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $conn->query("INSERT INTO items (name) VALUES ('$name')");
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM items WHERE id=$id");
}

$items = $conn->query("SELECT * FROM items");
?>
<!DOCTYPE html>
<html>
<head>
    <title>CRUD Sederhana</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Data Items</h2>
    <form method="POST" class="mb-3">
        <div class="input-group">
            <input type="text" name="name" class="form-control" placeholder="Nama item" required>
            <button type="submit" name="add" class="btn btn-success">Tambah</button>
        </div>
    </form>
    <table class="table table-bordered">
        <tr><th>No</th><th>Nama</th><th>Aksi</th></tr>
        <?php $no = 1; while($row = $items->fetch_assoc()): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $row['name'] ?></td>
            <td><a href="?delete=<?= $row['id'] ?>" onclick="return confirm('Hapus item ini?')" class="btn btn-danger btn-sm">Hapus</a></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="logout.php" class="btn btn-secondary">Logout</a>
</body>
</html>
