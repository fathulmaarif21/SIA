<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TriggerHandle extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cekAdmin();
        $this->load->model('TriggerModel');
    }
    public function createTrigger()
    {
        $this->TriggerModel->createTiger();
    }
    public function hapusTrigger()
    {
        $this->TriggerModel->dropTrigger();
    }
}
