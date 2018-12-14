<?php

namespace App\Exports;

use App\Item;
use Maatwebsite\Excel\Concerns\FromCollection;

class ItemsExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $headings = Item::select('column_2')->groupBy('column_2')->pluck('column_2')->all();

        asort($headings, SORT_NATURAL);

        $rows = [];

        foreach ($headings as $heading) {
            $columns = Item::select('column_3')->where('column_2', $heading)->pluck('column_3')->all();

            array_unshift($columns, $heading);

            array_push($rows, $columns);
        }

        Item::where('token', request()->token)->delete();

        return collect(array_map(null, ...$rows));
    }
}
