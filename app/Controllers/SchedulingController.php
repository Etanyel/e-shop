<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Scheduling;
use App\Models\UsersModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\I18n\Time;

class SchedulingController extends BaseController
{
    public function res()
    {
        $users = new UsersModel();
        $time = Time::now();


        $userall = $users->where('deleted', 0)->findAll();
        $data = [
            'status' => 'success',
            'message' => 'connected successfully',
            'message2' => 'Hello World',
            'date' => $time,
            // 'users' => [$userall]
        ];

        return $this->response->setJSON($data);
    }

    public function toggle($id)
    {
        $userModel = new Scheduling();

        // If checkbox is checked, it's sent; otherwise, it’s not
        $isActive = $this->request->getPost('isActive') ? 1 : 0;

        $userModel->update($id, ['isActive' => $isActive]);

        return redirect()->back()->with('message', 'User status updated.');
    }
}
