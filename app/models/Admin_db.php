<?php
class Admin_db
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function authenticate($data)
    {
        $this->db->query('SELECT * FROM admins WHERE email = :email');
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
    public function newpw($data, $user_id)
    {
        // Query untuk mengambil data admin berdasarkan admin_id
        $this->db->query('SELECT * FROM admins WHERE admin_id = :admin_id');
        $this->db->bind(':admin_id', $user_id);
        $row = $this->db->single();

        // Jika data admin ditemukan
        if ($row) {
            // Verifikasi kata sandi saat ini
            if (password_verify($data['password'], $row['password'])) {
                // Query untuk memperbarui kata sandi admin
                $query = "UPDATE admins SET password = :password WHERE admin_id = :admin_id";
                $this->db->query($query);
                $this->db->bind('password', password_hash($data['confirmPassword'], PASSWORD_ARGON2I));
                $this->db->bind('admin_id', $user_id);
                $this->db->execute();
                return "Password berhasil diubah";
            } else {
                // Jika kata sandi saat ini salah
                return "-1";
            }
        } else {
            // Jika admin_id tidak ditemukan
            return "-1";
        }
    }


    public function insertakun($data)
    {
        // Cek username yang sudah ada
        $this->db->query("SELECT * FROM admins WHERE username = :username");
        $this->db->bind('username', $data['username']);
        $this->db->execute();
        if ($this->db->rowCount() > 0) {
            return ['status' => false, 'message' => 'Username already exists'];
        }

        // Cek email yang sudah ada
        $this->db->query("SELECT * FROM admins WHERE email = :email");
        $this->db->bind('email', $data['email']);
        $this->db->execute();
        if ($this->db->rowCount() > 0) {
            return ['status' => false, 'message' => 'Email already exists'];
        }

        // Masukkan data baru ke database
        $query = "INSERT INTO admins (username, password, email) VALUES (:username, :password, :email)";
        $this->db->query($query);
        $this->db->bind('username', $data['username']);
        $this->db->bind('password', password_hash($data['password'], PASSWORD_ARGON2I));
        $this->db->bind('email', $data['email']);
        $this->db->execute();

        if ($this->db->rowCount() === 0) {
            return ['status' => false, 'message' => 'Failed to insert data'];
        } else {
            // Ambil ID admin baru
            $this->db->query("SELECT admin_id FROM admins WHERE email = :email");
            $this->db->bind('email', $data['email']);
            $this->db->execute();
            $newUser = $this->db->single();

            if ($newUser) {
                $_SESSION['email'] = $newUser['username'];
                $_SESSION['role'] = 'admin';
                $_SESSION['user_id'] = $newUser['admin_id'];
                return ['status' => true, 'message' => 'User registered successfully'];
            } else {
                return ['status' => false, 'message' => 'Failed to retrieve new user ID'];
            }
        }
    }

    public function profile($user_id)
    {
        $this->db->query("SELECT * FROM admins WHERE admin_id = :user_id");
        $this->db->bind(':user_id', $user_id);
        return $this->db->single();
    }

    public function editprofile($data)
    {
        $this->db->query("UPDATE admins SET nama_depan = :nama_depan, nama_belakang = :nama_belakang, email = :email, phone_number = :phone_number WHERE admin_id = :user_id");
        $this->db->bind(':nama_depan', $data['nama_depan']);
        $this->db->bind(':nama_belakang', $data['nama_belakang']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':phone_number', $data['phone_number']);
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function profileimagebaru()
    {

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image_tmp = file_get_contents($_FILES['image']['tmp_name']);
        }
        $this->db->query("UPDATE admins SET image = :image WHERE admin_id = :user_id");
        $this->db->bind(':image', $image_tmp, PDO::PARAM_LOB);
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function getallrental()
    {
        $this->db->query("SELECT * FROM rentals");
        return $this->db->resultSet();
    }


    public function getcategories()
    {
        $this->db->query('SELECT * FROM categories');
        return $this->db->resultSet();
    }
    public function proses_insert_cars($data)
    {
        try {
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image_tmp = file_get_contents($_FILES['image']['tmp_name']);
            }

            $query = "INSERT INTO cars (merek, description, price_per_day, year, color, image) VALUES (:merek, :description, :price_per_day, :year, :color, :image)";

            $this->db->query($query);
            $this->db->bind(':merek', $data['merek']);
            $this->db->bind(':description', $data['description']);
            $this->db->bind(':price_per_day', $data['price_per_day']);
            $this->db->bind(':year', $data['year']);
            $this->db->bind(':color', $data['color']);
            $this->db->bind(':image', $image_tmp, PDO::PARAM_LOB);

            $this->db->execute();

            $cars_id = $this->db->lastInsertId();

            if (isset($data['category_id']) && is_array($data['category_id'])) {
                $kategori_id = $data['category_id'];
                foreach ($kategori_id as $category_id) {
                    $insert_categories_query = "INSERT INTO car_categories (car_id, category_id) VALUES (:car_id, :category_id)";
                    $this->db->query($insert_categories_query);
                    $this->db->bind(':car_id', $cars_id);
                    $this->db->bind(':category_id', $category_id);
                    $this->db->execute();
                }
            }

            // Kembalikan jumlah baris yang terpengaruh untuk memastikan keberhasilan
            return $this->db->rowCount();
        } catch (Exception $e) {
            return array('error' => "Failed to get order data: " . $e->getMessage());
        }
    }

    public function getallinfo($id)
    {
        $db = $this->db;

        try {
            // Ambil data order berdasarkan order_id
            $db->query("SELECT * FROM `rentals` WHERE rental_id = :rental_id");
            $db->bind(':rental_id', $id);
            $orderData = $db->single();

            if (!$orderData) {
                return array('error' => "Order not found.");
            }
            $user_id = $orderData['user_id'];
            // Ambil data users berdasarkan users_id
            $db->query("SELECT * FROM `users` WHERE user_id = :user_id");
            $db->bind(':user_id', $user_id);
            $usersData = $db->single();

            if (!$usersData) {
                return array('error' => "users not found.");
            }
            $car_id = $orderData['car_id'];
            // Ambil detail item dari order_item berdasarkan order_id
            $db->query("SELECT * FROM cars WHERE car_id = :car_id");
            $db->bind(':car_id', $car_id);
            $cars_details = $db->resultSet();

            // Debug: cek apakah ada item_details yang diambil
            if (empty($cars_details)) {
                return $id;
            }

            // Kembalikan semua data dalam bentuk array
            return array(
                'order_data' => $orderData,
                'users_data' => $usersData,
                'cars_details' => $cars_details
            );
        } catch (Exception $e) {
            return array('error' => "Failed to get order data: " . $e->getMessage());
        }
    }
    public function getAllcars($data)
    {
        // Check if 'selected_items' are provided in the POST data
        if (!empty($data["id"])) {
            $placeholders = rtrim(str_repeat('?, ', count($data["id"])), ', ');

            $query = 'SELECT DISTINCT c.*, 
            (SELECT GROUP_CONCAT(cat.category_name) 
             FROM categories cat
             INNER JOIN car_categories cc2 ON cat.category_id = cc2.category_id
             WHERE cc2.car_id = c.car_id) AS category_names
     FROM cars c
     INNER JOIN car_categories cc ON c.car_id = cc.car_id
     WHERE cc.category_id IN (' . $placeholders . ')';

            $this->db->query($query);

            foreach ($data["id"] as $key => $id) {
                $this->db->bind($key + 1, $id);
            }

            return $this->db->resultSet();
        } elseif (!empty($data['keyword'])) {
            $keyword = $data['keyword'];
            $query = "SELECT c.*, GROUP_CONCAT(categories.category_name) AS category_names
            FROM cars c
            LEFT JOIN car_categories cc ON c.car_id = cc.car_id
            LEFT JOIN categories ON cc.category_id = categories.category_id
            WHERE c.merek LIKE :keyword
            GROUP BY c.car_id;";
            $this->db->query($query);
            $this->db->bind('keyword', "%$keyword%");

            return $this->db->resultSet();
        } else {
            $query = 'SELECT cars.car_id, cars.merek, cars.description, cars.price_per_day, cars.image, 
            GROUP_CONCAT(categories.category_name) AS category_names
            FROM cars
            LEFT JOIN car_categories ON cars.car_id = car_categories.car_id
            LEFT JOIN categories ON car_categories.category_id = categories.category_id
            GROUP BY cars.car_id';

            $this->db->query($query);

            return $this->db->resultSet();
        }
    }

    public function updateRentalStatus($rental_id, $new_status)
    {
        $query = "UPDATE rentals SET statusrental = :new_status WHERE rental_id = :rental_id";

        $this->db->query($query);
        $this->db->bind(':new_status', $new_status);
        $this->db->bind(':rental_id', $rental_id);

        return $this->db->execute();
    }

    public function getrentalbatal($rental_id)
    {

        $query = "SELECT * FROM rentals WHERE rental_id = :rental_id AND statusrental = 'cancel'";

        $this->db->query($query);
        $this->db->bind(':rental_id', $rental_id);
        $results = $this->db->resultSet();

        return $results;
    }

    public function getrentalStatus($carId)
    {
        $this->db->query("SELECT statusrental FROM rentals WHERE car_id = :car_id");
        $this->db->bind(":car_id", $carId);
        return $this->db->resultSet();
    }

    public function deleteAndMovecars($data)
    {
        $this->db->beginTransaction();

        try {
            foreach ($data["id"] as $car_id) {
                // Ambil data mobil yang akan dihapus
                $this->db->query("SELECT * FROM cars WHERE car_id = :car_id");
                $this->db->bind(":car_id", $car_id);
                $cars = $this->db->single();

                if ($cars) {
                    // Simpan data mobil yang dihapus ke dalam tabel cars_tidaktersedia
                    $this->db->query("INSERT INTO cars_tidakdigunakan
                    (car_id, merek, description, price_per_day, year, color, image) 
                    VALUES 
                    (:car_id, :merek, :description, :price_per_day, :year, :color, :image)");
                    $this->db->bind(":car_id", $cars['car_id']);
                    $this->db->bind(":merek", $cars['merek']);
                    $this->db->bind(":description", $cars['description']);
                    $this->db->bind(":price_per_day", $cars['price_per_day']);
                    $this->db->bind(":year", $cars['year']);
                    $this->db->bind(":color", $cars['color']);
                    $this->db->bind(":image", $cars['image']);
                    $this->db->execute();

                    // Hapus data mobil dari tabel cars
                    $this->db->query("DELETE FROM cars WHERE car_id = :car_id");
                    $this->db->bind(":car_id", $car_id);
                    $this->db->execute();
                } else {
                    // Jika data mobil tidak ditemukan, rollback transaksi
                    $this->db->rollBack();
                    throw new Exception("Mobil dengan ID $car_id tidak ditemukan");
                }
            }
            // Commit transaksi jika semua operasi berhasil
            $this->db->commit();
        } catch (Exception $e) {
            // Jika terjadi kesalahan, rollback transaksi dan lempar kembali kesalahan
            $this->db->rollBack();
            throw $e;
        }
    }

    public function updateimagebaru($data)
    {
        $cars_id = $data['car_id'];
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image_tmp = file_get_contents($_FILES['image']['tmp_name']);
        }
        $this->db->query("UPDATE cars SET image_url = :image WHERE car_id = :car_id");
        $this->db->bind(':image', $image_tmp, PDO::PARAM_LOB);
        $this->db->bind(':car_id', $cars_id);
        $this->db->execute();
        return $this->db->rowCount();
    }
    public function getAllRentals()
    {
        $this->db->query("SELECT * FROM rentals");
        return $this->db->resultSet();
    }
    public function getbarisrentals()
    {
        $this->db->query("SELECT COUNT(*) AS total_rentals FROM rentals");
        return $this->db->single();
    }

    public function getbarisuser()
    {
        $this->db->query("SELECT COUNT(*) AS total_users FROM users");
        return $this->db->single();
    }

    public function getbariscars()
    {
        $this->db->query("SELECT COUNT(*) AS total_cars FROM cars");
        return $this->db->single();
    }
}
