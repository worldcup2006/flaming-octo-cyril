<div id="showPost">
    <div class="date"><?=$post['date']?></div>    
    <h1><?=$post['title']?></h1>
    <div class="text"><?=$post['text']?></div>    
</div>

<!-- Comments -->
<div id="comments">
<?php
if (!empty($comments) && is_array($comments)) {
?>
    <h2>коментарии()</h2>
<?php
    foreach ($comments as $comment) {
?>   
    <div class="meta"><span class="author"><?=$this->escape($comment['author']);?></span> <span class="time"><?=$comment['date']?></span></div>
    <div class="message"><?=$this->escape($comment['text']);?></div>
<?php
    }
} else {
?>
    <h6>Коментариев к статье пока нет</h6>
<?php    
}
?>
</div>
<div id="commentsForm">
<?php 
    if (!empty($form)) {
        echo $form->startRender();
?>
        <!--<fieldset class="mainFieldset">-->
            <legend>Ваш комментарий:</legend>
            <p><label for="author">Имя:</label><?=$form->author;?></p>
            <p><!--<label for="text">Комментарий:</label>--><?=$form->text;?></p>
            
            <div class="captcha">
                <label for="captchakey">Введите цифры с картинки:</label>
                <p><?=$form->captchakey;?></p>
                <p><?=$form->captcha;?></p>  
            </div>
            
            <p><?=$form->submit;?></p>
        <!--</fieldset>-->
<?php
        echo $form->endRender();
    }
?>
</div>
