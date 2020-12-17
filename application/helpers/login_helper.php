<?php
//function cek akses blum login
function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('logged_in')) {
        redirect('login');
    }
}

function cekAdmin()
{
    $ci = get_instance();
    if (!$ci->session->userdata('logged_in') && $ci->session->userdata('logged_in') != '1') {
        redirect('login');
    }
}
