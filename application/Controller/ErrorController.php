<?php
namespace Controller;
use Minutes\Controller;
class ErrorController extends Controller
{
    public function actionNotFound() {
        $this->render('notfound');
    }
}
