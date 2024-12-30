<?php

namespace App\Imports;

use App\Models\produkAfiliate;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportShopee implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new produkAfiliate([
            'platformAfiliate_id'=>'2',
            
        ]);

    }
}
