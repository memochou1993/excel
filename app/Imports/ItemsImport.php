<?php

namespace App\Imports;

use App\Item;
use Maatwebsite\Excel\Concerns\ToModel;

class ItemsImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Item([
            'token' => csrf_token(),
            'column_1' => $row[0],
            'column_2' => $row[1],
            'column_3' => $row[2],
        ]);
    }
}
