<?php

/**
 * Auto generated by MySQL Workbench Schema Exporter.
 * Version 2.1.6-dev (doctrine2-annotation) on 2015-04-13 16:23:55.
 * Goto https://github.com/johmue/mysql-workbench-schema-exporter for more
 * information.
 */

namespace Umg\VotacionBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Umg\VotacionBundle\Entity\Catedratico
 *
 * @ORM\Entity()
 * @ORM\Table(name="Catedratico", indexes={@ORM\Index(name="fk_Catedratico_Usuario1_idx", columns={"Usuario_id"})})
 */
class Catedratico
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    protected $Codigo;

    /**
     * @ORM\Column(type="string", length=150)
     */
    protected $Nombre;

    /**
     * @ORM\Column(type="text")
     */
    protected $Direccion;

    /**
     * @ORM\Column(type="string", length=45)
     */
    protected $Nit;

    /**
     * @ORM\Column(type="string", length=45)
     */
    protected $Colegiado;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $Especialidad;

    /**
     * @ORM\Column(type="string", length=150)
     */
    protected $Universidad;

    /**
     * @ORM\Column(type="integer")
     */
    protected $Graduacion;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $Estudios;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $Logros;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $FechaNacimiento;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $Usuario_id;

    /**
     * @ORM\OneToMany(targetEntity="CampusCarrera", mappedBy="catedratico")
     * @ORM\JoinColumn(name="id", referencedColumnName="Catedratico_id")
     */
    protected $campusCarreras;

    /**
     * @ORM\OneToMany(targetEntity="CatedraticoCurso", mappedBy="catedratico")
     * @ORM\JoinColumn(name="id", referencedColumnName="Catedratico_id")
     */
    protected $catedraticoCursos;

    /**
     * @ORM\OneToMany(targetEntity="Respuestum", mappedBy="catedratico")
     * @ORM\JoinColumn(name="id", referencedColumnName="Catedratico_id")
     */
    protected $respuesta;

    /**
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="catedraticos")
     * @ORM\JoinColumn(name="Usuario_id", referencedColumnName="id", nullable=true)
     */
    protected $usuario;

    public function __construct()
    {
        $this->campusCarreras = new ArrayCollection();
        $this->catedraticoCursos = new ArrayCollection();
        $this->respuesta = new ArrayCollection();
    }

    /**
     * Set the value of id.
     *
     * @param integer $id
     * @return \Umg\VotacionBundle\Entity\Catedratico
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
     * Set the value of Codigo.
     *
     * @param string $Codigo
     * @return \Umg\VotacionBundle\Entity\Catedratico
     */
    public function setCodigo($Codigo)
    {
        $this->Codigo = $Codigo;

        return $this;
    }

    /**
     * Get the value of Codigo.
     *
     * @return string
     */
    public function getCodigo()
    {
        return $this->Codigo;
    }

    /**
     * Set the value of Nombre.
     *
     * @param string $Nombre
     * @return \Umg\VotacionBundle\Entity\Catedratico
     */
    public function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    /**
     * Get the value of Nombre.
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->Nombre;
    }

    /**
     * Set the value of Direccion.
     *
     * @param string $Direccion
     * @return \Umg\VotacionBundle\Entity\Catedratico
     */
    public function setDireccion($Direccion)
    {
        $this->Direccion = $Direccion;

        return $this;
    }

    /**
     * Get the value of Direccion.
     *
     * @return string
     */
    public function getDireccion()
    {
        return $this->Direccion;
    }

    /**
     * Set the value of Nit.
     *
     * @param string $Nit
     * @return \Umg\VotacionBundle\Entity\Catedratico
     */
    public function setNit($Nit)
    {
        $this->Nit = $Nit;

        return $this;
    }

    /**
     * Get the value of Nit.
     *
     * @return string
     */
    public function getNit()
    {
        return $this->Nit;
    }

    /**
     * Set the value of Colegiado.
     *
     * @param string $Colegiado
     * @return \Umg\VotacionBundle\Entity\Catedratico
     */
    public function setColegiado($Colegiado)
    {
        $this->Colegiado = $Colegiado;

        return $this;
    }

    /**
     * Get the value of Colegiado.
     *
     * @return string
     */
    public function getColegiado()
    {
        return $this->Colegiado;
    }

    /**
     * Set the value of Especialidad.
     *
     * @param string $Especialidad
     * @return \Umg\VotacionBundle\Entity\Catedratico
     */
    public function setEspecialidad($Especialidad)
    {
        $this->Especialidad = $Especialidad;

        return $this;
    }

    /**
     * Get the value of Especialidad.
     *
     * @return string
     */
    public function getEspecialidad()
    {
        return $this->Especialidad;
    }

    /**
     * Set the value of Universidad.
     *
     * @param string $Universidad
     * @return \Umg\VotacionBundle\Entity\Catedratico
     */
    public function setUniversidad($Universidad)
    {
        $this->Universidad = $Universidad;

        return $this;
    }

    /**
     * Get the value of Universidad.
     *
     * @return string
     */
    public function getUniversidad()
    {
        return $this->Universidad;
    }

    /**
     * Set the value of Graduacion.
     *
     * @param integer $Graduacion
     * @return \Umg\VotacionBundle\Entity\Catedratico
     */
    public function setGraduacion($Graduacion)
    {
        $this->Graduacion = $Graduacion;

        return $this;
    }

    /**
     * Get the value of Graduacion.
     *
     * @return integer
     */
    public function getGraduacion()
    {
        return $this->Graduacion;
    }

    /**
     * Set the value of Estudios.
     *
     * @param string $Estudios
     * @return \Umg\VotacionBundle\Entity\Catedratico
     */
    public function setEstudios($Estudios)
    {
        $this->Estudios = $Estudios;

        return $this;
    }

    /**
     * Get the value of Estudios.
     *
     * @return string
     */
    public function getEstudios()
    {
        return $this->Estudios;
    }

    /**
     * Set the value of Logros.
     *
     * @param string $Logros
     * @return \Umg\VotacionBundle\Entity\Catedratico
     */
    public function setLogros($Logros)
    {
        $this->Logros = $Logros;

        return $this;
    }

    /**
     * Get the value of Logros.
     *
     * @return string
     */
    public function getLogros()
    {
        return $this->Logros;
    }

    /**
     * Set the value of FechaNacimiento.
     *
     * @param datetime $FechaNacimiento
     * @return \Umg\VotacionBundle\Entity\Catedratico
     */
    public function setFechaNacimiento($FechaNacimiento)
    {
        $this->FechaNacimiento = $FechaNacimiento;

        return $this;
    }

    /**
     * Get the value of FechaNacimiento.
     *
     * @return datetime
     */
    public function getFechaNacimiento()
    {
        return $this->FechaNacimiento;
    }

    /**
     * Set the value of Usuario_id.
     *
     * @param integer $Usuario_id
     * @return \Umg\VotacionBundle\Entity\Catedratico
     */
    public function setUsuarioId($Usuario_id)
    {
        $this->Usuario_id = $Usuario_id;

        return $this;
    }

    /**
     * Get the value of Usuario_id.
     *
     * @return integer
     */
    public function getUsuarioId()
    {
        return $this->Usuario_id;
    }

    /**
     * Add CampusCarrera entity to collection (one to many).
     *
     * @param \Umg\VotacionBundle\Entity\CampusCarrera $campusCarrera
     * @return \Umg\VotacionBundle\Entity\Catedratico
     */
    public function addCampusCarrera(CampusCarrera $campusCarrera)
    {
        $this->campusCarreras[] = $campusCarrera;

        return $this;
    }

    /**
     * Remove CampusCarrera entity from collection (one to many).
     *
     * @param \Umg\VotacionBundle\Entity\CampusCarrera $campusCarrera
     * @return \Umg\VotacionBundle\Entity\Catedratico
     */
    public function removeCampusCarrera(CampusCarrera $campusCarrera)
    {
        $this->campusCarreras->removeElement($campusCarrera);

        return $this;
    }

    /**
     * Get CampusCarrera entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCampusCarreras()
    {
        return $this->campusCarreras;
    }

    /**
     * Add CatedraticoCurso entity to collection (one to many).
     *
     * @param \Umg\VotacionBundle\Entity\CatedraticoCurso $catedraticoCurso
     * @return \Umg\VotacionBundle\Entity\Catedratico
     */
    public function addCatedraticoCurso(CatedraticoCurso $catedraticoCurso)
    {
        $this->catedraticoCursos[] = $catedraticoCurso;

        return $this;
    }

    /**
     * Remove CatedraticoCurso entity from collection (one to many).
     *
     * @param \Umg\VotacionBundle\Entity\CatedraticoCurso $catedraticoCurso
     * @return \Umg\VotacionBundle\Entity\Catedratico
     */
    public function removeCatedraticoCurso(CatedraticoCurso $catedraticoCurso)
    {
        $this->catedraticoCursos->removeElement($catedraticoCurso);

        return $this;
    }

    /**
     * Get CatedraticoCurso entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCatedraticoCursos()
    {
        return $this->catedraticoCursos;
    }

    /**
     * Add Respuestum entity to collection (one to many).
     *
     * @param \Umg\VotacionBundle\Entity\Respuestum $respuestum
     * @return \Umg\VotacionBundle\Entity\Catedratico
     */
    public function addRespuestum(Respuestum $respuestum)
    {
        $this->respuesta[] = $respuestum;

        return $this;
    }

    /**
     * Remove Respuestum entity from collection (one to many).
     *
     * @param \Umg\VotacionBundle\Entity\Respuestum $respuestum
     * @return \Umg\VotacionBundle\Entity\Catedratico
     */
    public function removeRespuestum(Respuestum $respuestum)
    {
        $this->respuesta->removeElement($respuestum);

        return $this;
    }

    /**
     * Get Respuestum entity collection (one to many).
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRespuesta()
    {
        return $this->respuesta;
    }

    /**
     * Set Usuario entity (many to one).
     *
     * @param \Umg\VotacionBundle\Entity\Usuario $usuario
     * @return \Umg\VotacionBundle\Entity\Catedratico
     */
    public function setUsuario(Usuario $usuario = null)
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * Get Usuario entity (many to one).
     *
     * @return \Umg\VotacionBundle\Entity\Usuario
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    public function __sleep()
    {
        return array('id', 'Codigo', 'Nombre', 'Direccion', 'Nit', 'Colegiado', 'Especialidad', 'Universidad', 'Graduacion', 'Estudios', 'Logros', 'FechaNacimiento', 'Usuario_id');
    }

    public function __toString()
    {
      return $this->Codigo.' - '.$this->Nombre;      
    }
}
