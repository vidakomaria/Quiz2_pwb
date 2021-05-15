<?php
require "config.php";
$message = "";
$warning = "";
session_start();

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    if (strlen($username) == 0) {
        $warning = "Username kosong!";
    } elseif (strlen($password) == 0) {
        $warning = "Password kosong!";
    } else {
        $data = "INSERT INTO login (username, password) VALUES (:username, :password)";
        $statement = $connection->prepare($data);
        $statement->execute([":username" => $username, ":password" => $password]);
        $message = "Data berhasil ditambah";
        $_SESSION["username"] = $username;
        $_SESSION["password"] = $password;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Register</title>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>REGISTER</h1>
            </div>
            <div class="card-body">
                <div>
                    <?php if (!empty($message)) { ?>
                    <div class="alert alert-success">
                        <?= $message ?>
                    </div>
                    <?php
                    }
                    if (!empty($warning)) {
                    ?>
                    <div class="alert alert-warning">
                        <?= $warning ?>
                    </div>
                    <?php
                    }
                    ?>
                </div>

                <div>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="username">Username</label>
                            <input type="text" name="username" id="username" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-success">Register</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>

</html>

<?php require "footer.php" ?>