<?php

namespace App\Models;

use CodeIgniter\Model;

class ServisKeluarModel extends Model
{
    protected $table      = 'servis_keluar';
    protected $primaryKey = 'id_servis_keluar';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['tgl_keluar', 'id_servis', 'jml', 'total', 'pelanggan'];

    public function get_dataJoin()
    {
        $query =  $this->db->table('servis_keluar sk')
            ->get();
        return $query;
    }

    public function last_id()
    {
        $query =  "SELECT max(id_servis_keluar) as id_terakhir from servis_keluar";
        $sql = $this->db->query($query);
        return $sql->getResult();
    }

    public function get_detailPenjualan($id_keluar)
    {
        $query =  $this->db->table('detail_servis d')
            ->join('servis sp', 'sp.id_servis = d.id_servis')
            ->where('d.id_keluar', $id_keluar)
            ->get();
        return $query;
    }

    function tot_penjualan()
    {
        $query = "SELECT count(id_servis_keluar) as total FROM servis_keluar";
        $sql = $this->db->query($query);
        return $sql->getResult();
    }
}
