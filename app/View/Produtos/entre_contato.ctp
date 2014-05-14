<?php echo $this->element('java');?>
<script>
$(document).ready(function(){
   $('#ProdutosSendPerfilForm .input').addClass('uk-form-row');
});
</script>
<h4><?= $title;?></h4>
<hr>
<?= $this->Form->create('Produtos',array('action' => 'entreContato', 'class' => 'uk-form'))?>
    <?= $this->Form->hidden('imovel',array('value' => ''))?>
    <?= $this->Form->input('nome', array('class' => 'uk-form-large','label' => 'Seu Nome:', 'type' => 'text', 'placeholder' => 'Digite seu nome'));?>
    <?= $this->Form->input('email', array('class' => 'uk-form-large','label' => 'Seu E-mail:', 'type' => 'text', 'placeholder' => 'Digite seu E-mail'));?>
    <?= $this->Form->input('telefone', array('class' => 'uk-form-large','label' => 'Telefone:', 'type' => 'text', 'placeholder' => 'Digite seu Telefone'));?>
    <?= $this->Form->input('mensagem', array('class' => 'uk-form-large','label' => 'Sua mensagem para o amigo:', 'type' => 'textarea','placeholder' => 'Deixe sua mensagem'));?>
    <?= $this->Form->submit('Enviar Email', array('class' => 'uk-button uk-button-primary'))?>
<?= $this->Form->End();?>