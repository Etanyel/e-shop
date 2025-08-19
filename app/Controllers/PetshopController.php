<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PetshopModel;
use CodeIgniter\HTTP\ResponseInterface;

class PetshopController extends BaseController
{
    public function index()
    {
        $fetch = new PetshopModel();
        $search = $this->request->getGet('search');
        $data['user'] = session()->get('userData');

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

        return view('petshop/petshop', $data);
    }


}
