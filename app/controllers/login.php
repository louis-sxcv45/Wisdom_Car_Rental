<?php
class login extends Controller
{
    public function index()
    {
        $data['css'] = 'loginsignup';
        $data['judul'] = 'login/signup';
        $data['js'] = 'login';
        $this->view('templates/header', $data);
        $this->view('login/index', $data);
        $this->view('templates/footer', $data);
    }

    public function processLogincustomer()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $customer = $this->model('User_db')->authenticate($_POST);

            if (is_array($customer)) {
                $_SESSION['user_id'] = $customer['user_id'];
                $_SESSION['email'] = $customer['username'];
                $_SESSION['role'] = 'customer';
                header('Location: ' . BASEURL . '/katalog');
                exit();
            } elseif ($customer === "Email yang salah") {
                Flasher::setFlash('Email tidak di temukan', 'danger');
                header('Location: ' . BASEURL . '/login');
                exit();
            } elseif ($customer === "Password yang salah") {
                Flasher::setFlash('Password yang salah', 'danger');
                header('Location: ' . BASEURL . '/login');
                exit();
            } 
        } else {
            header('Location: ' . BASEURL . '/login');
            exit();
        }
    }
}
