<?php


namespace App\Service;


use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CategoryService
{
    private $sluggerService;
    private $em;
    private $validator;

    public function __construct(SluggerService $sluggerService, EntityManagerInterface $em, ValidatorInterface $validator)
    {
        $this->sluggerService = $sluggerService;
        $this->em = $em;
        $this->validator = $validator;
    }

    public function addCategory(Categorie $categorie)
    {
        $retour = null;
        $categorie->setSlug($this->sluggerService->getSlug($categorie->getName()));
        $errors = $this->validator->validate($categorie);
        if ($errors->count() > 0) {
            $retour['success'] = false;
            $retour['erreur'] = $errors;
            dump($retour);
            return $retour;
        } else {
            $retour['success'] = true;
            $this->em->persist($categorie);
            $this->em->flush();
            return $retour;
        }
    }

}
