<?php
namespace Minutes\Db;
class Mysql extends Common
{
    public function __construct($config) {
        //try {
            $this->db = new \PDO($config['dsn'], $config['username'], $config['password'], array(\PDO::ATTR_PERSISTENT => true));     //@error
            $this->db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        //} catch (\PDOException $e) {
        //    echo $e->getMessage();
        //}

        
    }
}
