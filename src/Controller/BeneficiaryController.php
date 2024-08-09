<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BeneficiaryRepository;

class BeneficiaryController extends AbstractController
{
    #[Route(path: '/', name: 'app_beneficiaries')]
    public function index(BeneficiaryRepository $beneficiaryRepository): Response
    {
        $user = $this->getUser(); // Récupération de l'utilisateur authentifié

        $beneficiaries = [];
        for ($i = 0; $i < 12; $i++) {
            $name = 'Beneficiary ' . $i;
            $avatarUrl = 'https://api.dicebear.com/8.x/avataaars/svg?seed=' . urlencode($name);
            $beneficiaries[] = ['name' => $name, 'avatar' => $avatarUrl];
        }
        
        $listbeneficiaries = $beneficiaryRepository->findAll();

        return $this->render('beneficiaries/index.html.twig', [
            'user' => $user, // Passer l'utilisateur au template
            'beneficiaries' => $beneficiaries,
            'listbeneficiaries' => $listbeneficiaries,
        ]);
    }
}
