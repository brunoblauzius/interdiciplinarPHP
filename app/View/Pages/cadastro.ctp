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
    <script>
    $(document).ready(function(){
        $('table').children('.juridica').hide();
        $(document).on('change', '.tipo_pessoa', function(){
            if( $('.tipo_pessoa').val() == '1' ){
                $('table').children('.juridica').show();
                $('table').children('.fisica').hide();
            } else {
                $('table').children('.juridica').hide();
                $('table').children('.fisica').show();
            }
        });
        
        $('.buscaCep').focusout(function(){
           var cep = $(this).val();
           var url = "http://cep.correiocontrol.com.br/" + cep + ".json";
            $('#PessoaEnderecoLogradouro').val('Aguarde o processamento...');
            $('#PessoaEnderecoUf').val('Aguarde o processamento...');
            $('#PessoaEnderecoBairro').val('Aguarde o processamento...');
            $('#PessoaEnderecoCidade').val('Aguarde o processamento...');
           $.getJSON(url, function(data){
                correiocontrolcep(data)
           })
        })
        function correiocontrolcep(data){
            $('#PessoaEnderecoLogradouro').val(data.logradouro);
            $('#PessoaEnderecoUf').val(data.uf);
            $('#PessoaEnderecoBairro').val(data.bairro);
            $('#PessoaEnderecoCidade').val(data.localidade);
        }
        
    })
</script>
<style>
    table tr td{background-color:#000; color:#FFF; border-bottom:none;}
</style>
    <body>
        <?= $this->element('header')?>
        
        <div id="conteudo">
            <h3>Formulário de contato</h3>
             <?= $this->Form->Create('Pessoa',array('controller' => 'pessoas', 'action' => 'cadastro', 'class' => 'uk-form'));?>
            
            
            
            
                    <table class="">
                        <thead>
                            <tr>
                                <td>Nome:</td>
                                <td><?= $this->Form->input('nome', array('class' => 'uk-width-*', 'label' => false, 'placeholder' => 'Ex.: José da silva'));?></td>
                            </tr>
                            <tr>
                                <td>E-mail:</td>
                                <td><?= $this->Form->input('email', array('class' => 'uk-width-*', 'label' => false, 'placeholder' => 'Ex.: jose.silva@seuemail.com'));?></td>
                            </tr>
                            <tr>
                                <td>Cpf:</td>
                                <td><?= $this->Form->input('cpf', array('class' => 'uk-width-*', 'label' => false, 'placeholder' => 'Ex.: digite seu cpf'));?></td>
                            </tr>
                            <tr>
                                <td>Telefone:</td>
                                <td><?= $this->Form->input('telefone', array('class' => 'uk-width-*', 'label' => false, 'placeholder' => 'Ex.: (41) 0000-0000'));?></td>
                            </tr>
                            <tr>
                                <td>Cep:</td>
                                <td><?= $this->Form->input('Pessoa.endereco.cep', array('class' => 'uk-width-* buscaCep', 'label' => false,'placeholder' => 'Ex.: 00000-000'));?></td>
                            </tr>
                            <tr>
                                <td>Logradouro:</td>
                                <td><?= $this->Form->input('Pessoa.endereco.logradouro', array('class' => 'uk-width-*', 'label' => false,'placeholder' => 'Ex.: Rua leila diniz, 531, casa'));?></td>
                            </tr>
                            <tr>
                                <td>Uf:</td>
                                <td><?= $this->Form->input('Pessoa.endereco.uf', array('class' => 'uk-width-*', 'label' => false ,'placeholder' => 'Ex.: PR'));?></td>
                            </tr>
                            <tr>
                                <td>Cidade:</td>
                                <td><?= $this->Form->input('Pessoa.endereco.cidade', array('class' => 'uk-width-*', 'label' => false,'placeholder' => 'Ex.: Pinhais'));?></td>
                            </tr>
                            <tr>
                                <td>Bairro:</td>
                                <td><?= $this->Form->input('Pessoa.endereco.bairro', array('class' => 'uk-width-*', 'label' => false, 'placeholder' => 'Ex.: Maria Antonieta'));?></td>
                            </tr>
                            <tr>
                                <td>Número:</td>
                                <td><?= $this->Form->input('Pessoa.endereco.numero', array('class' => 'uk-width-*', 'label' => false, 'placeholder' => 'Ex.: 568'));?></td>
                            </tr>
                            <tr>
                                <td>Complemento:</td>
                                <td><?= $this->Form->input('Pessoa.endereco.complemento', array('class' => 'uk-width-*', 'label' => false, 'placeholder' => 'Ex.: Casa,apartamento'));?></td>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td colspan="2"><h3>Digite a sua senha e confirme sua senha para realizar orçamentos:</h3></td>
                            </tr>
                            <tr>
                                <td>Senha:</td>
                                <td><?= $this->Form->input('password', array('class' => 'uk-width-*', 'type' => 'password', 'label' => false, 'placeholder' => 'digite sua senha aqui'));?></td>
                            </tr>
                            <tr>
                                <td>Confirme sua senha:</td>
                                <td><?= $this->Form->input('c-password', array('class' => 'uk-width-*', 'type' => 'password', 'label' => false, 'placeholder' => 'digite sua confirmação de senha aqui'));?></td>
                            </tr>
                        </tfoot>
                        
                    </table>
                    <?= $this->Form->button('Cadastrar-se na Nogarotto',array('class' => 'uk-button uk-button-primary'));?>
                    <?= $this->Form->End();?>
        </div>
        
        
        <?= $this->element('footer')?>
        
        
    </body>
</html>



