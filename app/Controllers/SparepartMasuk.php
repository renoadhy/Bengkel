<?php namespace App\Controllers;

use \App\Models\SparepartMasukModel;
use \App\Models\SparepartModel;
use \App\Models\SupplierModel;
use \App\Models\StokModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class SparepartMasuk extends BaseController
{
	public function index()
	{
        $sparepart_masuk = new SparepartMasukModel();
        $supplier = new SupplierModel();
        $sparepart = new SparepartModel();
        $data['sparepart_masuk'] = $sparepart_masuk->get_dataJoin()->getResult();
        $data['data_supplier'] = $supplier->findAll();
        $data['data_sparepart'] = $sparepart->findAll();
		echo view('sparepart_masuk/data_sparepart_masuk', $data);
    } 
 
    public function store()
    {  
        $sparepart_masuk = new SparepartMasukModel();
        if($this->request->getPost('tipe_form') == 'add'){ 
            $cek = $sparepart_masuk->insert([
                "tgl_masuk" => $this->request->getPost('tgl_masuk'),  
                "id_sparepart" => $this->request->getPost('id_sparepart'),  
                "jml" => $this->request->getPost('jml'),  
                "total" => $this->request->getPost('total'),  
                "id_supplier" => $this->request->getPost('id_supplier'),  
            ]);
            $stok = new StokModel();
            $stok_sparepart = $stok->where('id_sparepart',$this->request->getPost('id_sparepart' ))->first();
            $stok_terakhir = $stok_sparepart['stok'];
            $stok->update($this->request->getPost('id_sparepart'),[
                "stok" => $stok_terakhir + $this->request->getPost('jml')
            ]);


        }else{
            $cek = $sparepart_masuk->update($this->request->getPost('id_sparepart_masuk'), [
                "tgl_masuk" => $this->request->getPost('tgl_masuk'),  
                "id_sparepart" => $this->request->getPost('id_sparepart'),  
                "jml" => $this->request->getPost('jml'),  
                "total" => $this->request->getPost('total'),  
                "id_supplier" => $this->request->getPost('id_supplier'),  
            ]);
        }
            echo $cek;
         
    }
 

    public function edit($id)
    { 
        $sparepart_masuk = new SparepartMasukModel();
        $data['data_sparepart_masuk'] = $sparepart_masuk->where('id_masuk', $id)->first(); 
        echo view('sparepart_masuk/edit_sparepart_masuk', $data);
    }
 

	public function delete(){
        $sparepart_masuk = new SparepartMasukModel();
        $cek = $sparepart_masuk->delete($this->request->getPost('id_masuk')); 
        echo $cek;
    }
}