<?php

namespace App\Http\Controllers;

use App\Item;
use App\Imports\ItemsImport;
use App\Exports\ItemsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ItemController extends Controller
{
    protected $file;

    public function __construct(Request $request)
    {
        $this->file = $request->hasFile('excel') ? $request->file('excel') : null;
    }

    public function index()
    {
        return view('index');
    }

    public function import()
    {
        if ($this->file) {
            try {
                Excel::import(new ItemsImport, $this->file);
            } catch (\Exception $e) {
                return $e->getMessage();
                die();
            }

            return $this->export();
        }
    }

    protected function export()
    {
        return Excel::download(new ItemsExport, pathinfo($this->file->getClientOriginalName(), PATHINFO_FILENAME).'.xlsx');
    }

    public function truncate()
    {
        Item::truncate();

        return redirect()->route('index');
    }
}
