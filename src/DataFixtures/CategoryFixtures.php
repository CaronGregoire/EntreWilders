<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    private const CATEGORIES = [
        'tv-hifi',
        'informatique',
        'véhicules',
        'tacos'
    ];

    public function load(ObjectManager $manager)
    {
        foreach (Self::CATEGORIES as $index => $categoryName) {
            $category = new Category();
            $category->setName($categoryName);
            $manager->persist($category);
            $this->addReference('category_' . $index, $category);
        }
        $manager->flush();
    }
}
