<?php
namespace Widget;
use Minutes\Widget;
use Model\Comment;
use Model\FormComment;
class Comments extends Widget
{
    public function __construct($data, $properties) {
        parent::__construct($data, $properties);
        $this->widgetView = 'comments';
    }

    public function run() {
        if (isset($this->properties['postid'])) {
            $model = new Comment();
            $this->data['comments'] = $model->getComments((int)$this->properties['postid']);
            $form = new FormComment();
            $this->data['form'] = $form;
        } else {
            throw new \Exception('Wrong postId specified for widget');
        }
    }
}
