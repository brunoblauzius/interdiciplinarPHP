<?php

/*
 * Biblioteca Component padrão para fazer upload de arquivos e tratamentos para 
 * gravar no banco de dados
 * 
 */

/**
 * Description of LibraryComponent
 *
 * @author Bruno blauzius schuindt
 */
class UtilComponent extends Component {
    
    //@var private int
    private $cnpj_cpf = null;
    //@var private int
    private $data     = null;
    //@var string do caminho path
    private $path = '/var/www/uploads/moura/';
    //@var null
    private $zip  = null;
    
    /*
     * funcao de retorno do arquivo ele gera a pasta se não existir e upa o arquivo para dentro da pasta
     * entrada: artquivo txt
     * saida: array do conteudo do txt
     * 
     */
    public function retornoArquivoArray($cd_empresa, $file ) {
        ini_set("memory_limit", "100M");
        if( !file_exists( $this->path.$cd_empresa ) ) {
            mkdir( $this->path.$cd_empresa, 0777 );
            chmod( $this->path.$cd_empresa, 0777 );
        }
        ///fazer upload para a pasta do arquivo
        $retorno = move_uploaded_file( $file["tmp_name"], $this->path . $cd_empresa . DS . $file["name"] );
        //verifico se o meu retorno é falso caso nao ocorra o move_upload
        if( $retorno != FALSE ) {
            $dados = file( $this->path . $cd_empresa . DS . $file["name"] );
            return $dados;
        } else {
            return FALSE; 
        }
    }
    
    
     /*
     * funcao de retorno do arquivo ele gera a pasta se não existir e upa o arquivo para dentro da pasta
     * entrada: artquivo txt
     * saida: array do conteudo do txt
     * 
     */
    public function verificaRetornaArquivo( $caminho , $file_name ) {
        if( file_exists( $caminho."/tmp/".$file_name ) ) {
            $array = array();
            $dados = file( $caminho."/tmp/".$file_name );
            $file_name = substr($file_name, 0,-4);
            $array[$file_name] = $dados;
            return $array;
        } else {
            return FALSE; 
        }
    }
    
    
    
    
    /**
     * methodo de extração de arquivos no zip
     * @param type $file arquivo a ser extraido o conteudo
     * @param type $cd_empresa numero da empresa no banco de dados
     */
    
    public function extractToFile( $nome = null, $tmp_name = null , $type = null , $erro = null , $caminho = null)
    {
        /**
         * TODO:
         * caminho da pasta /var/www/uploads/moura/40 
         * no caso a empresa é 40 mais poderia ser qualquer outra
         */
        $this->path = $caminho;
        if( $erro == 4 )
            return  "Arquivo zip está vazio";
        //aqui ele faz upload de txt
        else if ( $type == "text/plain" )
        {
           if( !file_exists( $this->path ) ) {
                mkdir( $this->path, 0777 );
                chmod( $this->path, 0777 );
            }
            $retorno = move_uploaded_file( $tmp_name, $this->path . "/tmp/" . $nome);
            if( $retorno != FALSE ) {
                return TRUE;
            } else {
                return FALSE;
            }
        }
        // faz o upload de zip e logo em seguida faz a extração do arquivo
        else if ( $type == "application/zip"  ) {
            if( !file_exists( $this->path ) ) {
                mkdir( $this->path, 0777 );
                chmod( $this->path, 0777 );
            }
            $retorno = move_uploaded_file( $tmp_name, $this->path . DS . $nome);
            if( $retorno != FALSE ) {
                          //EXEC             ORIGEM                ?      DESTINO
                shell_exec( $exec = "unzip {$this->path}/{$nome}  -d  ".$this->path. DS . 'tmp' );
                return TRUE;
            } else {
                return FALSE;
            }
        }//end else
    }
    
    /**
     * 
     * metodo que busca os arquivos da pasta selecionada
     * 
     * @param type $path caminho do diretorio
     * @return type array de arquivos encontrados
     */
    
