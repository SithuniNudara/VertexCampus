<?php 



class DataBase{

    public static $connection;

    public static function setUpConnection(){

        
        if (!isset(DataBase::$connection)) {
            DataBase::$connection = new mysqli("localhost","root","1234","vertex","3306");
        }

    }
    public static function iud($q){
        DataBase::setUpConnection();
        DataBase::$connection->query($q);
    }

    public static function search($q){
        DataBase::setUpConnection();
        $resultset =  DataBase::$connection->query($q);
        return $resultset;
    }


}

?>