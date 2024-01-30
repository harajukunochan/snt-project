<?php
class DataBase
{
   private $connect;

   public function __construct()
   {
      $host = getenv("DB_HOST");
      $user = getenv("DB_LOGIN");
      $password = getenv("DB_PASSWORD");
      $database = getenv("DB_DATABASE");

      $this->connect = new mysqli($host, $user, $password, $database);

      if ($this->connect->connect_error) {
         die("Ошибка подключения к базе данных: " . $this->connect->connect_error);
      }
   }

   function __destruct()
   {
      $this->connect->close();
   }


   // Base section

   private function query(string $query, string|null $types = null, ...$params)
   {
      /* Prepared statement, stage 1: prepare */
      $stmt = $this->connect->prepare($query);

      /* Prepared statement, stage 2: bind and execute */
      if ($types && count($params) > 0) {
         $stmt->bind_param($types, ...$params);
      }

      $result = $stmt->execute();

      if (!$result) {
         return $result;
      } else {
         return $stmt->get_result();
      }
   }


   // User section

   public function login(string $login, string $password)
   {
      $result = $this->query(
         "SELECT * FROM user WHERE login = ? AND password = ?",
         "ss",
         $login,
         $password
      );

      if ($result && $result->num_rows > 0) {
         return $result->fetch_assoc();
      }

      return false;
   }

   public function get_users()
   {
      $result = $this->query(
         "SELECT * FROM user"
      );

      if ($result && $result->num_rows > 0) {
         return $result;
      }

      return false;
   }

   public function get_user(string $login)
   {
      $result = $this->query(
         "SELECT * FROM user WHERE login = ?",
         "s",
         $login
      );

      if ($result && $result->num_rows > 0) {
         return $result->fetch_assoc();
      }

      return false;
   }

   public function is_admin(int $id)
   {
      $result = $this->query(
         "SELECT * FROM admins WHERE id = ?",
         "i",
         $id
      );

      if ($result && $result->num_rows > 0) {
         return true;
      }

      return false;
   }

   public function get_user_by_id(int $id)
   {
      $result = $this->query(
         "SELECT * FROM user WHERE id = ?",
         "i",
         $id
      );

      if ($result && $result->num_rows > 0) {
         return $result->fetch_assoc();
      }

      return false;
   }

   public function add_user(
      string $fullname,
      string $email,
      string $phone_number,
      string $address,
      string $login,
      string $password
   ) {
      $result = $this->query(
         "INSERT INTO user (login, password, fullname, address, phone_number, email)
       VALUES (?, ?, ?, ?, ?, ?)",
         "ssssss",
         $login,
         $password,
         $fullname,
         $address,
         $phone_number,
         $email
      );

      if ($result && $result->num_rows > 0) {
         return $result->fetch_assoc();
      }

      return false;
   }

   public function update_user(
      int $id,
      string $fullname,
      string $email,
      string $phone_number,
      string $address,
      string $login,
      string $password
   ) {
      $result = $this->query(
         "
        UPDATE user
        SET login = ?, password = ?, fullname = ?, address = ?, phone_number = ?, email = ?
        WHERE id = ?
      ",
         "ssssssi",
         $login,
         $password,
         $fullname,
         $address,
         $phone_number,
         $email,
         $id
      );

      if ($result && $result->num_rows > 0) {
         return $result->fetch_assoc();
      }

      return false;
   }

   public function delete_user(int $id)
   {
      $result = $this->query(
         "DELETE FROM user WHERE id = ?",
         "i",
         $id
      );

      if ($result) {
         return true;
      }

      return false;
   }


   // Land section

   public function get_lands()
   {
      $result = $this->query(
         "SELECT * FROM land JOIN payed ON payed.land = land.id"
      );

      if ($result && $result->num_rows > 0) {
         return $result;
      }

      return false;
   }

   public function get_land(string $id)
   {
      $result = $this->query(
         "SELECT * FROM land JOIN payed ON payed.land = land.id WHERE id = ?",
         "s",
         $id
      );

      if ($result && $result->num_rows > 0) {
         return $result->fetch_assoc();
      }

      return false;
   }

   public function get_lands_by_landlord(int $id)
   {
      $result = $this->query(
         "SELECT * FROM land JOIN payed ON payed.land = land.id WHERE land_lord = ?",
         "i",
         $id
      );

      if ($result && $result->num_rows > 0) {
         return $result;
      }

      return false;
   }

   public function add_land(
      string $id,
      int $land_lord,
      string $address,
      bool $electricity,
      bool $water_pipe,
      bool $gas,
      float $area
   ) {
      $result = $this->query(
         "INSERT INTO land (id, land_lord, address, electricity, water_pipe, gas, area)
       VALUES (?, ?, ?, ?, ?, ?, ?)",
         "sisiiid",
         $id,
         $land_lord,
         $address,
         $electricity,
         $water_pipe,
         $gas,
         $area
      );

      if ($result && $result->num_rows > 0) {
         return $result->fetch_assoc();
      }

      return false;
   }

