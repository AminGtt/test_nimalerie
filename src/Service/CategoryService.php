<?php


namespace App\Service;


use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CategoryService
{
    private $sluggerService;
    private $entityManager;
    private $validator;

    public function __construct(SluggerService $sluggerService, EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        $this->sluggerService = $sluggerService;
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }

    public function addCategory(Categorie $categorie)
    {

        $categorie->setSlug($this->sluggerService->getSlug($categorie->getName()));

        $errors = $this->validator->validate($categorie);

        if ($errors->count() == 1) {
            return new FormError('Une catégorie avec le même slug existe déjà.');
        } else {
            $this->entityManager->persist($categorie);
            $this->entityManager->flush();
        }
    }
}
