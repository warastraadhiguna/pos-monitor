<?php

namespace App\Http\Controllers;

use App\Models\Receipts;

class ReceiptController extends Controller
{
    public function index()
    {
        $startDate = request()->start_date;
        $endDate = request()->end_date;
        $from = date($startDate ? $startDate : GetNowDate()->toDateString());
        $to = date($endDate ? $endDate : GetNowDate()->toDateString()) ;
        $receipts = Receipts::getSales($from, $to);

        $data =[
            'title' => "Data Penjualan",
            'start_date' => $from,
            'end_date'  => $to,
            'receipts'  => $receipts,
            'content' => "admin/receipt-history/index"
        ];

        return view("admin.layouts.wrapper", $data);
    }

    public function showDetailSale($id)
    {
        $data =[
            'title' => "Detail Penjualan",
            'receipt'  => Receipts::getNota($id),
            'details'   => Receipts::getDetailNota($id),
            'content' => "admin/receipt-history/detail-sale"
        ];

        return view("admin.layouts.wrapper", $data);
    }

    public function showReturSale($id)
    {
        $data =[
            'title' => "Return Penjualan",
            'receipt'  => Receipts::getNota($id),
            'details'   => Receipts::getRetur($id),
            'content' => "admin/receipt-history/detail-sale"
        ];

        return view("admin.layouts.wrapper", $data);
    }

    public function showSaleResume()
    {
        $startDate = request()->start_date;
        $endDate = request()->end_date;
        $from = date($startDate ? $startDate : GetNowDate()->toDateString());
        $to = date($endDate ? $endDate : GetNowDate()->toDateString()) ;

        $data =[
            'title' => "Ringkasan Penjualan",
            'start_date' => $from,
            'end_date'  => $to,
            'content' => "admin/receipt-history/sale-resume",
            'totalPenjualanHariIni'	=> Receipts::getTotalPenjualanHariIniResume($from, $to),
            'totalPembelianHariIni'	=> Receipts::getTotalPembelianHariIniResume($from, $to),
            'totalNotaHariIni'	=> Receipts::getTotalNotaHariIniResume($from, $to),
        ];

        return view("admin.layouts.wrapper", $data);
    }

    public function showProductSaleReturn()
    {
        $startDate = request()->start_date;
        $endDate = request()->end_date;
        $from = date($startDate ? $startDate : GetNowDate()->toDateString());
        $to = date($endDate ? $endDate : GetNowDate()->toDateString()) ;
        $products = Receipts::getProductResume($from, $to);

        $data =[
            'title' => "Ringkasan Penjualan Produk",
            'start_date' => $from,
            'end_date'  => $to,
            'products'  => $products,
            'content' => "admin/receipt-history/sale-product-resume"
        ];

        return view("admin.layouts.wrapper", $data);
    }

    public function showPurchasing()
    {
        $startDate = request()->start_date;
        $endDate = request()->end_date;
        $from = date($startDate ? $startDate : GetNowDate()->toDateString());
        $to = date($endDate ? $endDate : GetNowDate()->toDateString()) ;

        $status = request()->status;
        $status = !$status ? 4 : $status;

        $caraBayar = request()->caraBayar;
        $caraBayar = !$caraBayar ? 4 : $caraBayar;

        $data =[
            'title' => "Data Pembelian",
            'start_date' => $from,
            'end_date'  => $to,
            'caraBayar' =>$caraBayar,
            'status' => $status,
            'receipts'  => Receipts::getPurchasing($from, $to, $status, $caraBayar),
            'content' => "admin/receipt-history/purchasing-list"
        ];

        return view("admin.layouts.wrapper", $data);
    }

    public function showDetailPurchasing()
    {
        $id = request()->id;

        $data =[
            'title' => "Detail Pembelian",
            'receipt'  => Receipts::getNotaPembelian($id),
            'details'   => Receipts::getDetailNotaPembelian($id),
            'totalBayar' => Receipts::getTotalBayarPembelian($id),
            'content' => "admin/receipt-history/detail-purchasing"
        ];

        return view("admin.layouts.wrapper", $data);
    }

    public function showReturnPurchasing()
    {
        $id = request()->id;

        $data =[
            'title' => "Retur Pembelian",
            'receipt'  => Receipts::getNotaPembelian($id),
            'details'   => Receipts::getReturPembelian($id),
            'totalBayar' => Receipts::getTotalBayarPembelian($id),
            'content' => "admin/receipt-history/return-purchasing"
        ];

        return view("admin.layouts.wrapper", $data);
    }

    public function showCicilanPurchasing()
    {
        $id = request()->id;

        $data =[
            'title' => "Retur Pembelian",
            'receipt'  => Receipts::getNotaPembelian($id),
            'details'   => Receipts::getCicilanPembelian($id),
            'totalBayar' => Receipts::getTotalBayarPembelian($id),
            'content' => "admin/receipt-history/cicilan-purchasing"
        ];

        return view("admin.layouts.wrapper", $data);
    }
}