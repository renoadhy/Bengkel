<?php namespace App\Controllers;

use \App\Models\UserModel;
use CodeIgniter\Exceptions\PageNotFoundException;

class User extends BaseController
{
	public function index()
	{
        $user = new UserModel();
        $data['user'] = $user->findAll();
		echo view('user/data_user', $data);
    } 
 
    public function store()
    {  
        $user = new UserModel(); 
        if($this->request->getPost('tipe_form') == 'add'){

            $cek = $user->insert([
                "username" => $this->request->getPost('username'),  
                "password" => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),  
                "nm_user" => $this->request->getPost('nm_user'),  
                "level" => $this->request->getPost('level'),  
            ]);
        }else{
            $cek = $user->update($this->request->getPost('id_user'), [
                "username" => $this->request->getPost('username'),  
                "password" => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),  
                "nm_user" => $this->request->getPost('nm_user'),  
                "level" => $this->request->getPost('level'),  
            ]);
        }
            echo $cek;
         
    }
 

    public function edit($id)
    { 
        $user = new UserModel();
        $data['data_user'] = $user->where('id_user', $id)->first();
         
        echo view('user/edit_user', $data);
    }
 

	public function delete(){
        $user = new UserModel();
        $cek = $user->delete($this->request->getPost('id_user')); 
        echo $cek;
    }
}