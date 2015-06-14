<?php

namespace AppBundle\Controller;

use AppBundle\Entity\HBasket;
use AppBundle\Entity\HCategories;
use AppBundle\Entity\HProducts;
use AppBundle\Entity\HWishlist;
use AppBundle\Repository\HBasketRepository;
use AppBundle\Repository\HProductsRepository;
use AppBundle\Repository\HWishlistRepository;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DefaultController
 *
 * @package AppBundle\Controller
 */
class DefaultController extends Controller
{
    /**
     * @Route("/app/example", name="homepage")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
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
                $priceDiscounted       = round($product->getPrice() - $product->getPrice() * $product->getDiscount() / 100, 0) + 0.99;
                $results['products'][] = array(
                    "id"                    => $product->getId(),
                    "name"                  => $product->getName(),
                    "brand"                 => $product->getHBrands()->getName(),
                    "category"              => $product->getHCategories()->getName(),
                    "price"                 => $priceDiscounted,
                    "old_price"             => $product->getPrice() + 0.99,
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

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
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
                $priceDiscounted
                                       =
                    round($wish->getHProducts()->getPrice() - $wish->getHProducts()->getPrice() * $wish->getHProducts()->getDiscount() / 100, 0)
                    + 0.99;
                $results['wishlist'][] = array(
                    "id"                    => $wish->getId(),
                    "estimatedPurchase"     => $wish->getEstimatedPurchase(),
                    "order"                 => $wish->getOrder(),
                    "product_id"            => $wish->getHProducts()->getId(),
                    "name"                  => $wish->getHProducts()->getName(),
                    "brand"                 => $wish->getHProducts()->getHBrands()->getName(),
                    "category"              => $wish->getHProducts()->getHCategories()->getName(),
                    "price"                 => $priceDiscounted,
                    "old_price"             => $wish->getHProducts()->getPrice() + 0.99,
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

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function listBasketAction(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        /** @var HBasketRepository $basketRepo */
        $basketRepo     = $entityManager->getRepository(HBasket::REPOSITORY);
        $basketProducts = $basketRepo->findBy(array('status' => HBasket::STATUS_ACTIVE));
        $results        = array();
        $totalPrice     = 0;
        $totalQuantity  = 0;
        $magicDiscount  = 0;

        if (count($basketProducts) > 0) {
            /** @var HBasket $basketProduct */
            foreach ($basketProducts as $basketProduct) {
                $product                   = $basketProduct->getHProducts();
                $priceDiscounted           = round($product->getPrice() - $product->getPrice() * $product->getDiscount() / 100, 0) + 0.99;
                $results['basket_items'][] = array(
                    "id"                    => $basketProduct->getId(),
                    "product_id"            => $product->getId(),
                    "name"                  => $product->getName(),
                    "brand"                 => $product->getHBrands()->getName(),
                    "category"              => $product->getHCategories()->getName(),
                    "old_price"             => $product->getPrice() + 0.99,
                    "price"                 => $priceDiscounted,
                    "discount"              => $product->getDiscount(),
                    "deliveryEstimatedCost" => $product->getDeliveryEstimatedCost(),
                    "status"                => $product->getStatus(),
                    "quantity"              => $basketProduct->getQuantity()
                );
                $totalQuantity += $basketProduct->getQuantity();
                $magicDiscount += $basketProduct->getHProducts()->getDeliveryEstimatedCost() * $basketProduct->getQuantity();
                $totalPrice += ($basketProduct->getQuantity() * $priceDiscounted);
            }
            $results['magic_discount'] = round(($magicDiscount - $magicDiscount / $totalQuantity), 2);
            $results['total_price']    = floor($totalPrice) + 0.99;
            $results['magic_price']    = floor($totalPrice) + 0.99 - $results['magic_discount'];
        }

        $isJsonP = $request->get('callback');

        if ($isJsonP) {

            echo $isJsonP . '(' . json_encode($results) . ');';
            die;
        }

