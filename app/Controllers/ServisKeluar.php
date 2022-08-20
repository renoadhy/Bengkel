<?php namespace App\Controllers;

use \App\Models\ServisKeluarModel;
use \App\Models\ServisModel; 
use \App\Models\DetailPenjualanModel; 

use CodeIgniter\Exceptions\PageNotFoundException;

class ServisKeluar extends BaseController
{
    
	public function index()
	{
        $servis_keluar = new ServisKeluarModel(); 
        $servis = new ServisModel();
        $data['servis_keluar'] = $servis_keluar->get_dataJoin()->getResult(); 
        $data['data_servis'] = $servis->findAll();
		echo view('servis_keluar/data_servis_keluar', $data);
    } 
 
    public function store()
    {  
        $servis_keluar = new ServisKeluarModel();
        if($this->request->getPost('tipe_form') == 'add'){  
            $cek = $servis_keluar->insert([
                "tgl_keluar" => $this->request->getPost('tgl_keluar'),   
                "pelanggan" => $this->request->getPost('pelanggan'),  
                "total" => $this->request->getPost('grand_total'),  
            ]);{  

                $cek = $detail_penjualan->insert([
                    'id_keluar' => (int)$last_id[0]->id_terakhir,
                    'id_servis' => $_POST["id_servis"][$count],
                    'harga' => $_POST["harga"][$count], 
                    'jml' => $_POST["qty"][$count],
                    'total' => $_POST["total"][$count], 
                ]);
            }
        
        } 
        echo $cek;
         
    }
 

    public function edit($id)
    { 
        $servis_keluar = new ServisKeluarModel();
        $servis = new ServisModel();
        $data['data_servis'] = $servis->findAll();

        $data['data_servis_keluar'] = $servis_keluar->where('id_keluar', $id)->first(); 
        echo view('servis_keluar/edit_servis_keluar', $data);
    }
 

	public function delete(){
        $servis_keluar = new ServisKeluarModel();
        $cek = $servis_keluar->delete($this->request->getPost('id_keluar')); 
        echo $cek;
    }

    public function cetak_nota($id)
    {
        $servis_keluar = new ServisKeluarModel(); 
        $data['data_servis_keluar'] = $servis_keluar->where('id_keluar', $id)->first();  
        $data['data_detail_penjualan'] = $servis_keluar->get_detailPenjualan($id)->getResult();
        echo view('servis_keluar/cetaknota_new', $data);
    }
 

    public function detail_penjualan(){
      
        $servis_keluar = new ServisKeluarModel(); 
        $detail_penjualan = $servis_keluar->get_detailPenjualan($this->request->getPost('id_keluar'))->getResult(); 
        $html = ''; 
        $no=1;
        foreach ($detail_penjualan as $value) {
            $html .= '<tr><td>' . $no++.' </td><td>' . $value->nm_servis.' </td><td>'."Rp " . number_format($value->harga,0,',','.'). '</td><td>' .$value->jml . '</td><td>' . "Rp " . number_format($value->total,0,',','.') . '</td></tr>';
        }
        echo $html;

    }
}