<?php
function get_user_details($username)
{
    session_start();
    $server = 'localhost';
    $u = 'root';
    $p = 'humannature';
    $db = 'camagru_jronald';
    try {
        $conn = new PDO("mysql:host=$server; dbname=$db", $u, $p);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $err)
    {
        echo "Connection Failed : ".$err->getMessage();
        return (-1);
    }
    $sql = "SELECT * FROM users WHERE username='$username' ";
    $req = $conn->prepare($sql);
    $req->execute();
    if ($req->rowCount() > 0)
        return $req->fetchAll();
    else
        return (0);
}
?>