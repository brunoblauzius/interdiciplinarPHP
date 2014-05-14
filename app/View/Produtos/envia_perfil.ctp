<?php echo $this->element('java');?>
<script>
$(document).ready(function(){
   $('#ProdutosSendPerfilForm .input').addClass('uk-form-row');
});
</script>
<h4><?= $title;?></h4>
<hr>
<?= $this->Form->create('Produtos',array('action' => 'enviaPerfil', 'class' => 'uk-form'))?>
    <?= $this->Form->hidden('imovel',array('value' => ''))?>
    <?= $this->Form->input('nome_amigo', array('class' => 'uk-form-large','label' => 'Nome do Amigo:', 'type' => 'text'));?>
    <?= $this->Form->input('email_amigo', array('class' => 'uk-form-large','label' => 'E-mail do Amigo:', 'type' => 'text'));?>
    <?= $this->Form->input('nome', array('class' => 'uk-form-large','label' => 'Seu Nome:', 'type' => 'text'));?>
    <?= $this->Form->input('email', array('class' => 'uk-form-large','label' => 'Seu E-mail:', 'type' => 'text'));?>
    <?= $this->Form->input('mensagem', array('class' => 'uk-form-large','type' => 'textarea','label' => 'Sua mensagem para o amigo:'));?>
    <?= $this->Form->submit('Enviar Email', array('class' => 'uk-button uk-button-primary'))?>
<?= $this->Form->End();?>