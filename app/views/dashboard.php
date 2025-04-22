<?php
session_start();

if(!$_SESSION['user_id']) {
    header('Location: index.php?action=login');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h1>Hello <?= $_SESSION['username']?></h1>

    <form action=""></form>

    <table class="orders" border="1">
        <thead>
            <th>order_id</th>
            <th>user_id</th>
            <th>price</th>
            <th>order_type</th>
            <th>wash_mats</th>
            <th>at_created</th>
        </thead>
        <tbody>
            <?php foreach($results as $result): ?>
                <tr>
                    <td><?= htmlspecialchars($result['order_id']) ?></td>
                    <td><?= htmlspecialchars($result['user_id']) ?></td>
                    <td><?= htmlspecialchars($result['price']) ?></td>
                    <td><?= htmlspecialchars($result['order_type']) ?></td>
                    <td><?= htmlspecialchars($result['wash_mats']) ?></td>
                    <td><?= htmlspecialchars($result['at_created']) ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <button type=""><a href="index.php?action=exit">Выход</a></button>
</body>
</html>