<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
app::uses('WebserviceController', 'Controller/Component');
/**
 * Description of Pessoas
 *
 * @author brunoblauzius
 */
class PessoasController extends AppController {
    //put your code here
    
    public function cadastro(){
        try{
            $this->autoRender = FALSE;
            if( $this->request->is('post') || $this->request->is('put')){
                /**
                 * @link url = 'http://webservices-nguenodev.rhcloud.com/pessoa/cadastrar';
                 */
                
                $this->{$this->modelClass}->data = $this->request->data;
                if ( $this->{$this->modelClass}->validates() ) {
                    
                    $senha = $this->{$this->modelClass}->data[$this->modelClass]['password'];
                    $c_senha = $this->{$this->modelClass}->data[$this->modelClass]['c-password'];
                    
                    if( $senha != $c_senha ){
                       die(json_encode(array(
                            'erros' => array('password' => 'Senhas não conferem'),
                            'form' => $this->{$this->modelClass}->name . 'CadastroForm'
                        ))); 
                    }
                    
                    unset($this->{$this->modelClass}->data[$this->modelClass]['c-password']);
                    unset($this->{$this->modelClass}->data[$this->modelClass]['password']);
                    $this->{$this->modelClass}->data['login']['senha'] = md5($senha);
                    $this->{$this->modelClass}->data['login']['email'] = $this->{$this->modelClass}->data[$this->modelClass]['email'];
                    //print_r( $this->{$this->modelClass}->data );return;
                    $this->{$this->modelClass}->data['pessoa'] = $this->{$this->modelClass}->data[$this->modelClass];
                    
                    //envio para o webservice
                    $url = 'http://webservices-nguenodev.rhcloud.com/pessoa/cadastrar';
                    $Webservice = new WebserviceComponent($url, $this->{$this->modelClass}->data, 'json');
                    $json = $Webservice->sendPostCURL();
                    $Webservice->curlClose();
                    
                    $mensagem = json_decode($json, true);
                    echo json_encode(array(
                        'msg_sucess' => $mensagem['mensagem'],
                    ));
                } else {
                    echo json_encode(array(
                        'erros' => $this->{$this->modelClass}->validationErrors,
                        'form' => $this->{$this->modelClass}->name . 'CadastroForm'
                    ));
                }
            } 
        } catch (Exception $ex) {
            echo json_encode(array(
                'msg' => $ex->getMessage(),
            ));
        }
    }
    
}
