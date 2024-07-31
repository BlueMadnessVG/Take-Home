<?php

namespace App\Controllers;

use App\Models\NewsModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class News extends BaseController
{

    // GET: all the news and display them
    public function index()
    {
        $model = model(NewsModel::class);

        $data = [
            'news_list' => $model->getNews(),
            'title'     => 'News archive',
        ];

        return view('templates/header', $data)
            . view('news/index')
            . view('templates/footer');
    }

    // GET: specific item and show it information
    public function show(?string $slug = null)
    {
        $model = model(NewsModel::class);
        $data['news'] = $model->getNews($slug);

        // If the value is not found show page not found
        if( $data['news'] === null ) {
            throw new PageNotFoundException('Cannot find news item: '.$slug);
        }

        $data['title'] = $data['news']['title'];

        return view('templates/header', $data)
            . view('news/view')
            . view('templates/footer');
    }

}