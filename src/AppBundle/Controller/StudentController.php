<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Post;
use AppBundle\Entity\StudentForm;
use AppBundle\Form\FormValidationType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class StudentController extends Controller
{
/**
	* @Route("/student", name="studentpage")
     */
    public function studentAction(Request $request)
    {
		        // replace this example code with whatever you need
        $post = new Post();
        $form = $this->createFormBuilder($post)
            ->add('name', TextType::class)
            ->add('address', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Submit'))
            ->getForm();
          $form->handleRequest($request);
          if($form->isValid()){
            $data =$form->get('name')->getData();
            $data1 = $form->get('address')->getData();
//            echo"<pre>";print_r($data);die();
            $post->setName($data);
            $post->setaddress($data1);
            $doct = $this->getDoctrine()->getManager();
            $doct->persist($post);
            $doct->flush();

            return $this->redirect('index');
            }

        return $this->render('student/index.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}
