<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleCategoryRelationModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'categories_articles';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['category_id', 'article_id'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function updateData($id, $data)
    {
        $this->db->table($this->table)->where('id', $id)->update($data);
    }

}
