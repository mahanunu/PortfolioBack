<?php

namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface; // Pour gérer les dépendances

class ProjectFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Projet 1 (Visible, publié)
        $project1 = new Project();
        $project1->setTitle('Super Application Mobile');
        $project1->setDescription('Une application révolutionnaire pour smartphones.');
        $project1->setImageUrl('https://via.placeholder.com/400x250/FFA500/FFFFFF?Text=AppMobile');
        $project1->setIsPublished(true);
        $project1->setProjectUrl('https://example.com/app-mobile');
        $project1->setYear('2023');
        $project1->setIsViewable(true); // Visible par tous
        // Associer à un utilisateur si nécessaire, ex: l'admin
        $project1->setUser($this->getReference('admin-user')); 
        $manager->persist($project1);

        // Projet 2 (Non visible par défaut, publié)
        $project2 = new Project();
        $project2->setTitle('Outil de Data Science Interne');
        $project2->setDescription('Un outil puissant pour l\'analyse de données, non public.');
        $project2->setImageUrl('https://via.placeholder.com/400x250/4682B4/FFFFFF?Text=DataTool');
        $project2->setIsPublished(true);
        $project2->setProjectUrl('https://internal.example.com/data-tool');
        $project2->setYear('2024');
        $project2->setIsViewable(false); // Non visible par défaut, admin seulement
        $project2->setUser($this->getReference('admin-user'));
        $manager->persist($project2);

        // Projet 3 (Visible, non publié)
        $project3 = new Project();
        $project3->setTitle('Site Vitrine pour Artiste');
        $project3->setDescription('Un site web élégant, en cours de développement.');
        $project3->setImageUrl('https://via.placeholder.com/400x250/32CD32/FFFFFF?Text=ArtistSite');
        $project3->setIsPublished(false); // Non publié
        $project3->setProjectUrl('#');
        $project3->setYear('2024');
        $project3->setIsViewable(true); // Techniquement visible si publié, mais isPublished est false
        $project3->setUser($this->getReference('kaoutar-user'));
        $manager->persist($project3);
        
        // Ajoutez d'autres projets selon vos besoins...

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class, // S'assurer que les UserFixtures sont chargées avant
        ];
    }
} 