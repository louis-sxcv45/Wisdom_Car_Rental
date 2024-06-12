<?php

class katalog_db
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllcategories()
    {
        $this->db->query('SELECT * FROM categories');
        return $this->db->resultSet();
    }
    public function tampilcars($data)
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
    public function getRentedCarIds() {
        $this->db->query("SELECT car_id FROM rentals WHERE statusrental IN ('Sedang Dirental', 'dibayar', 'pending')");
        $results = $this->db->resultSet();
        $carIds = [];
        foreach ($results as $result) {
            $carIds[] = $result['car_id'];
        }
        return $carIds;
    }
    

    public function detail_cars($id)
    {
        $this->db->query('SELECT c.*, (
            SELECT GROUP_CONCAT(c.category_name) 
            FROM categories c 
            INNER JOIN car_categories cc ON c.category_id = cc.category_id 
            WHERE cc.car_id = :id
         ) AS category_names
         FROM cars c
         WHERE c.car_id = :id');
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
}
