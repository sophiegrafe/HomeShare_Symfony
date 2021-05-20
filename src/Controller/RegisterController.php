<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
    private $encoder;
    private $em;
    // private $guardAuthHandler;   

     public function __construct(EntityManagerInterface $em, UserPasswordEncoderInterface $encoder, GuardAuthenticatorHandler $guardAuthHandler)
     {   
         $this->encoder = $encoder;
         $this->em = $em;
         //     $this->guardAuthHandler = $guardAuthHandler;       
     }

    #[Route('/register', name: 'app_register')]
    public function register(       
        Request $request): Response
    {   

        $user = new User();
        $form = $this->createForm(
            RegisterType::class,
            $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $user->setPassword(
                $this->encoder->encodePassword(
                    $user,
                    $form->get('password')
                    ->getData()
                )
            );

            $this->em->persist($user);
            $this->em->flush();

            // generate a signed url and email it to the user
            /*
        $this->emailVerifier->sendEmailConfirmation(
            'app_verify_email',
            $user,
            (new TemplatedEmail())
                ->from(new Address('sophiegrafe@gmail.com', 'TinyHome Mail'))
                ->to($user->getEmail())
                ->subject('Confimation of your registation')
                ->htmlTemplate('register/confirmation_email.html.twig')
        );

        return $guardHandler->authenticateUserAndHandleSuccess(
                $user,
                $request,
                $authenticator,
                'main' // firewall name in security.yaml
            );
        */
            return $this->redirectToRoute("app_login");

        }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    // email verification
    // #[Route('/verify/email', name: 'app_verify_email')]
    // public function verifyUserEmail(Request $request): Response
    // {
    //     $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

    //     // validate email confirmation link, sets User::isVerified=true and persists
    //     try {
    //         $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
    //     } catch (VerifyEmailExceptionInterface $exception) {
    //         $this->addFlash('verify_email_error', $exception->getReason());

    //         return $this->redirectToRoute('app_register');
    //     }

    //     // @TODO Change the redirect on success and handle or remove the flash message in your templates
    //     $this->addFlash('success', 'Your email address has been verified.');

    //     return $this->redirectToRoute('home');
    // }

}
