<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WebserviceComponent
 *
 * @author brunoblauzius
 */
class WebserviceComponent extends Component {
    /**
     * Todo: alvo da minha curl
     * @var String  
     */
    public $url = null;
    
    /**
     * Todo: cabeçalhos da minha requisição curl
     * @var array headers
     */
    public $headers = array( 
        'Content-Type: application/json',
    );
    
    /**
     * @var cURL instance 
     */
    public $ch = null;
    
    /**
     * Todo: tipo de comunicação entre os webservices
     * @var string
     */
    public $tipoEnvio = 'JSON';
    
    /**
     * TODO: o tamanho da minha string no caso do json
     * @var int
     */
    public $stringLenght = null;
    
    /**
     * Todo: argumentos que serão transportado pela requisição
     * @var json
     */
    public $arguments = null;
    
    
    
    /**
     * TODO: modo construtor para envio da minha cURL para o destino desejado via xml ou json
     *       metodo abstrado 
     * @param string $url url de destino do meu post
     * @param array $arrayMaster valores a serem enviados
     * @param string $modoDeEnvio conversão para tipo de envio
     */
    public function __construct( $url = NULL, array $arrayMaster = NULL, $modoDeEnvio = NULL ) {
        //instacio minha curl
        $this->ch = curl_init();
        //seto minha url
        $this->url = $url;
        //verifico 
        if( strtoupper($modoDeEnvio) === $this->tipoEnvio ){
            //minha header aqui não é montada
            $this->arguments  = json_encode($arrayMaster);
            $this->stringLenght = (int) strlen($this->arguments);
        } else {
            $this->headers = array(
                'Content-Type: text/xml',
            );
            //transforma em simplexml
        }
    }
    
    /**
     * TODO: metodo de envio via post para webservice java
     * @version string INTERDICIPLINAR
     * @return json/xml 
     */
    public function sendPostCURL(){
        try{
            // incluo a pagina a ser requisitada
            curl_setopt($this->ch, CURLOPT_URL, $this->url);
            // isso garante o meu retorno do conteudo para a pagina solicitada
            curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($this->ch, CURLOPT_TIMEOUT, 10);
            // garante que eu vá redirecionar para a pagina se acaso meu 
            // servidor estiver com redirecionamento automatico para o server
            curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
            // garanto que é pelo metodo post
            curl_setopt($this->ch, CURLOPT_POST, true);
            //adiiciono meus paramentros para envio
            curl_setopt($this->ch, CURLOPT_POSTFIELDS, $this->arguments );
            
            //headers a serem adicionados a mais na requisição
            $this->headers = array_merge( $this->headers ,array(
                                                            'Content-Length: '. $this->stringLenght
                                                            ));
            
            curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->headers);
            
            $sucesso = curl_exec($this->ch);
            $erro = curl_errno($this->ch);
            if( $erro != NULL ){
                throw new Exception( $erro );
            }
            return $sucesso;
        } catch (Exception $ex) {
            echo json_encode(array(
                'msg' => $ex->getMessage(),
            ));
        }
    }
    
    
    public function sendGetCURL( $param = null ){
        try{
            
            
            
            
        } catch (Exception $ex) {
            echo json_encode(array(
                'msg' => $ex->getMessage(),
            ));
        }
    }
    
    
    /**
     * TODO: metodo para busca de json por get sem passagem de parametros
     * @return json lista de resultados
     *  
     */
    public function requestCURL(){
        try{
            curl_setopt($this->ch, CURLOPT_URL, $this->url);
            curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, 10);
            curl_setopt($this->ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, TRUE);
            
            $sucesso = curl_exec($this->ch);
            $erro = curl_errno($this->ch);
            if( $erro != NULL ){
                throw new Exception( $erro );
            }
            return ($sucesso);
        } catch (Exception $ex) {
            echo json_encode(array(
                'msg' => $ex->getMessage(),
            ));
        }
    }
    
    
    /**
     * Fecha a conexão com curl
     */
    public function curlClose(){
        curl_close($this->ch);
    }
    
}

