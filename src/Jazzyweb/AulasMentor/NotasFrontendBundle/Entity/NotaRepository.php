<?php

namespace Jazzyweb\AulasMentor\NotasFrontendBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * NotaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NotaRepository extends EntityRepository
{
    
    public function findByUsuarioOrderedByFecha($usuario)
    {
        $query = $this->getEntityManager()->createQuery(
                        "SELECT n FROM JazzywebAulasMentorNotasFrontendBundle:Nota n
                          JOIN n.usuario u
                          WHERE  u.username=:username ORDER BY n.fecha DESC")
                ->setParameters(array('username' => $usuario->getUsername()));

        return $query->getResult();
    }
    
    public function findByUsuarioAndTermino($usuario, $termino)
     {
         if ($usuario instanceof Usuario) {
             $username = $usuario->getUsername();
         } else {
             $username = $usuario;
         }

         $query = $this
           ->getEntityManager()
           ->createQuery(
             "SELECT n FROM JazzywebAulasMentorNotasFrontendBundle:Nota n
             JOIN n.usuario u
             WHERE u.username=:username AND (n.texto LIKE :termino OR n.titulo LIKE :termino)"
            )
           ->setParameters(array(
               'username' => $username,
                'termino' => '%' . $termino . '%')
            );

         return $query->getResult();
     }

    public function findByUsuarioAndEtiqueta($usuario, $etiqueta) 
    {
        if ($usuario instanceof Usuario) {
            $username = $usuario->getUsername();
        } else {
            $username = $usuario;
        }

        if ($etiqueta instanceof Etiqueta) {
            $id_etiqueta = $etiqueta->getId();
        } else {
            $id_etiqueta = $etiqueta;
        }

        $query = $this->getEntityManager()->createQuery(
               "SELECT n 
                FROM JazzywebAulasMentorNotasFrontendBundle:Nota n
                    JOIN n.etiquetas e
                    JOIN n.usuario u
                WHERE e.id = :id_etiqueta and u.username=:username")
                ->setParameters(array(
            'username' => $username,
            'id_etiqueta' => $id_etiqueta)
        );

        return $query->getResult();
    }

}
