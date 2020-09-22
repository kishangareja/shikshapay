<?php

/**
 * Is Ajax check for ajax request
 */
function is_ajax() {
    $C = & get_instance();
    if (!$C->input->is_ajax_request())
        exit('No direct script access allowed');
}

/**
 * Check Template
 */
function get_portal() {
    $C = & get_instance();
    $portal = 'admin';
    if ($C->session->userdata('admin_id')) {
        $portal = 'admin';
    }
    return $portal;
}
