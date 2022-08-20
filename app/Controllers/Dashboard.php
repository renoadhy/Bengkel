<?php namespace App\Controllers;

use \App\Models\SparepartModel; 
use \App\Models\SparepartKeluarModel;
use \App\Models\SparepartMasukModel;
use \App\Models\SupplierModel;


 
use CodeIgniter\Exceptions\PageNotFoundException;

class Dashboard extends BaseController
{
	public function index()
	{
        $sparepart_masuk = new SparepartMasukModel();
        $sparepart = new SparepartModel();   
        $sparepart_keluar = new SparepartKeluarModel(); 
        $supplier = new SupplierModel();


        $data['sparepart_masuk'] = $sparepart_masuk->tot_sparepart_masuk(); 
        $data['sparepart_keluar'] = $sparepart_keluar->tot_penjualan(); 
        $data['sparepart'] = $sparepart->tot_sparepart(); 
        $data['supplier'] = $supplier->tot_supplier();  
        
        echo view('dashboard/index',$data); 
    }

    
}