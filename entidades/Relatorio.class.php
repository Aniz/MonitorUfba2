<?php

/**
 * Classe Professor
 *
 */
require_once '../helper/funcoes.php';

class Professor {

  /**
   * Propriedades
   *
   */
  protected
    $id='',
    $arquivo='';
  /**
   * Construtor
   *
   * @param string $nome Nome completo da pessoa
   */
  public function __construct ($dados){
    //filter_var($dados, FILTER_SANITIZE_STRING);//filtrar
    $this->setNome($dados['arquivo']);
   
    
  }

  /**
   * Overloading.
   *
   * Esse método não é chamado diretamente. Ele irá interceptar chamadas
   * a métodos não definidos na classe. Se for um set* ou get* irá realizar
   * as ações necessárias sobre as propriedades da classe.
   *
   * @param string $metodo O nome do método quer será chamado
   * @param array $parametros Parâmetros que serão passados aos métodos
   * @return mixed
   */
  public function __call ($metodo, $parametros) {
    // se for set*, "seta" um valor para a propriedade
    if (substr($metodo, 0, 3) == 'set') {
      $var = substr(strtolower(preg_replace('/([a-z])([A-Z])/', "$1_$2", $metodo)), 4);
      $this->$var = $parametros[0];
    }
    // se for get*, retorna o valor da propriedade
    elseif (substr($metodo, 0, 3) == 'get') {
      

      $var = substr(strtolower(preg_replace('/([a-z])([A-Z])/', "$1_$2", $metodo)), 4);
      return $this->$var;

    }
  }  
}