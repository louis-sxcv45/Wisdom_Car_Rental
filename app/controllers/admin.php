<?php
class admin extends Controller
{

    public function __construct()
    {
        $this->acustomermustgo();
    }

    public function index()
    {
        $data['css'] = 'loginsignup';
        $data['judul'] = 'Admin Login';
        $data['js'] = 'admin/login';
        $this->view('templates/header', $data);
        $this->view('admin/login/index', $data);
        $this->view('templates/footer', $data);
    }
    public function menu()
    {
        $this->requireadminLogin();
        $this->acustomermustgo();
        $data['css'] = 'admin/dashboard';
        $data['judul'] = 'dashboard';
        $user_id = $_SESSION['user_id'] ?? null;
        $data['profile'] = $this->model('Admin_db')->profile($user_id);
        $data['barisusers']=$this->model('Admin_db')->getbarisuser();   
        $data['bariscars']=$this->model('Admin_db')->getbariscars(); 
        $data['barisrentals']=$this->model('Admin_db')->getbarisrentals(); 
        $this->view('templates/header', $data);
        $this->view('admin/navbar', $data);
        $this->view('admin/menu/index', $data);
        $this->view('templates/footer1');
        $this->view('templates/footer', $data);
    }
    public function cancelRental($rental_id)
    {
        $user_id = $_SESSION['user_id'];
    
        if (isset($user_id) && !empty($user_id)) {
            $profile_db = $this->model('Admin_db');
            
            if ($profile_db->updateRentalStatus($rental_id, 'cancel')) {
                header('Location: ' . BASEURL . '/admin/status');
            } else {
                header('Location: ' . BASEURL . '/admin/status?error=cancel_failed');
            }
        } else {
            header('Location: ' . BASEURL . '/login');
        }
    }
    public function submitRental($rental_id)
    {
        $user_id = $_SESSION['user_id'];
    
        if (isset($user_id) && !empty($user_id)) {
            $profile_db = $this->model('Admin_db');
            
            if ($profile_db->updateRentalStatus($rental_id, 'Sedang Dirental')) {
                header('Location: ' . BASEURL . '/admin/status');
            } else {
                header('Location: ' . BASEURL . '/admin/status?error=submit_failed');
            }
        } else {
            header('Location: ' . BASEURL . '/login');
        }
    }
    public function returnRental($rental_id)
    {
        $user_id = $_SESSION['user_id'];
    
        if (isset($user_id) && !empty($user_id)) {
            $profile_db = $this->model('Admin_db');
            
            if ($profile_db->updateRentalStatus($rental_id, 'Sudah Dikembalikan')) {
                header('Location: ' . BASEURL . '/admin/status');
            } else {
                header('Location: ' . BASEURL . '/admin/status?error=return_failed');
            }
        } else {
            header('Location: ' . BASEURL . '/login');
        }
    }
    public function processLoginadmin()
    {
        $admin = $this->model('Admin_db')->authenticate($_POST);

        if (is_array($admin)) {
            $_SESSION['user_id'] = $admin['admin_id'];
            $_SESSION['email'] = $admin['username'];
            $_SESSION['role'] = 'admin';
            header('Location: ' . BASEURL . '/admin/profile');
            exit();
        } elseif ($admin === "Email yang salah" || $admin === "Password yang salah") {
            Flasher::setFlash($admin, 'danger');
            header('Location: ' . BASEURL . '/admin/login');
            exit();
        } else {
            Flasher::setFlash('Email atau password yang salah', 'danger');
            header('Location: ' . BASEURL . '/admin/login');
            exit();
        }
    }
    public function signup()
    {
        $this->acustomermustgo();
        $data['css'] = 'signup';
        $data['judul'] = 'signup';
        $data['js'] = 'admin/signup';
        $this->view('templates/header', $data);
        $this->view('admin/signup/index', $data);
        $this->view('templates/footer', $data);
    }

