    <?php
        foreach ($posts as $v) {
    ?>
    <div class="post">
        <header class="entryHead">
            <h1 class="entryTitle">
                <a href="<?=$this->createUrl(null, null, array('id' => $v['id']), 'post') ?>"><?=$v['title']?></a>
            </h1>
        </header>
        <div class="entryContent">
            <div><?=$v['text']?></div>
        </div>
        <div class="entryMeta">
            <div class="date"><?=$v['date']?></div>
            <div class="views"><?=$v['views']?></div>
        </div>
    </div>
    <?php     
        }
        $this->widget('Pagination', array('route' => 'posts'), array('paginator' => $paginator));
    ?>
