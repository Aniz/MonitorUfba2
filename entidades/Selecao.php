<?php

namespace Bd\MonitorUfbaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Selecao
 *
 * @ORM\Table(name="selecao")
 * @ORM\Entity
 */
class Selecao
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nota", type="string", length=45, nullable=true)
     */
    private $nota;

    /**
     * @var string
     *
     * @ORM\Column(name="id_aluno", type="string", length=45, nullable=true)
     */
    private $idAluno;

    /**
     * @var string
     *
     * @ORM\Column(name="id_projeto", type="string", length=45, nullable=true)
     */
    private $idProjeto;

    /**
     * @var string
     *
     * @ORM\Column(name="aprovado", type="string", length=45, nullable=true)
     */
    private $aprovado;

    /**
     * @var string
     *
     * @ORM\Column(name="horario_atendimento", type="string", length=45, nullable=true)
     */
    private $horarioAtendimento;



    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nota
     *
     * @param string $nota
     * @return Selecao
     */
    public function setNota($nota)
    {
        $this->nota = $nota;
    
        return $this;
    }

    /**
     * Get nota
     *
     * @return string 
     */
    public function getNota()
    {
        return $this->nota;
    }

    /**
     * Set idAluno
     *
     * @param string $idAluno
     * @return Selecao
     */
    public function setIdAluno($idAluno)
    {
        $this->idAluno = $idAluno;
    
        return $this;
    }

    /**
     * Get idAluno
     *
     * @return string 
     */
    public function getIdAluno()
    {
        return $this->idAluno;
    }

    /**
     * Set idProjeto
     *
     * @param string $idProjeto
     * @return Selecao
     */
    public function setIdProjeto($idProjeto)
    {
        $this->idProjeto = $idProjeto;
    
        return $this;
    }

    /**
     * Get idProjeto
     *
     * @return string 
     */
    public function getIdProjeto()
    {
        return $this->idProjeto;
    }

    /**
     * Set aprovado
     *
     * @param string $aprovado
     * @return Selecao
     */
    public function setAprovado($aprovado)
    {
        $this->aprovado = $aprovado;
    
        return $this;
    }

    /**
     * Get aprovado
     *
     * @return string 
     */
    public function getAprovado()
    {
        return $this->aprovado;
    }

    /**
     * Set horarioAtendimento
     *
     * @param string $horarioAtendimento
     * @return Selecao
     */
    public function setHorarioAtendimento($horarioAtendimento)
    {
        $this->horarioAtendimento = $horarioAtendimento;
    
        return $this;
    }

    /**
     * Get horarioAtendimento
     *
     * @return string 
     */
    public function getHorarioAtendimento()
    {
        return $this->horarioAtendimento;
    }
}