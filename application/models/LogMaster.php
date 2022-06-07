<?php

defined('BASEPATH') or exit('No direct script access allowed');

class LogMaster extends CI_Model
{
    var $table = 'log_data_master';
    public function getAllLog()
    {
        $data = $this->db->query("SELECT a.*,b.role  FROM user a LEFT JOIN user_role b ON a.role_id = b.id");
        return $data;
    }
    public function getLog($username)
    {
        $this->db->from($this->table);
        $this->db->where('username', $username);
        $query = $this->db->get();
        return $query->row();
    }
    public function obatById($id)
    {
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    function addLog($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }
    function updateLog($id, $data)
    {
        $this->db->update($this->table, $data, ['id' => $id]);
        return $this->db->affected_rows();
    }
    public function cekUserUpdate($id, $username)
    {
        return $this->db->query("SELECT * FROM user where username='$username' and id != $id");
    }
    public function cekUserAdd($username)
    {
        return $this->db->query("SELECT * FROM user where username='$username'");
    }
    function delete_by_id($id)
    {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
    }
}
