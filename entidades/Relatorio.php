<?php

namespace Bd\MonitorUfbaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Relatorio
 *
 * @ORM\Table(name="relatorio")
 * @ORM\Entity
 */
class Relatorio
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
     * Set arquivo
     *
     * @param string $arquivo
     * @return Relatorio
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