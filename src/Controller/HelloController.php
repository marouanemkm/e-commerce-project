<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    /**
     * @Route( 
     * "/hello/{name?World}",  
     * name="hello", 
     * )
     */
    public function hello($name = "World")
    {
        return $this->render('hello', [ 'prenom' => 'Marouane', ]);
    }

    /**
     * @Route("/example", name="example")
     */
    public function example()
    {
        return $this->render('example', [ 'age' => 33, ]);
    }
}