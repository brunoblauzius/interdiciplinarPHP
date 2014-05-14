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
            
            
            <?= $this->element('slider')?>
            
            
            <h3>Novos Imóveis</h3>
            <div class="dividers"></div>
            
            <?php for ($index = 0; $index < 10 ; $index++) :?>
            <div class="cont">
                <a class="uk-thumbnail" href="">
                    <?= $this->Html->image('apartamento.jpg', array('class' => '', 'alt' => 'meu apartamento'))?>
                </a>
                <h4>Apartamento Cabral</h4>
                <p>
                    Quartos: 4 <br>
                    Garagem: 1 <br>
                    Suite: 1 <br>
                    <?= $this->Html->link('Conheça o imovel', array(), array('class' => 'uk-button uk-button-danger', 'data-uk-tooltip' => "{pos:'bottom-left'}", 'title' => 'conheça o imóvel' ))?>
                </p>
            </div>
            <?php endfor;?>
        </div>
        
        <?= $this->element('footer')?>
        
    </body>
</html>




