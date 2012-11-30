<?php
namespace Minutes\Db;
class Where
{
    const WHERE_AND = ' AND ';
    const WHERE_OR = ' OR ';

    private $limit;
    private $order;
    private $clause = '';
    private $values = array();


    public function __construct($data, $cond = self::WHERE_AND) {
        $where = array();
        foreach ($data as $key => $val) {
            $where[] = $key . '=?';
            $this->values[] = $val;
        }
        $this->clause .= implode($cond, $where);
    }
    public function addWhere($col, $val, $cond = self::WHERE_AND) {
        $this->clause = '(' . $this->clause . ')' . $cond . $col . '=?';
        $this->values[] = $val;
    }
    public function setOrder($colName, $direction = 'ASC') {
        $this->order = ' ORDER BY ' . $colName . ' ' . $direction;
    }
    public function setLimit($offset, $numItems) {
        $this->limit = ' LIMIT ' . $offset . ', ' . $numItems;
    }
    public function getClause() {
        return ' WHERE ' . $this->clause . $this->order . $this->limit;
    }
    public function getValues() {
        return $this->values;
    }   
}
