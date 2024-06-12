<?php

class payment extends Controller
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
            $profile = $this->model('profile_db')->profile($user_id);
            $data['profile'] = $profile;
            $data['cars'] = $this->model('profile_db')->getcarbyid($_POST);
            $data['post'] = $_POST;
            $pickup_date = $data['post']["pickup-date"];
            $return_time = $data['post']["return-time"];
            $return_date = $data['post']["return-date"];
            $pickup_time = $data['post']["pickup-time"];
            $price_per_day = $data['cars'][0]["price_per_day"]; 

            $pickup_datetime = new DateTime($pickup_date . ' ' . $pickup_time);
            $return_datetime = new DateTime($return_date . ' ' . $return_time);
            $diff = $pickup_datetime->diff($return_datetime);
            $total_days = $diff->days;
            $total_price = $total_days * intval($price_per_day);
            $data['totalsub'] = $total_price;
            $data['pajak']=$pajak = $data['totalsub'] * 0.1;
            $data['asuransi']=$asuransi = $data['totalsub'] * 0.2;
            $data['total'] = $data['totalsub'] + $pajak + $asuransi;

            $this->view('templates/header', $data);
            $this->view('templates/navbar', $data);
            $this->view('pembayaran/index', $data);
            $this->view('templates/footer1');
            $this->view('templates/footer', $data);
        }
    }
    public function intodb()
    {
        $user_id = $_SESSION['user_id'] ?? null;
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'customer') {
            header('Location: ' . BASEURL . '/admin/login');
            exit;
        }

        if ($this->model('User_db')->intodb($_POST, $user_id) > 0) {
            header('Location: ' . BASEURL . '/profile');
            exit;
        } else {
            header('Location: ' . BASEURL . '/katalog');
            exit;
        }
    }
}
