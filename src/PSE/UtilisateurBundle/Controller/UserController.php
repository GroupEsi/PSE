<?php

namespace PSE\UtilisateurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use PSE\UtilisateurBundle\Entity\Utilisateur;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;


class UserController extends Controller
{
    // Lance la session pour conserver l'id de l'user après sa connection



    /**
     * Fonction appellant la page "Login avec un formulaire de connexion"
     *
     */


    public function showLoginAction(Request $request)
    {

        // Ouver la session pour y stocker l'id de l'utilisateur qui sera connecté
    	$session = new Session();

    	// Crée un formulaire que l'on va passer à la vue pour la connexion

    	$form = $this->createFormBuilder()
    	->add('login', 'text', array('label' => 'Identifiant : '))
    	->add('password', 'password', array('label' => 'Mot de passe : '))
    	->add('connection', 'submit')
    	->getForm(); 

    	$form->handleRequest($request);

        // S'effectue lorsque l'on submit le formulaire
    	if ($form->isValid()) {

            $credentials = $form->getData();
            
            // Récupère l'utilisateur avec le login entré
            $em = $this->getDoctrine()->getManager();
            $utilisateur = $em->getRepository('UtilisateurBundle:Utilisateur')->findOneByLogin($credentials['login']);

            // Si l'utilisateur n'existe pas, lancer une exception
            if (!$utilisateur) {
                throw $this->createNotFoundException(
                    'Aucun utilisateur trouvé avec ce login : '. $credentials['login']
                    );
            }

            // Check si le password est correct
            if (md5($credentials['password']) == $utilisateur->getPassword()){

                // Si oui, ajouter l'utilisateur aux variables de sessions

                $session->set('userId', $utilisateur->getId());

                return $this->redirect($this->generateUrl('index'));
            }
            else
            {
                // Si non, lancer une exception
                throw $this->createNotFoundException(
                    'Ce mot de passe n\'est pas bon  : '. $credentials['password']
                    );
            }
        }

        // Ouvre la vue login avec le formulaire en paramètre
        return $this->render('UtilisateurBundle:User:login.html.twig', array(
          'form' => $form->createView()
          ));
    }



    public function modifyUserAction(Request $request){

        // Fonction pour la modification de l'utilisateur connecté
        $session = $request->getSession();

        //Récupère l'id de l'utilisateur connecté actuellement
        $userId = $session->get('userId');

        // Récupère les informations de l'utilisateur connecté depuis la BDD
        $em = $this->getDoctrine()->getManager();
        $utilisateur = $em->getRepository('UtilisateurBundle:Utilisateur')->find($userId);

        // Formulaire pour la modification des infos
        $form = $this->createFormBuilder()
        ->add('login', 'text', array(
           'label' => 'Identifiant : ',
           'data' => $utilisateur->getLogin()))
        ->add('mail', 'email', array(
            'label' => 'Adresse Mail : ',
            'data' => $utilisateur->getMail()))
        ->add('oldPassword', 'password', array(
            'label' => 'Ancien mot de passe : ',
            'data' =>'','required' => false))
        ->add('password', 'password', array(
            'label' => 'Changer de mot de passe : ',
            'data' =>'','required' => false))
        ->add('confirm', 'password', array(
            'label' => 'Confirmer le mot de passe : ',
            'data' =>'','required' => false))
        ->add('sauvegarder', 'submit')
        ->getForm();

        $form->handleRequest($request);

        // Se lance lorsque le formulaire est soumis
        if ($form->isValid()) {

            $credentials = $form->getData();

            // Enregistre le nouveau login dans la BDD
            $utilisateur->setLogin($credentials['login']);

            // Enregistre le nouveau @mail dans la BDD
            $utilisateur->setMail($credentials['mail']);

            // Si le champ password n'est pas nul
            if ($credentials['password'] != ''){

                // Si les champs password et confirm sont égaux
                if ($credentials['password'] == $credentials['confirm']){

                    // Si le oldPassword correspond a celui stocké en bdd (une fois crypté)
                    if (md5($credentials['oldPassword']) == $utilisateur->getPassword()){

                        // Si ces conditions sont réunies, changer le mot de passe stocké en bdd par celui entré
                        $utilisateur->setPassword(md5($credentials['password']));

                    }
                    else{

                        throw $this->createNotFoundException(
                            'L\'ancien mot de passe ne correspond pas.'
                            );
                    }

                }
                else{
                    throw $this->createNotFoundException(
                        'Les mots de passe ne correspondent pas.'
                        );
                }

            }

            // Applique les modifications de BDD
            $em->flush();

        }

        // Lance la view avec le formulaire en paramètre
        return $this->render('UtilisateurBundle:User:modify.html.twig', array(
          'form' => $form->createView()
          ));
    }







