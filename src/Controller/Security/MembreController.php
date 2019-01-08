<?php
namespace App\Controller\Security;

use App\Entity\Membres;
use App\Form\MembreType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MembreController extends AbstractController {


    /**
     * @Route("/inscription", name="security.inscription")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function inscription(Request $request, UserPasswordEncoderInterface $encoder) {

        $membre = new Membres();
        $form = $this->createForm(MembreType::class, $membre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Encoder le mot de passe de l'utilisateur
            $pasword = $encoder->encodePassword($membre, $membre->getMdp());
            $membre->setMdp($pasword);

            // Envoi les information d'inscription a la base de donnée
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($membre);
            $entityManager->flush();

          // Quand l'utilisateur et inscrit en le rediriger ver la page de connection
            return $this->redirectToRoute('security.inscription');
        }

        return $this->render("security/inscription.html.twig", [
            // En créer la vue du formulaire d'inscription
            'form' => $form->createView()
        ]);

    }

}