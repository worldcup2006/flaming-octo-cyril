<?php
namespace Model;
use Minutes\AForm;
use Minutes\Form\InputElement;
use Minutes\Form\TextareaElement;
use Minutes\Form\TextElement;
use Minutes\Form\SelectElement;
use Minutes\Form\CheckboxElement;
use Minutes\Form\RadioElement;
use Minutes\Form\CaptchaElement;
use Minutes\Validator\Captcha;
use Minutes\Validator\Numeric;
use Minutes\Validator\NotEmpty;
use Minutes\Filter\Trim;
use Minutes\Filter\Bool;
use Minutes\Validator\Enum;
use Minutes\Controller;
class SampleForm extends AForm
{
    public function __construct() {
        $this->atributes = array('method' => 'post');
        
        $title = new TextElement(array('name' => 'title'));
        //$title->addValidator(new Numeric(Numeric::NOT_ZERO));
        $title->addValidator(new NotEmpty());
        $title->addFilter(new Trim());
        //$title->setValue('bro');
        $this->elements['title'] = $title;
        
        $checkBox1 = new CheckboxElement(array('name' => "checkbox1", 'value' => "foo"));
        $checkBox1->addFilter(new Bool());
        $this->elements['checkbox1'] = $checkBox1;
        $checkBox2 = new CheckboxElement(array('name' => "checkbox2", 'value' => "bar"));
        //$checkBox2->setValue(1);
        $this->elements['checkbox2'] = $checkBox2;
        
        $radio1 = new RadioElement(array('name' => 'radio1', 'value' => "foo"));
        $radio1->addValidator(new Enum(array(), array('enum' => array('foo', 'bar'))));
        $this->elements['radio1'] = $radio1;
        $radio2 = new RadioElement(array('name' => 'radio1', 'value' => "bar"));
        $this->elements['radio2'] = $radio2;
        
        $text = new TextareaElement(array('name' => 'text'));
        $text->addFilter(new Trim());
        $text->addValidator(new NotEmpty());
        //$text->addValidator(new Enum(array(), array('enum' => array('bro', 'lol'))));
        $this->elements['text'] = $text;
        
        /*$radio3 = new RadioElement(array('name' => 'radio2', 'value' => "foo"));
        $radio3->addValidator(new Enum(array(), array('enum' => array('foo', 'bar'))));
        $this->elements['radio3'] = $radio3;
        $radio4 = new RadioElement(array('name' => 'radio2', 'value' => "bar"));
        $this->elements['radio4'] = $radio4;*/
        
        $select = new SelectElement(array('name' => 'select1', 'options' => array('one' => 1, 'two' => 2, 'three' => 3)));
        $this->elements['select'] = $select;
        
        $controller = new Controller();
        $captcha = new CaptchaElement(array('imgSrc' => $controller->createUrl('captcha', 'index')));
        $this->elements['captcha'] = $captcha;
        
        $captchakey = new TextElement(array('name' => 'captchakey'));
        $captchakey->addValidator(new Captcha());
        $captchakey->addValidator(new NotEmpty());
        $captchakey->addFilter(new Trim());
        $this->elements['captchakey'] = $captchakey;
        
        $this->elements['submit'] = new InputElement(array('type' => 'submit', 'value' => 'Go', 'name' => 'submit'));
    }
}
