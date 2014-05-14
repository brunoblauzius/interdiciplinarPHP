$(document).ready(function(){
    
    function atualizarId( url, elementId ){
        $.get(url,function(data){
            $( '#' + elementId ).html(data);
        })
    }
    
    function atualizarBody( url ){
        $.get(url,function(data){
            $( 'body' ).html(data);
        })
    }
    
    function redirect(url) {
        $(location).attr('href', url );
    }
    
    function tratarJSON( json ){
        if( json.msg ){
            alert(json.msg);
        } 
        if( json.erros ){
            tratarFormulario(json.erros, json.form);
        } 
        if( json.funcao ){
            eval(json.funcao);
        }
        if(json.url){
            redirect(json.url);
        }
        if( json.msg_sucess){
            sucesso( json.msg_sucess, json.form );
        }
    }
            
            
    function tratarFormulario( erros, form ){
        if( $('#'+form+' div.erros').length ){
            $('#'+form+' div.erros').html('<a class="uk-alert-close uk-close" href="#"></a><h4>Erros no formulario</h4>');
        } else{
            $('#' + form ).prepend('<div class="uk-alert uk-alert-danger uk-alert-large erros"><a class="uk-alert-close uk-close" href="#"></a><h4>Erros no formulario</h4></div>');
        }
        $('#'+form+' input').removeClass('uk-form-danger');

        $.each(erros,function(key, value ){
            $('#'+form+' input[name*="'+key+'"]').addClass('uk-form-danger');
            $('#'+form+' .erros').append('<strong>'+value+'</strong><br>');
        });
    }      
    
    
    function sucesso( msg_sucess, form ){
        if( $('#'+form+' div.success').length ){
            $('#'+form+' div.success').html('<a class="uk-alert-close uk-close" href="#"></a> <h4>Enviado com sucesso</h4>');
        } else {
            $('#' + form ).prepend('<div class="uk-alert uk-alert-success uk-alert-large success"> <a class="uk-alert-close uk-close" href="#"></a> <h4>Enviado com sucesso</h4> </div>');
        }
    }
    
    
    $('input').attr('required', false);
    $('email').attr('required', false);
    $('textarea').attr('required', false);
    /**
     * @todo main para os sends deforma assincrona pelo jquery form
     */
    $(document).on('click', 'form',function(){
        $id = $(this).attr('id');
        $( '#'+$id).ajaxForm({
            dataType: 'JSON',
            success: function(data){
                $('input[type=text], input[type=email]').val('');
                $('textarea').val('');
                tratarJSON(data);
            }
        });
    })
    
    //buscar item para a pagina cadastrar
    $(document).on('click', '.cadastrar', function(){
        $url = $(this).data('url');
            $.get($url,function(data){
                $('#admin-sub-conteudo').html(data);
            })
    })

    //buscar item para a pagina editar
    $(document).on('click', '.editar', function(){
        $url = $(this).data('url');
            $.get($url,function(data){
                $('#admin-sub-conteudo').html(data);
            })
    })

    //buscar item para a pagina cancelar
    $(document).on('click', '.cancelar', function(){
        $url = $(this).data('url');
        
            $.getJSON($url,function(data){
                tratarJSON(data);
            })
    })
    
    
    
    /**
     * @function viewBags função para que seja ativo um especifico 
     * item da minha ul da pagina de orçamento
     * 
     * @argument {int} index index do elemento a ser ativado
     * @version 1.0
     * @author Bruno blauzius
     * @
     */
    
    function viewBags( index ){
        
        var prefix = '/selito1/';
        if( index == 0 ){
            //troca de imagem de cinza para colorida
            $('.nav-header').children('li').children('img').eq(index).attr('src', prefix + 'img/1.jpg');
            $('.nav-header').children('li').children('img').eq(1).attr('src', prefix +  'img/2grey.jpg');
            $('.nav-header').children('li').children('img').eq(2).attr('src', prefix + 'img/3grey.jpg');

        } else if ( index == 1 ){
            //troca de imagem de cinza para colorida
            $('.nav-header').children('li').children('img').eq(index).attr('src', prefix +  'img/2.jpg');
            $('.nav-header').children('li').children('img').eq(0).attr('src', prefix +  'img/1grey.jpg');
            $('.nav-header').children('li').children('img').eq(2).attr('src', prefix +  'img/3grey.jpg');
        } else {
            //troca de imagem de cinza para colorida
            $('.nav-header').children('li').children('img').eq(index).attr('src', prefix +  'img/3.jpg');
            $('.nav-header').children('li').children('img').eq(0).attr('src', prefix +  'img/1grey.jpg');
            $('.nav-header').children('li').children('img').eq(1).attr('src', prefix +  'img/2grey.jpg');
        }

        $('.nav-content').children('li').siblings().hide();
        $('.nav-content').children('li').siblings().removeClass('ativo');
        $('.nav-content').children('li').eq(index).show();
        $('.nav-content').children('li').eq(index).addClass('ativo');
        
        if( index == 2 ){
            $('.avancar').hide();
        } else {
            $('.avancar').show();
        }
        
        if( index == 0 ){
            $('.voltar').hide();
        } else {
            $('.voltar').show();
        }
        
        
    }
});