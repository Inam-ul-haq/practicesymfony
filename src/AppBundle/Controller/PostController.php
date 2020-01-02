<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Entity\Post; 
use Symfony\Component\HttpFoundation\Response;
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
			public function updateAction($id){

					$doct =$this->getDoctrine()->getManager();
					$post =$doct->getRepository('AppBundle:Post')->find($id);
						if(!$post){
						throw $this->createNotFoundException(
							'no post found for id'. $id);}
												   
								$post->setaddress('address 7  street');
								$doct->flush();
							    return new Response('change updated');
			}

			/** 
			*@Route("/delete/{id}",name="deletepost")
			*/
			public function deleteAction($id){

						$doct  = $this->getDoctrine()->getManager();
						$post  = $doct->getRepository('AppBundle:Post')->find($id);
						if(!$post){
							throw $this->createNotFoundException('no post found form this id' .$id);
						}
   
						$doct->remove($post);
						$doct->flush();
						return new Response('Record deleted');
			}

}
