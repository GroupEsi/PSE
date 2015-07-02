<?php

namespace PSE\VideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use PSE\VideoBundle\Entity\Serie;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;


class VideoController extends Controller
{

  /**
  * Fonction appellant la page pour afficher les informations sur la video
  *
  */


  public function showVideoAction(Request $request, $id)
  {

    // Ouver la session pour y stocker l'id de l'utilisateur qui sera connecté
    //$session = $request->getSession();
    //$videoId = $session->get('id');
    // Récupère la video avec l'id entré
    $em = $this->getDoctrine()->getManager();
    $listeVideo = $em->getRepository('VideoBundle:Video')->find($id);


    // Ouvre la vue login avec le formulaire en paramètre
    return $this->render('VideoBundle:Video:video.html.twig', array(
      'listeVideo'=> $listeVideo
    ));
  }



}
