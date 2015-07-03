<?php

namespace PSE\VideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use PSE\VideoBundle\Entity\Serie;
use PSE\VideoBundle\Entity\Comment;

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

    // Ouvre la session pour y stocker l'id de l'utilisateur qui sera connecté
    $session = $request->getSession();

    // Récupère l'id de l'utilisateur connecté depuis la Session
    $userId = $session->get('userId');

    // Récupère les informations de la video avec l'id entré
    $em = $this->getDoctrine()->getManager();
    $listeVideo = $em->getRepository('VideoBundle:Video')->find($id);

    // Récupère la table comment pour afficher les commentaire en bas de la vidéo
    $comments = $em->getRepository('VideoBundle:Comment')->findByVideoId($id);

    // Récupère la table utilisateur pour les afficher dans les commentaires
    $utilisateurs = $em->getRepository('UtilisateurBundle:Utilisateur')->findAll();

    // Crée un formulaire pour submit les commentaires
    $form = $this->createFormBuilder()
    ->add('content', 'text', array('label' => ' '))
    ->add('Commenter', 'submit')
    ->getForm();

    // S'active lorsque le formulaire est soumis
    $form->handleRequest($request);

    if ($form->isValid()) {

      // Récupère les données du formulaire
      $credentials = $form->getData();

      // Crée un nouveau commentaire, le remplit avec le contenu, id de l'user, id de la vidéo
      $comment = new Comment();
      $comment->setContent($credentials['content']);
      $comment->setUserId($userId);
      $comment->setVideoId($id);

      $datePublish = new \DateTime();

      $comment->setDatePublish($datePublish);

      $em = $this->getDoctrine()->getManager();

      // Applique les modifications à la base de donnée
      $em->persist($comment);
      $em->flush();

      // Recharge la page avec les nouvelles informations
      return $this->redirect($this->generateUrl('video', array('id' => $id)));
    }

    // Ouvre la vue login avec le formulaire en paramètre
    return $this->render('VideoBundle:Video:video.html.twig', array(
      'listeVideo'=> $listeVideo,
      'comments'=> $comments,
      'utilisateurs'=> $utilisateurs,
      'userId'=> $userId,
      'videoId'=> $id,
      'form' => $form->createView()
      ));
  }

public function deleteCommentAction(Request $request, $id, $videoId)
  {

    // Récupère les informations du commentaire sélectionné et le supprime de la BDD
        $em = $this->getDoctrine()->getManager();
        $comment = $em->getRepository('VideoBundle:Comment')->find($id);
        $em->remove($comment);
        $em->flush();

      // Recharge la page avec les nouvelles informations
      return $this->redirect($this->generateUrl('video', array('id' => $videoId)));

  }
}
