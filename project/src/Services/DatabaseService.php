<?php

namespace AskNicely\Services;

use PDO;

class DatabaseService
{
    public static function createConnection(): PDO
    {
        $host = 'db'; // docker container name
        $db   = 'homestead';
        $user = 'postgres';
        $pass = 'NoPassword@123';

        $dsn = "pgsql:host=$host;dbname=$db;user=$user;password=$pass";

        $pdo = new PDO($dsn);

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }
}