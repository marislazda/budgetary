<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Purchases\StatsRequest;

class StatsController extends Controller {

    public function index(StatsRequest $request)
    {
        return view('purchases.stats');
    }

}
