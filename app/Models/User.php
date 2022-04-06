<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id', 'name', 'email', 'mobile', 'mobile_otp', 'role', 'access', 'created_at', 'updated_at'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
    
    public function reunquery()
    {
        echo "<pre></br>";
        print_r( $this->db); die;
        echo "</pre>";
    }

    public function get_user_list()
    {
        $query  = $this->db->query("SELECT `id`, `name`, `email`, `mobile`, `mobile_otp`, `role`, `access`, `created_at`, `updated_at`
                    FROM `users`
                    WHERE `id` NOT IN (1) 
                    -- AND `role` = 'admin'
                    AND `access` = 0");

        return $query->getResultArray();
    }

    public function get_user_doc_list()
    {
        $query  = $this->db->query("SELECT us_doc.`id`, us_doc.`uid`, us_doc.`file_name`, us_doc.`file_type`, us_doc.`file_content`, us_doc.`access`, us_doc.`created_at`, us_doc.`updated_at` 
                    FROM `users_document` AS us_doc
                    LEFT JOIN `users` AS u ON u.id = us_doc.uid
                    WHERE u.id = ".session()->get('id')."
                    AND u.`role` = 'user'
                    AND u.`access` = 0");

        return $query->getResultArray();
    }
}
