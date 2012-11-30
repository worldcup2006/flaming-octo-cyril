<?php
namespace Minutes\Db;
abstract class Table
{
    protected $adapter;
    protected $tableName;
    protected $columns;
    protected $rowCount = null;
    public function __construct(Common $adapter) {
        $this->adapter = $adapter;
    }
    
    public function findAll() {
        $q = 'SELECT * FROM ' . $this->tableName;
        return $this->adapter->query($q)->fetchAll();
    }
    public function findBy($columnNames, Where $criteria) {
        $q = 'SELECT ';
        if (is_array($columnNames)) {
            $q .= implode(', ', $columnNames);
        } else {
            $q .= $columnNames;
        }
        
        $q .= ' FROM ' . $this->tableName;
        $q .= $criteria->getClause();
        return $this->adapter->query($q, $criteria->getValues())->fetchAll();
    }
    /*
     * $data - assoc array: $key=columnName, $value=columnValue
     */
    public function insert($data) {
        $q =
            'INSERT INTO ' .
            $this->tableName .
            ' (' . implode(', ', array_keys($data)) . ') ' .
            'VALUES(';
        for ($i = 0; $i < count($data) - 1; $i++) {
            $q .= '?, ';
        }
        $q .= '?)';
        $this->adapter->query($q, array_values($data));
        /*if (1 < $argsCount = func_num_args()) {
            for($i = 1; $i <= $argsCount; $i++) {
                $data = func_get_arg($i);
                $this->adapter->query($q, array_values($data));
            }
        }*/
        return $this->adapter->db->lastInsertId();
    }
    /*
     * $criteria - assoc array: $key=columnName, $value=columnValue
     */    
    public function update($data, Where $criteria) {
        $q = 'UPDATE ' . $this->tableName . ' SET ';
        $keys = array_keys($data);
        for($i = 0;$i < count($keys); $i++) {
            $keys[$i] .= '=?';
        }
        $q .= implode(', ', $keys);
        /*$where = array();
        foreach ($criteria as $column => $value) {
            //$where[] = sprintf('%s=:%s', $column, $column);
            $where[] = $column . '=?';
        }
        $q .= ' WHERE ' . implode(' AND ', $where);*/
        $q .= $criteria->getClause();
        return $this->adapter->query($q, array_merge(array_values($data), $criteria->getValues()))->errorCode();
    }
    public function delete(Where $criteria) {
        $q = 'DELETE FROM ' . $this->tableName;
        /*
        foreach ($criteria as $column => $value) {
            $where[] = $column . '=?';
        }
         */
        $q .= $criteria->getClause();
        return $this->adapter->query($q, $criteria->getValues())->errorCode();
    }
    public function checkExistance($colName, $value) {
        $where = new Where(array($colName => $value));
        $q = 'SELECT ' . $colName . ' FROM ' . $this->tableName;
        $q .= $where->getClause();
        $res = $this->adapter->query($q, $where->getValues())->fetchAll();
        if ($res) {
            return true;
        } 
        return false;
    }
    public function getCount() {
        if (null == $this->rowCount) {
            $q = 'SELECT count(*) FROM ' . $this->tableName;
            $res = $this->adapter->query($q)->fetch();
            $this->rowCount = $res['count(*)'];
        }
        return $this->rowCount;
    }
    public function recordExists(Where $criteria){
        $res = $this->findBy('id', $criteria);
        if (isset($res[0])) {
            return true;
        }
        return false;
    }
}
