<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PetshopModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsersModel;
class PetshopController extends BaseController
{
    public function userModel()
    {
        $users = new UsersModel();
        return $users;
    }
    public function index()
    {
        $fetch = new PetshopModel();
        $search = $this->request->getGet('search');
        

        $fetch->where('qty', 0)->set(['status' => 'Sold_out'])->update();
        $query = $fetch->where('qty !=', 0)->where('status !=', 'Sold_out')->where('deleted', 0);

        if ($search) {
            $query = $query
                ->groupStart()
                    ->like('product_name', $search)
                    ->orLike('category', $search)
                    ->orLike('species', $search)
                    ->orLike('description', $search)
                ->groupEnd();
        }

        $data['products'] = $query->findAll();
        $data['search'] = $search;
        $data['user'] = session()->get('userData');
        return view('petshop/petshop', $data);
    }


    public function showProfile()
    {
        $data['user'] = session()->get('userData');

        return view('petshop/users/usersProfile/profile', $data);
        
    }
}
