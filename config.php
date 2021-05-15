<?php

try {
    $connection = new PDO("mysql:host=localhost;dbname=user", "root", "");
} catch (PDOException $exception) {
    print("DB Error dengan kode" . $exception->getMessage());
};