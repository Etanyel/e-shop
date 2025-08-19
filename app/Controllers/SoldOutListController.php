<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PetshopModel;
use CodeIgniter\HTTP\ResponseInterface;

class SoldOutListController extends BaseController
{
    
    public function index()
    {
        $soldProduct = new PetshopModel();
        $search = $this->request->getGet('search');
        $query = $soldProduct->where('status', 'Sold_out')
                             ->where('qty', 0)
                             ->where('deleted', 0);

        if($search)
        {
            $query = $query->groupStart()
                            ->like('category')
                            ->orLike('product_name')
                            ->orLike('species')
                            ->orLike('description')
                            ->groupEnd();
        }

        $data ['soldProduct'] = $query->findAll();
        $data['search'] = $search;
        
        return view('petshop/sold_out_product', $data);
    }

    public function updateSoldProduct($id)
    {
        
        $product = new PetshopModel();
        $db = db_connect();
        if($img = $this->request->getFile('photo'))
        {
            if($img->isValid() && !$img->hasMoved())
            {
                $imgName = $img->getRandomName();
                $img->move('uploads/',$imgName);
            }
        }

        if(!empty($_FILES['photo']['name']))
        {
            $db->query("UPDATE products SET photo = $imgName WHERE id = '$id'");
        }

        $data = array(
            'product_name' => $this->request->getPost('productName'), 
            'species' => $this->request->getPost('species'), 
            'breed' => $this->request->getPost('breed'), 
            'age' => $this->request->getPost('age'), 
            'qty' => $this->request->getPost('qty'), 
            'price' => $this->request->getPost('price'),
            'description' => $this->request->getPost('description'),    
        );

        $product->update($id, $data);

        return redirect()->back()->with('success','Product Updated Successfully!');
    }

    public function restock($id)
    {
        $stock = new PetshopModel();
        $qty = $this->request->getPost('qty');
        $restock = $stock->set('qty', $qty)
                         ->set('status', 'Available')
                         ->where('id', $id)
                         ->update();

        return redirect()->back()->with('success', 'Product Re-stocked Successfully!');

    }
}
