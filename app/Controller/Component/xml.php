<?php
class MyClassXml{
    
    /** @var String*/
    private static $atribute = null;
    /** @var String*/
    private static $arquiv   = 'xml.xml';
    /** @var String*/
    private static $nameAtribute = null;
    /** @var String*/
    private static $error = 'Documento esta sendo gerado sem conteudo';
    /** @var Array*/
    private static $array = array();
    /** @var SimpleXmlElement*/
    private static $xml = null;


    /*Ao instanciar a classe ela gera o XML */
    
    /*
     * TODO: classe construtora do XML são passados tres parametros
     * o atributo -> o elemento xml como um todo
     * o nome do atributo -> o nome to elemento inteiro
     * o array -> serão todos os valores que eu preciso para montar meu xml 
     * OBS: se existir array dentro de array ele vai ler normalmente e executar.
     * de preferencia monte o array da forma que você queira que o xml fique
     */
    
    public function __construct( $atribute = null , $nameAtribute = null, array $array = null ) {
        
        self::$atribute     = $atribute;
        self::$nameAtribute = $nameAtribute;
        self::$array        = $array;
        MyClassXml::criarNodeXML( self::$array );
    }
    
    
    /**
    * TODO: classe que cria o node principal
    * @param array $array -> array de valores
    */
    public static function criarNodeXML( array $arrayMaster = null ){
        $doc = new DOMDocument();
        $corpoXml = $doc->createElement('corpoXml');
        if( is_array($arrayMaster) ) {
            foreach ($arrayMaster as $array) {
                $corpoXml->setAttribute( self::$atribute , self::$nameAtribute);
                $corpoXml =  self::addNodeXML( $array, $doc, $corpoXml );
                $doc->appendChild($corpoXml);
            }
        }
        $doc->save( self::$arquiv );
    }
    
    /**
     * TODO: classe responsavel por gerar ou adicionar novos node ao corpo do xml
     * 
     * @param array $array array de parametros e valores a serem criados
     * @param type $doc Objeto DOMDocument()
     * @param type $paiElement Elemento pai ou o principal
     * @return type xml
     */
    public static function addNodeXML( array $array = NULL, DOMDocument $doc = NULL, $paiElement = NULL ){
        if( is_array($array) && !empty($array) ) {
            $elemento = NULL;
            foreach ( $array as $key => $value ) {
                if( !is_array($value) ) {
                    $elemento = $doc->createElement( $key, $value );
                    $paiElement->appendChild( $elemento );
                } else {
                    $NewNode    = $doc->createElement( $key );
                    $NewNode    = self::addNodeXML( $value, $doc, $NewNode );
                    $paiElement->appendChild( $NewNode );
                }
            }
            return $paiElement;
        } else {
            echo self::$error;
        }
    }
    
    /**
     * TODO: methodo de leitura do arquivo com o retorno em DOMDoc;
     * FORMATO NA VIEW
     * 
      foreach (MyClassXml::readFileXml()->getElementsByTagName('PESSOA') as $node ) 
        echo $node->getElementsByTagName('id')->item(0)->nodeValue.'<br>';
        echo $node->getElementsByTagName('nome')->item(0)->nodeValue.'<br>';
        echo $node->getElementsByTagName('email')->item(0)->nodeValue.'<br><br>';
     * 
     * @param type $nameArquivo nome do arquivo xml
     * @return type objecto DOMELEMENT
     */
    public static function readFileXml( $nameArquivo = null ) {
        if( !is_null($nameArquivo) ){
            self::$arquiv = $nameArquivo;
        }
            $DOM = new DOMDocument();
            $DOM->load( self::$arquiv );
            return $DOM;
    }
    
    /**
     * TODO: cria meu elemento simpleXML 
     * @return SimpleXMLElement
     */
    public static function simpleXmlLoadFile( ) {
        return simplexml_load_file( self::$arquiv );
    }
    
    /**
     * TODO: 
     * @param array $nodeSuperior referenciando o node a ser selecionado
     * @param string $title o titulo do node 
     * @param string $string o valor a ser encontrado
     * @return SimpleXMLElement/String contendo meu xml da procura
     * @throws Exception 
     */
    public static function xPathXml( array $nodeSuperior = null, $title = null, $string = null ) {
        try{
            if ( !empty($nodeSuperior) && !empty($title) && !empty($string) ) {
                $nodeSuperior = implode('/', $nodeSuperior);
                self::$xml = self::simpleXmlLoadFile()->xpath("//{$nodeSuperior}[contains({$title}, '{$string}')]");
                    if( empty(self::$xml) ) {
                        throw new Exception('Nenhum cadastro registrado');
                    }
                return self::$xml;
            } else {
                throw new Exception('nenhum cabeçalho foi enviado para procura');
            }
        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }

    public static function geraUserName ( $string = null ){
        if( $string ){
            $alunos = explode(' ', $string);
            if( count($alunos) > 1 ){
                return strtolower( $alunos[0] . '_' . $alunos[1]);
            } else {
                return $alunos;
            }
        } else {
            return 'aluno';
        }
    }
    

}

$array[] = array(
    'PESSOA' => array(
        'id'    => 1,
        'cdempresa'=> 8,
        'nome'  => 'BRUNO BLAUZIUS SCHUINDT',
        'rg'    => '005659898787',
        'cpf'   => '021857845454',
        'email' => 'brunoblauzius@mail.com',
        'codepin'   => 'AX2325',
        'endereco' => array(
            'logradouro' => 'RUA LEILA DINIZ, 531',
            'bairro'   => 'vila maria antonieta',
            'uf'       => 'PR',
            'cep' => '83331210',
        ),
    ),
    
);
$array[] = array(
    'PESSOA' => array(
        'id'    => 2,
        'cdempresa'=> 8,
        'nome'  => 'GLORIA AP. BLAUZIUS SCHUINDT',
        'rg'    => '005659898787',
        'cpf'   => '021857845454',
        'email' => 'glorinha@mail.com',
        'codepin'   => 'BX2325',
        'endereco' => array(
            'logradouro' => 'RUA LEILA DINIZ, 531',
            'bairro'   => 'vila maria antonieta',
            'uf'       => 'PR',
            'cep' => '83331210',
        ),
    ),
    
);

$xml = MyClassXml::xPathXml( array('cabecalho'), 'nome', 'Bruno' );
echo '<pre>';
print_r($xml);
echo '</pre>';