<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sitemap
 *
 * @author brunoblauzius
 */
class Sitemap extends Component{
    
    public $path;
    
    public function gravaXml( SimpleXMLElement $xml = NULL ) {
        $this->path = substr(dirname(__DIR__),0,-4);
        $xml->saveXML( $this->path.'/Sitemap.xml' );
    }
    
    
}
