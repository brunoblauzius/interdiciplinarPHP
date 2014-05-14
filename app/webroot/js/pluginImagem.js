$(document).ready(function(){
    
    //// função para aparecer a imagem na tela
    $(document).on('mouseover', '.thub-list',function(){
        //$attr = $(this).attr('src');
        $name = $(this).attr('name');
        $("#maxImage").fadeIn(500);
        $elemento = '<img class="perfil_imagem reset-padding" alt="" src="'+$name+'">';
        $($elemento).appendTo('#maxImage');
    });
    ///função que esconte a imagem no box lateral
      $(document).on('mouseout', '.thub-list', function(){      
        $("#maxImage").hide();
        $('#maxImage').empty();
      });
    
    ////função para trocar de imagem no campo central
    $('.navigator').eq(0).addClass('ativo').show();
    $('.ativo').prevAll().hide();
    $('.ativo').nextAll().hide();
    $(document).on('click','.nave', function(){
            $src = $(this).attr('name');
            $index = $('.nave').index(this);
            $('.navigator').prevAll().removeClass('ativo').hide();
            $('.navigator').nextAll().removeClass('ativo').hide();
            $('.navigator').eq($index).addClass('ativo').show();
            $('.thub-list').css('background-size', '90%');
            $('.thub-list').css('background-color', 'black');
     })
    
    
});