<?php

namespace AppBundle\Controller;

use AppBundle\Entity\HProducts;
use AppBundle\Entity\HWishlist;
use AppBundle\Repository\HWishlistRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/app/example", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

    public function homepageAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        /** @var \HProductsRepository $productsRepo */
        $productsRepo = $entityManager->getRepository(HProducts::REPOSITORY);
        $filters      = $request->query;
        $products     = $productsRepo->getAllProductsByFilters($filters);
        $results      = array();
        /** @var HProducts $product */
        foreach ($products as $product) {
            $results['products'][] = array(
                "id"                    => $product->getId(),
                "name"                  => $product->getName(),
                "brand"                 => $product->getHBrands()->getName(),
                "category"              => $product->getHCategories()->getName(),
                "price"                 => $product->getPrice(),
                "discount"              => $product->getDiscount(),
                "deliveryEstimatedCost" => $product->getDeliveryEstimatedCost(),
                "status"                => $product->getStatus()
            );
        }
        $results['num_rows'] = count($productsRepo->findAll());
        $isJsonP = $request->get('callback');


        if ($isJsonP) {

            echo $isJsonP . '(' . json_encode($results) . ');';die;
        }

        return new JsonResponse($results);

    }

    public function  wishlistAction()
    {
        $entityManager = $this->getDoctrine()->getManager();
        /** @var HWishlistRepository $wishlistRepo */
        $wishlistRepo = $entityManager->getRepository(HWishlist::REPOSITORY);

    }
}