    public function tambahakun()
    {
        $email = $_POST['email'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            Flasher::setFlash('Email tidak valid', 'danger');
            header('Location: ' . BASEURL . '/admin_signup');
            exit;
        }

        // Panggil model untuk membuat akun
        $result = $this->model('Admin_db')->insertakun($_POST);

        // Periksa hasil dan set flash message sesuai dengan hasil
        if ($result['status']) {
            header('Location: ' . BASEURL . '/admin/profile');
        } else {
            Flasher::setFlash($result['message'], 'danger');
            header('Location: ' . BASEURL . '/admin/signup');
        }

        // Redirect ke halaman yang sesuai
        exit;
    }
    public function profile()
    {
        // Mengambil ID pengguna dari session
        $user_id = $_SESSION['user_id'] ?? null;

        if (isset($user_id) && !empty($user_id)) {
            // Panggil model untuk mengambil profil pengguna berdasarkan id
            $profile = $this->model('Admin_db')->profile($user_id);
            if ($profile) {
                // Menyiapkan data yang akan dikirimkan ke view
                $data['css'] = 'profile';
                $data['judul'] = $profile['username'];
                $data['profile'] = $profile;
                $data['js'] = "admin/profile";

                // Tampilkan view dengan data yang telah disiapkan
                $this->view('templates/header', $data);
                $this->view('admin/navbar', $data);
                $this->view('admin/profile/index', $data);
                $this->view('templates/footer1');
                $this->view('templates/footer', $data);
            } else {
                // Jika profil pengguna tidak ditemukan, kembali ke halaman login
                header('Location: ' . BASEURL . '/admin/login');
                exit();
            }
        } else {
            // Jika user id tidak tersedia di session atau kosong, kembali ke halaman login
            header('Location: ' . BASEURL . '/admin/login');
            exit();
        }
    }

    public function editprofile()
    {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header('Location: ' . BASEURL . '/admin/login');
            exit;
        }

