<?php


    // $host = "localhost";
    // $username = "root";
    // $password = "";
    // $dbname = "brief7";

    // $cnx = new PDO("mysql:host=$host;dbname=$dbname",$username,$password);

    // if(!$cnx){
    //     die("Connection Faild");
    // }








    class database {

        private $host = "localhost";
        private $user = "root";
        private $password = "";
        private $database = "brief9";
        protected $cnx;

        public function connect(){
            $this->cnx = new PDO("mysql:host=$this->host;dbname=$this->database",$this->user,$this->password);

            if(!$this->cnx){
                die("Connection Faild");
            }else{
                return $this->cnx;
            }
        }
        



    }


?>