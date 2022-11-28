<?php

namespace Team\Projectbuilder\Core;

class Model
{
    private static $dsn = 'mysql:dbname=projectbuilder;host=localhost';
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
    }

    private static function clear()
    {
        $return[] = ':id';
        if (isset($_GET['insert'])) {
            $return[]['id'] = null;
        }
        foreach ($_POST as $key => $value) {
            $return[0] .= ',:' . $key;
            $return[1][$key] = htmlspecialchars($value);
        }
        return $return;
    }

    public static function create()
    {
        $vars = self::clear();
        $sql = 'insert into ' . self::getClass() . " values(" . $vars[0] . ")";
        return self::getInstance()
            ->prepare($sql)
            ->execute($vars[1]);
    }
}
