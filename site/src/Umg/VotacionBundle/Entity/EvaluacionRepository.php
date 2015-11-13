<?php
// src/AppBundle/Entity/ProductRepository.php
namespace Umg\VotacionBundle\Entity;

use Doctrine\ORM\EntityRepository;

class EvaluacionRepository extends EntityRepository
{
    public function findCarreraCoordinador($user)
    {
        
        return $this->getEntityManager()
        ->createQueryBuilder()
        ->select('c')
        ->from('UmgVotacionBundle:CampusCarrera', 'c')
        ->innerJoin('c.catedratico','ca')
        ->where('ca.Usuario_id = :codigo')
        ->setParameter('codigo', $user)
        ->getQuery()
        ->getResult();
    }

    public function findPunteoCatedraticoCarrera($catedratico,$carrera)
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('SUM(r.Punteo)/count(r.id) as calificacion')
            ->from('UmgVotacionBundle:Respuestum','r')
            ->innerJoin('r.preguntum','p')
            ->innerJoin('p.evaluacion','e')
            ->where('e.CampusCarrera_id = :carrera')
            ->andWhere('r.Catedratico_id = :catedratico')
            ->andWhere('r.Observacion = false')
            ->groupBy('e.id')
            ->setParameter('carrera',$carrera->getId())
            ->setParameter('catedratico',$catedratico->getId())
            ->getQuery()
            ->getResult();
    }
}
