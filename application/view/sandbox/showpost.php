<div>
    <?php
        foreach ($posts as $v) {
    ?>
    <div>
        <h1><a href="<?=$this->createUrl('sandbox', 'editpost', array('id' => $v['id'])) ?>"><?=$v['title']?></a></h1>
        <span><a href="<?=$this->createUrl('sandbox', 'deletepost', array('id' => $v['id'])) ?>">X</a></span>
        <div><?=$v['date']?></div>
        <div><?=$v['visible']?></div>
    </div>
    <?php     
        }
        $this->widget('Pagination', array('controller' => 'sandbox', 'action' => 'showpost'), array('paginator' => $paginator));
    ?>
</div>

