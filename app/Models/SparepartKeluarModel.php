<?php

namespace App\Models;

use CodeIgniter\Model;

class SparepartKeluarModel extends Model
{
    protected $table      = 'sparepart_keluar';
    protected $primaryKey = 'id_keluar';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['tgl_keluar', 'id_sparepart', 'jml', 'total', 'pelanggan'];

    public function get_dataJoin()
    {             
        $query =  $this->db->table('sparepart_keluar sk')  
         ->get();  
        return $query;
    }

    public function last_id()
    {             
        $query =  "SELECT max(id_keluar) as id_terakhir from sparepart_keluar"; 
        $sql = $this->db->query($query);
        return $sql->getResult();
    }

    public function get_detailPenjualan($id_keluar)
    {             
        $query =  $this->db->table('detail_penjualan d') 
        ->join('sparepart sp', 'sp.id_sparepart = d.id_sparepart') 
        ->where('d.id_keluar',$id_keluar)
        ->get();  
       return $query;
    }

    function tot_penjualan(){		
        $query = "SELECT count(id_keluar) as total FROM sparepart_keluar";
        $sql = $this->db->query($query);
        return $sql->getResult();
    }
}