<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?= $title_for_layout?></title>
        <?php
                echo $this->Html->meta('icon');
		echo $this->element('css');
                echo $this->element('java');
		echo $this->fetch('meta');
		echo $this->fetch('css');
        ?>
    </head>
    <body>
        <?= $this->element('header')?>
        
        <div id="conteudo">
            <h3>Formulário de contato</h3>
            <?= $this->Form->create('emails', array('controller' => 'emails', 'action' => 'send', 'class' => 'uk-form'))?>
            <?= $this->Form->inputs(array(
                'fieldset' => false,
                'legend'   => 'Formulário de contato',
                'nome' => array('type' => 'text', 'class' => 'uk-form-large', 'label' => 'Nome:', 'placeholder' => 'Ex.: José da silva', ),
                'email' => array('type' => 'text', 'class' => 'uk-form-large', 'label' => 'E-mail:', 'placeholder' => 'Ex.: seuemail@dominio.com', ),
                'assunto' => array('type' => 'text', 'class' => 'uk-form-large', 'label' => 'Assunto:', 'placeholder' => 'Ex.: venda de apartamento', ),
                'mensagem' => array('type' => 'textarea', 'class' => 'uk-form-large', 'label' => 'Deixe sua mensagem:', 'placeholder' => 'Deixe aqui sua mensagem e logo entraremos em contato', ),
            ))?>    
            <?= $this->Form->Submit('Enviar e-mail', array('class' => 'uk-button uk-button-primary'));?>
            <?= $this->Form->end();?>
        </div>
        
        
        <?= $this->element('footer')?>
        
        
    </body>
</html>



