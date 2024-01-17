<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index() {
        $articles = [
            [
                'title' => 'mon premier article',
                'content' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sapiente sit temporibus, iure hic quas ratione porro optio labore, culpa suscipit at facilis explicabo deserunt rerum! Tempore illo magni velit expedita rem quos, commodi aliquid nemo accusamus quisquam necessitatibus libero impedit ea quia amet dignissimos saepe animi, maxime delectus facilis quam!'
            ],
            [
                'title' => 'mon deuxième article',
                'content' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sapiente sit temporibus, iure hic quas ratione porro optio labore, culpa suscipit at facilis explicabo deserunt rerum! Tempore illo magni velit expedita rem quos, commodi aliquid nemo accusamus quisquam necessitatibus libero impedit ea quia amet dignissimos saepe animi, maxime delectus facilis quam!'
            ],
            [
                'title' => 'mon troisème article',
                'content' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Sapiente sit temporibus, iure hic quas ratione porro optio labore, culpa suscipit at facilis explicabo deserunt rerum! Tempore illo magni velit expedita rem quos, commodi aliquid nemo accusamus quisquam necessitatibus libero impedit ea quia amet dignissimos saepe animi, maxime delectus facilis quam!'
            ],
        ];
    
        return view('home', [
            'articles' => $articles
        ]);
    }

    public function snakeGame() {
        $snakeContent = '<canvas width="400" height="400"></canvas>';

        return view('snake', [
            'canvas' => $snakeContent
        ]);
    }
}