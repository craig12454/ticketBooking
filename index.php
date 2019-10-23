<?php
session_start();

$names = [];
$nameErr = [];
$isValid = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["submitAmount"])) {
        $amount = clean($_POST["taskOption"]);
        $_SESSION['taskOption'] = $amount;


    }

    if (isset($_POST["submitNames"])) {
        for($i = 0; $i < $_SESSION['taskOption']; $i++) {
            $names[$i] = "";
            $nameErr[$i] = "";
            if (empty($_POST["name" . $i])) {
                $nameErr[$i] = "Name is required";
                $isValid = false;
            } else {
                $name = clean($_POST["name" . $i]);
                // letters and whitespace only
                if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
                    $nameErr[$i] = "Only letters and white space allowed";
                    $isValid = false;
                } else {
                    $names[$i] = clean($_POST["name" . $i]);
                }
            }
        }
        if ($isValid) {
            $_SESSION['names'] = $names;
            header("Location: tickets.php");
        }
    }
}

function clean($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function console_log($data) {
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}

function dump_log($data) {
    echo '<pre>';
    var_dump($data);
    echo '<pre>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <?php if (!isset($_POST['submitAmount']) && !isset($_POST['submitNames'])): ?>
        <h1>How many?</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form-group">
            <select name="taskOption" class="form-control">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
        </div>
            <input type="submit" name="submitAmount" value="Get Selected Values" class="btn btn-primary" />
        </form>
    <?php else: ?>
        <h2>Enter Names:</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <div class="form-group">
                <?php 
                    for($i = 0; $i < $_SESSION['taskOption']; $i++) {
                        echo '<input type="text" name="name' . $i . '" value="'. $names[$i] .'" class="form-control">';
                        if($nameErr[$i] != "") {
                            echo '<span class="alert alert-danger"> '. $nameErr[$i] .'</span>';
                        }
                    }
                ?>
            </div>
            <input type="submit" name="submitNames" value="Submit" class="btn btn-primary" />
        </form>
    <?php endif; ?>
</div>
</body>
</html>