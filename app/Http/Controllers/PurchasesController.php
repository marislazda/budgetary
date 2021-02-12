<?php

namespace App\Http\Controllers;

use App\Http\Requests\Purchases\StatsRequest;
use App\Http\Requests\Purchases\StoreRequest;
use App\Http\Requests\Purchases\ImportRequest;
use App\Models\Type;
use App\Models\Purchase;
use App\Services\ImportService;

class PurchasesController extends Controller {

    public function form()
    {
        $types = Type::pluck('name', 'id');

        return view('purchases.form',
            compact('types')
        );
    }

    public function formSubmit(StoreRequest $request)
    {
        $data = $request->all();
        $data['created_at'] = gmdate('Y-m-d');
        $item = new Purchase;
        $item->fill($data);
        $item->save();

        return redirect('');
    }

    public function importForm()
    {
        return view('purchases.form_import');
    }

    public function importFormSubmit(ImportRequest $request)
    {
        if (!$request->file('file')->isValid()) {
            $this->response()->errorBadRequest('File upload failed');
        }
        if (!in_array($request->file('file')->getClientOriginalExtension(), ['pdf'])) {
            $this->response()->errorBadRequest('Invalid file format');
        }

        $service = new ImportService();
        try {
            $service->processFile($request->file('file'));

        } catch (\Exception $e) {
            return trigger_error($e->getMessage());
        }
    }

    public function stats(StatsRequest $request)
    {
        return 'purchases.stats';
    }
}
