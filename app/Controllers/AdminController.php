<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UsersModel;
use App\Models\ReportModel;
use App\Controllers\ReportsController;

class AdminController extends BaseController
{
    public function index()
    {
        $user = new UsersModel();
        $reports = new ReportModel();

        $currentDate = date('Y-m-d');

        $report = $reports->select('reports.*, products.product_name, products.category, products.price')
                          ->join('products', 'products.id = reports.item_sold');

        $data['users'] = $user->where('deleted', 0)->findAll();
        $data['approvedCount'] = $user->where('status', 'approved')->where('deleted', 0)->countAllResults();
        $data['PendingCount'] = $user->where('status', 'pending')->where('deleted', 0)->countAllResults();
        $data['rejectedCount'] = $user->where('status', 'rejected')->where('deleted', 0)->countAllResults();

        $data['reports'] = $report->where('DATE(date_sold)',$currentDate)->findAll();

        $totalprice = 0;
        foreach ($data['reports'] as $price){
            $totalprice += $price['total_amount'];
        }

        $data['Totalprice'] = $totalprice;
        $data['userData'] = session()->get('userData');

        return view('petshop/users/admin/admin_dashboard', $data);
    }

    public function adminSales()
    {

        $model = new ReportModel();

        $month = $this->request->getGet('month');
        $selectedMonth = $month;

        $builder = $model->select('reports.*, products.product_name, products.category, products.price')
            ->join('products', 'products.id = reports.item_sold');

        if ($month) {
            $start = date('Y-m-01', strtotime($month));
            $end = date('Y-m-t', strtotime($month));
            $builder->where('date_sold >=', $start)
                    ->where('date_sold <=', $end);
        }

        $results = $builder->orderBy('date_sold', 'DESC')->findAll();

        // Group by month label
        $groupedReports = [];

        foreach ($results as $row) {
            $label = date('F Y', strtotime($row['date_sold']));
            $groupedReports[$label][] = $row;
        }

        return view('petshop/users/admin/sales_admin', [
            'groupedReports' => $groupedReports,
            'selectedMonth' => $selectedMonth
        ]);


    }

    public function printSales($month = null, $year = null)
    {
        $printer = new ReportsController();
        $print = $printer->monthlyReport($month, $year);
    }

    public function users()
    {
        $users = new UsersModel();
        $search = $this->request->getGet('search');
        $query = $users->where('status', 'approved')->where('deleted', 0);
        if($search)
        {
            $query = $query->groupStart()
                           ->like('firstname', $search)
                           ->orLike('lastname', $search)
                           ->orLike('username', $search)
                           ->groupEnd();
        }

        $approved = $query->findAll();
        $data['users'] = $approved;
        $data['search'] = $search;

        return view('petshop/users/admin/users', $data);
    }

    public function pendingUsers()
    {
        $users = new UsersModel();
        $search = $this->request->getGet('search');

        $query = $users->where('status', 'pending')->where('deleted', 0);
        if($search)
        {
            $query = $query->groupStart()
                                ->like('firstname', $search)
                                ->orLike('lastname', $search)
                                ->orLike('username', $search)
                            ->groupEnd();
        }
        
        $pendingUsers = $query->findAll();
        $data['users'] = $pendingUsers;
        $data['search'] = $search;

        return view('petshop/users/admin/pendingUsers', $data);
    }

    public function rejectedUsers()
    {
        $search = $this->request->getGet('search');

        $users = new UsersModel();
        $query = $users->where('status','rejected')->where('deleted', 0);
        if($search)
        {
            $query = $query->groupStart()
                           ->like('firstname', $search)
                           ->orLike('lastname', $search)
                           ->orLike('username', $search)
                           ->groupEnd();
        }

        $rejected = $query->findAll();
        $data['users'] = $rejected;
        $data['search'] = $search;
        return view('petshop/users/admin/rejectedUsers', $data);
    }


    public function rejectUser($user_id)
    {
        $users = new UsersModel();
        $user_id = $this->request->getPost('id');
        $reject = $users->set('status', 'rejected')
                        ->where('user_id', $user_id);
        $reject->update();

        return redirect()->to('/admin/users/pending')->with('success', 'User Rejected Successfully!');
        
    }

    public function approveUser($user_id)
    {
        $users = new UsersModel();
        $user_id = $this->request->getPost('id');

        $approved = $users->set('status', 'approved')
                          ->where('deleted', 0)
                          ->where('user_id', $user_id);
        $approved->update();

        return redirect()->to('/admin/users/pending')->with('success', 'User Approved Successfully!');
    }

    public function pendingUser($id)
    {
        $users = new UsersModel();
        $user_id = $this->request->getPost('id');

        $pending = $users->set('status', 'pending')->where('user_id', $id);

        $pending->update();

        return redirect()->back()->with('success', 'User has moved to Pending.');
    }

}
