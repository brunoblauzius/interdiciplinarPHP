<?php

App::uses('CakeEmail', 'Network/Email');
APP::uses('ConcreteMail', 'Controller/Component');
/**
 * TODO: MODO DE ENVIO DE EMAIL PARA O CAKEPHP
 * TODOS OS ENVIOS DE EMAIL VÃO PASSAR POR ESSA CLASSE CONFORME FOR O METODO!
 * OS DADOS SÃO PASSADOS PELO ARRAY USER!
 * O METHOD BUSCA A FORMATAÇÃO DO EMAIL! 
 * 
 * @author Bruno Blauzius
 */
abstract class AbstractMail extends Component {

    public  $subject      = null;
    public  $emailUser    = null;
    public  $nomeContato  = null;
    
    private $FromMail    = array('suporte@nogarotto.com.br' => 'Nogarotto Orçamento');
    private $emailFormat = 'html'; /**/
    private $config      = 'default';
    private $headers;
    private $cc = 'brunoblauzius@gmail.com';
  
    /**
     * 
     * @param array $user elementos do email para serem enviados
     * @param string $mail para de para quem vai ser enviado
     * @param assunto do email a ser enviado $assunto
     * @param string $method nome da view que o email vai enviar
     * @return type
     */
    public function methodTemplateMail( array $user = null, $mail = null ,$assunto = null, $method = null ){
        try{
            
            
            $this->emailUser   = $mail;
            $this->subject     = $assunto;
            $this->nomeContato = ucwords( $user['Orcamentos']['nome'] );
            $enviarEmail = new CakeEmail();
            //parametros de email do remetente
            
            $enviarEmail
                        ->reset()
                        ->from( $this->FromMail )
                        ->config($this->config )//configuração do email para intec 
                        ->to( $this->emailUser )//envia o email para alguem
                        ->cc( $this->cc )
                        ->subject( $this->subject )//assunto do email
                        ->helpers( array('Html') )
                        ->template( $method )//tampplate a ser usado
                        ->emailFormat( $this->emailFormat )//formato do email |neste caso é html|
                        ->viewVars( array('user'=> $user) );
                        
                        return $enviarEmail->send();

            //echo $this->addBody( $user );
        } catch (Exception $ex) {
            echo json_encode(array(
                'msg' => $ex->getMessage()
            ));
        }
    }
    
    abstract protected function addBody( array $user = null );
    
}

?>
