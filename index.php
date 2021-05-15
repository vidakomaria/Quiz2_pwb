<?php
require "config.php";

require "header.php";

$message = "";
$warning = "";

if (isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    if (strlen($username) == 0) {
        $warning = "Username kosong!";
    } elseif (strlen($password) == 0) {
        $warning = "Password kosong!";
    } else {
        $hasil = False;
        $data = "SELECT * FROM login WHERE username=:username AND password=:password";
        $statement = $connection->prepare($data);
        if ($statement->execute([":username" => $username, ":password" => $password])) {
            $akun = $statement->fetchAll(PDO::FETCH_OBJ);
            foreach ($akun as $item) {
                $hasilUsername = $item->username;
                $hasilPw = $item->password;
                $benar = "Login Berhasil";
                $hasil = True;
                setcookie("username", $hasilUsername, time() + (86400 * 3), "/");
                setcookie("password", $hasilPw, time() + (86400 * 3), "/");
            }
        }
        if ($hasil == False) {
            $salah = "Username / Password Salah";
        }
    };
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
    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h1>LOGIN</h1>
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
                    if (!empty($benar)) { ?>
                    <div class="alert alert-success" role="alert">
                        <h4 class="alert-heading"><?= $benar ?></h4>
                        <p> <?= "Username : " . $_COOKIE['username'] ?></p>
                        <hr>
                    </div>
                    <?php
                    }
                    if (!empty($salah)) { ?>
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading"> <?= $salah ?> </h4>

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
                            <a href="register.php" class="btn btn-outline-info">Register</a>
                            <button type="submit" class="btn btn-outline-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
require "footer.php";
?>