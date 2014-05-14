<div id="header">
    <div id="header-align">
        <div id="logo">
            <a href="<?= $this->Html->url('/')?>">MINHA CASA</a>
        </div>
        <div id="busca">
            <?= $this->Form->Create('Produtos', array('controller' => 'produtos', 'action' => 'busca'));?>
            <table style="width: 300px">
                <tbody>
                    <tr>
                        <td style="width:200px;"><?= $this->Form->Input('busca',array('type' => 'text','label' => false ,'class' => 'uk-form-blank', 'placeholder' => 'Faça sua pesquisa aqui'));?></td>
                        <td>
                            <input class="uk-button uk-button-danger uk-button-small" type="submit" value="Buscar"> 
                            <a href="#"><i class="uk-icon-user uk-icon-button" style="margin-left: 5px;"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>

            <?= $this->Form->End();?>
        </div>
    </div>
    <div id="menu">
        <ul>
            <li><?=$this->Html->link('Home', array('controller' => 'pages', 'action' => 'display', 'home' ))?></li>
            <li><?=$this->Html->link('Venda', array('controller' => 'produtos', 'action' => 'lista', 'venda' ))?></li>
            <li><?=$this->Html->link('Aluguel', array('controller' => 'produtos', 'action' => 'lista', 'aluguel' ))?></li>
            <li><?=$this->Html->link('Novos', array('controller' => 'produtos', 'action' => 'lista', 'novos' ))?></li>
            <li><?=$this->Html->link('Cadastre-se', array('controller' => 'pages', 'action' => 'display', 'cadastro' ))?></li>
            <li><?=$this->Html->link('Contato', array('controller' => 'pages', 'action' => 'display', 'contato' ))?></li>
        </ul>
    </div>
</div>
<div class="dividers"></div>