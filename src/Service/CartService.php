<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartService
{
    private $session;

    public function __construct(SessionInterface $session){
        $this->session = $session;
    }

    public function addToCart($singleArticle) {
        $panier = $this->session->get('panier');
        $panier[] = $singleArticle;

        $this->session->set('panier', $panier);
    }

    public function getArticlesInCart()
    {
        return $this->session->get("panier");
    }

    public function deleteArticle($productId) {
        
        $panier = $this->session->get('panier');

        foreach ($panier as $article) {
            if ($article["product"]->getId() == $productId){
                $start = array_search($article, $panier);
                array_splice($panier, $start, 1);
                $this->session->set('panier', $panier);
            }
        }
    }
}
