<?php

class profile_db
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function profile($user_id)
    {
        $this->db->query("SELECT * FROM users WHERE user_id = :user_id");
        $this->db->bind(':user_id', $user_id);
        return $this->db->single();
    }
    public function newpw($data,$user_id)
    {
        $this->db->query('SELECT * FROM users WHERE user_id = :user_id');
        $this->db->bind(':user_id', $user_id);
        $row = $this->db->single();
    
        if ($row) {
            if (password_verify($data['password'], $row['password'])) {
                $query = "UPDATE users SET password = :password WHERE user_id = :user_id";
                $this->db->query($query);
                $this->db->bind('password', password_hash($data['confirmPassword'], PASSWORD_ARGON2I));
                $this->db->bind('user_id', $user_id);
                $this->db->execute();
                return "Password berhasil diubah";
            } else {
                return "-1";
            }
        } else {
            return "-1";
        }
    }

    public function profileimagebaru() {
        
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image_tmp = file_get_contents($_FILES['image']['tmp_name']);
        }
        $this->db->query("UPDATE users SET image = :image WHERE user_id = :user_id");
        $this->db->bind(':image', $image_tmp, PDO::PARAM_LOB);
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function ktpimagebaru() {
        
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image_tmp = file_get_contents($_FILES['image']['tmp_name']);
        }
        $this->db->query("UPDATE users SET ktp = :ktp WHERE user_id = :user_id");
        $this->db->bind(':ktp', $image_tmp, PDO::PARAM_LOB);
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function editprofile($data) {
        $this->db->query("UPDATE users SET nama_depan = :nama_depan, nama_belakang = :nama_belakang, email = :email, phone_number = :number_phone, nik = :nik WHERE user_id = :user_id");
        $this->db->bind(':nama_depan', $data['nama_depan']);
        $this->db->bind(':nama_belakang', $data['nama_belakang']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':number_phone', $data['phone_number']);
        $this->db->bind(':nik', $data['nik']);
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function getcarbyid($data)
    {
        $this->db->query("SELECT * FROM cars WHERE car_id = :car_id");
        $this->db->bind(':car_id', $data['car_id']);
        return $this->db->resultSet();
    }
    public function updateRentalStatus($rental_id, $new_status)
    {
        $query = "UPDATE rentals SET statusrental = :new_status WHERE rental_id = :rental_id";
        
        $this->db->query($query);
        $this->db->bind(':new_status', $new_status);
        $this->db->bind(':rental_id', $rental_id);

        return $this->db->execute();
    }
    public function deleteRentalById($rental_id)
    {
        $this->db->query('DELETE FROM rentals WHERE rental_id = :rental_id');
        $this->db->bind(':rental_id', $rental_id);
    
        // Jalankan query dan kembalikan hasilnya
        return $this->db->execute();
    }
    

}
