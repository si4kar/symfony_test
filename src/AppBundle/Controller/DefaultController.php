<?php

namespace AppBundle\Controller;

use AppBundle\Form\FeddbackType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('@App/default/index.html.twig');
    }

    /**
     * @Route("/feedback", name="feedback")
     * @param Request $request
     * @return Response
     */
    public function feedbackAction(Request $request)
    {
        $form = $this->createForm(FeddbackType::class);
        $form->add('submit', SubmitType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $feddback  = $form->getData();

            $em = $this->getDoctrine()->getManager();

            $em->persist($feddback);
            $em->flush();

            $this->addFlash('success', 'saved');
            return $this->redirectToRoute('feedback');
        }


        return $this->render('@App/default/feedback.html.twig', [
            'feedback_form' => $form->createView(),
        ]);
    }
}
