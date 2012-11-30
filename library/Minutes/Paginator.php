<?php
namespace Minutes;
class Paginator
{
    private $count;
    private $itemsPerPage;
    private $countPages;
    private $currentPage = 1;
    public function __construct($count, $itemsPerPage) {
        $this->count = $count;
        $this->itemsPerPage = $itemsPerPage;
        $this->countPages = (int)ceil($this->count / $this->itemsPerPage);
    }
    public function getPageOffset($pageNumber = null) {
        if (null == $pageNumber) {
            $pageNumber = $this->currentPage;
        }
        return $this->itemsPerPage * ($pageNumber - 1);
    }
    public function isValidPage($page) {
        if ($page > 0 && $page <= $this->countPages) {
            return true;
        }
        return false;
    }
    public function setCurrPage($page) {
        if ($this->isValidPage($page)) {
            $this->currentPage = $page;
        }
    }
    public function getCurrPage() {
        return $this->currentPage;
    }
    public function getNextPage() {
        $nextPage = $this->currentPage + 1;
        if ($this->isValidPage($nextPage)) {
            return $nextPage;
        }
        return false;
    }
    public function getPrevPage() {
        $prevPage = $this->currentPage - 1;
        if ($this->isValidPage($prevPage)) {
            return $prevPage;
        }
        return false;
    }   
    public function getCountPages() {
        return $this->countPages;
    }
    public function getItemsPerPage() {
        return $this->itemsPerPage;
    }
    /*
    public function isPrev($pageNumber) {
        if (($pageNumber - 1) > 0)  {
            return true;
        }
        return false;
    }
    public function isNext($pageNumber) {
        if (($pageNumber + 1) <= $this->countPages)  {
            return true;
        }
        return false;
    }
     */
}
