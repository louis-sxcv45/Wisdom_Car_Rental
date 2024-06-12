<?php

class order extends Controller
{

    public function __construct()
    {
        $this->requireLogin();
        $this->adminmustgo();
    }

    public function index()
    {
        $user_id = $_SESSION['user_id'] ?? null;
        if (isset($user_id) && !empty($user_id)) {
            $data['css'] = 'order';
            $data['judul'] = 'Order';
            $data['js'] = 'order';

            // Memanggil model User_db
            $user_db = $this->model('User_db');

            // Memeriksa profil pengguna
            $profile = $user_db->checkProfile($user_id);

            if (!$this->isProfileComplete($profile)) {
                Flasher::setFlash('lengkapi-profile', 'danger');
                $this->redirectToProfileCompletion();
            } else {
                // Profil ditemukan, lanjutkan ke halaman order
                $data['profile'] = $profile;
                $car = $this->model('profile_db')->getcarbyid($_POST);
                $data['cars'] = $car;
                $this->view('templates/header', $data);
                $this->view('templates/navbar', $data);
                $this->view('order/index', $data);
                $this->view('templates/footer1');
                $this->view('templates/footer', $data);
            }
        }
    }

    private function isProfileComplete($profile)
    {

        return !empty($profile['nama_depan']) && !empty($profile['nama_belakang']) &&
               !empty($profile['email']) && !empty($profile['phone_number']) &&
               !empty($profile['nik']) && !empty($profile['ktp']);
    }

    private function redirectToProfileCompletion()
    {
        header("Location: " . BASEURL . "/profile");
        exit();
    }
}

?>
