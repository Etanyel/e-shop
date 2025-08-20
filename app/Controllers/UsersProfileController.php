<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsersModel;

class UsersProfileController extends BaseController
{
    public function showProfile()
    {
        $session = session()->get('userData'); // or however you store it in session
        $userId = $session['user_id'];

        $userModel = new UsersModel();
        $data['user'] = $userModel->where('deleted', 0)
                      ->where('status', 'approved')
                      ->find($userId);

        return view('petshop/users/usersProfile/profile', $data);
    }

    public function updateProfile($user_id)
    {
        $user = new UsersModel();
        $userinfo = $user->where('deleted', 0)
                        ->where('status', 'approved')
                        ->where('user_id', $user_id)
                        ->first();

        if (!$userinfo) {
            return redirect()->back()->with('error', 'User not found!');
        }


        $data = [
            'firstname' => $this->request->getPost('firstname'),
            'lastname'  => $this->request->getPost('lastname'),
            'username'  => $this->request->getPost('username'),
            'contact'   => $this->request->getPost('contact'),
        ];

    
        $oldPassword = $this->request->getPost('OldPassword');
        $newPassword = $this->request->getPost('NewPassword');

        if (!empty($oldPassword) && !empty($newPassword)) {
            if (password_verify($oldPassword, $userinfo['password'])) {
                $data['password'] = password_hash($newPassword, PASSWORD_DEFAULT);
            } else {
                return redirect()->back()->with('error', 'Incorrect old password!');
            }
        }

      
        $img = $this->request->getFile('photo');
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $imgName = $img->getRandomName();
            $img->move('uploads/users/', $imgName);
            $data['photo'] = $imgName;
        }

        $user->update($user_id, $data);

        return redirect()->to('/profile')->with('success', 'Profile Updated Successfully!');
    }
}
