<?php
/**
 * Created by PhpStorm.
 * User: Julien
 * Date: 27/01/2019
 * Time: 10:04
 */

namespace App\Service;


use App\Repository\CategoryRepository;

class categoriesPosts
{
    private $categoryRepository;


 public function __construct(CategoryRepository $categoryRepository)
 {
    $this->categoryRepository = $categoryRepository;
 }

 public function getCategories()
 {
     return $this->categoryRepository->findAll();
 }
}