<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PetshopModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsersModel;

class ProductlistController extends BaseController
{
    public function index()
    {
        $fetch = new PetshopModel();
        $search = $this->request->getGet('search');

        $fetch->where('qty', 0)->set(['status' => 'Sold_out'])->update();
        $query = $fetch->where('qty !=', 0)
                        ->where('status !=', 'Sold_out')
                        ->where('deleted', 0);

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

        //To get the Users data
        $session = session()->get('userData'); 
        $userId = $session['user_id'];

        $userModel = new UsersModel();
        $data['user'] = $userModel->where('deleted', 0)
                      ->where('status', 'approved')
                      ->find($userId);

        return view('petshop/product_list', $data);
    }

    
    public function filterProduct()
    {
        $model = new PetshopModel();
    
        $category = $this->request->getGet('category');
        $species = $this->request->getGet('species');
    
        // Only get products that are not sold out
        $model->where('status !=', 'Sold_out')->where('deleted', 0);
    
        if (!empty($category)) {
            $model->where('category', $category);
        }
    
        if (!empty($species)) {
            $model->where('species', $species);
        }
    
        $data['products'] = $model->findAll();
    
        return view('petshop/product_list', $data);
    }

    
    public function addProduct()
    {
        if($img = $this->request->getFile('productImg'))
        {
            if($img->isValid() && !$img->hasMoved())
            {
                $imgName = $img->getRandomName();
                $img->move('uploads/',$imgName);
            }
        }
        $product = new PetshopModel();
        $product_id = random_int(1000, 99999);
        $data = array(
            'product_id' => $product_id, 
            'product_name' => $this->request->getPost('productName'), 
            'category' => $this->request->getPost('category'), 
            'species' => $this->request->getPost('species'), 
            'breed' => $this->request->getPost('breed'), 
            'age' => $this->request->getPost('age'), 
            'qty' => $this->request->getPost('qty'), 
            'price' => $this->request->getPost('price'),
            'arrival_date' => $this->request->getPost('arrivalDate'), 
            'description' => $this->request->getPost('description'), 
            'photo' => $imgName,
        );

        $product->insert($data);

        return redirect()->to('/product')->with('success','New Product Added Successfully!');
    }

    
    public function updateProduct($id)
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

        return redirect()->to('/product')->with('success','Product Updated Successfully!');
    }

    

    public function deleteProduct($id)
    {
        $model = new PetshopModel();

        $model->set('deleted',1)->update($id);
        return redirect()->to('/product')->with('success','Product Remove Successfully!');  

    }
}
