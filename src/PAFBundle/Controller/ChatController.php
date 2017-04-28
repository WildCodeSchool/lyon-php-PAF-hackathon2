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
        $user = $this->getDoctrine()->getRepository('PAFBundle:User')->findOneBy(array('name' => $name));

        $chat = new Chat();
        $formChat = $this->createForm(ChatForm::class, $chat);
        $formChat->handleRequest($request);
        if ($formChat->isValid() && $formChat->isSubmitted()) {
            $chat->setUser($user->getId());
            $em = $this->getDoctrine()->getManager();
            $em->persist($chat);
            $em->flush();

            $url = $this->generateUrl('chat');
            return $this->redirect($url);
        }

        return $this->render('PAFBundle:chat:index.html.twig', array(
            'name'      => $name,
            'user'      => $user,
            'chats'     => $chats,
            'formChat'  => $formChat->createView(),
        ));
    }
}
