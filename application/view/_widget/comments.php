<?php
if (!empty($comments) && is_array($comments)) {
    foreach ($comments as $comment) {
?>   
<p><h6><?=$comment['author']?>&nbsp;<?=$comment['date']?></h6>
    <?=$comment['text']?>
</p>
<?php
    }
} else {
?>
    <h6>Коментариев к статье пока нет</h6>
<?php    
}
?>
