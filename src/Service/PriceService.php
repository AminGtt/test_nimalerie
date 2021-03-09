<?php

namespace App\Service;

use App\Repository\ProductOrderRepository;

class PriceService {

    private $productOrderRepository;

    public function __construct(ProductOrderRepository $productOrderRepository)
    {
        $this->productOrderRepository = $productOrderRepository;
    }

    /**
     * total price = foreach product of productsInProductOrder (priceItemTTC * qty)
     */
    public function getTotalPrice(int $orderId) : float {

            $orderWeWantTotal = $this->productOrderRepository->findBy(['order' => $orderId]);

            $total = 0;

            if ($orderWeWantTotal != null) {

                foreach ($orderWeWantTotal as $article) {
                    $qty = $article->getQuantity();
                    $price = $article->getProduct()->getInclTaxPrice();
                    $totalPerArticle = $qty * $price;
                    $total += $totalPerArticle;
                }

                return $total;
            } else {
                return $total;
            }
    }


    public function getTotalPrices(array $orders): array {

        $totalPrices = [];

        foreach ($orders as $order) {
            $totalPrices[$order->getId()] = $this->getTotalPrice($order->getId());
        }

        return $totalPrices;
    }

}
