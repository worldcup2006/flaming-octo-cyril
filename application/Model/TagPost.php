<?php
namespace Model;
use Minutes\Db\Table;
use Minutes\Db\Where;
use Minutes\Application;
class TagPost extends Table
{
    public function __construct() {
        parent::__construct(Application::getInstance()->getDb());
        $this->tableName = 'tag_post';
        $this->columns = array('id', 'tag_id', 'post_id');
    }

    public function createTable() {
        $q = 'CREATE TABLE IF NOT EXISTS tag_post ' .
                '(tag_id INT UNSIGNED NOT NULL, ' .
                'post_id INT UNSIGNED NOT NULL) ' .
                'CHARACTER SET utf8';
        $this->adapter->query($q);
    }
}
