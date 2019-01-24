<?php
    class Connection{

        private static $instance = null;

        const USER = "db105054";
        const PASSWORD = "a9a2f15ad1f8641bbf1a55a14d020c581ca519ef82ed99ef99af93c1a74f3818";
        const DNS = 'mysql:host=db343039-aventure.sql-pro.online.net;dbname=db343039_aventure';

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
?>
