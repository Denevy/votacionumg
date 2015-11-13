<?php

namespace Umg\VotacionBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Umg\VotacionBundle\Entity\Evaluacion;
use Umg\VotacionBundle\Entity\Respuestum;
use Umg\VotacionBundle\Entity\Opcion;
use Ob\HighchartsBundle\Highcharts\Highchart;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $usr= $this->get('security.context')->getToken()->getUser();
        $alumno = $em->getRepository('UmgVotacionBundle:Alumno')->findBy(array('usuario'=>$usr));
        //dump();

        //die();


        if(count($alumno) > 0)
        {       
            $evaluacion = $em->getRepository('UmgVotacionBundle:Alumno')->findEvaluaciones($usr->getId());
        
            return $this->render('UmgVotacionBundle:Default:lista.html.twig', array(
                'eva' => count($evaluacion),
                'evaluaciones' => $evaluacion,
            ));
        }
        else
        {       
            $evaluacion = $em->getRepository('UmgVotacionBundle:Alumno')->findEvaluaciones($usr->getId());
        
            return $this->render('UmgVotacionBundle:Default:index.html.twig', array(
                'eva' => count($evaluacion),
                'evaluaciones' => $evaluacion,
            ));
        }   
    }

    public function verAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $evaluacion = $em->getRepository('UmgVotacionBundle:Evaluacion')->find($id);
        $usr= $this->get('security.context')->getToken()->getUser();
        $cc = $em->getRepository('UmgVotacionBundle:Alumno')->findRespuestasCurso($id,$usr->getId());
        $cnc = $em->getRepository('UmgVotacionBundle:Alumno')->findCursosNoCalificados($id,$usr->getId());
        $alumno = $em->getRepository('UmgVotacionBundle:Alumno')->findOneByUsuario($usr);

        return $this->render('UmgVotacionBundle:Default:ver.html.twig', array(
            'evaluacion' => $evaluacion,
            'cc' => $cc,
            'cnc' => $cnc,
            'alumno' => $alumno,
        ));
    }

    /*
     * @ $eid envia el id de la evaluación
     * @ $aid envia el id del alumno
     * @ $ccid envia el id del cursocarrera
     */
    public function evaluarAction($eid,$ccid,$aid)
    {
        $em = $this->getDoctrine()->getManager();
        $evaluacion = $em->getRepository('UmgVotacionBundle:Evaluacion')->find($eid);
        $cc = $em->getRepository('UmgVotacionBundle:CarreraCurso')->find($ccid);
        $alumno = $em->getRepository('UmgVotacionBundle:Alumno')->find($aid);
        
        return $this->render('UmgVotacionBundle:Default:evaluar.html.twig', array(
            'evaluacion' => $evaluacion,
            'cc' => $cc,
            'alumno' => $alumno,
        ));
    }

    /*
     * @ $eid envia el id de la evaluación
     * @ $aid envia el id del alumno
     * @ $ccid envia el id del cursocarrera
     */
    public function mostrarAction($eid,$ccid,$aid)
    {
        $em = $this->getDoctrine()->getManager();
        $usr= $this->get('security.context')->getToken()->getUser();
        $evaluacion = $em->getRepository('UmgVotacionBundle:Evaluacion')->find($eid);
        $cc = $em->getRepository('UmgVotacionBundle:CarreraCurso')->find($ccid);
        $alumno = $em->getRepository('UmgVotacionBundle:Alumno')->findOneByUsuario($usr);
        $respuestas = $em->getRepository('UmgVotacionBundle:Alumno')->findRespuestas($eid,$usr->getId(),$ccid);
;
        
        return $this->render('UmgVotacionBundle:Default:mostrar.html.twig', array(
            'evaluacion' => $evaluacion,
            'cc' => $cc,
            'alumno' => $alumno,
            'respuestas' => $respuestas,
        ));
    }
    

    public function insertarAction(Request $request, $eid, $ccid,$aid)
    {
        $em = $this->getDoctrine()->getManager();
        $evaluacion = $em->getRepository('UmgVotacionBundle:Evaluacion')->find($eid);
        $cc = $em->getRepository('UmgVotacionBundle:CarreraCurso')->find($ccid);
        $alumno = $em->getRepository('UmgVotacionBundle:Alumno')->find($aid);
        $acurso = $em->getRepository('UmgVotacionBundle:AlumnoCurso')->findOneBy(array(
            'alumno'=>$alumno,
            'carreraCurso'=>$cc,
        ));

        foreach( $cc->getCatedraticoCursos() as $cat)
            $catedratico = $cat;
        $preguntas = $evaluacion->getPregunta();
        $resp = $request->request->get('opcion');

        $em->getConnection()->beginTransaction();
        try 
        {

            $id = 0;
            foreach( $preguntas as $pregunta )
            {
                $opcion = $em->getRepository('UmgVotacionBundle:Opcion')->find($resp[$id]);
                $respuesta = new Respuestum();
                $respuesta->setRespuesta($opcion->getOpcion());
                $respuesta->setPreguntum($pregunta);
                $respuesta->setCatedratico($catedratico->getCatedratico());
                $respuesta->setAlumnoCurso($acurso);
                $respuesta->setObservacion(false);
                $respuesta->setPunteo($opcion->getPunteo());
                $respuesta->setPensumAnio($cc->getPensumAnio());
                $em->persist($respuesta);
                $em->flush();

                $id += 1;
            }
            $respuesta = new Respuestum();
            $respuesta->setRespuesta($resp[$id]);
            $respuesta->setPreguntum($pregunta);
            $respuesta->setCatedratico($catedratico->getCatedratico());
            $respuesta->setAlumnoCurso($acurso);
            $respuesta->setObservacion(true);
            $em->persist($respuesta);
            $em->flush();

            $em->getConnection()->commit();
            return $this->redirect($this->generateUrl('ver_resultado', array('id' => $evaluacion->getId())));


        }
        catch (Exception $e) 
        {
            $em->getConnection()->rollback();
            throw $e;
        }
    }

    public function chartAction()
    {
    // Chart
    $series = array(
        array("name" => "Data Serie Name",    "data" => array(1,2,4,5,6,3,8))
    );

    $ob = new Highchart();
    $ob->chart->renderTo('linechart');  // The #id of the div where to render the chart
    $ob->title->text('Chart Title');
    $ob->xAxis->title(array('text'  => "Horizontal axis title"));
    $ob->yAxis->title(array('text'  => "Vertical axis title"));
    $ob->series($series);

    return $this->render('UmgVotacionBundle:Default:chart.html.twig', array(
            'chart' => $ob
        ));
    }

    public function reporteAction()
    {
        $em = $this->getDoctrine()->getManager();
        $usr= $this->get('security.context')->getToken()->getUser();
        $entities = $em->getRepository('UmgVotacionBundle:CampusCarrera')->findCarreraCoordinador($usr->getId());
        
        return $this->render('UmgVotacionBundle:Default:carrera.html.twig', array(
            'entities' => $entities,
        ));

    }
}
