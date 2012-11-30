<?php
namespace Model;
use Minutes\AForm;
use Minutes\Form\InputElement;
use Minutes\Form\TextElement;
use Minutes\Form\TextareaElement;
use Minutes\Form\CheckboxElement;
use Minutes\Validator\NotEmpty;
use Minutes\Filter\Trim;
use Minutes\Filter\Bool;
class FormAddPost extends AForm
{
    public function __construct() {
        $this->atributes = array('method' => 'post');
        
        $title = new TextElement(array('name' => 'title'));
        $title->addValidator(new NotEmpty());
        $title->addFilter(new Trim());
        $this->elements['title'] = $title;

        $tags = new TextElement(array('name' => 'tags'));
        $tags->addValidator(new NotEmpty());
        $tags->addFilter(new Trim());
        $this->elements['title'] = $tags;
        
        $text = new TextareaElement(array('name' => 'text'));
        $text->addFilter(new Trim());
        $text->addValidator(new NotEmpty());
        $this->elements['text'] = $text;
        
        $visible = new CheckboxElement(array('name' => 'visible'));
        $visible->addFilter(new Bool());
        $this->elements['visible'] = $visible;
        
        $this->elements['submit'] = new InputElement(array('type' => 'submit', 'value' => 'Add', 'name' => 'submit'));
    }
}
