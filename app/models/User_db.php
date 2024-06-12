<?php
class User_db
{
    private $db;


    public function __construct()
    {
        $this->db = new Database;
    }

    public function authenticate($data)
    {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $data['email']);
        $row = $this->db->single();

        if ($row) {
            if (password_verify($data['password'], $row['password'])) {
                return $row;
            } else {
                unset($row);
                return "Password yang salah";
            }
        } else {
            unset($row);
            return "Email yang salah";
        }
    }
    public function editprofile($data)
    {
        $this->db->query("UPDATE users SET nama_depan = :nama_depan, nama_belakang = :nama_belakang, email = :email, number_phone = :number_phone, nik = :nik WHERE user_id = :user_id");
        $this->db->bind(':nama_depan', $data['nama_depan']);
        $this->db->bind(':nama_belakang', $data['nama_belakang']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':number_phone', $data['number_phone']);
        $this->db->bind(':nik', $data['nik']);
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function ktpimagebaru()
    {

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image_tmp = file_get_contents($_FILES['image']['tmp_name']);
        }
        $this->db->query("UPDATE users SET ktp = :ktp WHERE user_id = :user_id");
        $this->db->bind(':ktp', $image_tmp, PDO::PARAM_LOB);
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function newpw($data, $user_id)
    {
        $this->db->query('SELECT * FROM admins WHERE admin_id = :admin_id');
        $this->db->bind(':admin_id', $user_id);
        $row = $this->db->single();

        if ($row) {
            if (password_verify($data['password'], $row['password'])) {
                $query = "UPDATE admins SET password = :password WHERE admin_id = :admin_id";
                $this->db->query($query);
                $this->db->bind('password', password_hash($data['confirmPassword'], PASSWORD_ARGON2I));
                $this->db->bind('admin_id', $user_id);
                $this->db->execute();
                return "Password berhasil diubah";
            } else {
                return "-1";
            }
        } else {
            return "-1";
        }
    }

    public function getrentalpending($user_id)
    {

        $query = "SELECT * FROM rentals WHERE user_id = :user_id AND statusrental = 'pending'";

        $this->db->query($query);
        $this->db->bind(':user_id', $user_id);
        $results = $this->db->resultSet();

        return $results;
    }
    public function getrentaldibayar($user_id)
    {

        $query = "SELECT * FROM rentals WHERE user_id = :user_id AND statusrental IN ('dibayar', 'dirental')";

        $this->db->query($query);
        $this->db->bind(':user_id', $user_id);
        $results = $this->db->resultSet();

        return $results;
    }
    public function getrentalbatal($user_id)
    {

        $query = "SELECT * FROM rentals WHERE user_id = :user_id AND statusrental = 'cancel'";

        $this->db->query($query);
        $this->db->bind(':user_id', $user_id);
        $results = $this->db->resultSet();

        return $results;
    }

    public function getRentalById($rental_id) {
        $this->db->query("SELECT * FROM rentals WHERE rental_id = :rental_id");
        $this->db->bind(':rental_id', $rental_id);
        return $this->db->single();
    }
    public function getCarById($car_id) {
        $this->db->query("SELECT * FROM cars WHERE car_id = :car_id");
        $this->db->bind(':car_id', $car_id);
        return $this->db->single();
    }
    public function updatedbayar($rental_id)
    {
        $this->db->query("UPDATE rentals SET statusrental = :new_status WHERE rental_id = :rental_id");
        $this->db->bind('new_status', "dibayar");
        $this->db->bind('rental_id', $rental_id);
        return $this->db->execute();
    }

    public function insertakun($data)
    {
        $this->db->query("SELECT * FROM users WHERE username = :username");
        $this->db->bind('username', $data['username']);
        $this->db->execute();
        if ($this->db->rowCount() > 0) {
            return ['status' => false, 'message' => 'Username already exists'];
        }

        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind('email', $data['email']);
        $this->db->execute();
        if ($this->db->rowCount() > 0) {
            return ['status' => false, 'message' => 'Email already exists'];
        }
        $this->db->query("INSERT INTO users (username, password, email) VALUES (:username, :password, :email)");
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', password_hash($data['password'], PASSWORD_ARGON2I));
        $this->db->bind('email', $data['email']);
        $this->db->execute();

        if ($this->db->rowCount() === 0) {
            return ['status' => false, 'message' => 'Failed to insert data'];
        } else {
            $this->db->query("SELECT user_id FROM users WHERE email = :email");
            $this->db->bind('email', $data['email']);
            $this->db->execute();
            $newUser = $this->db->single();

            if ($newUser) {
                $_SESSION['email'] = $newUser['username'];
                $_SESSION['role'] = 'customer';
                $_SESSION['user_id'] = $newUser['user_id'];
                return ['status' => true, 'message' => 'User registered successfully'];
                
            } else {
                return ['status' => false, 'message' => 'Failed to retrieve new user ID'];
            }
        }
    }
    public function intodb($data, $user_id)
    {

        $this->db->query("SELECT * FROM users WHERE user_id = :user_id");
        $this->db->bind(':user_id', $user_id);
        $profile = $this->db->single();

        if (!$profile) {
            throw new Exception("User profile not found.");
        }
        $query = "INSERT INTO rentals (
                          user_id, car_id, rental_start_date, rental_end_date, 
                          tempat_pengambilan, alamat_rumah, total_cost, statusrental, 
                          nama_penerima, ktp, nik, pembayaran) 
                      VALUES (
                          :user_id, :car_id, :rental_start_date, :rental_end_date, 
                          :tempat_pengambilan, :alamat_rumah, :total_cost, :statusrental, 
                          :nama_penerima, :ktp, :nik, :bank)";
        $this->db->query($query);
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':car_id', $data['car_id']);
        $this->db->bind(':rental_start_date', $data['pickup-date'] . ' ' . $data['pickup-time']);
        $this->db->bind(':rental_end_date', $data['return-date'] . ' ' . $data['return-time']);
        $this->db->bind(':tempat_pengambilan', $data['pickup-location']);
        $this->db->bind(':alamat_rumah', $data['address']);
        $total_cost = str_replace(',', '', $data['total']);
        $this->db->bind(':total_cost', (float)$total_cost);
        $this->db->bind(':statusrental', "pending");
        $this->db->bind(':nama_penerima', $profile['nama_depan'] . ' ' . $profile['nama_belakang']);
        $this->db->bind(':ktp', $profile['ktp'], PDO::PARAM_LOB);
        $this->db->bind(':nik', $data['nik']);
        $this->db->bind(':bank', $data['bank-list']);

        $this->db->execute();

        return $this->db->rowCount();
    }

    public function checkProfile($user_id){
        $this->db->query("SELECT * FROM users WHERE user_id = :user_id");
        $this->db->bind(':user_id',$user_id);
        return $this->db->single();
    }
}
