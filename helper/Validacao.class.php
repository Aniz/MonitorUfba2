<?php 

/**
 * Classe Para validação da Dados
 * @author David CHC
 * @version 0.1
 *
 */

class Validacao {

    /**
     * Atributo que receberá os valores dos dados da validação
     * e o nome do campo
     * @var ARRAY $dados
     */
    private $dados;
    /**
     * Atributo que receberá as mensagens de erro
     * @var ARRAY $erro
     */
    private $erro = array();

    /**
     * Método que recebe os valores de validação e nome do campo
     * @param STRING $valor
     * @param STRING $nome
     * @return $this (retorna o próprio objeto)
     */
    public function set($valor, $nome) {
        $this->dados = array("valor" => trim($valor), "nome" => $nome);
        return $this;
    }

    /**
     *  Método que verifica se é o valor é obrigatório
     *  @return $this (retorna o próprio objeto)
     */
    public function obrigatorio() {
        if (empty($this->dados['valor'])) {
            $this->erro[] = sprintf("O campo %s é obrigatório", $this->dados['nome']);
        }
        return $this;
    }

    /**
     * Método que verifica se o email é válido
     * @return $this (retorna o próprio objeto)
     */
    public function email() {
        if (!filter_var($this->dados['valor'], FILTER_VALIDATE_EMAIL)) {
            $this->erro[] = sprintf("O campo %s só aceita um e-mail válido", $this->dados['nome']);
        }
        return $this;
    }

     /**
     * Método que verifica se o telefone está no formato (99)9999-9999
     * @return $this (retorna o próprio objeto)
     */
    public function tel() {
        //(99)9999-9999
        if (!preg_match("/^\([0-9]{2}\)[0-9]{4}\-[0-9]{4}$/", $this->dados['valor'])) {
            $this->erro[] = sprintf("O campo %s só aceita o formato (99)9999-9999", $this->dados['nome']);
        }
        return $this;
    }

    //valida data formato
    public function data() {
        //99-99-9999
        if (!preg_match("/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/", $this->dados['valor'])) {
            $this->erro[] = sprintf("O campo %s só aceita no formato 99/99/9999", $this->dados['nome']);
        }
        return $this;
    }

/*
    public function valData ()
    {
        if(preg_match('#^(\d{4})-(\d{2})-(\d{2})$#', $this->dados['valor'], $matches) && checkdate($matches[2], $matches[3], $matches[1]))//valida data
     $this->erro[] = sprintf("data invalida");
            
            return $this;
        }
*/
    //valida data formato e valor :)
    public function valData ($data)
    {
        //if(preg_match('#^(\d{4})-(\d{2})-(\d{2})$#', $data, $matches) && checkdate($matches[2], $matches[3], $matches[1]))//valida data
        if(preg_match('#^(\d{4})-(\d{2})-(\d{2})$#', $data, $matches) && checkdate($matches[2], $matches[3], $matches[1]))//valida data
           
           return true;
        else{
            $this->erro[] = sprintf("O campo Data só aceita se a data for válida e estiver no formato XX/XX/XXXX");
            return false;
        }
    }

    //valida cpf
    public function cpf() {
        //123.123.123-11
        if (!preg_match("/^[0-9]{3}\.[0-9]{3}\.[0-9]{3}\-[0-9]{2,2}$/", $this->dados['valor'])) {
            $this->erro[] = sprintf("O campo %s só aceita o formato XXX.XXX.XXX-XX", $this->dados['nome']);
        }
        return $this;
    }

    //Compara senhas
    public function compara_senha($senha2)
    {
        if(($senha2=="")||($this->dados['valor']!=$senha2))//compara senha e confirmacao
        {
         //   echo "<script>alert(\"Voce digitou senhas diferentes!\");</script>";    
            $this->erro[] = sprintf("Voce Digitou senhas diferentes!");
        return false;
        }
        else
            return true;
     }

