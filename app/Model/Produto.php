<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Produtos
 *
 * @author brunoblauzius
 */
class Produto extends AppModel {
  
    public $name = 'Produto';
    public $validate = array(
        'email' => array(
            'rule' => array('email'),
            'message' => 'Insira um email valido'
        ),
        'nome' => array(
            'rule' => array('notEmpty'),
            'message' => 'Nome deve ser preenchido!'
        ),
    );
}
