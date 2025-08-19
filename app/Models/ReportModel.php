<?php

namespace App\Models;

use CodeIgniter\Model;

class ReportModel extends Model
{
    protected $table            = 'reports';
    protected $primaryKey       = 'sale_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'date_sold', 
        'item_sold', 
        'total_qty', 
        'total_amount', 
        'sold_by', 
        'remarks',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getSalesWithProducts()
    {
        return $this->db->table('reports')
            ->select('reports.*, products.product_name, products.price, products.category')
            ->join('products', 'products.id = reports.item_sold')
            ->orderBy('date_sold', 'DESC')
            ->get()
            ->getResultArray(); // or ->getResult() if you prefer objects
    }

    public function getSalesWithProductsBetweenDates($start, $end)
    {
        return $this->db->table('reports')
            ->select('reports.*, products.product_name, products.price, products.category')
            ->join('products', 'products.id = reports.item_sold')
            ->where('date_sold >=', $start)
            ->where('date_sold <=', $end)
            ->orderBy('date_sold', 'ASC')
            ->get()
            ->getResultArray();
    }

}
