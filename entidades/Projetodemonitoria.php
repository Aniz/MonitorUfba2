<?php

namespace Bd\MonitorUfbaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Projetodemonitoria
 *
 * @ORM\Table(name="projetoDeMonitoria")
 * @ORM\Entity
 */
class Projetodemonitoria
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
     * @ORM\Column(name="resumo", type="string", length=45, nullable=false)
     */
    private $resumo;

    /**
     * @var string
     *
     * @ORM\Column(name="atividades", type="string", length=45, nullable=true)
     */
    private $atividades;

    /**
     * @var boolean
     *
     * @ORM\Column(name="bolsa", type="boolean", nullable=true)
     */
    private $bolsa;

    /**
     * @var boolean
     *
     * @ORM\Column(name="aprovado", type="boolean", nullable=true)
     */
    private $aprovado;

    /**
     * @var integer
     *
     * @ORM\Column(name="vagas_pedidas", type="integer", nullable=false)
     */
    private $vagasPedidas;

    /**
     * @var integer
     *
     * @ORM\Column(name="vagas_aprovadas", type="integer", nullable=true)
     */
    private $vagasAprovadas;

    /**
     * @var integer
     *
     * @ORM\Column(name="ch_total", type="integer", nullable=true)
     */
    private $chTotal;

    /**
     * @var integer
     *
     * @ORM\Column(name="ch_semanal", type="integer", nullable=true)
     */
    private $chSemanal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="periodo_inscricao_inicio", type="datetime", nullable=true)
     */
    private $periodoInscricaoInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="periodo_inscricao_final", type="datetime", nullable=true)
     */
    private $periodoInscricaoFinal;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="periodo_selecao", type="datetime", nullable=true)
     */
    private $periodoSelecao;

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
     * @var \Edital
     *
     * @ORM\ManyToOne(targetEntity="Edital")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="edital_id_codigo", referencedColumnName="id")
     * })
     */
    private $editalCodigo;

    /**
     * @var \Selecao
     *
     * @ORM\ManyToOne(targetEntity="Selecao")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="selecao_id", referencedColumnName="id")
     * })
     */
    private $selecao;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set resumo
     *
     * @param string $resumo
     * @return Projetodemonitoria
     */
    public function setResumo($resumo)
    {
        $this->resumo = $resumo;
    
        return $this;
    }

    /**
     * Get resumo
     *
     * @return string 
     */
    public function getResumo()
    {
        return $this->resumo;
    }

    /**
     * Set atividades
     *
     * @param string $atividades
     * @return Projetodemonitoria
     */
    public function setAtividades($atividades)
    {
        $this->atividades = $atividades;
    
        return $this;
    }

    /**
     * Get atividades
     *
     * @return string 
     */
    public function getAtividades()
    {
        return $this->atividades;
    }

    /**
     * Set bolsa
     *
     * @param boolean $bolsa
     * @return Projetodemonitoria
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
     * Set aprovado
     *
     * @param boolean $aprovado
     * @return Projetodemonitoria
     */
    public function setAprovado($aprovado)
    {
        $this->aprovado = $aprovado;
    
        return $this;
    }

    /**
     * Get aprovado
     *
     * @return boolean 
     */
    public function getAprovado()
    {
        return $this->aprovado;
    }

    /**
     * Set vagasPedidas
     *
     * @param integer $vagasPedidas
     * @return Projetodemonitoria
     */
    public function setVagasPedidas($vagasPedidas)
    {
        $this->vagasPedidas = $vagasPedidas;
    
        return $this;
    }

    /**
     * Get vagasPedidas
     *
     * @return integer 
     */
    public function getVagasPedidas()
    {
        return $this->vagasPedidas;
    }

    /**
     * Set vagasAprovadas
     *
     * @param integer $vagasAprovadas
     * @return Projetodemonitoria
     */
    public function setVagasAprovadas($vagasAprovadas)
    {
        $this->vagasAprovadas = $vagasAprovadas;
    
        return $this;
    }

    /**
     * Get vagasAprovadas
     *
     * @return integer 
     */
    public function getVagasAprovadas()
    {
        return $this->vagasAprovadas;
    }

    /**
     * Set chTotal
     *
     * @param integer $chTotal
     * @return Projetodemonitoria
     */
    public function setChTotal($chTotal)
    {
        $this->chTotal = $chTotal;
    
        return $this;
    }

    /**
     * Get chTotal
     *
     * @return integer 
     */
    public function getChTotal()
    {
        return $this->chTotal;
    }

    /**
     * Set chSemanal
     *
     * @param integer $chSemanal
     * @return Projetodemonitoria
     */
    public function setChSemanal($chSemanal)
    {
        $this->chSemanal = $chSemanal;
    
        return $this;
    }

    /**
     * Get chSemanal
     *
     * @return integer 
     */
    public function getChSemanal()
    {
        return $this->chSemanal;
    }

    /**
     * Set periodoInscricaoInicio
     *
     * @param \DateTime $periodoInscricaoInicio
     * @return Projetodemonitoria
     */
    public function setPeriodoInscricaoInicio($periodoInscricaoInicio)
    {
        $this->periodoInscricaoInicio = $periodoInscricaoInicio;
    
        return $this;
    }

    /**
     * Get periodoInscricaoInicio
     *
     * @return \DateTime 
     */
    public function getPeriodoInscricaoInicio()
    {
        return $this->periodoInscricaoInicio;
    }

    /**
     * Set periodoInscricaoFinal
     *
     * @param \DateTime $periodoInscricaoFinal
     * @return Projetodemonitoria
     */
    public function setPeriodoInscricaoFinal($periodoInscricaoFinal)
    {
        $this->periodoInscricaoFinal = $periodoInscricaoFinal;
    
        return $this;
    }

    /**
     * Get periodoInscricaoFinal
     *
     * @return \DateTime 
     */
    public function getPeriodoInscricaoFinal()
    {
        return $this->periodoInscricaoFinal;
    }

    /**
     * Set periodoSelecao
     *
     * @param \DateTime $periodoSelecao
     * @return Projetodemonitoria
     */
    public function setPeriodoSelecao($periodoSelecao)
    {
        $this->periodoSelecao = $periodoSelecao;
    
        return $this;
    }

    /**
     * Get periodoSelecao
     *
     * @return \DateTime 
     */
    public function getPeriodoSelecao()
    {
        return $this->periodoSelecao;
    }

    /**
     * Set relatorioRelatorio
     *
     * @param \Bd\MonitorUfbaBundle\Entity\Relatorio $relatorioRelatorio
     * @return Projetodemonitoria
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

    /**
     * Set editalCodigo
     *
     * @param \Bd\MonitorUfbaBundle\Entity\Edital $editalCodigo
     * @return Projetodemonitoria
     */
    public function setEditalCodigo(\Bd\MonitorUfbaBundle\Entity\Edital $editalCodigo = null)
    {
        $this->editalCodigo = $editalCodigo;
    
        return $this;
    }

    /**
     * Get editalCodigo
     *
     * @return \Bd\MonitorUfbaBundle\Entity\Edital 
     */
    public function getEditalCodigo()
    {
        return $this->editalCodigo;
    }

    /**
     * Set selecao
     *
     * @param \Bd\MonitorUfbaBundle\Entity\Selecao $selecao
     * @return Projetodemonitoria
     */
    public function setSelecao(\Bd\MonitorUfbaBundle\Entity\Selecao $selecao = null)
    {
        $this->selecao = $selecao;
    
        return $this;
    }

    /**
     * Get selecao
     *
     * @return \Bd\MonitorUfbaBundle\Entity\Selecao 
     */
    public function getSelecao()
    {
        return $this->selecao;
    }

    /**
     * Set professorProfessor
     *
     * @param \Bd\MonitorUfbaBundle\Entity\Professor $professorProfessor
     * @return Projetodemonitoria
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
}