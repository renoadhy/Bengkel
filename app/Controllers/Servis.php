<?php namespace App\Controllers;

use \App\Models\ServisModel; 

use CodeIgniter\Exceptions\PageNotFoundException;

class Servis extends BaseController
{
     

	public function index()
	{
        $servis = new ServisModel();  
        $data['servis'] = $servis->semua();
        echo view('servis/data_servis', $data);
    } 
 
    public function store()
    {  
        $servis = new ServisModel();   
        
        if($this->request->getPost('tipe_form') == 'add'){   
            $cek = $servis->insert([
                "nm_servis" => $this->request->getPost('nm_servis'), 
                "harga" => $this->request->getPost('harga')
            ]);
            $last_id = $servis->last_id();  
    
        }else{
            $cek = $servis->update($this->request->getPost('id_servis'), [
                "nm_servis" => $this->request->getPost('nm_servis'), 
                "harga" => $this->request->getPost('harga'),  
                ]);
        }
    
        echo $cek;

                }
            

    public function edit($id)
    { 
        $servis = new ServisModel();
        $data['data_servis'] = $servis->ambilServis($id);    
        echo view('servis/edit_servis', $data);
    }

    public function update()
    {
            
         
    }


	public function delete(){
        $servis = new ServisModel();   
        $cek = $servis->delete($this->request->getPost('id_servis')); 
        echo $cek; 
    } 

    public function show()
    { 
        $servis = new ServisModel();   
        $data = $servis->where('id_servis', $this->request->getPost('id_servis'))->first(); 
        echo json_encode($data);
    }

    public function list_servis()
    {
        $query = $this->request->getPost('query');
        $servis = new ServisModel();
        $data = $servis->get_allListServis($query); 
        $output = '';
        foreach ($data as $value) {
            $output .= '<li class="list-group-item contsearch drop">
							<a href="javascript:void(0)" class="gsearch" style="color:#333;text-decoration:none;" id_servis=' . $value->id_servis . ' nm_servis ='.$value->nm_servis.' harga=' . $value->harga . '>'.$value->nm_servis.'</a>
							</li>
							';
        }
        echo $output;
    }
}