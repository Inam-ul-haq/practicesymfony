<?php

namespace AppBundle\Controller;

use AppBundle\Entity\StudentForm;
use AppBundle\Form\FormValidationType;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\PercentType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class StudentController extends Controller
{
/**
	* @Route("/student", name="studentpage")
     */
    public function studentAction(Request $request)
    {
		        // replace this example code with whatever you need
        $stud = new StudentForm();
        $form = $this->createFormBuilder($stud)
            ->add('studentName', TextType::class)
            ->add('studentId', TextType::class)
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'invalid_message' => 'The password fields 
            must match.', 'options' => array('attr' => array('class' => 'password-field')),
                'required' => true, 'first_options'  => array('label' => 'Password'),
                'second_options' => array('label' => 'Re-enter'),
            ))

            ->add('address', TextareaType::class)


            ->add('save', SubmitType::class, array('label' => 'Submit'))
            ->getForm();
        return $this->render('student/index.html.twig', array(
            'form' => $form->createView(),
        ));


    }

}
