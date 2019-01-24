<?php
require_once 'ConnectionMethods.php'; 

class Verify extends ConnectionMethods {

    public function connectionUser($user_mail, $user_password) {
        $this->startConnection();

        $req = $this->connection->prepare('SELECT *
        FROM user 
        WHERE user_mail = :user_mail
        AND user_password = :user_password');

        $req->bindParam(':user_mail', $user_mail);
        $req->bindParam(':user_password', $user_password);
        $req->execute();

        $result = $req->fetch();

        $this->endConnection();
        return $result;
    }

}

//------------------------ Verify Post --------------------------------

session_start();

if(isset($_POST['connection'])) {
    $user_mail = $_POST['user_mail'];
    $user_password = $_POST['user_password'];
    $verif = new Verify;
    $result = $verif->connectionUser($user_mail, $user_password);
    if($verif = null){
        header('Location:../index.php?info=1');
        exit;
    }else {
        if ($_POST['auth']) {
            setcookie("user_mail", $result['user_mail'], time() + 365*24*3600, "/");
            setcookie("user_password", $result['user_password'], time() + 365*24*3600, "/");

            $_COOKIE['user_mail'] = $result['user_mail'];
            $_COOKIE['user_password'] = $result['user_password'];
        }
        $_SESSION['user_mail'] = $result['user_mail'];
        $_SESSION['user_password'] = $result['user_password'];
        $_SESSION['user_isAdmin'] = $result['user_isAdmin'];
        $_SESSION['user_uid'] = $result['user_uid'];
        $_SESSION['user_name'] = $result['user_name'];

        header('Location: ../connect.php');
    }
} 

//------------------------ Verify Session --------------------------------

if(isset($_COOKIE['user_mail']) && isset($_COOKIE['user_password'])) {
    $_SESSION['user_mail'] = $_COOKIE['user_mail'];
    $_SESSION['user_password'] = $_COOKIE['user_password'];
} else {
    if(isset($_SESSION['user_mail']) && isset($_SESSION['user_password'])) {
        $verif = new Verify;
        $result = $verif->connectionUser($_SESSION['user_mail'], $_SESSION['user_password']);
        if($verif = null){
            header('Location:../index.php?info=1');
        } else {
            $_SESSION['user_mail'] = $result['user_mail'];
            $_SESSION['user_password'] = $result['user_password'];
            $_SESSION['user_isAdmin'] = $result['user_isAdmin'];
            $_SESSION['user_name'] = $result['user_name'];
        }
    } else {
        header('Location:../index.php?info=1');
    }
}

//------------------------ Deconnection --------------------------------

if (isset($_GET['deco'])){
    session_destroy();
    setcookie("user_mail", "", time() - 365*24*3600, "/");
    setcookie("user_password", "", time() - 365*24*3600, "/");
    header('Location:../index.php?info=2');
}

?>