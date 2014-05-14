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
        $("#thumbnailList2 .nav-list img").MyThumbnail({
            thumbWidth:350,
            thumbHeight:300,
            imageDivClass:"thub-list"
        });
        
        $("#thumbnailList1 img").MyThumbnail({
            thumbWidth:60,
            thumbHeight:60,
            imageDivClass:"nave"
        });
        
        $('.thub-list').css('background-size', '90%');
        $('.thub-list').css('background-color', 'black');
        
        $('.uk-icon-button').click(function(){
            $url = $(this).data('url');
            $.ajax({
                url: $url,
                data:{},
                type: 'GET',
                dataType:'Html',
                success: function (data) {
                    $('.modal-conteudo').html(data);
                }
            });
        });
                    
    });
</script>
    </head>
    <body>
       <?= $this->element('header')?>
        
        <div id="conteudo">

            <ul class="uk-breadcrumb" style="font-size:22px;">
                <li><a href="<?= $this->Html->url('/')?>">Home</a></li>
                <li><a href="<?= $this->Html->url('/')?>"><?= $categoria?></a></li>
                <li class="uk-active"><span><?= $produto?></span></li>
            </ul>
            
            <!-- perfil imagem -->
            <div class="plug-image">
                <div id="thumbnailList2">
                    <ul class="nav-list">
                        <li class="navigator"><?= $this->Html->image('1.jpg',array('class' => 'col-md-12 perfil_imagem', 'name' => '1.jpg'));?></li>
                        <li class="navigator"><?= $this->Html->image('2.jpg',array('class' => 'col-md-12 perfil_imagem', 'name' => '2.jpg'));?></li>
                        <li class="navigator"><?= $this->Html->image('3.jpg',array('class' => 'col-md-12 perfil_imagem', 'name' => '3.jpg'));?></li>
                    </ul>

                </div>
                <ul class="nav-image" id="thumbnailList1">
                        <li><?= $this->Html->image('1.jpg',array('class' => 'col-md-5 nav imgLiquidFill imgLiquid'));?></li>
                        <li><?= $this->Html->image('2.jpg',array('class' => 'col-md-5 nav imgLiquidFill imgLiquid'));?></li>
                        <li><?= $this->Html->image('3.jpg',array('class' => 'col-md-5 nav imgLiquidFill imgLiquid'));?></li>
                </ul>
            </div>
            <div id="maxImage" class="maxImage"></div>
            
            <div class="descricao">
                <table>
                    <tbody>
                        <tr>
                            <td colspan="2"><h3>Imóvel: Apartamento Cabral</h3></td>
                        </tr>
                        <tr>
                            <td>Tipo Imóvel:</td>
                            <td>Apartamento</td>
                        </tr>
                        <tr>
                            <td>Quarto(s):</td>
                            <td>5</td>
                        </tr>
                        <tr>
                            <td>Garagem(s):</td>
                            <td>2</td>
                        </tr>
                        <tr>
                            <td>Suite(s):</td>
                            <td>1</td>
                        </tr>
                        <tr>
                            <td>Local:</td>
                            <td> Rua: Av. kennedy, 5434 - PR - Curitiba / Novo mundo</td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <i class="uk-icon-button uk-icon-envelope" data-url="<?= $this->Html->url(array('controller' => 'Produtos', 'action' => 'entreContato', 1 ))?>" data-uk-modal="{target:'.modal'}" data-uk-tooltip="{pos:'bottom-left'}" title="Envie um email para a empresa"></i> 
                                <i class="uk-icon-button uk-icon-users" data-url="<?= $this->Html->url(array('controller' => 'Produtos', 'action' => 'enviaPerfil', 1 ))?>" data-uk-modal="{target:'.modal'}" data-uk-tooltip="{pos:'bottom-left'}" title="Recomende a um amigo"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="dividers" style="clear:both; margin-top:20px;"></div>
            <h3>Descrição Completa do Imóvel</h3>
            <div class="dividers"></div>
            <p>
                aqui está a minha descrição do imóvel
            </p>
            
        </div>
        
        <?= $this->element('footer')?>
        
    </body>
</html>




