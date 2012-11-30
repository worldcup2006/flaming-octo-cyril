<?php
namespace Controller;
use Minutes\Application;
use Minutes\Controller;
use Minutes\Auth;
use Minutes\Paginator;
use Model\User;
use Model\Post;
use Minutes\Validator\Numeric;
use Model\SampleForm;
use Minutes\Captcha\Kcaptcha;
use Model\Comment;
use Model\FormComment;
use Model\Tag;
class IndexController extends Controller
{
    public function actionIndex() {
        $modelPost = new Post();        
        $pg = new Paginator($modelPost->countVisible(), 2);
        $currPage = 1;
        if (isset($this->params['page'])) {
            $validator = new Numeric(array(Numeric::POSITIVE, Numeric::NOT_ZERO));
            if ($validator->isValid($this->params['page']) && $pg->isValidPage($this->params['page'])) {
                $currPage = $this->params['page'];
            } else {
                $this->notFound();
            }
        }
        $pg->setCurrPage($currPage);
        $posts = $modelPost->getPreviews($pg);
        $this->render('index', array('posts' => $posts, 'paginator' => $pg));
    }
    public function actionShow() {
        
        if (isset($this->params['id'])) {
            $id = $this->params['id'];
            $modelPost = new Post();
            $validator = new Numeric(array(Numeric::POSITIVE, Numeric::NOT_ZERO));
            if ($validator->isValid($id) && $post = $modelPost->getPostById($id)) {
                //tags
                $modelTag = new Tag();
                $tags = $modelTag->getTags($id);
                //comments
                $modelComment = new Comment();
                $form = new FormComment();                    
                if ($this->isPost()) {
                    $res = $form->filter($_POST);
                    if ($form->isValid($res)) {
                        $modelComment->insert(array('postid' => $id, 'text' => $res['text'], 'author' => $res['author']));
                    }
                }
                $comments = $modelComment->getComments($id);
                
                $modelPost->addViews($id);
                $this->render('show', array('post' => $post, 'comments' => $comments, 'form' => $form, 'tags' => $tags));
            } else {
                $this->notFound();
            }
        } else {
            $this->notFound();
        }
    }
    public function actionTest() {
        $modelTag = new Tag();
        $modelTag->setTags(array('PHP'), 4);
        /*
         * Form test
        form = new SampleForm();
        $message = '';
        if ($this->isPost()) {
            var_dump($_POST);
            echo '<hr/>';
            var_dump($res = $form->filter($_POST));
            echo '<hr/>';
            var_dump($form->isValid($res));
            $res = $form->filter($_POST);
            if ($form->isValid($res)) {
                $message = 'Success';
                $this->redirect($this->createUrl('index', 'index'));
            } else {
                $message = 'Error';
                $form->populate($_POST);
            }
        }
        $this->render('test', array('form' => $form, 'message' => $message));*/
        
        
        /*
         * Validator test
         *
        $val = new Numeric(array(Numeric::POSITIVE, Numeric::NOT_ZERO));
        var_dump($val->isValid(0));
        var_dump(is_null(0));
        */
        //echo $this->createUrl(null, null, array('page' => 'b'), 'posts') . '<br/>';        
        /*
         * Paginator test
        $pg = new Paginator(123, 7);
        for ($i = 1; $i <= $pg->getCountPages(); $i++) {
            echo ($pg->getPageOffset($i));
            echo '<hr/>';
        } 
         * 
         */       
    }
    public function actionTest2() {
        print_r($_SESSION);
    }
}
