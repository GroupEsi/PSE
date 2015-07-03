<?php

namespace PSE\VideoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use PSE\VideoBundle\Entity\Serie;
use PSE\VideoBundle\Entity\Video;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;


class SommaireController extends Controller
{
  // Lance la session pour conserver l'id de l'user après sa connection



  /**
  * Fonction appellant la page "Login avec un formulaire de connexion"
  *
  */


  public function showListAction(Request $request)
  {

    // Ouver la session pour y stocker l'id de l'utilisateur qui sera connecté
    $session = new Session();

    // Récupère l'utilisateur avec le login entré
    $em = $this->getDoctrine()->getManager();
    $listeSeries = $em->getRepository('VideoBundle:serie')->findAll();


    // Ouvre la vue login avec le formulaire en paramètre
    return $this->render('VideoBundle:Sommaire:sommaire.html.twig', array(
      'listeSeries'=> $listeSeries
    ));
  }

  public function showSaisonAction(Request $request, $id)
  {
    // Récupère l'utilisateur avec le login entré
    $em = $this->getDoctrine()->getManager();
    $listeSaison = $em->getRepository('VideoBundle:video')->findBySerieId($id);
    $Serie = $em->getRepository('VideoBundle:serie')->find($id);


    // Ouvre la vue login avec le formulaire en paramètre
    return $this->render('VideoBundle:Sommaire:saison.html.twig', array(
      'listeSaison'=> $listeSaison,
      'serie' => $Serie
    ));
  }


public function addSerieAction(Request $request){

  // Fonction pour la modification de l'utilisateur connecté


  // Récupère les informations de l'utilisateur connecté depuis la BDD
  $em = $this->getDoctrine()->getManager();
  $newSerie = new serie();

  // Formulaire pour la modification des infos
  $form = $this->createFormBuilder()
  ->add('titre', 'text', array(
    'label' => 'Titre : ',
    'data' =>''))
    ->add('nbSaisons', 'text', array(
      'label' => 'Nombre de saison : ',
      'data' =>''))
      ->add('genre', 'text', array(
        'label' => 'Genre : ',
        'data' =>''))
        ->add('description', 'text', array(
          'label' => 'Description : ',
          'data' =>''))
          ->add('annee', 'text', array(
            'label' => 'Date de création : ',
            'data' =>'','required' => false))
            ->add('urlImage', 'text', array(
              'label' => 'Url de l\'image : ',
              'data' =>'','required' => false))
            ->add('sauvegarder', 'submit')
            ->getForm();

            $form->handleRequest($request);

            // Se lance lorsque le formulaire est soumis
            if ($form->isValid()) {

              $serie = $form->getData();

              // Enregistre le nouveau titre dans la BDD
              $newSerie->setTitre($serie['titre']);

              // Enregistre le nouveau nbSaisons dans la BDD
              $newSerie->setNbSaisons($serie['nbSaisons']);

              // Enregistre le nouveau genre dans la BDD
              $newSerie->setGenre($serie['genre']);

              // Enregistre le nouveau description dans la BDD
              $newSerie->setDescription($serie['description']);

              // Enregistre le nouveau annee dans la BDD
              $newSerie->setAnnee($serie['annee']);

              // Enregistre le nouveau urlImage dans la BDD
              $newSerie->setUrlImage($serie['urlImage']);

              // Applique les modifications de BDD
              $em->persist($newSerie);
              $em->flush();
          }




        // Lance la view avec le formulaire en paramètre
        return $this->render('VideoBundle:Sommaire:addSerie.html.twig', array(
          'form' => $form->createView()
        ));
      }

      public function addVideoAction(Request $request, $id){
        // Récupère les informations de l'utilisateur connecté depuis la BDD
        $em = $this->getDoctrine()->getManager();
        $newVideo = new video();
        $Series = $em->getRepository('VideoBundle:serie')->find($id);

        // Formulaire pour la modification des infos
        $form = $this->createFormBuilder()
        ->add('titre', 'text', array(
          'label' => 'Titre : ',
          'data' =>''))
          ->add('url', 'text', array(
            'label' => 'Url de l\'iframe : ',
            'data' =>''))
            ->add('serie_id', 'text', array(
              'label' => 'Serie id : ',
              'data' => $Series-> getTitre()))
                  ->add('saison', 'text', array(
                    'label' => 'Saison : ',
                    'data' =>''))
                    ->add('episode', 'text', array(
                      'label' => 'Episode : ',
                      'data' =>''))
                      ->add('urlImage', 'text', array(
                        'label' => 'Url de l\'image : ',
                        'data' =>'','required' => false))
                        ->add('sauvegarder', 'submit')
                        ->getForm();

                  $form->handleRequest($request);

                  // Se lance lorsque le formulaire est soumis
                  if ($form->isValid()) {

                    $video = $form->getData();

                    // Enregistre le nouveau titre dans la BDD
                    $newVideo->setTitre($video['titre']);

                    // Enregistre le nouveau nbSaisons dans la BDD
                    $newVideo->setUrl($video['url']);

                    // Enregistre le nouveau genre dans la BDD
                    $newVideo->setSerieId($id);

                    // Enregistre le nouveau description dans la BDD
                    $newVideo->setSaison($video['saison']);

                    // Enregistre le nouveau annee dans la BDD
                    $newVideo->setEpisode($video['episode']);

                    // Enregistre le nouveau urlImage dans la BDD
                    $newVideo->setUrlImage($video['urlImage']);

                    // Applique les modifications de BDD
                    $em->persist($newVideo);
                    $em->flush();
                }




              // Lance la view avec le formulaire en paramètre
              return $this->render('VideoBundle:Sommaire:addVideo.html.twig', array(
                'form' => $form->createView()
              ));
            }
    }
