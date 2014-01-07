<?php
/**
 * Classe Projeto de monitoria
 *
 */
class Projetodemonitoria {

  /**
   * Propriedades
   *
   */
  protected
    $id='',
    $resumo='',
    $atividades='',
    $bolsa='',
    $aprovado='',
    $vagasPedidas='',
    $vagasAprovadas='',
    $chTotal='',
    $chSemanal='',
    $periodoInscricaoInicio='',
    $periodoInscricaoFinal='',
    $periodoSelecao='',
    $id_relatorio='',
    $id_edital='',
    $id_selecao='',
    $id_professor='';
  
  /**
   * Construtor
   *
   * @param string $nome Nome completo da pessoa
   */
  public function __construct ($dados){
    //filter_var($dados, FILTER_SANITIZE_STRING);//filtrar
    $this->setResumo($dados['resumo']);
    $this->setBolsa($dados['bolsa']);    
    $this->setAprovado($dados['aprovado']);    
    $this->setVagasPedidas($dados['vagasPedidas']);    
    $this->setVagasAprovadas($dados['vagasAprovadas']);    
    $this->setChTotal($dados['chTotal']);    
    $this->setChSemanal($dados['chSemanal']);    
    $this->setPeriodoInscricaoInicio($dados['periodoInscricaoInicio']);    
    $this->setPeriodoInscricaoFinal($dados['periodoInscricaoFinal']);    
    $this->setPeriodoSelecao($dados['periodoSelecao']);    
   
    $this->setIdProfessor($dados['professor']);       
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

  public function ValidaUsuario($senha2)
  {
    require('../helper/Validacao.class.php');
    $val = new Validacao();
    $val->set($this->getNome(), 'Nome') -> obrigatorio()
      ->set($this->getCPF(),'CPF') -> obrigatorio() -> cpf()
      ->set($this->getEmail(),'Email') -> obrigatorio() ->email()
      ->set($this->getSenha(),'Senha') -> obrigatorio();
  
    $val->compara_senha($senha2);//valida senha
    
    if(!$val->validar())
    {  
      return $val->getErros();
    }
  }
}