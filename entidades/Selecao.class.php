<?php
/**
 * Classe Selecao
 *
 */
class Selecao
{
	  /**
	   * Propriedades
	   *
	   */
    protected $id='',
    $nota='',
    $idAluno='',
    $idProjeto='',
    $aprovado='',
    $horarioAtendimento='';

  /**
   * Construtor
   *
   * @param string $nome Nome completo da pessoa
   */
  public function __construct ($dados){
    //filter_var($dados, FILTER_SANITIZE_STRING);//filtrar
    $this->setNota($dados['nota']);
    $this->setIdAluno($dados['aluno']);
    $this->setIdProjeto($dados['projeto']);
    $this->setAprovado($dados['aprovado']);
    $this->setHorarioAtendimento($dados['horarioAtendimento']);
    
  }

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
