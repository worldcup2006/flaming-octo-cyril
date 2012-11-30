<?php
namespace Model;
use Minutes\Paginator;
use Minutes\Db\Table;
use Minutes\Db\Where;
use Minutes\Application;
class Comment extends Table
{
    public function __construct() {
        parent::__construct(Application::getInstance()->getDb());
        $this->tableName = 'comment';
        $this->columns = array('id', 'postid', 'text', 'date', 'rating', 'visible', 'author');
    }
    
    
    public function getComments($postId) {
        $criteria = new Where(array('visible' => 1, 'postid' => $postId));
        return $this->findBy(array('id', 'text', 'date', 'rating', 'author'), $criteria);
    }
    public function createTable() {
        $q = 'CREATE TABLE comment ' .
                '(id INT UNSIGNED NOT NULL AUTO_INCREMENT, ' .
                'postid INT UNSIGNED NOT NULL, ' .
                'text TEXT, ' .
                'date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, ' .
                'rating TINYINT NOT NULL DEFAULT 0, ' .
                'visible TINYINT NOT NULL DEFAULT 1, ' .
                'author VARCHAR(30) NOT NULL, ' .
                'PRIMARY KEY(id)) CHARACTER SET utf8';
        $this->adapter->query($q);
    }
}
