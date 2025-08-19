<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ReportModel;
use App\Models\PetshopModel;
use Dompdf\Dompdf;

class ReportsController extends BaseController
{
    public function sales()
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

        return view('petshop/reports/sales', [
            'groupedReports' => $groupedReports,
            'selectedMonth' => $selectedMonth
        ]);
    }

    public function monthlyReport($month = null, $year = null)
    {
        helper('date');
        helper('url');

        $dompdf = new Dompdf();
        $reportModel = new ReportModel();

        $month = $month ?? date('m');
        $year  = $year ?? date('Y');

        // Get start and end of month
        $startDate = "$year-$month-01";
        $endDate   = date("Y-m-t", strtotime($startDate));

        // Fetch reports with JOIN
        $reports = $reportModel->getSalesWithProductsBetweenDates($startDate, $endDate);

        // Group by day and compute totals
        $groupedReports = [];
        $monthlyTotal = 0;

        foreach ($reports as $report) {
            $date = date('Y-m-d', strtotime($report['date_sold']));

            if (!isset($groupedReports[$date])) {
                $groupedReports[$date] = [
                    'records' => [],
                    'daily_total' => 0
                ];
            }

            $groupedReports[$date]['records'][] = $report;
            $groupedReports[$date]['daily_total'] += $report['total_amount'];
            $monthlyTotal += $report['total_amount'];
        }

        $data['groupedReports'] = $groupedReports;
        $data['month'] = date('F', strtotime($startDate));
        $data['year'] = $year;
        $data['monthlyTotal'] = $monthlyTotal;

        // Load HTML view
        $html = view('petshop/reports/pdf/sales_report_pdf', $data);

        // Generate PDF
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream("Sales_Report_{$year}_{$month}.pdf", ['Attachment' => false]);

        return true;
    }
}
