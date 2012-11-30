<div id="topMenu">
    <div id="tabs">
        <?php
            foreach ($data['items'] as $name => $url) {
                $class = '';
                if (!strcasecmp($data['current'], $name)) {
                    $class = 'current';
                }
        ?>
                <a class="<?=$class?>" href="<?=$url?>"><?=$name?></a>            
        <?php
            }
        ?>
    </div>
</div>