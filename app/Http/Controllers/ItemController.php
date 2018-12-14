<?php

namespace App\Http\Controllers;

use App\Log;
use App\Item;
use App\Helpers\Helper;
use App\Imports\ItemsImport;
use App\Exports\ItemsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ItemController extends Controller
{
    protected $request;

    protected $file;

    public function __construct(Request $request)
    {
        $this->request = $request;

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
            } catch (\Exception $exception) {
                Helper::log(false, $exception->getMessage());

                $this->request->session()->flash('message', $exception->getMessage());

                return redirect()->route('index');
            }

            Helper::log(true);

            return $this->export();
        }
    }

    protected function export()
    {
        return Excel::download(new ItemsExport, pathinfo($this->file->getClientOriginalName(), PATHINFO_FILENAME).'.xlsx');
    }

    public function truncate()
    {
        if (Item::truncate()) {
            Helper::log(true);
        }

        return redirect()->route('index');
    }
}
