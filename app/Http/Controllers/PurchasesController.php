<?php

namespace App\Http\Controllers;

use App\Http\Requests\Purchases\StoreRequest;
use App\Http\Requests\Purchases\ImportRequest;
use App\Models\Type;
use App\Models\Purchase;
use App\Services\ImportService;
use Illuminate\Support\Facades\Storage;

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

        return redirect('')
            ->with('success', 'OK');
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

    public function importFromFile()
    {
        $file = Storage::disk('public')->path('import.csv');
        $service = new ImportService;

        if (($handle = fopen($file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($data[0] === 'Barbora') {
                    continue;
                }

                $date = \DateTime::createFromFormat('d.m', $data[2]);

                $purchaseData = [
                    'created_at' => $date->format('Y-m-d'),
                    'product' => $data[0],
                    'price' => str_replace(',', '.', $data[3]),
                    'type_id' => $service->getTypeIdByName($data[1]),
                    'type' => $data[1]
               ];

                $item = new Purchase;
                $item->fill($purchaseData);
                $item->save();

            }
            fclose($handle);
        }

        die('ok');
    }
}
