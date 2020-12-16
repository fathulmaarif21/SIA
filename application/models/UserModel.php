<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $allowedFields = ['nama', 'username', 'foto', 'password', 'role_id'];
    public function getAllUser()
    {
        $data = $this->db->query("SELECT a.*,b.role FROM user a LEFT JOIN user_role b ON a.role_id = b.id");
        if (!$data) {
            return $error = $this->db->error();
        }
        return $data;
    }
    public function cekUserUpdate($id, $username)
    {
        return $this->db->query("SELECT * FROM user where username='$username' and id != $id");
    }
}
