<?php 

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;

class Pages extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function view(string $page = 'home')
    {
        //CHECK: if page exist has a file in the directory
        if(! is_file(APPPATH.'Views/pages/'.$page.".php") ) {
            // ERROR: page do not exist
            throw new PageNotFoundException($page);
        }

        // MAKE: first letter capital
        $data['title'] = ucfirst($page);

        // RETURN: views of the specific pages with the data
        return view('/templates/header', $data) 
            .view('pages/'.$page) 
            .view('templates/footer');
    }
}