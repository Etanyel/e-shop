<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Scheduling;
use CodeIgniter\HTTP\ResponseInterface;

class DeviceRegister extends BaseController
{
    protected $format = 'json';

    public function register()
    {
        $data = $this->request->getJSON(true); // Get JSON body as associative array
        $model = new Scheduling(); // Model for devices

        // Validate input
        if (empty($data['chip_id'])) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Missing chip_id'
                ]);
        }

        // Check if already registered
        $existing = $model->where('chip_id', $data['chip_id'])->first();

        if ($existing) {
            return $this->response->setJSON([
                'status' => 'success',
                'message' => 'Device already registered',
                'chip_id' => $data['chip_id']
            ]);
        }

        // Register new device
        $model->insert([
            'chip_id' => $data['chip_id']
        ]);

        return $this->response->setJSON([
            'status' => 'success',
            'message' => 'Device registered successfully',
            'chip_id' => $data['chip_id']
        ]);
    }

    public function update()
    {
        $model = new Scheduling();
        $id = $this->request->getPost('id');
        $data = [
            'system_name' => $this->request->getPost('name'),
            'network_name' => $this->request->getPost('network_name'),
            'morning_sched' => $this->request->getPost('morning'),
            'noon_sched' => $this->request->getPost('noon'),
            'evening_sched' => $this->request->getPost('evening'),
        ];

        $check = $model->where('system_id', $id);

        if (!$check) {
            return redirect()->back()->withInput()->with('error', 'System Not Found.');
        }

        $model->update($id, $data);

        return redirect()->back()->withInput()->with('success', 'System Updated.');
    }

    public function addDevice()
    {
        $model = new Scheduling();
        $data = [
            'system_name' => $this->request->getPost('name'),
            'network_name' => $this->request->getPost('network_name'),
            'morning_sched' => $this->request->getPost('morning'),
            'noon_sched' => $this->request->getPost('noon'),
            'evening_sched' => $this->request->getPost('evening'),
        ];

        $model->insert($data);
        return redirect()->back()->withInput()->with('success', 'Device Recorded.');
    }

    public function getSched()
    {
        $data = $this->request->getJSON(true);
        $model = new Scheduling();

        if (empty($data['chip_id'])) {
            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'Missing chip_id'
                ]);
        }

        $fetch = $model->where('chip_id', $data['chip_id'])->first();

        if (!$fetch) {
            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'status' => 'error',
                    'message' => 'System not found'
                ]);
        }

        return $this->response->setJSON([
            'status' => 200,
            'morning' => $fetch['morning_sched'],
            'noon' => $fetch['noon_sched'],
            'evening' => $fetch['evening_sched']
        ]);
    }
}
