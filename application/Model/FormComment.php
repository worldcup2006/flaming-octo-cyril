<?php
namespace Model;
use Minutes\AForm;
use Minutes\Form\InputElement;
use Minutes\Form\TextElement;
use Minutes\Form\TextareaElement;
use Minutes\Form\CaptchaElement;
use Minutes\Validator\NotEmpty;
use Minutes\Validator\Captcha;
use Minutes\Filter\Trim;
use Minutes\Controller;
class FormComment extends AForm
{
    public function __construct() {
        $this->atributes = array('method' => 'post', 'class' => 'commonForm');
        
        //$id = new InputElement();
        
        $author = new TextElement(array('name' => 'author'));
        $author->addValidator(new NotEmpty());
        $author->addFilter(new Trim());
        $this->elements['author'] = $author;
              
        $text = new TextareaElement(array('name' => 'text', 'rows' => 5));
        $text->addFilter(new Trim());
        $text->addValidator(new NotEmpty());
        $this->elements['text'] = $text;
       
        $controller = new Controller();
        $captcha = new CaptchaElement(array('width' => '160px', 'height' => '80px', 'src' => $controller->createUrl('captcha', 'index')));
        $this->elements['captcha'] = $captcha;
        
        $captchakey = new TextElement(array('name' => 'captchakey'));
        $captchakey->addValidator(new Captcha());
        $captchakey->addValidator(new NotEmpty());
        $captchakey->addFilter(new Trim());
        $this->elements['captchakey'] = $captchakey;
        
        $this->elements['submit'] = new InputElement(array('type' => 'submit', 'value' => 'Добавить', 'name' => 'submit', 'class' => 'submit'));
    }
}
