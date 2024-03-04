<?php

namespace App\Models;

use CodeIgniter\Model;

class Feedback extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'feedback';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

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

    function getFeedback()
    {
        $data = $this->select('feedback.*,pembeli.nama as nama_pembeli,event.*')
            ->join('transaksi','transaksi.id=feedback.transaksi_id')
            ->join('pembeli','transaksi.pembeli_id=pembeli.id')
            ->join('event','event.id=feedback.event_id');
        return $data;
    }
    function getResumeEventFeedback()
    {
        $data = $this->select('event.*,kategori_event.nama as nama_kategori,(SUM(feedback.rating)/COUNT(feedback.id)) rating, count(transaksi.id) as jumlah_transaksi')
            ->join('transaksi','transaksi.id=feedback.transaksi_id')
            ->join('event','event.id=feedback.event_id')
            ->join('kategori_event','kategori_event.id=event.kategori_event_id')
            ->groupBy('event.id');

        return $data;
    }
}
