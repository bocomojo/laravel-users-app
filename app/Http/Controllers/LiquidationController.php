<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CashAdvance;

class LiquidationController extends Controller
{
    public function index()
    {
        $cashAdvances = CashAdvance::latest()->get();

        return view('liquidation.index', compact('cashAdvances'));
    }
}
