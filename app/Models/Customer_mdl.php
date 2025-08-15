<?php namespace App\Models;

use CodeIgniter\Model;

class Customer_mdl extends Model
{
    protected $table = 'company_manager';
    protected $primaryKey = 'cm_id';
    protected $allowedFields = ['cm_id', 'name', 'email', 'password', 'company_id', 'permission', 'created_at', 'updated_at'];

    public function getCustomerCategories($customer_category_id)
    {
        // Example: Assuming the 'customer_category' table is related by user_id
        return $this->db->table('customer_category')
            ->where('customer_category_id', $customer_category_id)
            ->where('status', 1)
            ->get()
            ->getResultArray();
    }

    public function getSellerdataCategories($sales_person_id)
    {
        // Example: Assuming the 'customer_category' table is related by user_id
        return $this->db->table('sales_person')
            ->where('sales_person_id', $sales_person_id)
            ->where('status', 1)
            ->get()
            ->getResultArray();
    }
    public function checkemailduplicationsupplier($email)
    {
        return $this->db->table('supplier')
            ->where('email', $email)
            ->get()
            ->getRow();
    }
    public function getCustomeridquotation($id)
    {

        $data = array();
        $data['mainquot'] = $this->db->table('quotation')
            ->where('quotation_id', $id)
            ->get()
            ->getResultArray();

        $data['quotitem'] = $this->db->table('quotation_item')
            ->where('quotation_id', $id)
            ->get()
            ->getResultArray();

        return $data;

    }
    public function getdatafromreporttable($formats, $parent_company_id, $startDate = null, $endDate = null)
    {
        if (empty($formats)) {
            return [];
        }
    
        // Step 1: Get supplier_id and email for this parent company
        $suppliers = $this->db->table('supplier s')
            ->select('s.s_id, s.email')
            ->join('company_manager cm', 'cm.cm_id = s.parent_id', 'left')
            ->where('cm.cm_id', $parent_company_id)
            ->get()
            ->getResultArray();
    
        if (empty($suppliers)) {
            return [];
        }
    
        // Create email -> supplier_id map
        $emailMap = [];
        foreach ($suppliers as $sup) {
            $emailMap[$sup['email']] = $sup['s_id'];
        }
    
        $emails = array_keys($emailMap);
    
        // Flatten formats for select
        $flat = [];
        foreach ($formats as $format) {
            $flat[] = $format['value'];
            $flat[] = $format['file'];
        }
        $selectColumns = 'email,' . implode(',', $flat);
    
        // Step 2: Build reportdata query
        $builder = $this->db->table('reportdata')
            ->select($selectColumns)
            ->whereIn('email', $emails);
    
        if ($startDate) {
            $builder->where('DATE(create_at) >=', $startDate);
        }
        if ($endDate) {
            $builder->where('DATE(create_at) <=', $endDate);
        }
    
        $rows = $builder->get()->getResultArray();
    
        // Step 3: Attach supplier_id to each row
        foreach ($rows as &$row) {
            $row['s_id'] = $emailMap[$row['email']] ?? null;
        }
    
        return $rows;
    }


    public function insertsupplierdata($data)
    {
        $this->db->table('supplier')->insert($data);
        return $this->db->insertID();
    }
    public function insertquotation($data)
    {
        $Settings_mdl = new Settings_mdl();

        $this->db->table('quotation')->insert($data);
        $quotation_id = $this->db->insertID();

        // START-Generate a quotation number
        $quot_prefix = $Settings_mdl->get_setting_value('quot_prefix');
        $quote_number_length = $Settings_mdl->get_setting_value('quote_number_length');
        $no = sprintf("%0" . $quote_number_length . "d", $quotation_id);
        $quotation_number = $quot_prefix . $no;
        $update_data = [
            'quotation_id' => $quotation_id,
            'quotation_number' => $quotation_number,
        ];
        $this->update_quotation_number($update_data);
        // END-Generate a quotation number
        return $quotation_id;
    }

    public function update_quotation_number($data)
    {
        return $this->db->table('quotation')
            ->where('quotation_id', $data['quotation_id'])
            ->update(['quotation_number' => $data['quotation_number']]);
    }

    public function insertquotatioitem($data)
    {
        $this->db->table('quotation_item')->insert($data);
        return $this->db->insertID();
    }

    public function getZohoAccess()
    {
        // Example: Assuming the 'customer_category' table is related by user_id
        return $this->db->table('setting')
            ->get()
            ->getResultArray();
    }

    public function postdeletequotation($ids)
    {

        if (!empty($ids)) {
            // Perform the delete operation
            $this->db->table('quotation_item')->where('quotation_id', $ids)->delete();
            $this->db->table('quotation')->where('quotation_id', $ids)->delete();
            return 1;
        } else {
            return 0;
        }
    }
    public function getallcompanhy()
    {
        return $this->db->table('company')
            ->get()
            ->getResultArray();
    }
    public function getallssuppliyer()
    {
       return $this->db->table('supplier s')
    ->select('s.*')
    ->get()
    ->getResultArray();

    }
    public function getallssuppliyerwithcurrent($cm_id)
    {
       return $this->db->table('supplier s')
    ->select('s.*')
    ->where('parent_id', $cm_id)
    ->get()
    ->getResultArray();

    }
       public function checkemailcvr($email)
    {
        return $this->db->table('reportdata')
            ->where('email', $email)
            ->get()
            ->getResultArray();
    }
    
    public function checkcvremail($cvr)
    {
        return $this->db->table('reportdata')
            ->where('cvr', $cvr)
            ->get()
            ->getResultArray();
    }
    
   
    

    public function getallssuppliyeractive($email)
    {
        $session = session();
        $cm_id = $session->get('cm_id');
    
        return $this->db->table('supplier s')
            ->select('s.*, c.company_name, r.*')
            ->join('company c', 'c.company_id = s.company_id', 'left')
            ->join('reportdata r', 'r.email = s.email', 'left') // join on email
            ->where('s.status', 'accepted')
            ->where('r.email', $email) // filter by email
            ->get()
            ->getResultArray();
    }

    
    
    public function countStatus($status)
    {
        $session = session();
        $customer_id = $session->get('customerId');
        if ($status == "all") {
            return $this->db->table('quotation')
                ->select("COUNT(*) as count")
                ->where('customer_id', $customer_id)
                ->get()
                ->getResultArray();
        } else {
            return $this->db->table('quotation')
                ->select("COUNT(*) as count")
                ->where('status', $status)
                ->where('customer_id', $customer_id)
                ->groupBy('status') // Group by status
                ->get()
                ->getResultArray();
        }
    }

    public function putlogdata($data)
    {
        $this->db->table('logs')->insert($data);
        return $this->db->insertID();
    }
    
}
