<?php
namespace Controller;
use Minutes\Controller;
use Model\FormAddPost;
use Model\Post;
use Minutes\Validator\Numeric;
use Minutes\Paginator;
class SandboxController extends Controller
{
    public function actionAddpost() {
        $form = new FormAddPost();
        $message = '';
        if ($this->isPost()) {
            $res = $form->filter($_POST);
            if ($form->isValid($res)) {
                $postModel = new Post();
                $postModel->insert(array(
                    'title' => $res['title'],
                    'text' => $res['text'],
                    'visible' => $res['visible']));
                $message = 'Success';
            } else {
                $message = 'Error';
                $form->populate($res);
            }
        }
        $this->render('addpost', array('form' => $form, 'message' => $message));
    }
    public function actionEditpost() {
        if (isset($this->params['id'])) {
            $form = new FormAddPost();
            $postModel = new Post();
            $message = '';
            $id = $this->params['id'];
            $validator = new Numeric(array(Numeric::POSITIVE, Numeric::NOT_ZERO));
            if ($validator->isValid($id) && $postModel->checkExistance('id', $id)) {
                if ($this->isPost()) {
                    $res = $form->filter($_POST);
                    if ($form->isValid($res)) {
                        $postModel->updatePost(array(
                            'title' => $res['title'],
                            'text' => $res['text'],
                            'visible' => $res['visible']), $id);
                        $message = 'Success';
                    } else {
                        $message = 'Error';
                    }
                    $form->populate($res);
                } else {
                    $form->populate($postModel->getPostById($id));
                }
                $this->render('editpost', array('form' => $form, 'message' => $message));
            } else {
                $this->notFound();
            }
        }        
    }
    public function actionShowpost() {
        $modelPost = new Post();        
        $pg = new Paginator($modelPost->getCount(), 10);
        $currPage = 1;
        if (isset($this->params['page'])) {
            $page = $this->params['page'];
            $validator = new Numeric(array(Numeric::POSITIVE, Numeric::NOT_ZERO));
            if ($validator->isValid($page) && $pg->isValidPage($page)) {
                $currPage = $page;
            } else {
                $this->notFound();
            }
        }
        $pg->setCurrPage($currPage);
        $posts = $modelPost->getTitles($pg);
        $this->render('showpost', array('posts' => $posts, 'paginator' => $pg));
    }
    public function actionDeletepost() {
        if (isset($this->params['id'])) {
            $id = $this->params['id'];
            $validator = new Numeric(array(Numeric::POSITIVE, Numeric::NOT_ZERO));
            if ($validator->isValid($id)) {
                $modelPost = new Post();
                $modelPost->deletePost($id);
            }
        }
        $this->redirect($this->createUrl('sandbox', 'showpost'));
    }
}
