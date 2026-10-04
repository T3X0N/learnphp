<?php

namespace App\Controllers;

class PublicController
{
    public function index()
    {
        $title = 'World';
        $posts = [
            [
                'title' => 'Some World title 1',
                'date' => 'January 1, 2021',
                'author' => 'Pets',
                'body' => 'Some World content 1',
            ],
            [
                'title' => 'Some World title 2',
                'date' => 'January 3, 2021',
                'author' => 'Manivald',
                'body' => 'Some World content 2',
            ],
            [
                'title' => 'Some World title 3',
                'date' => 'January 5, 2021',
                'author' => 'Jorss',
                'body' => 'Some World content 3',
            ],
            [
                'title' => 'Some World title 4',
                'date' => 'January 7, 2021',
                'author' => 'Heli Kopter',
                'body' => 'Some World content 4',
            ],
        ];
        view('index', compact('title', 'posts'));
    }

    public function us()
    {
        $title = 'U.S';
        $posts = [
            [
                'title' => 'Some U.S title 1',
                'date' => 'January 1, 2021',
                'author' => 'Pets',
                'body' => 'Some U.S content 1',
            ],
            [
                'title' => 'Some U.S title 2',
                'date' => 'January 3, 2021',
                'author' => 'Manivald',
                'body' => 'Some U.S content 2',
            ],
            [
                'title' => 'Some U.S title 3',
                'date' => 'January 5, 2021',
                'author' => 'Jorss',
                'body' => 'Some U.S content 3',
            ],
            [
                'title' => 'Some U.S title 4',
                'date' => 'January 7, 2021',
                'author' => 'Heli Kopter',
                'body' => 'Some U.S content 4',
            ],
        ];
        view('us', compact('title', 'posts'));
    }

    public function tech()
    {
        $title = 'Technology';
        $posts = [
            [
                'title' => 'AI chips are reshaping laptop performance',
                'date' => 'January 10, 2021',
                'author' => 'Marten',
                'body' => 'New AI-focused silicon is pushing more on-device processing into everyday laptops and tablets.',
            ],
            [
                'title' => 'Cloud security teams are scaling with automation',
                'date' => 'January 12, 2021',
                'author' => 'Annika',
                'body' => 'Teams are automating threat detection and policy checks to keep up with rapid cloud growth.',
            ],
            [
                'title' => 'Low-code tools are accelerating product launches',
                'date' => 'January 15, 2021',
                'author' => 'Kaspar',
                'body' => 'More startups are leaning on visual workflows to ship experiments faster without a large engineering backlog.',
            ],
            [
                'title' => 'Battery breakthroughs are extending mobile workdays',
                'date' => 'January 18, 2021',
                'author' => 'Riin',
                'body' => 'Manufacturers are improving energy density and thermal management while keeping devices lighter and cooler.',
            ],
        ];
        view('tech', compact('title', 'posts'));
    }

    public function test() {
        $db = new App\DB();
    }

    public function form() {
        
        view('form');
    }

    public function answer(){
        dump($_GET, $_POST);
    }
}
