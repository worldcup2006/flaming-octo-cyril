<?php
namespace Minutes;
interface IAuthUserModel
{
    public function checkCredentials($login, $pass);
    public function checkSessId($userId, $sessId);
    public function setSessId($userId, $sessId);
}
