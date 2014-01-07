<?php

**
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
    $nome='',
    $cpf='',
    $email='',
    $rg='',
    $orgaoEmissor='',
    $senha='',
    $endereco='',
    $telefone='',
    $tipo='',
    $matricula='',
    $departamentoId='';
  /**
   * Construtor
   *
   * @param string $nome Nome completo da pessoa
   */
  public function __construct ($dados){
    //filter_var($dados, FILTER_SANITIZE_STRING);//filtrar
    $this->setNome($dados['nome']);
    $this->setCPF($dados['cpf']);    
    $this->setEmail($dados['email']);
    $this->setRg($dados['rg']);
    $this->setOrgaoEmissor($dados['orgaoEmissor']);
    $this->setSenha($dados['senha']);
    $this->setEndereco($dados['endereco']);
    $this->setTelefone($dados['telefone']);
    $this->setTipo($dados['tipo']);
    $this->setMatricula($dados['matricula']);
    $this->setDepartamentoId($dados['departamentoId']);
    
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

/*
class Professor
{
    private $id;

    private $cpf;

    private $nome;

    private $email;

    private $senha;

    private $rg;

    private $orgaoEmissor;

    private $endereco;

    private $telefone;

    private $tipo;

    private $matricula;

    private $departamentoDepartamento;


    public function getId()
    {
        return $this->id;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    
        return $this;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    
        return $this;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    
        return $this;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setRg($rg)
    {
        $this->rg = $rg;
    
        return $this;
    }

    public function getRg()
    {
        return $this->rg;
    }

    public function setOrgaoEmissor($orgaoEmissor)
    {
        $this->orgaoEmissor = $orgaoEmissor;
    
        return $this;
    }

    public function getOrgaoEmissor()
    {
        return $this->orgaoEmissor;
    }

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    
        return $this;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
    
        return $this;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setMatricula($matricula)
    {
        $this->matricula = $matricula;
    
        return $this;
    }

    public function getMatricula()
    {
        return $this->matricula;
    }
    
    public function setDepartamentoDepartamento(\Bd\MonitorUfbaBundle\Entity\Departamento $departamentoDepartamento = null)
    {
        $this->departamentoDepartamento = $departamentoDepartamento;
    
        return $this;
    }

    public function getDepartamentoDepartamento()
    {
        return $this->departamentoDepartamento;
    }
    */
}