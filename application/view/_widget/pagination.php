<?php
if ($countPages > 1) {
?>

<div class="pagination">
<?php
    if ($prevPage) {
?>
    <a class="fright" href="<?=$this->createUrl($controller, $action, array('page' => $prevPage), $route)?>">Earlier&Rarr;</a>
<?php
    }
?>
<?php
/*    for ($i = 1; $i <= $countPages; $i++) {
    if ($i == $currPage) {
        echo $i;
        continue;
    }
?>
<a href="<?=$this->createUrl($controller, $action, array('page' => $i), $route)?>"><?=$i?></a>
<?php
    }*/
?>
<?php
    if ($nextPage) {
?>
    <a class="fleft" href="<?=$this->createUrl($controller, $action, array('page' => $nextPage), $route)?>">&lt;Older</a>
<?php
    }
?>
</div>

<?php
}
?>