    public function signUpAction(Request $request){

        // Ouver la session pour y stocker l'id de l'utilisateur qui sera connecté
        $session = new Session();

        // Formulaire pour la modification des infos
        $form = $this->createFormBuilder()
        ->add('login', 'text', array(
           'label' => 'Identifiant : '))
        ->add('mail', 'email', array(
            'label' => 'Adresse Mail : '))
        ->add('password', 'password', array(
            'label' => 'Changer de mot de passe : ',
            'data' =>''))
        ->add('confirm', 'password', array(
            'label' => 'Confirmer le mot de passe : ',
            'data' =>''))
        ->add('sauvegarder', 'submit')
        ->getForm();

        $form->handleRequest($request);

        // Se lance lorsque le formulaire est soumis
        if ($form->isValid()) {

            $credentials = $form->getData();

            $utilisateur = new Utilisateur();
            $utilisateur->setLogin($credentials['login']);
            $utilisateur->setMail($credentials['mail']);

                // Si les champs password et confirm sont égaux
            if ($credentials['password'] == $credentials['confirm']){

                // Si oui, changer le mot de passe stocké en bdd par celui entré
                $utilisateur->setPassword(md5($credentials['password']));

            }
            else
            {
                throw $this->createNotFoundException(
                    'Les mots de passe ne correspondent pas.'
                    );
            }

            $em = $this->getDoctrine()->getManager();

            $em->persist($utilisateur);
            $em->flush();

            $session->set('userId', $utilisateur->getId());

            return $this->redirect($this->generateUrl('index'));

        }


        // Lance la view avec le formulaire en paramètre
        return $this->render('UtilisateurBundle:User:signup.html.twig', array(
          'form' => $form->createView()
          ));
    }



    public function adminUserAction(Request $request){

// Fonction pour la modification de l'utilisateur connecté
        $session = $request->getSession();

        //Récupère l'id de l'utilisateur connecté actuellement
        $userId = $session->get('userId');

        // Récupère les informations de l'utilisateur connecté depuis la BDD
        $em = $this->getDoctrine()->getManager();
        $utilisateurs = $em->getRepository('UtilisateurBundle:Utilisateur')->findAll();

        // Lance la view avec le formulaire en paramètre
        return $this->render('UtilisateurBundle:User:admin.html.twig', array(
          'utilisateurs' => $utilisateurs
          ));

    }

    // Delete l'utilisateur selectionne
    public function deleteAction($id){

        // Récupère les informations de l'utilisateur sélectionné
        $em = $this->getDoctrine()->getManager();
        $utilisateur = $em->getRepository('UtilisateurBundle:Utilisateur')->find($id);
        $em->remove($utilisateur);
        $em->flush();

        // Récupère les informations de l'utilisateur connecté depuis la BDD
        $em = $this->getDoctrine()->getManager();
        $utilisateurs = $em->getRepository('UtilisateurBundle:Utilisateur')->findAll();

        // Lance la view avec le formulaire en paramètre
        return $this->render('UtilisateurBundle:User:admin.html.twig', array(
          'utilisateurs' => $utilisateurs
          ));
    }

    public function editAction($id,Request $request){


        // Récupère les informations de l'utilisateur sélectionné
        $em = $this->getDoctrine()->getManager();
        $utilisateur = $em->getRepository('UtilisateurBundle:Utilisateur')->find($id);
        


// Formulaire pour la modification des infos
        $form = $this->createFormBuilder()
        ->add('login', 'text', array(
           'label' => 'Identifiant : ',
           'data' => $utilisateur->getLogin()))
        ->add('mail', 'email', array(
            'label' => 'Adresse Mail : ',
            'data' => $utilisateur->getMail()))
        ->add('sauvegarder', 'submit')
        ->getForm();

        $form->handleRequest($request);

        // Se lance lorsque le formulaire est soumis
        if ($form->isValid()) {

            $credentials = $form->getData();

            // Enregistre le nouveau login dans la BDD
            $utilisateur->setLogin($credentials['login']);

            // Enregistre le nouveau @mail dans la BDD
            $utilisateur->setMail($credentials['mail']);

            // Applique les modifications de BDD
            $em->flush();


            return $this->redirect($this->generateUrl('admin'));
        }

        

        // Lance la view avec le formulaire en paramètre
        return $this->render('UtilisateurBundle:User:modify.html.twig', array(
          'form' => $form->createView()
          ));


    }

}