    public function lerDiretorio( $path ) {
        $arquivos =  scandir( $path );   
        $valor = array();
        if( is_array( $arquivos ) ) {
            foreach( $arquivos as $key => $value ) {
                if( $value != "." && $value != ".." )
                   $valor[] =  $value;    
            }    
        }
        return $valor;
    }
        
    /*
     * funcao utilizada para formatação de string 
     * nela eu so retiro os numeros
     */
    public function retornaNumeroStr( $str ) {
        return preg_replace("/[^0-9]/", "", $str);
    }
    
     public function ConvertStringSystem( array $array = null, $typeFormat = null ){
        if(is_array($array)){
            $newArray = array();
            if( is_null( $typeFormat ) ) {
                foreach ($array as $key => $value) {
                    $newArray[$key] = self::strToLower( $value );
                }
            } else if( strtolower($typeFormat) == 'upper' ){
                foreach ($array as $key => $value) {
                    $newArray[$key] = self::strToUpper( $value );
                }
            } else if( strtolower($typeFormat) == 'ucwords' ){
                foreach ($array as $key => $value) {
                    $newString      = self::strToLower( $value );
                    $newArray[$key] = self::strUcWords( $newString );
                }
            }
        } 
        return $newArray;
    }
    
    
    /**
     * funcao usada para converter strings com acentuação ou não para minuscula
     * @param type $string
     * @return type
     */
    
    public function strToLower( $string = '' ) {
//        /$string = htmlentities($string, ENT_QUOTES, "UTF-8");
        $string = strip_tags( trim( $string ) );
        $maiusculaAcentuada = array("Ã","Á",'À','Â','Ä','Ç','É','È','Ê','Ë','Ó','Ò','Ô','Õ','Ö','Í','Ì','Î','Ï','Ú','Ù','Û','Ü',);
        $minusculaAcentuada = array('ã','á','à','â','ä','ç','é','è','ê','ë','ó','ò','ô','õ','ö','í','ì','î','ï','ú','ù','û','ü',);
        $string = str_replace( $maiusculaAcentuada, $minusculaAcentuada, $string );
        return strtolower( trim( ( mysql_escape_string ($string) ) )  );
    }
    
    
    public function strUcWords( $string = NULL ) {
//        /$string = htmlentities($string, ENT_QUOTES, "UTF-8");
        $string = strip_tags( trim( $string ) );
        $maiusculaAcentuada = array("Ã","Á",'À','Â','Ä','Ç','É','È','Ê','Ë','Ó','Ò','Ô','Õ','Ö','Í','Ì','Î','Ï','Ú','Ù','Û','Ü',);
        $minusculaAcentuada = array('ã','á','à','â','ä','ç','é','è','ê','ë','ó','ò','ô','õ','ö','í','ì','î','ï','ú','ù','û','ü',);
        $string = str_replace( $maiusculaAcentuada, $minusculaAcentuada, $string );
        return ucwords( trim( ( mysql_escape_string ($string) ) ) );
    }
    
    
    /**
     * funcao usada para converter strings com acentuação ou não para Maiuscula
     * @param type $string
     * @return type
     */
    
    public function strToUpper( $string='' ) {
        //$string = htmlentities($string, ENT_QUOTES, "UTF-8");
        $string = strip_tags( trim( $string ) );
        $maiusculaAcentuada = array("Ã","Á",'À','Â','Ä','Ç','É','È','Ê','Ë','Ó','Ò','Ô','Õ','Ö','Í','Ì','Î','Ï','Ú','Ù','Û','Ü',);
        $minusculaAcentuada = array('ã','á','à','â','ä','ç','é','è','ê','ë','ó','ò','ô','õ','ö','í','ì','î','ï','ú','ù','û','ü',);
        $string = str_replace( $minusculaAcentuada, $maiusculaAcentuada, $string );
        return strtoupper( trim( ( mysql_escape_string ($string)  ) ) );
    }
    
    /**
     * TODO: foi usada na classe clientescontroller somente no limite de credito
     * @param type $string string a ser modificada
     * @return type $string formatada 
     */
    
    public function strReplaceMoeda($string = null) {
        $string = str_replace(".", "", $string);
        return str_replace(",", ".", $string);
    }
    
