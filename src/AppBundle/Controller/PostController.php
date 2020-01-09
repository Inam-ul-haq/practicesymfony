<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Post;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class PostController extends Controller
{             
			/**
		     * @Route("/index", name="postpage")
		     */
		    public function indexAction(Request $request)
		    {
				        // replace this example code with whatever you need

				        $post = $this->getDoctrine()->getRepository('AppBundle:Post')->findall();
				 	

				        return $this->render('post/index.html.twig',array('data' => $post));
		    }
				/**
			     * @Route("/create", name="createpage")

                 */

			public function createAction(Request $request){
				$post = new Post();
				$post->setName('inam');
					$post->setaddress('1234');
					$doct = $this->getDoctrine()->getManager();
					$doct->persist($post);
					$doct->flush();
					 // $post->getId();
			     return new Response('Save new post'.$post->getId());
		      }



			/** 
			*@Route("/update/{id}",name="updatepost")
			*/
			public function updateAction($id , Request $request){

			$doct =$this->getDoctrine()->getManager();
			$post =$doct->getRepository('AppBundle:Post')->find($id);
			if(!$post){
				throw $this->createNotFoundException(
									'no post found for id'. $id);
				}
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

            return $this->redirectToRoute('postpage');
            }

        	 return $this->render('student/edit.html.twig', array(
            'form' => $form->createView(),
       		 ));

						
			}

			/** 
			*@Route("/delete/{id}",name="deletepost")
			*/
			public function deleteAction($id){
						$doct  = $this->getDoctrine()->getManager();
						$post  = $doct->getRepository('AppBundle:Post')->find($id);
 						// echo "<pre>";print_r($post);die();	
						if(!$post){
							throw $this->createNotFoundException('no post found form this id' .$id);
						}
                        $doct->remove($post);
						$doct->flush();
						return $this->redirectToRoute('postpage');
			}

}
