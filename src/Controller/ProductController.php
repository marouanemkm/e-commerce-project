<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class ProductController extends AbstractController
{
    /**
     * @Route("/{slug}", name="product_category")
     */
    public function category($slug, CategoryRepository $categoryRepository): Response
    {
        $category = $categoryRepository->findOneBy([
            'slug' => $slug,
        ]);

        if (!$category) {
            throw $this->createNotFoundException("La catégorie '$slug' n'existe pas");
        }

        return $this->render('product/category', [
            'slug' => $slug,
            'category' => $category,
        ]);
    }


    /**
     * @Route("/{category_slug}/{slug}", name="product_show")
     */
    public function show($slug, ProductRepository $productRepository)
    {
        $product = $productRepository->findOneBy([
            'slug' => $slug,
        ]);

        if (!$product) {
            throw $this->createNotFoundException("Le produit recherché n'existe pas");
        }

        return $this->render('product/show', [
            'product' => $product,
        ]);
    }

    /**
     * @Route("/admin/product/create", name="product_create")
     */
    public function create(FormFactoryInterface $formFactory)
    {
        $builder = $formFactory->createBuilder();

        $builder->add('name')->add('shortDescription')->add('price')->add('category');

        $form = $builder->getForm();
        $formView = $form->createView();

        return $this->render('product/create', [
            'formView' => $formView
        ]);
    }
}
