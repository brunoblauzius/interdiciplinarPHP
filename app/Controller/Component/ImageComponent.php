<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ImageComponent
 *
 * @author brunoblauzius
 */
class ImageComponent extends Component {
    
    /** @var String */
    public $pathBanner = 'files/banners';
    /** @var array */
    public $tipoPermitido = array('jpeg', 'jpg', 'png' );
    /** @var String */
    public $pathProdutos  = 'files/produtos/';
    
    public $tipoAceito    = array("image/jpeg", "image/png", "image/bmp");
    
    public function moveUploadFile( array $imagem = null ) {
        try{
            
            if( !empty($imagem)){
                //se não existir minha pasta em files banner
                if( !file_exists($this->pathBanner) ){
                    mkdir($this->pathBanner, 0777);
                }
                //pego o tipo da minha imagem
                $tipoDaImagem = explode('.', $imagem['name']);
                //verifico se é do tipo permitido
                if( in_array( $tipoDaImagem[1], $this->tipoPermitido )){
                    ///logica do acerto
                    if( move_uploaded_file( $imagem['tmp_name'], $this->pathBanner . DS . $imagem['name']) ) {
                        $nomeImagem = $imagem['name'];
                        return $nomeImagem;
                    } else {
                        throw new Exception('Imagem não pode ser enviada ao servidor');
                    }
                } else {
                    throw new Exception('Imagem não é do tipo permitido');
                }
            } else {
                throw new Exception('Imagem está vazia');
            }
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    public function cadastraImagem( $file = null ) {
        try{
            $nomeVelho        = $file["name"];
            $tamanho          = $file["size"];
            $tipoArquivo      = $file["type"];
            $tmp              = $file['tmp_name'];
            $tamanhoPermitido = "8500000";//5,5MB max
            
            //verificando se existe a pasta se nao eu crio .uma 
             if( !file_exists($this->pathProdutos) ) {
                 mkdir($this->pathProdutos, 0777);
                //mkdir( $pasta."/thumb"); imagem em miniatura
             }
            
            

            if( $tamanho > $tamanhoPermitido) {
                throw new Exception("Tamanho do arquivo não é permitido");
            }
            if( !in_array( $tipoArquivo, $this->tipoAceito ) ) {
                throw new Exception("formato inválido de imagem");
            }
            //atribui tipo imagem
            if($tipoArquivo == "image/jpeg" )
                $tipoImagem = ".jpeg";
            if($tipoArquivo == "image/png" )
                $tipoImagem = ".png";
            if($tipoArquivo == "image/bmp" )
                $tipoImagem = ".bmp";


            //atribui o novo nome   
            $novo_nome = md5(uniqid( rand(),true)).$tipoImagem;
            //redimenciona imagem
            $this->redimenciona($tmp, $novo_nome, 600, $this->pathProdutos."/", $tipoArquivo );
            return $novo_nome;
        } catch (Exception $ex) {

        }
     }
    
    public function redimenciona( $tmp, $nome, $largura, $pasta, $tipo_img ) {    
       
        if( $tipo_img == 'image/jpeg' ){
            $img = imagecreatefromjpeg($tmp);
        }
        else if($tipo_img == 'image/bmp'){
            $img = imagecreatefromjpeg($tmp);
        }

            // recebe a altura e a largura da imagem
            $x = imagesx($img);
            $y = imagesy($img);
            
            // descobrir minha altura
            $altura = ($largura * $y)/$x;
            // criando uma nova imagem
            $nova_img = imagecreatetruecolor($largura,$altura);
            // faz a copia da imagem com tamanho e altura
            imagecopyresampled($nova_img, $img, 0,0,0,0, $largura,$altura,$x,$y);
            
             
            if( $tipo_img == 'image/jpeg' ){
                imagejpeg($nova_img, $pasta.$nome, 100);
            }
            else if($tipo_img == 'image/bmp'){
                image2wbmp($nova_img, $pasta.$nome, 100);
            }
	    else{
		throw new Exception("tipo não permitido");
	    }
            chmod($nova_img, 0777);
            //destroy as imagens
            imagedestroy($img);
            imagedestroy($nova_img); 		      
     }//END redimenciona
    
}
