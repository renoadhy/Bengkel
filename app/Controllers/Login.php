<?php

namespace App\Controllers;
use App\Models\UserModel;

class Login extends BaseController
{ 
    public function index()
    { 
        echo view('index');
    } 

	public function aksi_login()
    {
        $session = session(); 
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
         
        $model = new UserModel();
        $cek = $model->where('username', $username)->first();

        if ($cek) {  
            if(password_verify($password, $cek['password'])){
                $data_session = array(
                'username' => $username,
                'id_user' => $cek['id_user'],
                'nm_user' => $cek['nm_user'],
                'is_login' => true,
                'level' => $cek['level'], 
            );
            $session->set($data_session);
            $data = [
                'success' => true, 
            ];
            
            return $this->response->setJSON($data);
            // return  $this->response->setStatusCode(200, 'OK');

            }else{
                 return  $this->response->setStatusCode(401, 'Password Salah');
            } 
        } else {
            return $this->response->setStatusCode(401, 'User tidak ditemukan');
        }

    }

    public function logout()
    {
        $session = session(); 
        $session->destroy();
        return redirect()->to('/');

    }
}
