<?php

class Config
{
    public function connect()
    {
        $conn = new PDO("mysql:host=localhost; dbname=message_realtime", "root", "");
        return $conn;
    }
}
