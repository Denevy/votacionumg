<?php
// src/AppBundle/Entity/ProductRepository.php
namespace Umg\VotacionBundle\Entity;
use DateTime;

use Doctrine\ORM\EntityRepository;

class AlumnoRepository extends EntityRepository
{
    public function findEvaluaciones($user)
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('e')
            ->from('UmgVotacionBundle:Evaluacion', 'e')
            ->innerJoin('e.campusCarrera','c')
            ->innerJoin('c.carreraCursos','cc')
            ->innerJoin('cc.alumnoCursos','ac')
            ->innerJoin('ac.alumno','a')
            ->groupBy('e.id')
            ->where('a.Usuario_id = :usuario')
            ->andWhere('e.Activa = true')
            ->andWhere('e.FechaHora <= :now')
            ->andWhere('e.FechaHoraFinal > :now')
            ->setParameter('usuario', $user)
            ->setParameter('now', new \DateTime('now'))
            ->getQuery()
            ->getResult()
            ;
    }

    public function findRespuestasCatedratico($evaluacion,$alumno)
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('r')
            ->from('UmgVotacionBundle:Respuestum','r')
            ->innerJoin('r.preguntum','p')
            ->innerJoin('p.evaluacion','e')
            ->innerJoin('r.alumnoCurso','ac')
            ->innerJoin('ac.alumno','a')
            ->where('e.id = :evaluacion')
            ->andWhere('a.Usuario_id = :alumno')
            ->groupBy('r.Catedratico_id')
            ->setParameter('evaluacion',$evaluacion)
            ->setParameter('alumno',$alumno)
            ->getQuery()
            ->getResult()
            ;
    }

    public function findCatedraticosNoCalificados($evaluacion,$alumno)
    {
        $q =  $this->getEntityManager()
            ->createQueryBuilder()
            ->select('c')
            ->from('UmgVotacionBundle:Catedratico','c')
            ->innerJoin('c.respuesta','r')
            ->innerJoin('r.preguntum','p')
            ->innerJoin('p.evaluacion','e')
            ->innerJoin('r.alumnoCurso','ac')
            ->innerJoin('ac.alumno','a')
            ->where('e.id = :evaluacion')
            ->andWhere('a.Usuario_id = :alumno')
            ->groupBy('r.Catedratico_id')
            ->setParameter('evaluacion',$evaluacion)
            ->setParameter('alumno',$alumno)
            ->getQuery()
            ->getResult()
            ;
        if( count($q) > 0 )
        {

            return $this->getEntityManager()
                ->createQueryBuilder()
                ->select('r')
                ->from('UmgVotacionBundle:Respuestum','r')
                ->innerJoin('r.catedratico','c')
                ->innerJoin('c.catedraticoCursos','cc')
                ->innerJoin('cc.carreraCurso','cu')
                ->innerJoin('cu.campusCarrera','cac')
                ->innerJoin('cac.evaluacions','e')
                ->innerJoin('cu.alumnoCursos','ac')
                ->innerJoin('ac.alumno','a')
                ->where('e.id = :evaluacion')
                ->andWhere('a.Usuario_id = :alumno')
                ->andWhere($this->getEntityManager()->createQueryBuilder()->expr()->notIn('c.id',$q))
                ->groupBy('c.id')
                ->setParameter('evaluacion',$evaluacion)
                ->setParameter('alumno',$alumno)
                ->getQuery()
                ->getResult()
                ;
        }
        else
        {
            return $this->getEntityManager()
                ->createQueryBuilder()
                ->select('r')
                ->from('UmgVotacionBundle:Catedratico','c')
                ->innerJoin('c.catedraticoCursos','cc')
                ->innerJoin('cc.carreraCurso','cu')
                ->innerJoin('cu.campusCarrera','cac')
                ->innerJoin('cac.evaluacions','e')
                ->innerJoin('cu.alumnoCursos','ac')
                ->innerJoin('ac.alumno','a')
                ->where('e.id = :evaluacion')
                ->andWhere('a.Usuario_id = :alumno')
                ->groupBy('c.id')
                ->setParameter('evaluacion',$evaluacion)
                ->setParameter('alumno',$alumno)
                ->getQuery()
                ->getResult()
                ;
        }

    }
}
