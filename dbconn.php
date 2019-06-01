<?php
$pdo = new PDO('pgsql:host=localhost;port=5432;dbname=mydb', 'postgres', 'Gfhjkm0021');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
if (!$pdo)
{
die("Не могу приконнектится к серверу баз данных!!!");
}