    /*
     * funcao usada para converter moeda para float em formato banco de dados
     */
       
    public function formatMoeda( $string ) {
        return number_format( (float) $string , 2, ".", "." );
    }
    
    
    /*
     * função para converter data em formato para banco de dados 
     * tipo de saida: 0000-00-00
     */
      
    public function converteDataParaDb( $data = NULL ) {
        $data = str_replace('-', '', $data);
        if ( $data == 0 ) {
            return $data;
        }
        if( is_numeric( $data ) ) {
            $ano = substr( $data, 0,4 );
            $mes = substr($data, 4, 2 );
            $dia = substr($data, -2 );
            $this->data = $ano."-".$mes."-".$dia;
        } else {
            $data = explode( "/", $data );
            $ano = $data[2];
            $mes = $data[1];
            $dia = $data[0];
            $this->data = $ano."-".$mes."-".$dia;
        } 
        return $this->data;
    }
    
    /**
     * TODO:    data vindo do banco de dados, metodo para formata a data de 0000-00-00 para 00/00/0000
     * @param type $data DATA VINDA DO BANCO DE DADOS
     * @return type DATA FORMATADA
     */
    public function converteDataParaView( $data = NULL ) {
        $data = explode("-", $data);
        $ano = $data[0];
        $mes = $data[1];
        $dia = $data[2];
        return $dia . DS . $mes . DS . $ano;
    }
    

    /*
     * entrada: limpa string cpf ou cnpj para o banco de dados 
     * retorno: somente caracteres numericos.
     * 
     */
    public function limpaCnpjCpf( $cnpj_cpf ) {
        //verifico se é numerico
        if( is_numeric( $cnpj_cpf ) ) {
            return $cnpj_cpf;
        }
        //verifica se existe a ocorrencia ou o caracter na string
        if( stristr( $cnpj_cpf, '/' ) ) {
            $cnpj_cpf = explode( "/", $cnpj_cpf );
            $cnpj_cpf = $cnpj_cpf[0].$cnpj_cpf[1];
        }
        $cnpj_cpf       = explode( "-", $cnpj_cpf );
        $cnpj_cpf       = $cnpj_cpf[0].$cnpj_cpf[1];
        $cnpj_cpf       = explode(".", $cnpj_cpf);
        $this->cnpj_cpf = $cnpj_cpf[0].$cnpj_cpf[1].$cnpj_cpf[2];
        
        return $this->cnpj_cpf;
    }

    /**
     * TODO: metodo para gerar user name para tabela USERs 
     * @param type $string
     * @return string
     */
    public function geraUserName ( $string = null ) {
        if( $string ){
            $alunos = explode(' ', $string);
            return $alunos[0] . '_' . $alunos[1];
        } else {
            return 'aluno';
        }
    }
    
    
    public function urlAmigavel( $string = null ) {
        $table = array(
            'Š'=>'S', 'š'=>'s', 'Đ'=>'Dj', 'đ'=>'dj', 'Ž'=>'Z',
            'ž'=>'z', 'Č'=>'C', 'č'=>'c', 'Ć'=>'C', 'ć'=>'c',
            'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
            'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
            'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
            'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O',
            'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
            'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss',
            'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
            'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e',
            'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
            'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o',
            'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
            'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b',
            'ÿ'=>'y', 'Ŕ'=>'R', 'ŕ'=>'r',
        );
        // Traduz os caracteres em $string, baseado no vetor $table
        $string = strtr($string, $table);
        // converte para minúsculo
        $string = strtolower($string);
        // remove caracteres indesejáveis (que não estão no padrão)
        $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
        // Remove múltiplas ocorrências de hífens ou espaços
        $string = preg_replace("/[\s-]+/", " ", $string);
        // Transforma espaços e underscores em hífens
        $string = preg_replace("/[\s_]/", "-", $string);
        // retorna a string
        return $string;
    }
    
    
    public function zerosLeft( $int = NULL ){
        return str_pad($int, 10, '0', STR_PAD_LEFT);
    }
    
}

