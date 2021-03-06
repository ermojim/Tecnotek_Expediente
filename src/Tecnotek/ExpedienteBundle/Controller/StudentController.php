<?php

namespace Tecnotek\ExpedienteBundle\Controller;

use Tecnotek\ExpedienteBundle\Entity\Club as Club;
use Tecnotek\ExpedienteBundle\Entity\Student;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends Controller
{
    /* Metodos para CRUD de Students */
    public function studentListAction($rowsPerPage = 10)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $dql = "SELECT students FROM TecnotekExpedienteBundle:Student students";
        $query = $em->createQuery($dql);

        $param = $this->get('request')->query->get('rowsPerPage');
        if(isset($param) && $param != "")
            $rowsPerPage = $param;

        $dql2 = "SELECT count(students) FROM TecnotekExpedienteBundle:Student students";
        $page = $this->getPaginationPage($dql2, $this->get('request')->query->get('page', 1), $rowsPerPage);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $page/*page number*/,
            $rowsPerPage/*limit per page*/
        );

        return $this->render('TecnotekExpedienteBundle:SuperAdmin:Student/list.html.twig', array(
            'pagination' => $pagination, 'rowsPerPage' => $rowsPerPage, 'menuIndex' => 3
        ));
    }

    public function studentCreateAction()
    {
        $entity = new Student();
        $form   = $this->createForm(new \Tecnotek\ExpedienteBundle\Form\StudentFormType(), $entity);
        return $this->render('TecnotekExpedienteBundle:SuperAdmin:Student/new.html.twig', array('entity' => $entity,
            'form'   => $form->createView(), 'menuIndex' => 3));
    }

    public function studentShowAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository("TecnotekExpedienteBundle:Student")->find($id);
        $form   = $this->createForm(new \Tecnotek\ExpedienteBundle\Form\StudentFormType(), $entity);
        return $this->render('TecnotekExpedienteBundle:SuperAdmin:Student/show.html.twig', array('entity' => $entity,
            'form'   => $form->createView(), 'menuIndex' => 3));
    }

    public function studentSaveAction(){
        $entity  = new Student();
        $request = $this->getRequest();
        $form    = $this->createForm(new \Tecnotek\ExpedienteBundle\Form\StudentFormType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('_expediente_sysadmin_student', array('id' => $entity->getId())));
        } else {
            return $this->render('TecnotekExpedienteBundle:SuperAdmin:Student/new.html.twig', array(
                'entity' => $entity, 'form'   => $form->createView(), 'menuIndex' => 3
            ));
        }
    }

    public function studentDeleteAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository("TecnotekExpedienteBundle:Student")->find( $id );
        if ( isset($entity) ) {
            $em->remove($entity);
            $em->flush();
        }
        return $this->redirect($this->generateUrl('_expediente_sysadmin_student'));
    }

    public function studentEditAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository("TecnotekExpedienteBundle:Student")->find($id);
        $form   = $this->createForm(new \Tecnotek\ExpedienteBundle\Form\StudentFormType(), $entity);
        return $this->render('TecnotekExpedienteBundle:SuperAdmin:Student/edit.html.twig', array('entity' => $entity,
            'form'   => $form->createView(), 'menuIndex' => 3));
    }

    public function studentUpdateAction(){
        $em = $this->getDoctrine()->getEntityManager();
        $request = $this->get('request')->request;
        $entity = $em->getRepository("TecnotekExpedienteBundle:Student")->find( $request->get('id'));

        if ( isset($entity) ) {
            $request = $this->getRequest();
            $form    = $this->createForm(new \Tecnotek\ExpedienteBundle\Form\StudentFormType(), $entity);
            $form->bindRequest($request);

            if ($form->isValid()) {
                $em->persist($entity);
                $em->flush();
                return $this->redirect($this->generateUrl('_expediente_sysadmin_student_show_simple') . "/" . $entity->getId());
            } else {
                return $this->render('TecnotekExpedienteBundle:SuperAdmin:Student/edit.html.twig', array(
                    'entity' => $entity, 'form'   => $form->createView(), 'menuIndex' => 3
                ));
            }
        } else {
            return $this->redirect($this->generateUrl('_expediente_sysadmin_student'));
        }

    }
    /* Final de los metodos para CRUD de students*/

    /* Metodos para CRUD de Clubs */
    public function clubListAction($rowsPerPage = 10)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $dql = "SELECT clubs FROM TecnotekExpedienteBundle:Club clubs";
        $query = $em->createQuery($dql);

        $param = $this->get('request')->query->get('rowsPerPage');
        if(isset($param) && $param != "")
            $rowsPerPage = $param;

        $dql2 = "SELECT count(clubs) FROM TecnotekExpedienteBundle:Club clubs";
        $page = $this->getPaginationPage($dql2, $this->get('request')->query->get('page', 1), $rowsPerPage);

        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $query,
            $page/*page number*/,
            $rowsPerPage/*limit per page*/
        );

        return $this->render('TecnotekExpedienteBundle:SuperAdmin:Club/list.html.twig', array(
            'pagination' => $pagination, 'rowsPerPage' => $rowsPerPage, 'menuIndex' => 3
        ));
    }

    public function clubCreateAction()
    {
        $entity = new Club();
        $form   = $this->createForm(new \Tecnotek\ExpedienteBundle\Form\ClubFormType(), $entity);
        return $this->render('TecnotekExpedienteBundle:SuperAdmin:Club/new.html.twig', array('entity' => $entity,
            'form'   => $form->createView(), 'menuIndex' => 3));
    }

    public function clubShowAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository("TecnotekExpedienteBundle:Club")->find($id);
        $form   = $this->createForm(new \Tecnotek\ExpedienteBundle\Form\ClubFormType(), $entity);
        return $this->render('TecnotekExpedienteBundle:SuperAdmin:Club/show.html.twig', array('entity' => $entity,
            'form'   => $form->createView(), 'menuIndex' => 3));
    }

    public function clubSaveAction(){
        $entity  = new Club();
        $request = $this->getRequest();
        $form    = $this->createForm(new \Tecnotek\ExpedienteBundle\Form\ClubFormType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('_expediente_sysadmin_club', array('id' => $entity->getId())));
        } else {
            return $this->render('TecnotekExpedienteBundle:SuperAdmin:Club/new.html.twig', array(
                'entity' => $entity, 'form'   => $form->createView(), 'menuIndex' => 3
            ));
        }
    }

    public function clubDeleteAction($id){
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository("TecnotekExpedienteBundle:Club")->find( $id );
        if ( isset($entity) ) {
            $em->remove($entity);
            $em->flush();
        }
        return $this->redirect($this->generateUrl('_expediente_sysadmin_club'));
    }

    public function clubEditAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository("TecnotekExpedienteBundle:Club")->find($id);
        $form   = $this->createForm(new \Tecnotek\ExpedienteBundle\Form\ClubFormType(), $entity);
        return $this->render('TecnotekExpedienteBundle:SuperAdmin:Club/edit.html.twig', array('entity' => $entity,
            'form'   => $form->createView(), 'menuIndex' => 3));
    }

    public function clubUpdateAction(){
        $em = $this->getDoctrine()->getEntityManager();
        $request = $this->get('request')->request;
        $entity = $em->getRepository("TecnotekExpedienteBundle:Club")->find( $request->get('id'));

        if ( isset($entity) ) {
            $request = $this->getRequest();
            $form    = $this->createForm(new \Tecnotek\ExpedienteBundle\Form\ClubFormType(), $entity);
            $form->bindRequest($request);

            if ($form->isValid()) {
                $em->persist($entity);
                $em->flush();
                return $this->redirect($this->generateUrl('_expediente_sysadmin_club_show_simple') . "/" . $entity->getId());
            } else {
                return $this->render('TecnotekExpedienteBundle:SuperAdmin:Club/edit.html.twig', array(
                    'entity' => $entity, 'form'   => $form->createView(), 'menuIndex' => 3
                ));
            }
        } else {
            return $this->redirect($this->generateUrl('_expediente_sysadmin_club'));
        }

    }
    /* Final de los metodos para CRUD de clubs*/

    public function getPaginationPage($dql, $currentPage, $rowsPerPage){
        if(isset($currentPage) == false || $currentPage <= 1){
            return 1;
        } else {
            $em = $this->getDoctrine()->getEntityManager();
            $query = $em->createQuery($dql);
            $total = $query->getSingleScalarResult();
            //Check if current page has Results
            if( $total > (($currentPage - 1) * $rowsPerPage)){//the page has results
                return $currentPage;
            } else {
                $x = intval($total / $rowsPerPage);
                if($x == 0){
                    return 1;
                } else {
                    if( $total % ($x * $rowsPerPage) > 0){
                        return $x+1;
                    } else {
                        return $x;
                    }
                }
            }
        }
    }

    public function getListAction(){
        $logger = $this->get('logger');
        if ($this->get('request')->isXmlHttpRequest())// Is the request an ajax one?
        {
            try {
                $request = $this->get('request')->request;
                $type = $request->get('type');
                $text = $request->get('text');
                $clubId = $request->get('clubId');

                $em = $this->getDoctrine()->getEntityManager();
                $sql = "SELECT std.id, std.firstname, std.lastname "
                    . " FROM tek_students std"
                    . " WHERE (std.firstname like '%" . $text . "%' OR std.lastname like '%" . $text . "%')"
                    . " AND std.id NOT IN (SELECT cs.student_id FROM club_student cs WHERE cs.club_id = " . $clubId . ")"
                    . " ORDER BY std.firstname, std.lastname";
                $stmt = $em->getConnection()->prepare($sql);
                $stmt->execute();
                $students = $stmt->fetchAll();

                if ( isset($students) ) {
                    return new Response(json_encode(array('error' => false, 'students' => $students)));
                } else {
                    return new Response(json_encode(array('error' => true, 'message' => "Data not found.")));
                }
            }
            catch (Exception $e) {
                $info = toString($e);
                $logger->err('Student::getListAction [' . $info . "]");
                return new Response(json_encode(array('error' => true, 'message' => $info)));
            }
        }// endif this is an ajax request
        else
        {
            return new Response("<b>Not an ajax call!!!" . "</b>");
        }
    }

    function associateStudentToClubAction(){
        $logger = $this->get('logger');
        if ($this->get('request')->isXmlHttpRequest())// Is the request an ajax one?
        {
            try {
                $request = $this->get('request')->request;
                $studentId = $request->get('studentId');
                $clubId = $request->get('clubId');

                $em = $this->getDoctrine()->getEntityManager();
                $student = $em->getRepository("TecnotekExpedienteBundle:Student")->find($studentId);
                $club = $em->getRepository("TecnotekExpedienteBundle:Club")->find($clubId);
                $club->getStudents()->add($student);
                $em->persist($club);
                $em->flush();

                return new Response(json_encode(array('error' => false)));
            }
            catch (Exception $e) {
                $info = toString($e);
                $logger->err('Student::getListAction [' . $info . "]");
                return new Response(json_encode(array('error' => true, 'message' => $info)));
            }
        }// endif this is an ajax request
        else
        {
            return new Response("<b>Not an ajax call!!!" . "</b>");
        }
    }

    public function removeStudentFromClubAction(){
        $logger = $this->get('logger');
        if ($this->get('request')->isXmlHttpRequest())// Is the request an ajax one?
        {
            try {
                $request = $this->get('request')->request;
                $studentId = $request->get('studentId');
                $clubId = $request->get('clubId');
                $em = $this->getDoctrine()->getEntityManager();
                $sql = "DELETE FROM club_student WHERE club_id = " . $clubId .
                    " AND student_id = " . $studentId. ";";
                $logger->err($sql);
                $stmt = $em->getConnection()->prepare($sql);
                $stmt->execute();

                return new Response(json_encode(array('error' => false)));
            }
            catch (Exception $e) {
                $info = toString($e);
                $logger->err('Student::removeStudentFromClub [' . $info . "]");
                return new Response(json_encode(array('error' => true, 'message' => $info)));
            }
        }// endif this is an ajax request
        else
        {
            return new Response("<b>Not an ajax call!!!" . "</b>");
        }
    }
}
