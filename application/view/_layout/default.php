<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/css/main.css"/>
        <title><?=$this->view->getTitle(); ?></title>
    </head>
    <body>
        
        
        <div id="container">
            <div id="header">
                <h1 id="header-acr">
                    <a href="<?=$this->baseUrl()?>">TiNLtE</a>
                </h1>
                <div id="header-text">There is No Limit to Enchancement</div>
            </div>

            <div id="main">
                <?php  $this->widget('Menu', array('items' => array(
                    'Posts' => $this->baseUrl(),
                    'About' => $this->baseUrl() . '/about',
                    'Contacts' => $this->baseUrl() . '/contacts')
                ,'current' => $this->view->getCurrentMenuItem()))?>
                
                    <div id="all">
                        <div id="right">content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/>content<br/></div>
                        <div id="center">
                            <?php echo $content; ?>
                            <div class="clear"></div>
                        </div>
                    </div>
            </div>
            <div id="footer">
                Copyright ©
            </div>
        </div>
    </body>
</html>