   public function update_land(
      string $id,
      int $land_lord,
      string $address,
      bool $electricity,
      bool $water_pipe,
      bool $gas,
      float $area
   ) {
      $result = $this->query(
         "
        UPDATE land
        SET id = ?, land_lord = ?, address = ?, electricity = ?, water_pipe = ?, gas = ?, area = ?
        WHERE id = ?
      ",
         "sisiiids",
         $id,
         $land_lord,
         $address,
         $electricity,
         $water_pipe,
         $gas,
         $area,
         $id
      );

      if ($result && $result->num_rows > 0) {
         return $result->fetch_assoc();
      }

      return false;
   }

   public function delete_land(string $id)
   {
      $result = $this->query(
         "DELETE FROM land WHERE id = ?",
         "s",
         $id
      );

      if ($result) {
         return true;
      }

      return false;
   }

   // Billing section

   public function add_bill_for_land(string $id, float $sum, string $comment = null) {
      $result = $this->query(
         "INSERT INTO bills (land, sum, comment)
         VALUES (?, ?, ?)",
         "sds",
         $id,
         $sum,
         isset($comment) ? $comment : null,
      );

      if ($result && $result->num_rows > 0) {
         return $result->fetch_assoc();
      }

      return false;
   }

   public function delete_bill(int $id) {
      $result = $this->query(
         "DELETE FROM bills WHERE id = ?",
         "i",
         $id,
      );

      if ($result) {
         return true;
      }

      return false;
   }

   public function set_bill_status(int $id, string $type, bool $status = true) {
      $result = $this->query(
         "
            UPDATE bills
            SET type_payment = ?, payedFee = ?
            WHERE id = ?
         ",
         "sii",
         $type,
         $status ? 1 : 0,
         $id,
      );

      if ($result && $result->num_rows > 0) {
         return $result->fetch_assoc();
      }


      return false;
   }

   public function get_bills() {
      $result = $this->query(
         "
            SELECT bills.*, user.login, user.id as land_lord, user.fullname
            FROM bills
            JOIN land
            ON bills.land = land.id
            JOIN user
            ON land.land_lord = user.id
         ",
      );

      if ($result && $result->num_rows > 0) {
         return $result;
      }

      return false;
   }

   public function get_not_payed_bills() {
      $result = $this->query(
         "
            SELECT bills.*, user.login, user.id as land_lord, user.fullname
            FROM bills
            JOIN land
            ON bills.land = land.id
            JOIN user
            ON land.land_lord = user.id
            WHERE bills.payedFee = 0
         ",
      );

      if ($result && $result->num_rows > 0) {
         return $result;
      }

      return false;
   }

   public function get_payed_bills() {
      $result = $this->query(
         "
            SELECT bills.*, user.login, user.id as land_lord, user.fullname
            FROM bills
            JOIN land
            ON bills.land = land.id
            JOIN user
            ON land.land_lord = user.id
            WHERE bills.payedFee = 1
         ",
      );

      if ($result && $result->num_rows > 0) {
         return $result;
      }

      return false;
   }

   public function get_bills_for_land(string $id) {
      $result = $this->query(
         "SELECT * FROM bills WHERE land = ?",
         "s",
         $id
      );

      if ($result && $result->num_rows > 0) {
         return $result;
      }

      return false;
   }

   public function get_payed_bills_for_land(string $id) {
      $result = $this->query(
         "SELECT * FROM bills WHERE land = ? AND payedFee = 1",
         "s",
         $id
      );

      if ($result && $result->num_rows > 0) {
         return $result;
      }

      return false;
   }

   public function get_not_payed_bills_for_land(string $id) {
      $result = $this->query(
         "SELECT * FROM bills WHERE land = ? AND payedFee = 0",
         "s",
         $id
      );

      if ($result && $result->num_rows > 0) {
         return $result;
      }

      return false;
   }

   public function get_bills_for_user(int $id) {
      $result = $this->query(
         "SELECT * FROM bills WHERE land IN (SELECT id FROM land WHERE land_lord = ?)",
         "i",
         $id
      );

      if ($result && $result->num_rows > 0) {
         return $result;
      }

      return false;
   }

   public function get_not_payed_bills_for_user(int $id) {
      $result = $this->query(
         "SELECT * FROM bills WHERE land IN (SELECT id FROM land WHERE land_lord = ?) AND payedFee = 0",
         "i",
         $id
      );

      if ($result && $result->num_rows > 0) {
         return $result;
      }

      return false;
   }

   public function get_payed_bills_for_user(int $id) {
      $result = $this->query(
         "SELECT * FROM bills WHERE land IN (SELECT id FROM land WHERE land_lord = ?) AND payedFee = 1",
         "i",
         $id
      );

      if ($result && $result->num_rows > 0) {
         return $result;
      }

      return false;
   }

   public function land_bills_is_payed(string $id) {
      $result = $this->query(
         "SELECT payed FROM payed WHERE land = ?",
         "s",
         $id
      );

      if ($result && $result->num_rows > 0) {
         return $result->fetch_assoc();
      }

      return false;
   }

   public function add_bill_for_all(float $sum, string $comment = null) {
      $result = $this->query(
         "
            INSERT INTO bills (land, sum, comment)
            SELECT land.id AS land, ?, ?
            FROM land
         ",
         "ds",
         $sum,
         isset($comment) ? $comment : null,
      );

      if ($result && $result->num_rows > 0) {
         return $result->fetch_assoc();
      }

      return false;
   }
}

global $db;
$db = new DataBase();
