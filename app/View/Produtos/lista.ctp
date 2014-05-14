<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $title_for_layout?></title>
         <?php
                echo $this->Html->meta('icon');
                echo $this->element('java');
		echo $this->element('css');
		echo $this->fetch('meta');
		echo $this->fetch('css');
        ?>
        <script type="text/javascript">
            $(document).ready(function() {
                var slider = $('#slider').leanSlider({
                    directionNav: '#slider-direction-nav',
                    controlNav: '#slider-control-nav'
                });
            });
        </script>
    </head>
    <body>
       <?= $this->element('header')?>
        
        <div id="conteudo">

            <ul class="uk-breadcrumb" style="font-size:22px;">
                <li><a href="<?= $this->Html->url('/')?>">Home</a></li>
                <li class="uk-active"><span><?= $categoria?></span></li>
            </ul>
            
            <?php for ($index = 0; $index < 10 ; $index++) :?>
                <div class="cont-lista">
                <a class="uk-thumbnail imagem" href="<?= $this->Html->url(array('controller' => 'produtos', 'action' => 'perfil', 'novos', 123))?>">
                    <?= $this->Html->image('apartamento.jpg', array('class' => '', 'alt' => 'meu apartamento'))?>
                </a>
                <div style="float:left">
                    <h4>Apartamento Cabral</h4>
                    <p>
                        Quartos: 4 <br>
                        Garagem: 1 <br>
                        Suite: 1 <br>
                        <?= $this->Html->link('Conheça o imovel', array('controller' => 'produtos', 'action' => 'perfil', 'novos', 123), array('class' => 'uk-button uk-button-danger', 'data-uk-tooltip' => "{pos:'right'}", 'title' => 'conheça o imóvel' ))?>
                    </p>
                </div>
            </div>
            <?php endfor;?>
        </div>
        
        <?= $this->element('footer')?>
        
    </body>
</html>




