<?php

namespace Model;

use Core\Entity;
use PDO;
use PDOException;

class TestModel extends Entity
{
        /**
         * @var string
         */
    protected string $table = 'user';

        /**
         * @var string
         */
    private string $email;

        /**
         * @var string
         */
    private string $password;
    private string $lastname;
    private string $firstname;
    private string $birthdate;
    private string $address;
    private string $zipcode;
    private string $city;
    private string $country;
    public function __construct()
    {
            parent::__construct();
            $this->email = "";
            $this->password = "";
    }

        /**
         * @param string $email
         * @return mixed
         */
    public function getUserByEmail(string $email): mixed
    {
            $sql = "SELECT * FROM $this->table WHERE email = :email";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':email', $email);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
    }

        /**
         * @param int $id
         * @return mixed
         */
    public function getUserById(int $id): mixed
    {
            $sql = "SELECT * FROM $this->table WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            return $stmt->fetch();
    }

        /**
         * @return false|string
         */
    public function createUser(): false|string
    {
            $sql = "INSERT INTO $this->table (email, password, firstname, lastname, birthdate)
VALUES (:email, :password, :firstname, :lastname, :birthdate)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':password', $this->password);
            $stmt->bindParam(':firstname', $this->firstname);
            $stmt->bindParam(':lastname', $this->lastname);
            $stmt->bindParam(':birthdate', $this->birthdate);
            return $stmt->execute();
    }

        /**
         * @param array $data
         * @return int
         */
    public function updateUser(array $data): int
    {
            $sql = "UPDATE $this->table SET email = :email, 
                 firstname = :firstname,
                 lastname = :lastname,
                 birthdate = :birthdate,
                 address = :address,
                    zipcode = :zipcode,
                    city = :city,
                    country = :country
             WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':id', $data['id']);
            $stmt->bindParam(':email', $data['email']);
            $stmt->bindParam(':firstname', $data['firstname']);
            $stmt->bindParam(':lastname', $data['lastname']);
            $stmt->bindParam(':birthdate', $data['birthdate']);
            $stmt->bindParam(':address', $data['address']);
            $stmt->bindParam(':zipcode', $data['zipcode']);
            $stmt->bindParam(':city', $data['city']);
            $stmt->bindParam(':country', $data['country']);
            $stmt->execute();
            return $stmt->rowCount();
    }

        /**
         * @param int $id
         * @return bool
         */
    public function deleteUser(int $id): bool
    {
            // Initiate a transaction
            $this->db->beginTransaction();

        try {
                // Delete User (references membership table)
                $sql = "DELETE FROM " . $this->table . " WHERE id = :id";
                $stmt = $this->db->prepare($sql);
                $stmt->bindParam(':id', $id);

            if (!$stmt->execute()) {
                throw new PDOException("Error deleting user: " . $stmt->errorInfo()[2]);
            }

                // Commit the transaction if all deletions are successful
                $this->db->commit();
                return true;
        } catch (PDOException $e) {
                // Rollback the transaction if any errors occur
                $this->db->rollBack();
                error_log($e->getMessage(), 0);
                return false;
        }
    }


        /**
         * @return false|array
         */
    public function getUsers(): false|array
    {
            $sql = "SELECT * FROM $this->table";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPassword(): string
    {
            return $this->password;
    }

    public function setPassword(string $password): void
    {
            $this->password = $password;
    }

    public function getEmail(): string
    {
            return $this->email;
    }

    public function setEmail(string $email): void
    {
            $this->email = $email;
    }

    public function getBirthdate(): string
    {
            return $this->birthdate;
    }

    public function setBirthdate(string $birthdate): void
    {
            $this->birthdate = $birthdate;
    }

    public function getFirstname(): string
    {
            return $this->firstname;
    }

    public function setFirstname(string $firstname): void
    {
            $this->firstname = $firstname;
    }

    public function getLastname(): string
    {
            return $this->lastname;
    }

    public function setLastname(string $lastname): void
    {
            $this->lastname = $lastname;
    }

    public function getAddress(): string
    {
            return $this->address;
    }

    public function setAddress(string $address): void
    {
            $this->address = $address;
    }

    public function getZipcode(): string
    {
            return $this->zipcode;
    }

    public function setZipcode(string $zipcode): void
    {
            $this->zipcode = $zipcode;
    }

    public function getCity(): string
    {
            return $this->city;
    }

    public function setCity(string $city): void
    {
            $this->city = $city;
    }

    public function getCountry(): string
    {
            return $this->country;
    }

    public function setCountry(string $country): void
    {
            $this->country = $country;
    }
}
