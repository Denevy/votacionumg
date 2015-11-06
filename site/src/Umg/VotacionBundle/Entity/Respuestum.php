<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 2.1.6-dev (doctrine2-annotation) on 2015-04-20 17:39:41.
 * Goto https://github.com/johmue/mysql-workbench-schema-exporter for more
 * information.
 */

namespace Umg\VotacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Umg\VotacionBundle\Entity\Respuestum
 *
 * @ORM\Entity()
 * @ORM\Table(name="Respuesta", indexes={@ORM\Index(name="fk_Respuesta_Pregunta1_idx", columns={"Pregunta_id"}), @ORM\Index(name="fk_Respuesta_AlumnoCurso1_idx", columns={"AlumnoCurso_id"}), @ORM\Index(name="fk_Respuesta_Catedratico1_idx", columns={"Catedratico_id"}), @ORM\Index(name="fk_Respuesta_PensumAnio1_idx", columns={"PensumAnio_id"})})
 */
class Respuestum
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="text")
     */
    protected $Respuesta;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $Pregunta_id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $AlumnoCurso_id;

    /**
     * @ORM\Column(type="integer")
     */
    protected $Catedratico_id;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $Observacion;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $Punteo;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $PensumAnio_id;

    /**
     * @ORM\ManyToOne(targetEntity="Preguntum", inversedBy="respuesta")
     * @ORM\JoinColumn(name="Pregunta_id", referencedColumnName="id", nullable=true)
     */
    protected $preguntum;

    /**
     * @ORM\ManyToOne(targetEntity="AlumnoCurso", inversedBy="respuesta")
     * @ORM\JoinColumn(name="AlumnoCurso_id", referencedColumnName="id", nullable=true)
     */
    protected $alumnoCurso;

    /**
     * @ORM\ManyToOne(targetEntity="Catedratico", inversedBy="respuesta")
     * @ORM\JoinColumn(name="Catedratico_id", referencedColumnName="id")
     */
    protected $catedratico;

    /**
     * @ORM\ManyToOne(targetEntity="PensumAnio", inversedBy="respuesta")
     * @ORM\JoinColumn(name="PensumAnio_id", referencedColumnName="id", nullable=true)
     */
    protected $pensumAnio;

    public function __construct()
    {
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Umg\VotacionBundle\Entity\Respuestum
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
     * Set the value of Respuesta.
     *
     * @param string $Respuesta
     * @return \Umg\VotacionBundle\Entity\Respuestum
     */
    public function setRespuesta($Respuesta)
    {
        $this->Respuesta = $Respuesta;

        return $this;
    }

    /**
     * Get the value of Respuesta.
     *
     * @return string
     */
    public function getRespuesta()
    {
        return $this->Respuesta;
    }

    /**
     * Set the value of Pregunta_id.
     *
     * @param integer $Pregunta_id
     * @return \Umg\VotacionBundle\Entity\Respuestum
     */
    public function setPreguntaId($Pregunta_id)
    {
        $this->Pregunta_id = $Pregunta_id;

        return $this;
    }

    /**
     * Get the value of Pregunta_id.
     *
     * @return integer
     */
    public function getPreguntaId()
    {
        return $this->Pregunta_id;
    }

    /**
     * Set the value of AlumnoCurso_id.
     *
     * @param integer $AlumnoCurso_id
     * @return \Umg\VotacionBundle\Entity\Respuestum
     */
    public function setAlumnoCursoId($AlumnoCurso_id)
    {
        $this->AlumnoCurso_id = $AlumnoCurso_id;

        return $this;
    }

    /**
     * Get the value of AlumnoCurso_id.
     *
     * @return integer
     */
    public function getAlumnoCursoId()
    {
        return $this->AlumnoCurso_id;
    }

    /**
     * Set the value of Catedratico_id.
     *
     * @param integer $Catedratico_id
     * @return \Umg\VotacionBundle\Entity\Respuestum
     */
    public function setCatedraticoId($Catedratico_id)
    {
        $this->Catedratico_id = $Catedratico_id;

        return $this;
    }

    /**
     * Get the value of Catedratico_id.
     *
     * @return integer
     */
    public function getCatedraticoId()
    {
        return $this->Catedratico_id;
    }

    /**
     * Set the value of Observacion.
     *
     * @param boolean $Observacion
     * @return \Umg\VotacionBundle\Entity\Respuestum
     */
    public function setObservacion($Observacion)
    {
        $this->Observacion = $Observacion;

        return $this;
    }

    /**
     * Get the value of Observacion.
     *
     * @return boolean
     */
    public function getObservacion()
    {
        return $this->Observacion;
    }

    /**
     * Set the value of Punteo.
     *
     * @param integer $Punteo
     * @return \Umg\VotacionBundle\Entity\Respuestum
     */
    public function setPunteo($Punteo)
    {
        $this->Punteo = $Punteo;

        return $this;
    }

    /**
     * Get the value of Punteo.
     *
     * @return integer
     */
    public function getPunteo()
    {
        return $this->Punteo;
    }

    /**
     * Set the value of PensumAnio_id.
     *
     * @param integer $PensumAnio_id
     * @return \Umg\VotacionBundle\Entity\Respuestum
     */
    public function setPensumAnioId($PensumAnio_id)
    {
        $this->PensumAnio_id = $PensumAnio_id;

        return $this;
    }

    /**
     * Get the value of PensumAnio_id.
     *
     * @return integer
     */
    public function getPensumAnioId()
    {
        return $this->PensumAnio_id;
    }

    /**
     * Set Preguntum entity (many to one).
     *
     * @param \Umg\VotacionBundle\Entity\Preguntum $preguntum
     * @return \Umg\VotacionBundle\Entity\Respuestum
     */
    public function setPreguntum(Preguntum $preguntum = null)
    {
        $this->preguntum = $preguntum;

        return $this;
    }

    /**
     * Get Preguntum entity (many to one).
     *
     * @return \Umg\VotacionBundle\Entity\Preguntum
     */
    public function getPreguntum()
    {
        return $this->preguntum;
    }

    /**
     * Set AlumnoCurso entity (many to one).
     *
     * @param \Umg\VotacionBundle\Entity\AlumnoCurso $alumnoCurso
     * @return \Umg\VotacionBundle\Entity\Respuestum
     */
    public function setAlumnoCurso(AlumnoCurso $alumnoCurso = null)
    {
        $this->alumnoCurso = $alumnoCurso;

        return $this;
    }

    /**
     * Get AlumnoCurso entity (many to one).
     *
     * @return \Umg\VotacionBundle\Entity\AlumnoCurso
     */
    public function getAlumnoCurso()
    {
        return $this->alumnoCurso;
    }

    /**
     * Set Catedratico entity (many to one).
     *
     * @param \Umg\VotacionBundle\Entity\Catedratico $catedratico
     * @return \Umg\VotacionBundle\Entity\Respuestum
     */
    public function setCatedratico(Catedratico $catedratico = null)
    {
        $this->catedratico = $catedratico;

        return $this;
    }

    /**
     * Get Catedratico entity (many to one).
     *
     * @return \Umg\VotacionBundle\Entity\Catedratico
     */
    public function getCatedratico()
    {
        return $this->catedratico;
    }

    /**
     * Set PensumAnio entity (many to one).
     *
     * @param \Umg\VotacionBundle\Entity\PensumAnio $pensumAnio
     * @return \Umg\VotacionBundle\Entity\Respuestum
     */
    public function setPensumAnio(PensumAnio $pensumAnio = null)
    {
        $this->pensumAnio = $pensumAnio;

        return $this;
    }

    /**
     * Get PensumAnio entity (many to one).
     *
     * @return \Umg\VotacionBundle\Entity\PensumAnio
     */
    public function getPensumAnio()
    {
        return $this->pensumAnio;
    }

    public function __sleep()
    {
        return array('id', 'Respuesta', 'Pregunta_id', 'AlumnoCurso_id', 'Catedratico_id', 'Observacion', 'Punteo', 'PensumAnio_id');
    }
}
