<?php
class katalog extends Controller
{
    
    public function index()
    {
        $user_id = $_SESSION['user_id'];
        $data['profile'] = $this->model('profile_db')->profile($user_id);
        $data['judul'] = 'Katalog';
        $data['css'] = 'card';
        $data['js'] = 'card';
        $data['categories'] = $this->model('katalog_db')->getAllcategories();
        $data['cars'] = $this->model('katalog_db')->tampilcars($_POST);
        $rentedCarIds = $this->model('katalog_db')->getRentedCarIds();
        foreach ($data['cars'] as &$produk) {
            $produk['isRented'] = in_array($produk['car_id'], $rentedCarIds);
        }
        $this->view('templates/header', $data);
        $this->view('templates/navbar', $data);
        $this->view('katalog/index', $data);
        $this->view('katalog/tampil_cars', $data);
        $this->view('templates/footer1');
        $this->view('templates/footer', $data);
    }
}
?>