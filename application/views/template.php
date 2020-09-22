<?php

$this->load->view('header');
if (isset($view))
    $this->load->view($view);
$this->load->view('footer');
?>