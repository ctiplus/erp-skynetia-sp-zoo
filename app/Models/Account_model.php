<?php

namespace App\Models;

use CodeIgniter\Model;

class Account_model extends Model {
    protected $table = 'accounts';

    // Pobierz wszystkie konta księgowe
    public function get_all_accounts() {
    $query = $this->db->query("SELECT * FROM accounts");
    return $query->getResultArray();


    }
}
