<?php 

require_once './app/models/model.php';

class adminModel extends Model{

    public function getAdminByUser($user){
        $query = $this->db->prepare('SELECT * FROM users WHERE user_name = ?');
        $query->execute([$user]);

        $userFromDB = $query->fetch(PDO::FETCH_OBJ);
        return $userFromDB;
    }
}