<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 2.1.6-dev (doctrine2-annotation) on 2015-03-23 20:21:18.
 * Goto https://github.com/johmue/mysql-workbench-schema-exporter for more
 * information.
 */

namespace Umg\VotacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Umg\VotacionBundle\Entity\PensumAnio
 *
 * @ORM\Entity()
 * @ORM\Table(name="PensumAnio", indexes={@ORM\Index(name="fk_PensumAnio_Curso1_idx", columns={"Curso_id"}), @ORM\Index(name="fk_PensumAnio_Pensum1_idx", columns={"Pensum_id"})})
 */
class PensumAnio
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $Curso_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $Pensum_id;

    /**
     * @ORM\OneToMany(targetEntity="CarreraCurso", mappedBy="pensumAnio")
     * @ORM\JoinColumn(name="id", referencedColumnName="PensumAnio_id")
     */
    protected $carreraCursos;

    /**
     * @ORM\ManyToOne(targetEntity="Curso", inversedBy="pensumAnios")
     * @ORM\JoinColumn(name="Curso_id", referencedColumnName="id")
     */
    protected $curso;

    /**
     * @ORM\ManyToOne(targetEntity="Pensum", inversedBy="pensumAnios")
     * @ORM\JoinColumn(name="Pensum_id", referencedColumnName="id")
     */
    protected $pensum;

    public function __construct()
    {
        $this->carreraCursos = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Umg\VotacionBundle\Entity\PensumAnio
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of id.
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of Curso_id.
     *
     * @param integer $Curso_id
     * @return \Umg\VotacionBundle\Entity\PensumAnio
     */
    public function setCursoId($Curso_id)
    {
        $this->Curso_id = $Curso_id;

        return $this;
    }

    /**
     * Get the value of Curso_id.
     *
     * @return integer
     */
    public function getCursoId()
    {
        return $this->Curso_id;
    }

    /**
     * Set the value of Pensum_id.
     *
     * @param integer $Pensum_id
     * @return \Umg\VotacionBundle\Entity\PensumAnio
     */
    public function setPensumId($Pensum_id)
    {
        $this->Pensum_id = $Pensum_id;

        return $this;
    }

    /**
     * Get the value of Pensum_id.
     *
     * @return integer
     */
    public function getPensumId()
    {
        return $this->Pensum_id;
    }

    /**
     * Add CarreraCurso entity to collection (one to many).
     *
     * @param \Umg\VotacionBundle\Entity\CarreraCurso $carreraCurso
     * @return \Umg\VotacionBundle\Entity\PensumAnio
     */
    public function addCarreraCurso(CarreraCurso $carreraCurso)
    {
        $this->carreraCursos[] = $carreraCurso;

        return $this;
    }

    /**
     * Remove CarreraCurso entity from collection (one to many).
     *
     * @param \Umg\VotacionBundle\Entity\CarreraCurso $carreraCurso
     * @return \Umg\VotacionBundle\Entity\PensumAnio
     */
    public function removeCarreraCurso(CarreraCurso $carreraCurso)
    {
        $this->carreraCursos->removeElement($carreraCurso);

        return $this;
    }

    /**
     * Get CarreraCurso entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCarreraCursos()
    {
        return $this->carreraCursos;
    }

    /**
     * Set Curso entity (many to one).
     *
     * @param \Umg\VotacionBundle\Entity\Curso $curso
     * @return \Umg\VotacionBundle\Entity\PensumAnio
     */
    public function setCurso(Curso $curso = null)
    {
        $this->curso = $curso;

        return $this;
    }

    /**
     * Get Curso entity (many to one).
     *
     * @return \Umg\VotacionBundle\Entity\Curso
     */
    public function getCurso()
    {
        return $this->curso;
    }

    /**
     * Set Pensum entity (many to one).
     *
     * @param \Umg\VotacionBundle\Entity\Pensum $pensum
     * @return \Umg\VotacionBundle\Entity\PensumAnio
     */
    public function setPensum(Pensum $pensum = null)
    {
        $this->pensum = $pensum;

        return $this;
    }

    /**
     * Get Pensum entity (many to one).
     *
     * @return \Umg\VotacionBundle\Entity\Pensum
     */
    public function getPensum()
    {
        return $this->pensum;
    }

    public function __sleep()
    {
        return array('id', 'Curso_id', 'Pensum_id');
    }
}