<?php

namespace Bd\MonitorUfbaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Monitoria
 *
 * @ORM\Table(name="monitoria")
 * @ORM\Entity
 */
class Monitoria
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
     * @var \DateTime
     *
     * @ORM\Column(name="data_inicio", type="date", nullable=true)
     */
    private $dataInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_fim", type="date", nullable=true)
     */
    private $dataFim;

    /**
     * @var string
     *
     * @ORM\Column(name="semestre", type="string", length=5, nullable=true)
     */
    private $semestre;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=45, nullable=true)
     */
    private $status;

    /**
     * @var boolean
     *
     * @ORM\Column(name="bolsa", type="boolean", nullable=true)
     */
    private $bolsa;

    /**
     * @var string
     *
     * @ORM\Column(name="id_relatorio_aluno", type="string", length=45, nullable=true)
     */
    private $idRelatorioAluno;

    /**
     * @var string
     *
     * @ORM\Column(name="id_relatorio_professor", type="string", length=45, nullable=true)
     */
    private $idRelatorioProfessor;

    /**
     * @var string
     *
     * @ORM\Column(name="unidade", type="string", length=45, nullable=true)
     */
    private $unidade;

    /**
     * @var string
     *
     * @ORM\Column(name="orgao", type="string", length=45, nullable=true)
     */
    private $orgao;

    /**
     * @var string
     *
     * @ORM\Column(name="componentes_curriculres", type="string", length=45, nullable=true)
     */
    private $componentesCurriculres;

    /**
     * @var string
     *
     * @ORM\Column(name="termo", type="string", length=45, nullable=true)
     */
    private $termo;

    /**
     * @var integer
     *
     * @ORM\Column(name="id_professor_orientador", type="integer", nullable=true)
     */
    private $idProfessorOrientador;

    /**
     * @var \Aluno
     *
     * @ORM\ManyToOne(targetEntity="Aluno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="aluno_id_aluno", referencedColumnName="id")
     * })
     */
    private $alunoAluno;

    /**
     * @var \Certificado
     *
     * @ORM\ManyToOne(targetEntity="Certificado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="certificado_id_certificado", referencedColumnName="id")
     * })
     */
    private $certificadoCertificado;

    /**
     * @var \Professor
     *
     * @ORM\ManyToOne(targetEntity="Professor")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="professor_id_professor", referencedColumnName="id")
     * })
     */
    private $professorProfessor;

    /**
     * @var \Relatorio
     *
     * @ORM\ManyToOne(targetEntity="Relatorio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="relatorio_id_relatorio", referencedColumnName="id")
     * })
     */
    private $relatorioRelatorio;



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
     * Set dataInicio
     *
     * @param \DateTime $dataInicio
     * @return Monitoria
     */
    public function setDataInicio($dataInicio)
    {
        $this->dataInicio = $dataInicio;
    
        return $this;
    }

    /**
     * Get dataInicio
     *
     * @return \DateTime 
     */
    public function getDataInicio()
    {
        return $this->dataInicio;
    }

    /**
     * Set dataFim
     *
     * @param \DateTime $dataFim
     * @return Monitoria
     */
    public function setDataFim($dataFim)
    {
        $this->dataFim = $dataFim;
    
        return $this;
    }

    /**
     * Get dataFim
     *
     * @return \DateTime 
     */
    public function getDataFim()
    {
        return $this->dataFim;
    }

    /**
     * Set semestre
     *
     * @param string $semestre
     * @return Monitoria
     */
    public function setSemestre($semestre)
    {
        $this->semestre = $semestre;
    
        return $this;
    }

    /**
     * Get semestre
     *
     * @return string 
     */
    public function getSemestre()
    {
        return $this->semestre;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Monitoria
     */
    public function setStatus($status)
    {
        $this->status = $status;
    
        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set bolsa
     *
     * @param boolean $bolsa
     * @return Monitoria
     */
    public function setBolsa($bolsa)
    {
        $this->bolsa = $bolsa;
    
        return $this;
    }

    /**
     * Get bolsa
     *
     * @return boolean 
     */
    public function getBolsa()
    {
        return $this->bolsa;
    }

    /**
     * Set idRelatorioAluno
     *
     * @param string $idRelatorioAluno
     * @return Monitoria
     */
    public function setIdRelatorioAluno($idRelatorioAluno)
    {
        $this->idRelatorioAluno = $idRelatorioAluno;
    
        return $this;
    }

    /**
     * Get idRelatorioAluno
     *
     * @return string 
     */
    public function getIdRelatorioAluno()
    {
        return $this->idRelatorioAluno;
    }

    /**
     * Set idRelatorioProfessor
     *
     * @param string $idRelatorioProfessor
     * @return Monitoria
     */
    public function setIdRelatorioProfessor($idRelatorioProfessor)
    {
        $this->idRelatorioProfessor = $idRelatorioProfessor;
    
        return $this;
    }

    /**
     * Get idRelatorioProfessor
     *
     * @return string 
     */
    public function getIdRelatorioProfessor()
    {
        return $this->idRelatorioProfessor;
    }

    /**
     * Set unidade
     *
     * @param string $unidade
     * @return Monitoria
     */
    public function setUnidade($unidade)
    {
        $this->unidade = $unidade;
    
        return $this;
    }

    /**
     * Get unidade
     *
     * @return string 
     */
    public function getUnidade()
    {
        return $this->unidade;
    }

    /**
     * Set orgao
     *
     * @param string $orgao
     * @return Monitoria
     */
    public function setOrgao($orgao)
    {
        $this->orgao = $orgao;
    
        return $this;
    }

    /**
     * Get orgao
     *
     * @return string 
     */
    public function getOrgao()
    {
        return $this->orgao;
    }

    /**
     * Set componentesCurriculres
     *
     * @param string $componentesCurriculres
     * @return Monitoria
     */
    public function setComponentesCurriculres($componentesCurriculres)
    {
        $this->componentesCurriculres = $componentesCurriculres;
    
        return $this;
    }

    /**
     * Get componentesCurriculres
     *
     * @return string 
     */
    public function getComponentesCurriculres()
    {
        return $this->componentesCurriculres;
    }

    /**
     * Set termo
     *
     * @param string $termo
     * @return Monitoria
     */
    public function setTermo($termo)
    {
        $this->termo = $termo;
    
        return $this;
    }

    /**
     * Get termo
     *
     * @return string 
     */
    public function getTermo()
    {
        return $this->termo;
    }

    /**
     * Set idProfessorOrientador
     *
     * @param integer $idProfessorOrientador
     * @return Monitoria
     */
    public function setIdProfessorOrientador($idProfessorOrientador)
    {
        $this->idProfessorOrientador = $idProfessorOrientador;
    
        return $this;
    }

    /**
     * Get idProfessorOrientador
     *
     * @return integer 
     */
    public function getIdProfessorOrientador()
    {
        return $this->idProfessorOrientador;
    }

    /**
     * Set alunoAluno
     *
     * @param \Bd\MonitorUfbaBundle\Entity\Aluno $alunoAluno
     * @return Monitoria
     */
    public function setAlunoAluno(\Bd\MonitorUfbaBundle\Entity\Aluno $alunoAluno = null)
    {
        $this->alunoAluno = $alunoAluno;
    
        return $this;
    }

    /**
     * Get alunoAluno
     *
     * @return \Bd\MonitorUfbaBundle\Entity\Aluno 
     */
    public function getAlunoAluno()
    {
        return $this->alunoAluno;
    }

    /**
     * Set certificadoCertificado
     *
     * @param \Bd\MonitorUfbaBundle\Entity\Certificado $certificadoCertificado
     * @return Monitoria
     */
    public function setCertificadoCertificado(\Bd\MonitorUfbaBundle\Entity\Certificado $certificadoCertificado = null)
    {
        $this->certificadoCertificado = $certificadoCertificado;
    
        return $this;
    }

    /**
     * Get certificadoCertificado
     *
     * @return \Bd\MonitorUfbaBundle\Entity\Certificado 
     */
    public function getCertificadoCertificado()
    {
        return $this->certificadoCertificado;
    }

    /**
     * Set professorProfessor
     *
     * @param \Bd\MonitorUfbaBundle\Entity\Professor $professorProfessor
     * @return Monitoria
     */
    public function setProfessorProfessor(\Bd\MonitorUfbaBundle\Entity\Professor $professorProfessor = null)
    {
        $this->professorProfessor = $professorProfessor;
    
        return $this;
    }

    /**
     * Get professorProfessor
     *
     * @return \Bd\MonitorUfbaBundle\Entity\Professor 
     */
    public function getProfessorProfessor()
    {
        return $this->professorProfessor;
    }

    /**
     * Set relatorioRelatorio
     *
     * @param \Bd\MonitorUfbaBundle\Entity\Relatorio $relatorioRelatorio
     * @return Monitoria
     */
    public function setRelatorioRelatorio(\Bd\MonitorUfbaBundle\Entity\Relatorio $relatorioRelatorio = null)
    {
        $this->relatorioRelatorio = $relatorioRelatorio;
    
        return $this;
    }

    /**
     * Get relatorioRelatorio
     *
     * @return \Bd\MonitorUfbaBundle\Entity\Relatorio 
     */
    public function getRelatorioRelatorio()
    {
        return $this->relatorioRelatorio;
    }
}