Edit post
<?php
    $this->view->setTitle($this->view->getTitle() . 'Edir post');
    echo $message;
?>
<?php
    echo $form->startRender();
    echo $form->title;
    echo $form->text;
    echo $form->visible;
    echo $form->submit;
    echo $form->endRender();
?>
