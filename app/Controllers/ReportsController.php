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

    public function monthlyReport()
    {
        helper('date');
        helper('url');

        $dompdf = new Dompdf();
        $reportModel = new ReportModel();

        // Read month from GET parameter (format: YYYY-MM)
        $monthParam = $this->request->getGet('month'); // e.g., "2025-09"

        if ($monthParam) {
            $year = date('Y', strtotime($monthParam . '-01'));
            $month = date('m', strtotime($monthParam . '-01'));
        } else {
            $month = date('m');
            $year = date('Y');
        }

        // Start & end of month
        $startDate = "$year-$month-01";
        $endDate = date("Y-m-t", strtotime($startDate));

        // Fetch reports
        $reports = $reportModel->getSalesWithProductsBetweenDates($startDate, $endDate);

        // Group by day
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

        $data = [
            'groupedReports' => $groupedReports,
            'month' => date('F', strtotime($startDate)),
            'year' => $year,
            'monthlyTotal' => $monthlyTotal
        ];

        // Load PDF view
        $html = view('petshop/reports/pdf/sales_report_pdf', $data);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $dompdf->stream("Sales_Report_{$year}_{$month}.pdf", ['Attachment' => false]);
    }
}
