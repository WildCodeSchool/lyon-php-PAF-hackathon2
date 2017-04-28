<?php

namespace PAFBundle\Controller;

use PAFBundle\Entity\Chat;
use PAFBundle\Form\ChatForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class ChatController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/chat", name="chat")
     */
    public function indexAction(Request $request)
    {
        $login = $request->getSession();
        $name = $login->get('name');

        $chats = $this->getDoctrine()->getRepository('PAFBundle:Chat')->findAll();

        $chat = new Chat();
        $formChat = $this->createForm(ChatForm::class, $chat);
        $formChat->handleRequest($request);
        if ($formChat->isValid() && $formChat->isSubmitted()) {
            $chat->setName($name);
            $em = $this->getDoctrine()->getManager();
            $em->persist($chat);
            $em->flush();

            $url = $this->generateUrl('chat');
            return $this->redirect($url);
        }

        return $this->render('PAFBundle::layout.html.twig', array(
            'name'      => $name,
            'chats'     => $chats,
            'formChat'  => $formChat->createView(),
        ));
    }
}
