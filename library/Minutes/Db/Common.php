<?php
namespace Minutes\Db;
abstract class Common
{
    /*
     * param identifier
     */
    const PI = ':';
    public $db;
    
    abstract public function __construct($config);
    
    public function query($queryString, $params = array()){
        //$this->db->query("SET NAMES 'utf8'");
        $stmt = $this->db->prepare($queryString);
        /*$pattern = '/' . self::PI . '[\w]+/';
        $matches = array();
        preg_match_all($pattern, $queryString, $matches);
        foreach ($matches[0] as $value) {
            $param = $params[ltrim($value, self::PI)];
            if (isset($param)) {
                $stmt->bindValue($value, $param);
            } else {
                throw new \Exception('Query params mismatch');
            }            
        }*/
        $stmt->setFetchMode(\PDO::FETCH_ASSOC);
        $stmt->execute($params);
        return $stmt;
    }
    public function makeParam($data){
        if (is_array($data)) {
            for($i = 0;$i < count($data); $i++) {
                $data[$i] = self::PI . $data[$i];
            }
        } else {
            $data = self::PI . $data;
        }
        return $data;
    }
}
