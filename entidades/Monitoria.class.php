<?php
/**
 * Classe Monitoria
 *
 */
class Monitoria
{
    /**
   * Propriedades
   *
   */
    protected 
    $id='',
    $dataInicio='',
    $dataFim='',
    $semestre='',
    $status='',
    $bolsa='',
    $unidade='',
    $orgao='',
    $componentesCurriculres='',

    $idRelatorioAluno='',
    $idRelatorioProfessor='',
    $idProfessorOrientador='',
    $idAluno='',
    $idCertificado='',
    $idProfessor='';

/**
   * Construtor
   *
   * @param string $nome Nome completo da pessoa
   */
  public function __construct ($dados){
    //filter_var($dados, FILTER_SANITIZE_STRING);//filtrar
    $this->setDataInicio($dados['dataInicio']);
    $this->setDataFim($dados['dataFim']);
    $this->setSemestre($dados['semestre']);
    $this->setStatus($dados['status']);
    $this->setBolsa($dados['bolsa']);
    $this->setUnidade($dados['unidade']);
    $this->setOrgao($dados['orgao']);
    $this->setComponentesCurriculares($dados['componentesCurriculres']);
  
    $this->setIdProfessor($dados['idProfessor']);
    $this->setIdAluno($dados['idAluno']);
    $this->setIdProfessorOrientador($dados['idProfessorOrientador']);

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
?>