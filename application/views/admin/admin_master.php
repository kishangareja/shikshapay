<?php

$this->load->view('admin/header');
$this->load->view('admin/side_menu');
if (isset($view))
    $this->load->view($view);
$this->load->view('admin/footer');
?>