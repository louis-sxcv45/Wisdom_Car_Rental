<?php

class Profile extends Controller
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
            $profile = $this->model('profile_db')->profile($user_id);
            if ($profile) {
                $data['css'] = 'profile';
                $data['judul'] = $profile['username'];
                $data['profile'] = $profile;
                $data['js'] = "profile";

                $this->view('templates/header', $data);
                $this->view('templates/navbar', $data);
                $this->view('profile/index', $data);
                $this->view('templates/footer1');
                $this->view('templates/footer', $data);
            } else {
                header('Location: ' . BASEURL . '/login');
                exit();
            }
        } else {
            header('Location: ' . BASEURL . '/login');
            exit();
        }
    }

    public function editprofile()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
            header('Location: ' . BASEURL . '/admin/login');
            exit;
        }

        if ($this->model('profile_db')->editprofile($_POST) > 0) {
            header('Location: ' . BASEURL . '/profile');
            exit;
        } else {
            header('Location: ' . BASEURL . '/profile');
            exit;
        }
    }

    public function ktpimagebaru()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
            header('Location: ' . BASEURL . '/admin/login');
            exit;
        }

        if ($this->model('profile_db')->ktpimagebaru($_POST) > 0) {
            header('Location: ' . BASEURL . '/profile');
            exit;
        } else {
            header('Location: ' . BASEURL . '/profile');
            exit;
        }
    }
    public function newpw()
    {
        $user_id = $_SESSION['user_id'];
        if ($this->model('profile_db')->newpw($_POST, $user_id) > 0) {
            Flasher::setFlash('Password berhasil diganti', 'success');
            header('Location: ' . BASEURL . '/profile/profile');
            exit;
        } else {
            Flasher::setFlash('Password gagal diganti', 'danger');
            header('Location: ' . BASEURL . '/profile/profile');
            exit;
        }
    }
    public function Tagihan()
    {
        $user_id = $_SESSION['user_id'] ?? null;

        if (isset($user_id) && !empty($user_id)) {
            $data['css'] = 'profile';
            $data['judul'] = 'Tagihan';
            $profile = $this->model('profile_db')->profile($user_id);
            $data['profile'] = $profile;
            $rentalResult = $this->model('User_db')->getrentalpending($user_id);
            $data['tagihan'] = $rentalResult;

            $this->view('templates/header', $data);
            $this->view('templates/navbar', $data);
            $this->view('profile/tagihan', $data);
            $this->view('templates/footer1');
            $this->view('templates/footer', $data);
        } else {
            header('Location: ' . BASEURL . '/login');
        }
    }
    public function bayar()
    {
        $user_id = $_SESSION['user_id'] ?? null;

        if (isset($user_id) && !empty($user_id)) {
            $data['judul'] = 'Bayar';
            $profile = $this->model('profile_db')->profile($user_id);
            $data['profile'] = $profile;
            $rental_id = $_POST['rental_id'];
            $rental = $this->model('User_db')->getRentalById($rental_id);
            $data['rental'] = $rental;
            $this->view('templates/header', $data);
            $this->view('templates/navbar', $data);
            $this->view('profile/bayar', $data);
            $this->view('templates/footer1');
            $this->view('templates/footer', $data);
        } else {
            header('Location: ' . BASEURL . '/login');
        }
    }
    public function Sedangberlangsung()
    {
        $user_id = $_SESSION['user_id'] ?? null;

        if (isset($user_id) && !empty($user_id)) {
            $data['css'] = 'profile';
            $data['judul'] = 'Tagihan';
            $profile = $this->model('profile_db')->profile($user_id);
            $data['profile'] = $profile;
            $rentalResult = $this->model('User_db')->getrentaldibayar($user_id);
            $data['tagihan'] = $rentalResult;

            $this->view('templates/header', $data);
            $this->view('templates/navbar', $data);
            $this->view('profile/Sedangberlangsung', $data);
            $this->view('templates/footer1');
            $this->view('templates/footer', $data);
        } else {
            header('Location: ' . BASEURL . '/login');
        }
    }
    public function Dibatalkan()
    {
        $user_id = $_SESSION['user_id'] ?? null;

        if (isset($user_id) && !empty($user_id)) {
            $data['css'] = 'profile';
            $data['judul'] = 'Tagihan';
            $profile = $this->model('profile_db')->profile($user_id);
            $data['profile'] = $profile;
            $rentalResult = $this->model('User_db')->getrentalbatal($user_id);
            $data['tagihan'] = $rentalResult;

            $this->view('templates/header', $data);
            $this->view('templates/navbar', $data);
            $this->view('profile/pembatalan', $data);
            $this->view('templates/footer1');
            $this->view('templates/footer', $data);
        } else {
            header('Location: ' . BASEURL . '/login');
        }
    }
    public function deleteRental()
    {
        if (isset($_POST['rental_id'])) {
            $rental_id = $_POST['rental_id'];
            $profile = $this->model('profile_db')->deleteRentalById($rental_id);
            Flasher::setFlash('berhasil-dihapus', 'primary');
            if ($profile !== false) {
                header('Location: ' . BASEURL . '/profile/pembatalan');
                exit;
            }
        }
    }
    
    public function cancelRental($rental_id)
    {
        $user_id = $_SESSION['user_id'] ?? null;

        if (isset($user_id) && !empty($user_id)) {
            $profile_db = $this->model('profile_db');

            if ($profile_db->updateRentalStatus($rental_id, 'cancel')) {
                header('Location: ' . BASEURL . '/profile/rentals');
            } else {
                header('Location: ' . BASEURL . '/profile/rentals?error=cancel_failed');
            }
        } else {
            header('Location: ' . BASEURL . '/login');
        }
    }

    public function detail()
    {
        $rental_id = $_POST['rental_id'];
        $data['css'] = 'Detail';
        $data['judul'] = 'Detail';
        $user_id = $_SESSION['user_id'] ?? null;
        $profile = $this->model('profile_db')->profile($user_id);
        $data['profile'] = $profile;
        $rental = $this->model('User_db')->getRentalById($rental_id);
        $car = $this->model('User_db')->getCarById($rental['car_id']);
        $data['rental'] = $rental;
        $data['car'] = $car;

        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('profile/detail_rentals', $data);
        $this->view('templates/footer1');
        $this->view('templates/footer', $data);
    }
    public function gantistatus()
    {
        $rental_id = $_POST['rental_id'] ?? null;
        if ($this->model('User_db')->updatedbayar($rental_id) > 0) {
            header('Location: ' . BASEURL . '/profile/Sedangberlangsung');
            exit;
        } else {
            header('Location: ' . BASEURL . '/profile/Tagihan');
            exit;
        }
    }
    public function profileimagebaru()
    {
        if ($this->model('profile_db')->profileimagebaru($_POST) > 0) {
            header('Location: ' . BASEURL . '/profile');
            exit;
        } else {
            header('Location: ' . BASEURL . '/profile');
            exit;
        }
    }
}