        if ($this->model('Admin_db')->editprofile($_POST) > 0) {
            header('Location: ' . BASEURL . '/admin/profile');
            exit;
        } else {
            header('Location: ' . BASEURL . '/admin/profile');
            exit;
        }
    }

    public function detail_order($id)
    {
        // Mengambil ID pengguna dari session
        $user_id = $_SESSION['user_id'] ?? null;

        if (isset($user_id) && !empty($user_id)) {
            // Panggil model untuk mengambil semua pesanan
            $orderResult = $this->model('Admin_db')->getallinfo($id);
            $profile = $this->model('Admin_db')->profile($user_id);
            // Pisahkan pesanan berdasarkan status
            $data['css'] = 'profile';
            $data['judul'] = 'Daftar orderan';
            $data['profile'] = $profile;
            $data['js'] = '';
            $data['orders'] = $orderResult;

            $this->view('templates/header', $data);
            $this->view('admin/navbar', $data);
            $this->view('admin/ceck_order/detail_order', $data);
            $this->view('templates/footer1');
            $this->view('templates/footer', $data);
        } else {
            echo "User ID tidak ditemukan.";
        }
    }
    public function insert_cars()
    {
        $data['css'] = 'admin/insert_cars';
        $data['judul'] = 'insert cars';
        $data['js'] = 'admin/insert_cars';
        $user_id = $_SESSION['user_id'];
        $data['profile'] = $this->model('Admin_db')->profile($user_id);
        $data['categories'] = $this->model('Admin_db')->getcategories();
        var_dump($user_id);
        $this->view('templates/header', $data);
        $this->view('admin/navbar', $data);
        $this->view('admin/insert_cars/index', $data);
        $this->view('templates/footer1');
        $this->view('templates/footer', $data);
    }
    public function proses_insert_cars()
    {
        if ($this->model('Admin_db')->proses_insert_cars($_POST) > 0) {
            Flasher::setFlash('berhasil di tambah', 'success');
            header('Location: ' . BASEURL . '/admin/insert_cars');
            exit;
        } else {
            Flasher::setFlash('gagal di tambahkan', 'danger');
            header('Location: ' . BASEURL . '/admin/insert_cars');
            exit;
        }
    }
    public function profileimagebaru()
    {
        if ($this->model('Admin_db')->profileimagebaru($_POST) > 0) {
            header('Location: ' . BASEURL . '/admin/profile');
            exit;
        } else {
            header('Location: ' . BASEURL . '/admin/profile');
            exit;
        }
    }
    public function logout()
    {
        $this->view('templates/header');
        $this->view('admin/logout/index');
        $this->view('templates/footer');
    }
    public function cars()
    {
        // Ambil data mobil dari model Admin_db
        $cars = $this->model('Admin_db')->getAllcars($_POST);
        $dipesan = [];
        $ready = [];

        foreach ($cars as $product) {
            $productId = $product['car_id'];
            $productOrders = $this->model('Admin_db')->getrentalStatus($productId);

            $isOrdered = false;

            // Periksa apakah ada data status pemesanan
            if ($productOrders) {
                foreach ($productOrders as $order) {
                    if ($order['status'] != 'pending') {
                        $isOrdered = true;
                        break; // keluar dari loop jika ditemukan status yang bukan 'pending'
                    }
                }
            }

            if ($isOrdered) {
                $dipesan[] = $product;
            } else {
                $ready[] = $product;
            }
        }

        $data['dipesan'] = $dipesan;
        $data['ready'] = $ready;
        $user_id = $_SESSION['user_id'];
        $data['profile'] = $this->model('Admin_db')->profile($user_id);
        $data['judul'] = 'Hapus Mobil';
        $data['css'] = 'card';
        $data['js'] = '/admin/card';
        $data['categories'] = $this->model('katalog_db')->getAllcategories();

        // Muat view-template dan teruskan data ke view
        $this->view('templates/header', $data);
        $this->view('admin/navbar', $data);
        $this->view('admin/delete_cars/index', $data);
        $this->view('admin/delete_cars/tampil_cars', $data);
        $this->view('templates/footer1');
        $this->view('templates/footer', $data);
    }

    public function status()
    {
        if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $data['judul'] = 'Status Rentals';
            $profile = $this->model('Admin_db')->profile($user_id);
            $data['profile'] = $profile;
    
            // Fetch all rentals for the user
            $rentals = $this->model('Admin_db')->getAllRentals($user_id);
            $data['rentals'] = $rentals;
            $this->view('templates/header', $data);
            $this->view('admin/navbar', $data);
            $this->view('admin/ceck_rental/index', $data);
            $this->view('templates/footer1');
            $this->view('templates/footer', $data);
        } else {
            header('Location: ' . BASEURL . '/admin/login');
            exit();
        }
    }
    

    public function newpw()
    {
        $user_id = $_SESSION['user_id'];
        if ($this->model('Admin_db')->newpw($_POST, $user_id) > 0) {
            Flasher::setFlash('Password berhasil diganti', 'success');
            header('Location: ' . BASEURL . '/admin/profile');
            exit;
        } else {
            Flasher::setFlash('Password gagal diganti', 'danger');
            header('Location: ' . BASEURL . '/admin/profile');
            exit;
        }
    }
    public function hapus()
    {
        if ($this->model('Admin_db')->deleteAndMovecars($_POST) > 0) {
            header('Location: ' . BASEURL . '/admin/cars');
            exit;
        } else {
            Flasher::setFlash('gagal-berhasil-dihapus', 'danger');
            header('Location: ' . BASEURL . '/admin/cars');
            exit;
        }
    }
    public function updateimagebaru()
    {
        if ($this->model('Admin_db')->updateimagebaru($_POST) > 0) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: ' . BASEURL . '/admin/hapus_cars');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: ' . BASEURL . '/admin/hapus_cars');
            exit;
        }
    }
}
