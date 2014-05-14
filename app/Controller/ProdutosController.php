<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
App::uses('Controller', 'AppController');
/**
 * Description of ProdutosController
 *
 * @author brunoblauzius
 */
class ProdutosController extends AppController{
    
    public function beforeFilter() {
        parent::beforeFilter();
    }
    
    
    public function perfil( $categoria = null, $id = null ){
        $this->autoLayout = FALSE;
        try {
            $this->set('categoria', $categoria);
            $this->set('produto', 'Apartamento Cabral');
            $this->set('title_for_layout', $categoria);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function lista( $categoria = null ){
        $this->autoLayout = FALSE;
        try {
            $this->set('categoria', $categoria);
            $this->set('title_for_layout', $categoria);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function busca( ){
        $this->autoLayout = FALSE;
        try {
            $this->request->data;
            $categoria = 'Novos';
            $this->set('categoria', $categoria);
            $this->set('procura',  $this->request->data['Produtos']['busca']);
            $this->set('title_for_layout', $categoria. ' - ' . $this->request->data['Produtos']['busca'] );
            
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    /**
     * @todo Description envio de email para um amigo!
     * @param int $id
     */
    public function enviaPerfil( $id = NULL ){
        try{
            $this->autoLayout = NUll;
            
            if($this->request->is('post') || $this->request->is('put')){
                $this->autoRender = FALSE; 
                $this->autoLayout = NUll;
                print_r($this->request->data);
                
                $ConcreteMail = new ConcreteMail();

                
            } else {
                
                $this->set('title', 'Envie para um amigo este perfil!');
            }
        } catch (Exception $ex) {
            echo json_encode(array(
                'msg' => $ex->getMessage(),
            ));
        }
    }
    
    /**
     * @todo Description envio de email para um amigo!
     * @param int $id
     */
    public function entreContato( $id = NULL ){
        try{
            $this->autoLayout = NUll;
            
            if($this->request->is('post') || $this->request->is('put')){
                $this->autoRender = FALSE; 
                print_r($this->request->data);
                
                
            } else {
                
                $this->set('title', 'Fale Conosco!');
            }
        } catch (Exception $ex) {
            echo json_encode(array(
                'msg' => $ex->getMessage(),
            ));
        }
    }
}
