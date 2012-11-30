<h1>Hello from test</h1>
<?php
$this->view->setTitle($this->view->getTitle() . 'Test page');
echo $message;
?>
<br/>
<?php
echo $form->startRender();
echo $form->title;
echo $form->checkbox1;
echo $form->checkbox2;
echo $form->radio1;
echo $form->radio2;
echo $form->text;
//echo $form->captcha;
//echo $form->captchakey;
echo $form->submit;
echo $form->endRender();
?>
