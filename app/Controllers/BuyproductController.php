<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ReportModel;
use App\Models\PetshopModel;

class BuyproductController extends BaseController
{
    public function buyProduct($id)
    {
        date_default_timezone_set('Asia/Manila');
        $product = new PetshopModel();

        $report = new ReportModel();

        $qty = $this->request->getPost('qty');

        $item = $product->find($id);

        if(!$item)
        {
            return redirect()->back()->with('error', 'Invalid Product');
        }elseif($qty > $item['qty']){
            return redirect()->back()->with('error', 'Insufficient Product');

        }

        $total_amount = $item['price'] * $qty;



        $data = array(
            'date_sold' => date('Y-m-d H:i:s'),
            'item_sold' => $id,
            'total_qty' => $qty,
            'total_amount' => $total_amount,
            'sold_by' => $this->request->getPost('sold_by'),
            'remarks' => $this->request->getPost('remarks'),
        );

        $product->set('qty', 'qty - '. $qty, false)->where('id', $id)->update();

        if($item['qty'] === 0)
        {
            $product->set('status', 'Sold_out')->update();
        }
        $report->insert($data);

        return redirect()->back()->with('success', 'Product Purchased Successfully!');
    }
}
