<?php

namespace App\Controllers;

use App\Models\User;

class AuthController extends BaseController
{
    public function index()
    {
        $data['title'] = 'Login';
        $data['content'] = 'auth/login';
        return view('layout/auth',$data);
    }

    public function validateLogin()
    {
        $user = new User();
        $session = session();
        $user_name = $this->request->getPost('username');
        $user_password = $this->request->getPost('password');
        $data = $user->asObject()->where(['username'=>$user_name])->find();

        if($data){
            if (password_verify($user_password, $data[0]->password)) {
                $session->set([
                    'is_login'=>true,
                    'username'=>$data[0]->username,
                    'id'=>$data[0]->user_id,
                    'role'=>$data[0]->role,
                    'petugas_id'=>$data[0]->petugas_id,
                ]);
                $message = [
                    'status'=>'success',
                    'message'=>'Login Success!',
                ];
                $this->session->setFlashdata('notif', $message);
                return redirect()->to(base_url('admin/dashboard'));
            }
        }else{
            $message = [
                'status'=>'danger',
                'message'=>'Login Faild!<p>Invalid User Name!</p>',
            ];
            $this->session->setFlashdata('notif', $message);
            return redirect()->to(base_url('login'));
        }
        $message = [
            'status'=>'danger',
            'message'=>'Login Faild!<p>Invalid Password!</p>',
        ];
        $this->session->setFlashdata('notif', $message);
        return redirect()->to(base_url());
    }

    public function logout(){
        $session = session();
        $session->destroy();
        return redirect()->to(base_url('login'));
    }
}
