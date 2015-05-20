<?php

namespace Jazzyweb\AulasMentor\NotasFrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \Doctrine\Common\Collections\ArrayCollection;
use Jazzyweb\AulasMentor\NotasFrontendBundle\Entity\Nota;

class EstudioORMController extends Controller 
{

    public function crearAction() 
    {
        $nota1 = new Nota();
        $nota1->setFecha(new \DateTime());
        $nota1->setTitulo('Nota de prueba 1');
        $nota1->setTexto('Texto para la nota de pruebas 1');
        $nota1->setPath('ruta/a/nota1');

        $nota2 = new Nota();
        $nota2->setFecha(new \DateTime());
        $nota2->setTitulo('Nota de prueba 2');
        $nota2->setTexto('Texto para la nota de pruebas 2');
        $nota2->setPath('ruta/a/nota2');
        //Por lo pronto no le asociamos usuario
        // Ahora hay que persistirlo
        // solicitamos el servicio de persistencia (ORM)
        $em = $this->getDoctrine()->getEntityManager();
        // Le enviamos a dicho servicio el objeto que queremos persistir (no se
        // realiza query aún
        $em->persist($nota1);
        $em->persist($nota2);

        // Al final del proceso, cuando hayamos enviado a todos los objetos
        // al servicio de persistencia, lo enviamos efectivamente a la base de
        // datos (insert)
        $em->flush();

        $notas = new ArrayCollection();

        $notas->add($nota1);
        $notas->add($nota2);

        return $this->render('JazzywebAulasMentorNotasFrontendBundle:EstudioORM:crear.html.twig', array('notas' => $notas));
    }

}
