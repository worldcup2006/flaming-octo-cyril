<?php
namespace Model;
use Minutes\Db\Table;
use Minutes\Db\Where;
use Minutes\Application;
class Tag extends Table
{
    private $tableTagPost;
    public function __construct() {
        parent::__construct(Application::getInstance()->getDb());
        $this->tableName = 'tag';
        $this->columns = array('id', 'name', 'date');
        $this->tableTagPost = new TagPost();
    }
    /*
    public function tagExists($name){
        $criteria = new Where(array('name' => $name));
        return $this->recordExists($criteria);
    }
    */
    public function getId($name){
        $criteria = new Where(array('name' => $name));
        $res = $this->findBy('id', $criteria);
        if (isset($res[0]['id'])) {
            return $res[0]['id'];
        }
        return false;        
    }
    public function addTag($name){
        return $this->insert(array('name' => $name));
    }

    public function setTags($names, $postId){
        // data for tag_post table
        $data = array('tag_id' => '', 'post_id' => $postId);
        //delete old rows... (
        $criteria = new Where(array('post_id' => $postId));
        $this->tableTagPost->delete($criteria);
        
        foreach ($names as $name) {
            $tagId = $this->getId($name);
            if (!$tagId) {
                $tagId = $this->addTag($name);
            }
            $data['tag_id'] = $tagId;
            $this->tableTagPost->insert($data);
        }        
    }
    public function getTagCount(){
        /*select tag_id ,count(*) from tag_post group by tag_id;*/
    }

    public function getTags($postId){
        $criteria = new Where(array('tag_post.post_id' => $postId));
        $q = 'SELECT tag.name FROM tag INNER JOIN tag_post ON tag.id = tag_post.tag_id';
        $q .= $criteria->getClause();
        return $this->adapter->query($q, $criteria->getValues())->fetchAll();
    }

    public function createTable() {
        $q = 'CREATE TABLE IF NOT EXISTS tag ' .
                '(id INT UNSIGNED NOT NULL AUTO_INCREMENT, ' .
                'name VARCHAR(100), ' .
                'date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, ' .
                'PRIMARY KEY(id)) CHARACTER SET utf8';
        $this->adapter->query($q);
    }
}
