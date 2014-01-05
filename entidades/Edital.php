<?php

namespace Bd\MonitorUfbaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Edital
 *
 * @ORM\Table(name="edital")
 * @ORM\Entity
 */
class Edital
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
     * @ORM\Column(name="publicacao", type="string", length=45, nullable=true)
     */
    private $publicacao;

    /**
     * @var string
     *
     * @ORM\Column(name="arquivo", type="text", nullable=true)
     */
    private $arquivo;



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
     * Set publicacao
     *
     * @param string $publicacao
     * @return Edital
     */
    public function setPublicacao($publicacao)
    {
        $this->publicacao = $publicacao;
    
        return $this;
    }

    /**
     * Get publicacao
     *
     * @return string 
     */
    public function getPublicacao()
    {
        return $this->publicacao;
    }

    /**
     * Set arquivo
     *
     * @param string $arquivo
     * @return Edital
     */
    public function setArquivo($arquivo)
    {
        $this->arquivo = $arquivo;
    
        return $this;
    }

    /**
     * Get arquivo
     *
     * @return string 
     */
    public function getArquivo()
    {
        return $this->arquivo;
    }
}