<?php namespace App\Controllers;

use \App\Models\SupplierModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class Supplier extends BaseController
{
	public function index()
	{
        $supplier = new SupplierModel();
        $data['supplier'] = $supplier->findAll();
		echo view('supplier/data_supplier', $data);
    } 
 
    public function store()
    {  
        $supplier = new SupplierModel();
        if($this->request->getPost('tipe_form') == 'add'){

            $cek = $supplier->insert([
                "nm_supplier" => $this->request->getPost('nm_supplier'),  
                "alamat" => $this->request->getPost('alamat'),  
                "no_telp" => $this->request->getPost('no_telp'),  
            ]);
        }else{
            $cek = $supplier->update($this->request->getPost('id_supplier'), [
                "nm_supplier" => $this->request->getPost('nm_supplier'),  
                "alamat" => $this->request->getPost('alamat'),  
                "no_telp" => $this->request->getPost('no_telp'),  
            ]);
        }
            echo $cek;
         
    }
 

    public function edit($id)
    { 
        $supplier = new SupplierModel();
        $data['data_supplier'] = $supplier->where('id_supplier', $id)->first(); 
        echo view('supplier/edit_supplier', $data);
    }
 

	public function delete(){
        $supplier = new SupplierModel();
        $cek = $supplier->delete($this->request->getPost('id_supplier')); 
        echo $cek;
    }
}