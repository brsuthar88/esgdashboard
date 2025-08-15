<?php

namespace App\Models;

use CodeIgniter\Model;

class ZohoInventoryModel extends Model
{
    protected $table      = 'inventory';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'item_id',
        'item_name',
        'unit',
        'description',
        'rate',
        'rate_cate',
        'stocks',
        'sku',
        'cf_sheet',
        'created_at',
        'updated_at',
        'warehouse_id',
        'warehouse_name',
        'warehouse_detail',
        'stock',
    ];

    // Enable timestamps if you want them to be automatically handled
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Insert or Update an item in the inventory
    public function syncItem($itemdata)
    {
        // Check if the item already exists by item_id
        $existingItem = $this->where('item_id', $itemdata['item_id'])->first();

        if ($existingItem) {
            // Item exists, update it
            // Update the record with the new item data
            $this->update($existingItem['id'], $itemdata);
        } else {
            // Item does not exist, insert it
            // Insert the new item into the database
            $this->insert($itemdata);
        }
    }
}
