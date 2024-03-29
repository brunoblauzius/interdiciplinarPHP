<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('ConcreteMail', 'Controller/Component');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
    public $helpers    = array('Html', 'Form', 'Session');
    public $components = array('Webservice');
    public $ConcreteMail;
    
    public function __construct($request = null, $response = null) {
        parent::__construct($request, $response);
        
    }


    public function beforeFilter() {
        parent::beforeFilter();
        
    }
    
    
     public function urlApp(){
        if($_SERVER['SERVER_PROTOCOL'] == 'HTTP/1.1'){
            $http = 'http://';
        } else {
            $http = 'https://';
        }
        return $http.$_SERVER['HTTP_HOST'];
    }  
    
}
