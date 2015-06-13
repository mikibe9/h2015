<?php

namespace AppBundle\Controller;

use AppBundle\Entity\HBasket;
use AppBundle\Entity\HProducts;
use AppBundle\Entity\HWishlist;
use AppBundle\Repository\HBasketRepository;
use AppBundle\Repository\HProductsRepository;
use AppBundle\Repository\HWishlistRepository;
use Doctrine\ORM\EntityManager;
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
        /** @var HProductsRepository $productsRepo */
        $productsRepo = $entityManager->getRepository(HProducts::REPOSITORY);
        $filters      = $request->query;
        $products     = $productsRepo->getAllProductsByFilters($filters);
        $results      = array();
        if (count($products) > 0) {
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

        } else {
            $results['products'] = array();
        }
        $results['num_rows'] = count($productsRepo->findAll());

        $isJsonP = $request->get('callback');


        if ($isJsonP) {

            echo $isJsonP . '(' . json_encode($results) . ');';
            die;
        }

        return new JsonResponse($results);

    }

    public function  wishlistAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $filters       = $request->query;
        /** @var HWishlistRepository $wishlistRepo */
        $wishlistRepo = $entityManager->getRepository(HWishlist::REPOSITORY);
        $wishes       = $wishlistRepo->getAllProductsForWishlist($filters);

        if (count($wishes) > 0) {
            /** @var HWishlist $wish */
            foreach ($wishes as $key => $wish) {
                $results['wishlist'][] = array(
                    "id"                    => $wish->getId(),
                    "estimatedPurchase"     => $wish->getEstimatedPurchase(),
                    "order"                 => $wish->getOrder(),
                    "product_id"            => $wish->getHProducts()->getId(),
                    "name"                  => $wish->getHProducts()->getName(),
                    "brand"                 => $wish->getHProducts()->getHBrands()->getName(),
                    "category"              => $wish->getHProducts()->getHCategories()->getName(),
                    "price"                 => $wish->getHProducts()->getPrice(),
                    "discount"              => $wish->getHProducts()->getDiscount(),
                    "deliveryEstimatedCost" => $wish->getHProducts()->getDeliveryEstimatedCost(),
                    "status"                => $wish->getHProducts()->getStatus()
                );
            }

        } else {
            $results['wishlist']
                = array();
        }

        $results['num_rows'] = count($wishlistRepo->findAll());

        $isJsonP = $request->get('callback');


        if ($isJsonP) {

            echo $isJsonP . '(' . json_encode($results) . ');';
            die;
        }

        return new JsonResponse($results);
    }

    public function listBasketAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        /** @var HBasketRepository $basketRepo */
        $basketRepo     = $entityManager->getRepository(HBasket::REPOSITORY);
        $basketProducts = $basketRepo->findAll();
        $results        = array();

        if (count($basketProducts) > 0) {
            /** @var HBasket $basketProduct */
            foreach ($basketProducts as $basketProduct) {
                $product                   = $basketProduct->getHProducts();
                $results['basket_items'][] = array(
                    "id"       => $basketProduct->getId(),
                    "product"  => array(
                        "id"                    => $product->getId(),
                        "name"                  => $product->getName(),
                        "brand"                 => $product->getHBrands()->getName(),
                        "category"              => $product->getHCategories()->getName(),
                        "price"                 => $product->getPrice(),
                        "discount"              => $product->getDiscount(),
                        "deliveryEstimatedCost" => $product->getDeliveryEstimatedCost(),
                        "status"                => $product->getStatus()
                    ),
                    "quantity" => $basketProduct->getQuantity()
                );
            }

        }

        $isJsonP = $request->get('callback');


        if ($isJsonP) {

            echo $isJsonP . '(' . json_encode($results) . ');';
            die;
        }

        return new JsonResponse($results);
    }

    public function wishlistAddAction(Request $request)
    {
        $productId = $request->request->get('product_id');
        /** @var EntityManager $entityManager */
        $entityManager = $this->getDoctrine()->getManager();
        /** @var HWishlistRepository $wishlistRepo */
        $wishlistRepo = $entityManager->getRepository(HWishlist::REPOSITORY);
        $wish         = $wishlistRepo->findBy(array('hProducts' => $productId));
        if ($wish instanceof HWishlist) {
            return true;
        } else {
            /** @var HProductsRepository $productsRepo */
            $productsRepo = $entityManager->getRepository(HProducts::REPOSITORY);
            /** @var HProducts $product */
            $product = $productsRepo->find($productId);
            $wish    = new HWishlist();
            $wish->setOrder(0);
            $wish->setHProducts($product);
            $wish->setEstimatedPurchase("");
            $wish->setStatus('active');

            $entityManager->persist($wish);
            $entityManager->flush();
        }

    }

    public function wishlistRemoveAction(Request $request)
    {
        $productId = $request->request->get('product_id');
        /** @var EntityManager $entityManager */
        $entityManager = $this->getDoctrine()->getManager();
        /** @var HWishlistRepository $wishlistRepo */
        $wishlistRepo = $entityManager->getRepository(HWishlist::REPOSITORY);
        $wish         = $wishlistRepo->findOneBy(array('hProducts' => $productId));
        if ($wish instanceof HWishlist) {
            $wish->setStatus('deleted');
            $entityManager->persist($wish);
            $entityManager->flush();
        }
    }

    public function offersAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        $filters             = $request->query;
        $results['products'] = array();

        /** @var HWishlistRepository $wishlistRepo */
        $wishlistRepo   = $entityManager->getRepository(HWishlist::REPOSITORY);
        $offersWishlist = $wishlistRepo->findAll();


        if (count($offersWishlist) > 0) {
            /** @var HWishlist $offer */
            foreach ($offersWishlist as $offer) {
                $results['products'][] = array(
                    "id"                    => $offer->getHProducts()->getId(),
                    "name"                  => $offer->getHProducts()->getName(),
                    "brand"                 => $offer->getHProducts()->getHBrands()->getName(),
                    "category"              => $offer->getHProducts()->getHCategories()->getName(),
                    "price"                 => $offer->getHProducts()->getPrice(),
                    "discount"              => $offer->getHProducts()->getDiscount(),
                    "deliveryEstimatedCost" => $offer->getHProducts()->getDeliveryEstimatedCost(),
                    "status"                => $offer->getHProducts()->getStatus()
                );
            }

        }

        $results['num_rows'] = count($wishlistRepo->findAll());

        $isJsonP = $request->get('callback');


        if ($isJsonP) {

            echo $isJsonP . '(' . json_encode($results) . ');';
            die;
        }

        return new JsonResponse($results);
    }
}
