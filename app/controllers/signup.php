<?php
class signup extends Controller
{
    public function index()
    {
        $data['css'] = 'signup';
        $data['judul'] = 'signup';
        $data['js'] = 'signup';
        $this->view('templates/header', $data);
        $this->view('signup/index', $data);
        $this->view('templates/footer', $data);
    }
    
    public function tambahakun() {
        $email = $_POST['email'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Flasher::setFlash('Email tidak valid', 'danger');
            header('Location: ' . BASEURL . '/signup');
            exit;
        }
        $result = $this->model('User_db')->insertakun($_POST);

        if ($result['status']=true) {
            echo '<script>alert("Register Successfully");</script>';
            header('Location: ' . BASEURL . '/katalog');
        } else {
            Flasher::setFlash($result['message'], 'danger');
            header('Location: ' . BASEURL . '/signup');
        }

        exit;
    }
}
