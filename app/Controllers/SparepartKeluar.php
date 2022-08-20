<?php namespace App\Controllers;

use \App\Models\SparepartKeluarModel;
use \App\Models\SparepartModel; 
use \App\Models\StokModel; 
use \App\Models\DetailPenjualanModel; 

use CodeIgniter\Exceptions\PageNotFoundException;

class SparepartKeluar extends BaseController
{
    
	public function index()
	{
        $sparepart_keluar = new SparepartKeluarModel(); 
        $sparepart = new SparepartModel();
        $data['sparepart_keluar'] = $sparepart_keluar->get_dataJoin()->getResult(); 
        $data['data_sparepart'] = $sparepart->findAll();
		echo view('sparepart_keluar/data_sparepart_keluar', $data);
    } 
 
    public function store()
    {  
        $sparepart_keluar = new SparepartKeluarModel();
        if($this->request->getPost('tipe_form') == 'add'){  
            $cek = $sparepart_keluar->insert([
                "tgl_keluar" => $this->request->getPost('tgl_keluar'),   
                "pelanggan" => $this->request->getPost('pelanggan'),  
                "total" => $this->request->getPost('grand_total'),  
            ]);
            $stok = new StokModel();
            $detail_penjualan = new DetailPenjualanModel(); 
            $last_id = $sparepart_keluar->last_id();   
            for ($count = 0; $count < count($_POST["id_sparepart"]); $count++) {  

                $cek = $detail_penjualan->insert([
                    'id_keluar' => (int)$last_id[0]->id_terakhir,
                    'id_sparepart' => $_POST["id_sparepart"][$count],
                    'harga' => $_POST["harga"][$count], 
                    'jml' => $_POST["qty"][$count],
                    'total' => $_POST["total"][$count], 
                ]);

                $stok_sparepart = $stok->where('id_sparepart',$_POST["id_sparepart"][$count])->first();
                $stok_terakhir = $stok_sparepart['stok'];
                $stok->update($this->request->getPost('id_sparepart'),[
                    "stok" => $stok_terakhir - $_POST["qty"][$count] 
                ]);
            }
        
        } 
        echo $cek;
         
    }
 

    public function edit($id)
    { 
        $sparepart_keluar = new SparepartKeluarModel();
        $sparepart = new SparepartModel();
        $data['data_sparepart'] = $sparepart->findAll();

        $data['data_sparepart_keluar'] = $sparepart_keluar->where('id_keluar', $id)->first(); 
        echo view('sparepart_keluar/edit_sparepart_keluar', $data);
    }
 

	public function delete(){
        $sparepart_keluar = new SparepartKeluarModel();
        $cek = $sparepart_keluar->delete($this->request->getPost('id_keluar')); 
        echo $cek;
    }

    public function cetak_nota($id)
    {
        $sparepart_keluar = new SparepartKeluarModel(); 
        $data['data_sparepart_keluar'] = $sparepart_keluar->where('id_keluar', $id)->first();  
        $data['data_detail_penjualan'] = $sparepart_keluar->get_detailPenjualan($id)->getResult();
        echo view('sparepart_keluar/cetaknota_new', $data);
    }
 

    public function detail_penjualan(){
      
        $sparepart_keluar = new SparepartKeluarModel(); 
        $detail_penjualan = $sparepart_keluar->get_detailPenjualan($this->request->getPost('id_keluar'))->getResult(); 
        $html = ''; 
        $no=1;
        foreach ($detail_penjualan as $value) {
            $html .= '<tr><td>' . $no++.' </td><td>' . $value->nm_sparepart.' </td><td>'."Rp " . number_format($value->harga,0,',','.'). '</td><td>' .$value->jml . '</td><td>' . "Rp " . number_format($value->total,0,',','.') . '</td></tr>';
        }
        echo $html;

    }
}