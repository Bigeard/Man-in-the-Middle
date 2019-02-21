<?php
    class Connection{

        private static $instance = null;

        const USER = "root";
        const PASSWORD = "nuggets";
        const DNS = 'mysql:host=localhost;dbname=mastoodon';

        public static function startConnection(){
            try{
                self::$instance = new PDO(self::DNS, self::USER, self::PASSWORD,  array( PDO::ATTR_TIMEOUT => 100, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$instance->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
                self::$instance->query("SET NAMES UTF8");
                return self::$instance;
            
            }catch (PDOException $e){
                die($e->getMessage());
                echo $e;
                header('Location:../index.php');
                return null;
            }
        }

        public static function endConnection(){
            self::$instance = null;
        }
    }


    // ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
    // ░░░░░░░░░░░░░░░▄░░░░░░░░░░░░░░░░▄░░░░░░░░░░
    // ░░░░░░░░░░░░░░▌▒█░░░░░░░░░░░░░▄▀▒▌░░░░░░░░░
    // ░░░░░░░░░░░░░░▌▒▒█░░░░░░░░░░▄▀▒▒▒▐░░░░░░░░░
    // ░░░░░░░░░░░░░▐▄▀▒▒▀▀▀▀▄▄▄▄▄▀▒▒▒▒▒▐░░░░░░░░░
    // ░░░░░░░░░░░▄▄▀▒░▒▒▒▒▒▒▒▒▒▒▒█▒▒▄█▒▐░░░░░░░░░
    // ░░░░░░░░░▄▀▒▒▒░░░▒▒▒░░░▒▒▒▒▒▀██▀▒▌░░░░░░░░░
    // ░░░░░░░░▐▒▒▒▄▄▒▒▒▒░░░▒▒▒▒▒▒▒▒▒▀▄▒▒▌░░░░░░░░
    // ░░░░░░░░▌░░██▀▒▒▒▒▒▄██▄▒▒▒▒▒▒▒▒▒█▒▐░░░░░░░░
    // ░░░░░░░▐░░░▒▒▒▒▒▒▒▒██  ▒▒▒▒░░░▒▒▒▀▄▌░░░░░░░
    // ░░░░░░░▌░▒▄██▄▒▒▒▒▒▒▒▒▒░░░░░░░░▒▒▒▒▌░░░░░░░
    // ░░░░░░▀▒▀▐▄█▄█▌▄░▀▒▒░░░░░░░░░░░░▒▒▒▐░░░░░░░
    // ░░░░░░▐▒▒▐▀▐▀▒░▄▄▒▄▒▒▒▒▒▒▒▒░▒░▒░▒▒▒▒▌░░░░░░
    // ░░░░░░▐▒▒▒▀▀▄▄▒▒▒▄▒▒▒▒▒▒▒▒▒▒░▒░▒░▒▒▐░░░░░░░
    // ░░░░░░░▌▒▒▒▒▒▒▀▀▀▒▒▒▒▒▒░▒░▒░▒░▒░▒▒▒▌░░░░░░░
    // ░░░░░░░▐▒▒▒▒▒▒▒▒▒▒▒▒▒▒░▒░▒░▒░▒▒▄▒▒▐░░░░░░░░
    // ░░░░░░░░▀▄▒▒▒▒▒▒▒▒▒▒▒░▒░▒░▒░▒▄▒▒▒▒▌░░░░░░░░
    // ░░░░░░░░░░▀▄▒▒▒▒▒▒▒▒▒▒▄▄▄▄▄▀▒▒▒▒▄▀░░░░░░░░░
    // ░░░░░░░░░░░░▀▄▄▄▄▄▄▀▀▀▒▒▒▒▒▒▒▄▄▀░░░░░░░░░░░
    // ░░░░░░░░░░░░░░░▒▒▒▒▒▒▒▒▒▒▒▒▀▀░░░░░░░░░░░░░░
    // ░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░░
?>


