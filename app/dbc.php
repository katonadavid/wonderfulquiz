<?php
// PDO osztály
    class Database {
        private $host = DB_HOST;
        private $user = DB_USER;
        private $pass = DB_PASS;
        private $dbname = DB_NAME;

        private $dbc;
        private $stmt;
        private $error;

        public function __construct(){
            // DSN beállítása
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname .';charset=utf8mb4';
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );

            // PDO példányosítása
            try{
                $this->dbc = new PDO($dsn, $this->user, $this->pass, $options);
            } catch (PDOException $e){
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        // Lekérdezés előkészítése

        public function query($sql){

            $this->stmt = $this->dbc->prepare($sql);

        }

        // Változók befűzése a lekérdezésbe

        public function bind($param, $value, $type = null){

            if(is_null($type)){
                switch(true){
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                    break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                    break;
                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                    break;
                    default:
                        $type = PDO::PARAM_STR;
                }
            }

            $this->stmt->bindValue($param, $value, $type);
        }

        // Az előkészített lekérdezés futtatása
        public function execute(){
            return $this->stmt->execute();
        }

        // Eredménykészlet kinyerése

        public function resultSet(){
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        // Egyetlen rekord kinyerése az eredményből

        public function single(){
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_ASSOC);
        }

        // Eredmények számának visszaadása

        public function rowCount(){
            return $this->stmt->rowCount();
        }
    }