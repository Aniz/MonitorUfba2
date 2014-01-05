<?php


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
}