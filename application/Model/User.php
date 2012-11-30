<?php
namespace Model;
use Minutes\Db\Where;
use Minutes\Db\Table;
use Minutes\Application;
use Minutes\Crypt;
use Minutes\IAuthUserModel;
class User extends Table implements IAuthUserModel
{
    public function __construct() {
        parent::__construct(Application::getInstance()->getDb());
        $this->tableName = 'user';
        $this->columns = array('id', 'login', 'password', 'role', 'sessid');
    }
    public function addUser($login, $pass) {
        $this->insert(array('login' => $login, 'password' => Crypt::getHash($pass), 'role' => 'user'));
    }
    public function checkCredentials($login, $pass) {
        $where = new Where(array('login' => $login, 'password' => Crypt::getHash($pass)));
        $res = $this->findBy(array('id', 'login', 'role'), $where);
        if (isset($res[0])) {
            return $res[0];
        }
        return false;
    }
    public function checkSessId($userId, $sessId) {
        $where = new Where(array('id' => $userId, 'sessid' => $sessId));
        $res = $this->findBy('id', $where);
        if (isset($res[0])) {
            return true;
        }
        return false;
    }
    public function setSessId($userId, $sessId) {
        $where = new Where(array('id' => $userId));
        $this->update(array('sessid' => $sessId), $where);
    }
    public function createTable() {
        $q = 'CREATE TABLE user ' .
                '(id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, ' .
                'login VARCHAR(40), ' .
                'password VARCHAR(40), ' .
                'role VARCHAR(40), ' .
                'sessid VARCHAR(40))';
        $this->adapter->query($q);
    }
    
}
