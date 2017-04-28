<?php

namespace PAFBundle\Controller;

use PAFBundle\Form\UserEditForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class UserController extends Controller
{
    /**
     * @Route("/account/{id}", name="account_page")
     */
    public function accountAction($id)
    {
        $user = $this->getDoctrine()->getRepository('PAFBundle:User')->find($id);

        return $this->render('PAFBundle:user:index.html.twig', array(
            'user' => $user,
        ));
    }

    /**
     * @Route("/account/edit/{id}", name="account_edit")
     */
    public function editAction(Request $request, $id)
    {
        $user = $this->getDoctrine()->getRepository('PAFBundle:User')->find($id);
        $formEdit = $this->createForm(UserEditForm::class, $user);
        $formEdit->handleRequest($request);
        if ($formEdit->isValid() && $formEdit->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $url = $this->generateUrl('account_page', array('id' => $id));
            return $this->redirect($url);
        }

        return $this->render('PAFBundle:user:edit.html.twig', array(
            'user' => $user,
            'formEdit'  => $formEdit->createView(),
        ));
    }
}
