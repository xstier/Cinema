<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MenuAdminController extends AbstractController
{

    #[Route('/menu/admin', name: 'app_menu_admin')]
    public function index(): Response
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('app_home');
        }
        return $this->render('menu_admin/admin.html.twig', [
            'controller_name' => 'MenuAdminController',
        ]);
    }
    #[Route('/menu/employe', name: 'app_menu_employe')]
    public function menuEmpploye(): Response
    {
        if (!$this->isGranted('ROLE_EMPLOYE')) {
            return $this->redirectToRoute('app_home');
        }
        return $this->render('menu_admin/employe.html.twig', [
            'controller_name' => 'MenuEmployeController',
        ]);
    }
}
