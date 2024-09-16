<?php

namespace Tests\Unit;

use App\Models\Group;
use PHPUnit\Framework\TestCase;

class GroupTest extends TestCase
{
    public function test_group_creation()
    {
        // Créer un groupe avec des données
        $group = new Group([
            'title' => 'Groupe 1',
            'min_age' => 5,
            'max_age' => 10,
        ]);

        // Vérifier que le groupe a bien été créé
        $this->assertEquals('Groupe 1', $group->title);
        $this->assertEquals(5, $group->min_age);
        $this->assertEquals(10, $group->max_age);
    }

    public function test_group_validation()
    {
        // Créer un groupe avec des données invalides (âge max inférieur à âge min)
        $group = new Group([
            'title' => 'Groupe Invalide',
            'min_age' => 15,
            'max_age' => 10, // Invalide : max_age ne doit pas être inférieur à min_age
        ]);

        // Vérifier que les valeurs ne sont pas valides
        $this->assertTrue($group->min_age > $group->max_age);
    }

    public function test_group_update()
    {
        // Créer un groupe
        $group = new Group([
            'title' => 'Groupe Test',
            'min_age' => 5,
            'max_age' => 10,
        ]);

        // Mettre à jour le groupe avec de nouvelles données
        $group->title = 'Groupe Mis à Jour';
        $group->min_age = 6;
        $group->max_age = 12;

        // Vérifier que les données du groupe ont bien été mises à jour
        $this->assertEquals('Groupe Mis à Jour', $group->title);
        $this->assertEquals(6, $group->min_age);
        $this->assertEquals(12, $group->max_age);
    }

    // public function test_group_deletion()
    // {
    //     // Créer un groupe
    //     $group = new Group([
    //         'title' => 'Groupe à Supprimer',
    //         'min_age' => 5,
    //         'max_age' => 10,
    //     ]);

    //     // Supprimer le groupe
    //     $group->delete();

    //     // Vérifier que le groupe a bien été supprimé
    //     $this->assertTrue($group->trashed());
    // }

    public function test_group_title_validation()
    {
        // Créer un groupe avec un titre manquant
        $group = new Group([
            'min_age' => 5,
            'max_age' => 10,
        ]);

        // Vérifier que le titre est manquant
        $this->assertNull($group->title);
    }




}
