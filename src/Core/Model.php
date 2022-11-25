<?php

namespace Team\Projectbuilder\Core;

class Model
{
    private static $dsn = 'mysql:dbname=projectbuilder;host=localhost:3308';
    private static $username = 'me';
    private static $password = '123456';
    public static $instance = null;

    private function __construct()
    {
        try {
            self::$instance = new \PDO(
                self::$dsn,
                self::$username,
                self::$password
            );
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            new Model();
        }
        return self::$instance;
    }

    private static function getClass()
    {
        $classe = get_called_class();
        $classeTab = explode('\\', $classe);
        return $classeTab[count($classeTab) - 1];
    }

    public static function getByAttribute($name, $value)
    {
        $query = self::getInstance()->query(
            'select * from ' .
                self::getClass() .
                ' where ' .
                $name .
                '=' .
                "'" .
                $value .
                "'"
        );
        return $query->fetchAll(\PDO::FETCH_CLASS, get_called_class());
    }
}
