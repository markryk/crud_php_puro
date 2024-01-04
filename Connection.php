<?php
    class Connection {
        public static function open(){
            return mysqli_connect('localhost', 'root', '', 'db_restaurante');
        }
    }
?>