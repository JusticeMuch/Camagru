<?php
function change_password($username, $old_pw, $new_pw)
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
    $sql = "SELECT * FROM users WHERE username='$username' AND password='$old_pw'";
    try {
        $conn->query($sql);
    }
    catch (PDOException $e)
    {
        return (0);
    }
    $sql1 = "UPDATE users SET password='$new_pw' WHERE username='$username' ";
    try {
        $ex = $conn->prepare($sql1);
        $ex->execute();
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
        return (0);
    }
    $conn = null;
    return (1);
}
?>