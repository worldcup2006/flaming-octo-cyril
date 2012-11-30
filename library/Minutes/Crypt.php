<?php
namespace Minutes;
class Crypt
{
    public static function getHash($value) {
        return sha1($value);
    }
}
