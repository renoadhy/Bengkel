<?php namespace App\Controllers;

use \App\Models\SparepartModel; 
use \App\Models\StokModel; 

use CodeIgniter\Exceptions\PageNotFoundException;

class Sparepart extends BaseController
{
     

	public function index()
	{
        $sparepart = new SparepartModel();  
        $data['sparepart'] = $sparepart->get_dataJoin()->getResult();  
		echo view('sparepart/data_sparepart', $data);
    } 
 
    public function store()
    {  
        $stok = new StokModel();
        $sparepart = new SparepartModel();   

     
        if($this->request->getPost('tipe_form') == 'add'){    
            if( $_FILES["gambar"]["name"] !== "") 
            {
                $dataBerkas = $this->request->getFile('gambar');
                $fileName = $dataBerkas->getRandomName();
                    $cek = $sparepart->insert([
                        "nm_sparepart" => $this->request->getPost('nm_sparepart'), 
                        "harga" => $this->request->getPost('harga'), 
                        "gambar" => $fileName
                    ]);

                    $dataBerkas->move('./uploads', $fileName); 
                    $last_id = $sparepart->last_id();  
                    $cek2 = $stok->insert([
                        "id_sparepart" => (int)$last_id[0]->id_terakhir, 
                        "stok" => 0
                    ]); 

            }else{
                $cek = $sparepart->insert([
                    "nm_sparepart" => $this->request->getPost('nm_sparepart'), 
                    "harga" => $this->request->getPost('harga')
                ]);
                $last_id = $sparepart->last_id();  
                $cek2 = $stok->insert([
                    "id_sparepart" => (int)$last_id[0]->id_terakhir, 
                    "stok" => 0
                ]); 
            }

        }else{
            if ( $_FILES["gambar"]["name"] !== "") 
            { 
                    $dataBerkas = $this->request->getFile('gambar');
                    $fileName = $dataBerkas->getRandomName();

                    $cek = $sparepart->update($this->request->getPost('id_sparepart'), [
                        "nm_sparepart" => $this->request->getPost('nm_sparepart'), 
                        "harga" => $this->request->getPost('harga'), 
                        "gambar" => $fileName
                    ]); 
                    $dataBerkas->move('uploads', $fileName);
            }
            else{
                    $cek = $sparepart->update($this->request->getPost('id_sparepart'), [
                        "nm_sparepart" => $this->request->getPost('nm_sparepart'), 
                        "harga" => $this->request->getPost('harga'),  
                    ]);
            }
        }
            echo $cek;   
         
    }
 

    public function edit($id)
    { 
        $sparepart = new SparepartModel();   
        $data['data_sparepart'] = $sparepart->where('id_sparepart', $id)->first(); 
        echo view('sparepart/edit_sparepart', $data);
    }
 

	public function delete(){
        $sparepart = new SparepartModel();   
        $cek = $sparepart->delete($this->request->getPost('id_sparepart')); 
        echo $cek; 
    } 

    public function show()
    { 
        $sparepart = new SparepartModel();   
        $data = $sparepart->where('id_sparepart', $this->request->getPost('id_sparepart'))->first(); 
        echo json_encode($data);
    }

    public function list_sparepart()
    {
        $query = $this->request->getPost('query');
        $sparepart = new SparepartModel();
        $data = $sparepart->get_allListSparepart($query); 
        $output = '';
        foreach ($data as $value) {
            $output .= '<li class="list-group-item contsearch drop">
							<a href="javascript:void(0)" class="gsearch" style="color:#333;text-decoration:none;" id_sparepart=' . $value->id_sparepart . ' nm_sparepart ='.$value->nm_sparepart.'  stok ='.$value->stok.' harga=' . $value->harga . '>'.$value->nm_sparepart.'</a>
							</li>
							';
        }
        echo $output;
    }
	 
}