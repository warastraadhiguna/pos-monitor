<?php

namespace App\Http\Controllers;

use App\Models\Stock;

class StockController extends Controller
{
    public function index()
    {
        $startDate = request()->start_date;
        $endDate = request()->end_date;
        // $startDate = date($startDate ? $startDate : GetNowDate()->toDateString());
        // $endDate = date($endDate ? $endDate : GetNowDate()->toDateString()) ;
        $show = request()->show;
        $show = $show ? $show : "2";
        $limit = request()->limit;
        $limit = $limit ? $limit : "100";

        $data =[
            'title' => "Rincian Stok",
            'start_date' => $startDate,
            'end_date'  => $endDate,
            'show'  => $show,
            'limit'  => $limit,
            'stocks'  => Stock::getStock($startDate, $endDate, $show, $limit),
            'content' => "admin/stock/index"
        ];

        return view("admin.layouts.wrapper", $data);
    }

    public function showTotal()
    {
        $show = request()->show;
        $show = $show ? $show : "2";
        $limit = request()->limit;
        $limit = $limit ? $limit : "100";

        $data =[
            'title' => "Stok Total",
            'show'  => $show,
            'limit'  => $limit,
            'stocks'  => Stock::getTotalStock($show, $limit),
            'content' => "admin/stock/total"
        ];

        return view("admin.layouts.wrapper", $data);
    }
}