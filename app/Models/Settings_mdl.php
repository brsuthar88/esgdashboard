<?php
// app/Models/Settings_mdl.php

namespace App\Models;

use CodeIgniter\Model;

class Settings_mdl extends Model
{
    protected $table = 'setting';
    protected $primaryKey = 'setting_id';
    protected $allowedFields = ['key_name', 'value'];

    public function getGlobalPrefix()
    {
        return $this->where('key_name', 'quot_prefix')->first()['value'] ?? '';
    }

    public function getGlobalCurrencysymbol()
    {
        return $this->where('key_name', 'currency-symbol')->first()['value'] ?? '';
    }
    
    public function getGlobaldefaulttimezone()
    {
        return $this->where('key_name', 'default_timezone')->first()['value'] ?? '';
    }

    public function getGlobaldefaultdateformat()
    {
        return $this->where('key_name', 'dateformat')->first()['value'] ?? 'd-m-Y';
    }
    public function get_setting_value($key)
    {
        return $this->where('key_name', $key)->first()['value'] ?? '';
    }
}
