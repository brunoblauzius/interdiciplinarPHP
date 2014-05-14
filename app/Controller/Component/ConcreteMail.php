<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

APP::uses('AbstractMail', 'Controller/Component');

/**
 * Description of ConcreteMail
 *
 * @author Bruno Blauzius
 */
class ConcreteMail extends AbstractMail {
    //put your code here
    
    /**
     * @deprecated since version number Versão depreciada por que não precisa mais ser feita deste modo
     * @param array $user
     */
    protected function addBody( array $user = null ) {
        $string = "<h2>Prezado(a) <strong>".ucwords($user['Orcamentos']['nome'])."</strong> seu email foi enviado com sucesso</h2>";
        $servico = "<table style='width:100%; padding:5px;'>";
                $servico .= "<tr>";
                    $servico .= "<th>Produto</th>";
                    $servico .= "<th>Codigo</th>";
                    $servico .= "<th>Marca</th>";
                    $servico .= "<th>Quantidade</th>";
                $servico .= "</tr>";
        foreach ( $user['Carrinho'] as $value ) {
               $servico .= "<tr>"; 
                    $servico .= "<td>".$value['descricao']."</td>";
                    $servico .= "<td>".$value['codigo']."</td>";
                    $servico .= "<td>".$value['marca']."</td>";
                    $servico .= "<td>".$value['qtde']."</td>";
               $servico .= "</tr>";
        }
        $servico .= "</table>";
        $string .= $servico;
        $string .= "<h5> email enviado: ". date( 'd/m/Y' ) . ' ás '. date( 'H:i:s' ) . "</h5><br><br>";
        return $string;
    }
    
    public function prote(){
        echo 'ok';
    }
}

?>