        return new JsonResponse($results);
    }

    /**
     * @param Request $request
     *
     * @return bool
     */
    public function wishlistAddAction(Request $request)
    {
        $productId = $request->get('product_id');
        /** @var EntityManager $entityManager */
        $entityManager = $this->getDoctrine()->getManager();
        /** @var HWishlistRepository $wishlistRepo */
        $wishlistRepo = $entityManager->getRepository(HWishlist::REPOSITORY);
        $wish         = $wishlistRepo->findBy(array('hProducts' => $productId));
        if ($wish instanceof HWishlist) {
            return new JsonResponse($wish->getId());
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

        return new JsonResponse($wish->getId());

    }

    /**
     * @param Request $request
     */
    public function wishlistRemoveAction(Request $request)
    {
        $productId = $request->get('product_id');
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

        return new JsonResponse($wish->getId());
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function addToBasketAction(Request $request)
    {
        $productId = $request->get('product_id');

        /** @var EntityManager $entityManager */
        $entityManager = $this->getDoctrine()->getManager();

        /** @var HBasketRepository $basketRepo */
        $basketRepo = $entityManager->getRepository(HBasket::REPOSITORY);

        $basket = $basketRepo->findOneBy(array('hProducts' => $productId));

        if ($basket instanceof HBasket) {
            $basket->setQuantity($basket->getQuantity() + 1);
        } else {

            /** @var HProductsRepository $productsRepo */
            $productsRepo = $entityManager->getRepository(HProducts::REPOSITORY);

            /** @var HProducts $product */
            $product = $productsRepo->find($productId);

            $basket = new HBasket();
            $basket->setHProducts($product);
            $basket->setQuantity(1);
        }
        $basket->setStatus(HBasket::STATUS_ACTIVE);
        $entityManager->persist($basket);
        $entityManager->flush();

        return new JsonResponse($basket->getQuantity());
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function removeFromBasketAction(Request $request)
    {
        $productId = $request->get('product_id');

        /** @var EntityManager $entityManager */
        $entityManager = $this->getDoctrine()->getManager();

        /** @var HBasketRepository $basketRepo */
        $basketRepo = $entityManager->getRepository(HBasket::REPOSITORY);
        $basket     = $basketRepo->findOneBy(array('hProducts' => $productId));

        if ($basket instanceof HBasket) {
            if (($basket->getQuantity() - 1) <= 0) {
                $basket->setStatus(HBasket::STATUS_DELETED);
                $basket->setQuantity(0);
            } else {
                $basket->setQuantity($basket->getQuantity() - 1);
            }

            $entityManager->persist($basket);
            $entityManager->flush();
        }

        return new JsonResponse($basket->getQuantity());
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function offersAction(Request $request)
    {
        /** @var EntityManager $entityManager */
        $entityManager = $this->getDoctrine()->getManager();

        $filters             = $request->query;
        $results['products'] = array();

        /** @var HProductsRepository $productsRepo */
        $productsRepo = $entityManager->getRepository(HProducts::REPOSITORY);

        $products     = $productsRepo->getAllProductsOffers($filters, $entityManager);
        if (count($products) > 0) {
            /** @var HProducts $product */
            foreach ($products as $product) {
                $priceDiscounted       = round($product->getPrice() - $product->getPrice() * $product->getDiscount() / 100, 0) + 0.99;
                $results['products'][] = array(
                    "id"                    => $product->getId(),
                    "name"                  => $product->getName(),
//                    "brand"                 => $product->getHBrands()->getName(),
//                    "category"              => $entityManager->getRepository(HCategories::REPOSITORY)->find($product->getHCategories()->getId()),
                    "old_price"             => $product->getPrice() + 0.99,
                    "price"                 => $priceDiscounted,
                    "discount"              => $product->getDiscount(),
                    "deliveryEstimatedCost" => $product->getDeliveryEstimatedCost(),
                    "status"                => $product->getStatus()
                );
            }

        } else {
            $results['products'] = array();
        }
        $results['num_rows'] = count($products);

        $isJsonP = $request->get('callback');


        if ($isJsonP) {

            echo $isJsonP . '(' . json_encode($results) . ');';
            die;
        }

        return new JsonResponse($results);
    }
}
