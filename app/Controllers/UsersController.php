<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsersModel;


class UsersController extends BaseController
{
    public function usersModel()
    {
        $usersModel = new UsersModel();
        return $usersModel;
    }
    
    public function users()
    {
        return view('/petshop/users/login');
    }

    public function registerUser()
    {
        if($img = $this->request->getFile('photo'))
        {
            $user = new UsersModel();
            if($img->isValid() && !$img->hasMoved())
            {
                $imgName = $img->getRandomName();
                $img->move('uploads/users/', $imgName);
            }
        }
        $data = array(
            'firstname' => $this->request->getPost('fname'), 
            'lastname' => $this->request->getPost('lname'), 
            'username' => $this->request->getPost('username'), 
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT), 
            'contact' => $this->request->getPost('contact'), 
            'photo' => $imgName,
        );

        $user->insert($data);

        return redirect()->to('/login')->with('success', 'User Registered Successfully, Ask the admin to Approve your registration.');
    }

    public function login()
    {
        $validation = \Config\Services::validation();
        $validation->setRules([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', 'Username and password are required');
        }

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $model = new UsersModel();
        $user = $model->where('username', $username)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return redirect()->back()->withInput()->with('error', 'Invalid username or password');
        }

        session()->set('isLoggedIn', true);
        session()->set('userData', $user);

        if($user['role'] === 'employee')
        {
            return redirect()->to('/petshop');
        }elseif($user['role'] === 'admin')
        {   
            return redirect()->to('/dashboard');
        }
    }

    public function allUsers()
    {
        $userModel = new UsersModel();
        $data['users'] = $userModel->where('role', 'employee')->where('deleted', 0)->findAll();
        return view('admin/users', $data);
    }

    public function approve($id)
    {
        $userModel = new UsersModel();
        $userModel->update($id, ['status' => 'approved']);
        return redirect()->back()->with('success', 'User approved successfully!');
    }

    public function reject($id)
    {
        $userModel = new UsersModel();
        $userModel->update($id, ['status' => 'rejected']);
        return redirect()->back()->with('success', 'User rejected successfully!');
    }

    public function reports()
    {
        $userModel = new UsersModel();
        $data['users'] = $userModel->findAll();
        
        return view('admin/reports', $data);
    }

    public function updateUser($id)
    {
        $users = new UsersModel();
        if($img = $this->request->getFile('photo'))
        {
            if($img->isValid() && !$img->hasMoved())
            {
                $imgName = $img->getRandomName();
                $img->move('uploads/users/', $imgName);
            }
        }

        if(!empty($_FILES['photo']['name']))
        {
            $users->set('photo', $imgName)->where('user_id', $id)->update();
        }


        $data = array(
            'firstname' => $this->request->getPost('fname'), 
            'lastname' => $this->request->getPost('lname'), 
            'username' => $this->request->getPost('username'),
            'contact' => $this->request->getPost('contact'), 
            'photo' => $imgName,
            'role' => $this->request->getPost('role')
        );

        $users->update($id, $data);
        return redirect()->back()->with('success', 'User Updated Successfully!');
    }

    public function deleteUser($user_id)
    {
        $user_id = $this->request->getPost('id');

        $delete = $this->usersModel()->set('deleted', 1)->where('user_id', $user_id);

        $delete->update();

        return redirect()->back()->with('success', 'User has been Deleted.');
    }


}
