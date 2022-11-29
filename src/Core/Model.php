<?php

namespace Team\Projectbuilder\Core;

class Model
{
    private static $dsn = 'mysql:dbname=projectbuilder;host=localhost';
    private static $username = 'me';
    private static $password = '123456';
    public static $instance = NULL;

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


    public static function getAll()
    {
        $query = self::getInstance()->query('select * from ' . self::getClass());
        return $query->fetchAll(\PDO::FETCH_CLASS, get_called_class());
    }

    public static function getInstance()
    {
        if (self::$instance === NULL) {
            new Model();
        }
        return self::$instance;
    }

    public static function getById($id)
    {
        $query = self::getInstance()
            ->query('select * from ' . self::getClass() . ' where id=' . $id);
        $result = $query->fetchAll(\PDO::FETCH_CLASS, get_called_class());
        return $result[0];
    }

    private static function getClass()
    {
        $classe = get_called_class();
        $classeTab = explode('\\', $classe);
        return $classeTab[count($classeTab) - 1];
    }

    public static function deleteById($id)
    {
        $sql = "delete from ".self::getClass()." where id=".$id;
        echo "<pre>";
        var_dump($sql);
        echo "</pre>";
        $query = self::getInstance()->exec($sql);
        echo "<pre>";
        var_dump($query);
        echo "</pre>";
    }

    public static function updateById()
    {
        $sql = "update " . self::getClass() . " set ";
        foreach ($_POST as $key => $value) {
            if ($key === 'create') {
                continue;
            }
            $sql .= $key . '= :' . $key . ',';
        }
        $sql = substr($sql, 0, strlen($sql) - 1);
        $sql .= " where id=" . $_GET['update'];
        $vars = self::clear();
        return self::getInstance()->prepare($sql)->execute($vars[1]);
    }


    public static function getByAttribute($name, $value)
    {
        $query = self::getInstance()->query('select * from ' . self::getClass() . ' where ' . $name . '=' . "'" . $value . "'");
        return $query->fetchAll(\PDO::FETCH_CLASS, get_called_class());
    }

    private static function clear()
    {
        unset($_POST['create']);
        $return[] = ':id';
        if (isset($_GET['insert'])) {
            $return[]['id'] = NULL;
        }
        foreach ($_POST as $key => $value) {
            $return[0] .= ',:' . $key;
            $return[1][$key] = htmlspecialchars($value);
        }
        if (isset($_GET['idproject'])) {
            $return[0] .= ',:idProject,:idUser';
            $return[1]['idProject'] = $_GET['idproject'];
            $return[1]['idUser'] = NULL;
        }
        return $return;
    }

    public static function newEmail($mail)
    {
        $return = '';
        $users = self::getAll();
        foreach ($users as $user) {
            $userarr = (array) $user;
            foreach ($userarr as $key) {
                if ($mail === $key) {
                    $return = 'Email is already used';
                }
            }
        }
        return $return;
    }

    public static function create()
    {
        $vars = self::clear();
        $sql = 'insert into ' . self::getClass() . " values(" . $vars[0] . ")";
        return self::getInstance()->prepare($sql)->execute($vars[1]);
    }
}
