<?php

namespace App\Controller;

use App\Classes\Dates;
use App\Repository\ParentEnfantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CantineController extends AbstractController
{
    /**
     * @Route("/admin/cantine", name="inscription_cantine")
     * @param ParentEnfantRepository $parentEnfantRepository
     *
     * @return Response
     */
    public function index(Dates $dates, ParentEnfantRepository $parentEnfantRepository): Response
    {
        $enfants = $parentEnfantRepository->findBy(['parent' => $this->getUser()->getId()]);

        return $this->render('cantine/index.html.twig', [
            'enfants' => $enfants,
            'dates' =>$dates->genereProchainsJours(10)
        ]);
    }
}
