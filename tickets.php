<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h1>Thank you for requesting <?php echo $_SESSION['taskOption']?>x</h1>
    <?php if($_SESSION['taskOption'] > 5): ?>
        <h2>Discount Price: <?php echo (count($_SESSION['names'])*2) * 0.8 ?></h2>
    <?php else: ?>
        <h2>Price: <?php echo count($_SESSION['names']) * 2 ?></h2>
    <?php endif; ?>
    <table class="table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Number</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($_SESSION['names'] as $name): ?>
            <tr>
                <td><?php echo $name?></td>
                <td><?php echo mt_rand(100000,999999)?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
   

</body>
</html>