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

        $names = [
            "David", "Sarah", "Betty", "Robert", "John", "Deborah",
            "Karen", "Donna", "Mary", "James", "Dorothy", "Nancy",
            "Jessica", "Helen", "Michelle", "Richard", "Michael",
            "William", "Ruth", "Patricia"
        ];

        $beneficiaries = $this->generateRandomBeneficiaries($names, 12); // Par exemple pour ceux non stockés
        
        $listbeneficiaries = $beneficiaryRepository->findAll();

        return $this->render('beneficiaries/index.html.twig', [
            'user' => $user, // Passer l'utilisateur au template
            'beneficiaries' => $beneficiaries,
            'listbeneficiaries' => $listbeneficiaries,
        ]);
    }

    private function generateRandomBeneficiaries(array $names, int $count): array
    {
        $beneficiaries = [];

        for ($i = 0; $i < $count; $i++) {
            $beneficiaries[] = [
                'name' => $names[array_rand($names)]
            ];
        }

        return $beneficiaries;
    }
}
