<?php

namespace Bd\MonitorUfbaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Departamento
 *
 * @ORM\Table(name="departamento")
 * @ORM\Entity
 */
class Departamento
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
     * @var integer
     *
     * @ORM\Column(name="chefe", type="integer", nullable=true)
     */
    private $chefe;



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
     * Set chefe
     *
     * @param integer $chefe
     * @return Departamento
     */
    public function setChefe($chefe)
    {
        $this->chefe = $chefe;
    
        return $this;
    }

    /**
     * Get chefe
     *
     * @return integer 
     */
    public function getChefe()
    {
        return $this->chefe;
    }
}