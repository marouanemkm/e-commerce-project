<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="hoempage")
     */
    public function homepage(ProductRepository $pr)
    {
        $products = $pr->findBy([], [], 3);

        return $this->render('home', [
            'products' => $products,
        ]);
    }
}