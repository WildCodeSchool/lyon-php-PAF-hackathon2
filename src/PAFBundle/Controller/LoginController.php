<?php

namespace PAFBundle\Controller;

use PAFBundle\Entity\User;
use PAFBundle\Form\LoginForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class LoginController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function loginAction(Request $request)
    {
        $login = $request->getSession();
        $user = new User();

        $formLogin = $this->createForm(LoginForm::class, $user);
        $formLogin->handleRequest($request);
        if ($formLogin->isSubmitted() && $formLogin->isValid()) {
            $login->getFlashBag()->add('success', 'Bienvenue '.$user->getName().' sur PAFLeChat !');
            $login->set('name', $user->getName());

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            $url = $this->generateUrl('chat');
            return $this->redirect($url);
        }

        return $this->render('PAFBundle:login:index.html.twig', array(
            'formLogin' => $formLogin->createView(),
        ));
    }
}
