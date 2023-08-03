<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Stock extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function getStock($tanggalAwal, $tanggalAkhir, $show, $limit)
    {
        $tanggalAwalShow = $tanggalAwal ? "and tanggalStok >='". $tanggalAwal ." 00:00:00'" : "";
        $tanggalAkhirShow = $tanggalAkhir ? "tanggalStok <='". $tanggalAkhir ." 23:59:59'" : "";

        $queryShow = $show === "1" ? "and stok=0" : ($show =="2" ? "and stok>0" : "");

        $sql = "SELECT idStok, '' as ID,DATE_FORMAT(tanggalStok, '%d-%m-%Y') as tanggalStok,noBarang,namaBarang,stok, namasatuan,FORMAT(hargaJual, 2, 'de_DE') as hargaJual,FORMAT(hargaBeli, 2, 'de_DE') as hargaBeli, namaUser,case when tglExpired= '0000-00-00 00:00:00' then '' else DATE_FORMAT(tglExpired, '%d-%m-%Y')   end as tglExpired, note from tstok where idStok<>'' $tanggalAwalShow $tanggalAkhirShow $queryShow order by tanggalStok desc limit $limit" ;

        return DB::select($sql);
    }

    public static function getTotalStock($show, $limit)
    {
        $queryShow = $show === "1" ? "and stok=0" : ($show =="2" ? "and stok>0" : "");

        $sql = "SELECT noBarang, '' as ID,namaBarang,   sum(stok) AS stok, namaSatuan, FORMAT(hargaBeli, 2, 'de_DE')  as hargaBeli, case when sum(stok) < 0 then 0 else FORMAT(sum(stok*hargaBeli), 2, 'de_DE')   end as nilai from tstok where idStok<>'' $queryShow group by noBarang, namaBarang, namaSatuan order by namaBarang desc limit $limit" ;

        return DB::select($sql);
    }
}