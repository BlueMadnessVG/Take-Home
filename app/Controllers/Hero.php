<?php

namespace App\Controllers;

use App\Models\HerosModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Hero extends BaseController
{
    /* GET CONTROLLERS */

    /* Get all the component in the HERO_MODEL paginate and show it in the page */
    public function index()
    {
        /* make the session */
        session();
        /* hero model component */
        $model = new HerosModel();
        /* data with the paginator */
        $data = [
            'hero_list' => $model->paginate(10), /* default paginator is 20, but only 10 item are going to be show up */
            'pager'     => $model->pager,       /* paginator controller */
            'title'     => 'News archive',      /* tittle for the page */
        ];

        /* redirection of the "index" page */
        return view('templates/header', $data)
        . view('marvel/index')
        . view('templates/footer');
    }

    /* redirection to create form */
    public function new() {
        /* save posibles error in the form */
        helper('form');

        /* redirection to the "create" page */
        return view('templates/header', ['title' => 'Create a news item'])
            .view('marvel/create')
            .view('templates/footer');
    }

    /* find the item to be edited and show the page */
    public function edit($id) {
         /* save posibles error in the form */
        helper('form');

        /* find the data from bd */
        $model = new HerosModel();
        $hero = $model->asObject()->find($id);

        /* If the value is not found show page not found */
        if( $hero === null ) {
            /* trow error page */
            throw new PageNotFoundException('Cannot find news item: '. $id);
        }

        /* item data */
        $data = [
            'data'      => $hero,
            'title'     => 'Edit hero',
        ];

        /* redirection to "edit" page */
        return view('templates/header', $data)
            .view('marvel/edit')
            .view('templates/footer');
    }

    /* show the data from item */
    public function show($id)
    {
        session();

         /* find the data from bd */
        $model = new HerosModel();
        $hero = $model->asObject()->find($id);

        // If the value is not found show page not found
        if( $hero === null ) {
            throw new PageNotFoundException('Cannot find news item: '.$id);
        }

        /* add title to the data */
        $data['title'] = $hero['news']['title'];

        return view('templates/header', $data)
            . view('marvel/view')
            . view('templates/footer');
    }

    /* POST CONTROLLERS */
    /* create controller */
    public function create() {
        /* hero model component */
        $hero = new HerosModel();

        /* validate if the post data is valid */
        if($this->validate('hero')){
            /* save in bd */
            $hero->save(
                [
                    'name' => $this->request->getPost('name'),
                    'description' => $this->request->getPost('description'),
                    'thumbnail_path' => $this->request->getPost('thumbnail_path'),
                ]
            );
            /* return to index */
            return $this->index();
        }
        /* if not valid, return with error in validator */
        return redirect()->back()->withInput();

    }

    /* update controller */
    public function update($id) 
    {   
         /* find the data from bd */
        $model = new HerosModel();
        $hero = $model->asObject()->find($id);

        /* If the value is not found show page not found */
        if( $hero === null ) {
            throw new PageNotFoundException('Cannot find news item: '. $id);
        }

        /* validate if data in post is valid */
        if($this->validate('hero')){
            /* update the data in bd */
            $model->update($id,
                [
                    'name' => $this->request->getPost('name'),
                    'description' => $this->request->getPost('description'),
                    'thumbnail_path' => $this->request->getPost('thumbnail_path'),
                ]
            );

            /* return to index */
            return $this->index();
        }
        /* if not valid, return with error in validator */
        return redirect()->back()->withInput();
    }

    /* delete controller */
    public function delete($id) 
    {
        /* find the data from bd */
        $model = new HerosModel();
        $hero = $model->asObject()->find($id);

        /* If the value is not found show page not found */
        if( $hero === null ) {
            throw new PageNotFoundException('Cannot find news item: '. $id);
        }

        /* delete the item */
        $model->delete($id);

        /* redirect to hero */
        return redirect()->to('/hero');
    }

}
