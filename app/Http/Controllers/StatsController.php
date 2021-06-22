<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Purchases\StatsRequest;
use App\Services\StatsService;

class StatsController extends Controller {

    public function index(StatsRequest $request)
    {
        return view('purchases.stats', [
            'data' => (new StatsService())->getData($request->all())
        ]);
    }

}
