<?php

namespace App\Controllers;

use App\Models\Scheduling;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }

    public function schedule()
    {
        $device = new Scheduling();

        $devices = $device->findAll();

        return view('petshop/schedule/schedule_system', ['devices' => $devices]);
    }
}
