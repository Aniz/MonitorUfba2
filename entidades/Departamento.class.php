<?php
/**
 * Classe Departamento
 *
 */
class Departamento
{
  /**
   * Propriedades
   *
   */  
    protected 
    $id='',
    $chefe='',
    $nome='';
    
    /**
   * Construtor
   *
   * @param string $nome Nome completo da pessoa
   */
  public function __construct ($dados){
    //filter_var($dados, FILTER_SANITIZE_STRING);//filtrar
    $this->setChefe($dados['chefe']);
    $this->setNome($dados['nome']);

  }

    public function __call ($metodo, $parametros) {
		
    if (substr($metodo, 0, 3) == 'set') {
      $var = substr(strtolower(preg_replace('/([a-z])([A-Z])/', "$1_$2", $metodo)), 4);
      $this->$var = $parametros[0];
    }

    elseif (substr($metodo, 0, 3) == 'get') {
      

      $var = substr(strtolower(preg_replace('/([a-z])([A-Z])/', "$1_$2", $metodo)), 4);
      return $this->$var;

    }
  }
}


