<?php
namespace Model;
use Minutes\Paginator;
use Minutes\Db\Table;
use Minutes\Db\Where;
use Minutes\Application;
class Post extends Table
{
    public function __construct() {
        parent::__construct(Application::getInstance()->getDb());
        $this->tableName = 'post';
        $this->columns = array('id', 'title', 'text', 'date', 'rating', 'visible', 'author_id', 'views');
    }
    
    public function addPost($data) {
        $this->insert($data);
    }
    public function getPostById($id) {
        $criteria = new Where(array('id' => $id));
        $res = $this->findBy('*', $criteria);
        if (isset($res[0])) {
            return $res[0];
        }
        return false;
    }
    public function getTitles(Paginator $paginator = null) {
        $q = "SELECT id, title, date, visible FROM post";
        $q .= ' ORDER BY date DESC';
        if ($paginator) {
            $offset = $paginator->getPageOffset();
            $itemsPerPage = $paginator->getItemsPerPage();
            $q .= ' LIMIT ' . $offset . ', ' . $itemsPerPage;
        }
        return $this->adapter->query($q)->fetchAll();
    }
    
    public function getPreviews(Paginator $paginator = null) {
        $criteria = new Where(array('visible' => 1));
        $criteria->setOrder('date', 'DESC');
        if ($paginator) {
            $offset = $paginator->getPageOffset();
            $itemsPerPage = $paginator->getItemsPerPage();
            $criteria->setLimit($offset, $itemsPerPage);
        }
        return $this->findBy(array('id', 'title', "CONCAT(SUBSTRING(text, 1, 600), '...') as text", 'date', 'views'), $criteria);
    }
    public function countVisible() {
        $q = 'SELECT count(*) FROM ' . $this->tableName . ' WHERE visible=1';
        $res = $this->adapter->query($q)->fetch();
        return $res['count(*)'];
    }
    public function updatePost($data, $id) {
        $criteria = new Where(array('id' => $id));
        $this->update($data, $criteria);
    }
    public function deletePost($id) {
        $criteria = new Where(array('id' => $id));
        $this->delete($criteria);
    }
    public function addViews($id, $num = 1) {
        $q = 'UPDATE post SET views = views + ' . (int)$num . ' WHERE id = ' . (int)$id;
        $this->adapter->query($q);
    }
    public function createTable() {
        $q = 'CREATE TABLE post ' .
                '(id INT UNSIGNED NOT NULL AUTO_INCREMENT, ' .
                'title VARCHAR(100), ' .
                'text TEXT, ' .
                'date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, ' .
                'rating TINYINT NOT NULL DEFAULT 0, ' .
                'visible INT(1) NOT NULL DEFAULT 0, ' .
                'author_id INT UNSIGNED NOT NULL, ' .
                'views INT UNSIGNED NOT NULL, ' .
                'PRIMARY KEY(id)) CHARACTER SET utf8';
        $this->adapter->query($q);
    }
}