    /**
     * Método que verifica se teve alguma mensagem de erro
     * @return BOOLEANO (true/false) 
     */
    public function validar() {
        if (count($this->erro) > 0) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Método que retorna os erros encontrados
     * @return ARRAY $erro
     */
    public function getErros() {
        return $this->erro;
    }
/////////


    /**
     * isCpfValid
     *
     * Esta fun√ß√£o testa se um cpf √© valido ou n√£o. 
     *
     * @author  Raoni Botelho Sporteman <raonibs@gmail.com>
     * @version 1.0 Debugada em 26/09/2011 no PHP 5.3.8
     * @param   string      $cpf            Guarda o cpf como ele foi digitado pelo cliente
     * @param   array       $num            Guarda apenas os n√∫meros do cpf
     * @param   boolean     $isCpfValid     Guarda o retorno da fun√ß√£o
     * @param   int         $multiplica     Auxilia no Calculo dos D√≠gitos verificadores
     * @param   int         $soma           Auxilia no Calculo dos D√≠gitos verificadores
     * @param   int         $resto          Auxilia no Calculo dos D√≠gitos verificadores
     * @param   int         $dg             D√≠gito verificador
     * @return  boolean                     "true" se o cpf √© v√°lido ou "false" caso o contr√°rio
     *
     */
     
    public function isCpfValid()
        {$cpf=$this->dados['valor'];

            //Etapa 1: Cria um array com apenas os digitos num√©ricos, isso permite receber o cpf em diferentes formatos como "000.000.000-00", "00000000000", "000 000 000 00" etc...
            $j=0;
            for($i=0; $i<(strlen($cpf)); $i++)
                {
                    if(is_numeric($cpf[$i]))
                        {
                            $num[$j]=$cpf[$i];
                            $j++;
                        }
                }
            //Etapa 2: Conta os d√≠gitos, um cpf v√°lido possui 11 d√≠gitos num√©ricos.
            if(count($num)!=11)
                {
                    $isCpfValid=false;
                }
            //Etapa 3: Combina√ß√µes como 00000000000 e 22222222222 embora n√£o sejam cpfs reais resultariam em cpfs v√°lidos ap√≥s o calculo dos d√≠gitos verificares e por isso precisam ser filtradas nesta parte.
            else
                {
                    for($i=0; $i<10; $i++)
                        {
                            if ($num[0]==$i && $num[1]==$i && $num[2]==$i && $num[3]==$i && $num[4]==$i && $num[5]==$i && $num[6]==$i && $num[7]==$i && $num[8]==$i)
                                {
                                    $isCpfValid=false;
                                    break;
                                }
                        }
                }
            //Etapa 4: Calcula e compara o primeiro d√≠gito verificador.
            if(!isset($isCpfValid))
                {
                    $j=10;
                    for($i=0; $i<9; $i++)
                        {
                            $multiplica[$i]=$num[$i]*$j;
                            $j--;
                        }
                    $soma = array_sum($multiplica); 
                    $resto = $soma%11;          
                    if($resto<2)
                        {
                            $dg=0;
                        }
                    else
                        {
                            $dg=11-$resto;
                        }
                    if($dg!=$num[9])
                        {
                            $isCpfValid=false;
                        }
                }
            //Etapa 5: Calcula e compara o segundo d√≠gito verificador.
            if(!isset($isCpfValid))
                {
                    $j=11;
                    for($i=0; $i<10; $i++)
                        {
                            $multiplica[$i]=$num[$i]*$j;
                            $j--;
                        }
                    $soma = array_sum($multiplica);
                    $resto = $soma%11;
                    if($resto<2)
                        {
                            $dg=0;
                        }
                    else
                        {
                            $dg=11-$resto;
                        }
                    if($dg!=$num[10])
                        {
                            $this->erro[] = sprintf("cpf invalido");
      
                            $isCpfValid=false;
                        }
                    else
                        {
                            $isCpfValid=true;
                        }
                }
            //Trecho usado para depurar erros.
            /*
            if($isCpfValid==true)
                {
                    echo "<font color=\"GREEN\">Cpf √© V√°lido</font>";
                }
            if($isCpfValid==false)
                {
                    echo "<font color=\"RED\">Cpf Inv√°lido</font>";
                }
            */
            //Etapa 6: Retorna o Resultado em um valor booleano.
            return $isCpfValid;                 
        }
}

?>