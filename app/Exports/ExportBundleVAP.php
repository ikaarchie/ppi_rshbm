<?php

namespace App\Exports;

use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class ExportBundleVAP implements FromView, ShouldAutoSize, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct(
        $igd_VAP0101,
        $igd_VAP0102,
        $igd_VAP0103,
        $igd_VAP0104,
        $igd_VAP0201,
        $igd_VAP0202,
        $igd_VAP0203,
        $igd_VAP0204,
        $igd_VAP0205,
        $igd_VAP0206,
        $igd_VAP0207,
        $igd_VAP0208,
        $igd_jumlah,

        $no_igd_VAP0101,
        $no_igd_VAP0102,
        $no_igd_VAP0103,
        $no_igd_VAP0104,
        $no_igd_VAP0201,
        $no_igd_VAP0202,
        $no_igd_VAP0203,
        $no_igd_VAP0204,
        $no_igd_VAP0205,
        $no_igd_VAP0206,
        $no_igd_VAP0207,
        $no_igd_VAP0208,
        $no_igd_jumlah,

        $denominator_igd,

        $int_VAP0101,
        $int_VAP0102,
        $int_VAP0103,
        $int_VAP0104,
        $int_VAP0201,
        $int_VAP0202,
        $int_VAP0203,
        $int_VAP0204,
        $int_VAP0205,
        $int_VAP0206,
        $int_VAP0207,
        $int_VAP0208,
        $int_jumlah,

        $no_int_VAP0101,
        $no_int_VAP0102,
        $no_int_VAP0103,
        $no_int_VAP0104,
        $no_int_VAP0201,
        $no_int_VAP0202,
        $no_int_VAP0203,
        $no_int_VAP0204,
        $no_int_VAP0205,
        $no_int_VAP0206,
        $no_int_VAP0207,
        $no_int_VAP0208,
        $no_int_jumlah,

        $denominator_int,

        $ok_VAP0101,
        $ok_VAP0102,
        $ok_VAP0103,
        $ok_VAP0104,
        $ok_VAP0201,
        $ok_VAP0202,
        $ok_VAP0203,
        $ok_VAP0204,
        $ok_VAP0205,
        $ok_VAP0206,
        $ok_VAP0207,
        $ok_VAP0208,
        $ok_jumlah,

        $no_ok_VAP0101,
        $no_ok_VAP0102,
        $no_ok_VAP0103,
        $no_ok_VAP0104,
        $no_ok_VAP0201,
        $no_ok_VAP0202,
        $no_ok_VAP0203,
        $no_ok_VAP0204,
        $no_ok_VAP0205,
        $no_ok_VAP0206,
        $no_ok_VAP0207,
        $no_ok_VAP0208,
        $no_ok_jumlah,

        $denominator_ok,

        $lt2_VAP0101,
        $lt2_VAP0102,
        $lt2_VAP0103,
        $lt2_VAP0104,
        $lt2_VAP0201,
        $lt2_VAP0202,
        $lt2_VAP0203,
        $lt2_VAP0204,
        $lt2_VAP0205,
        $lt2_VAP0206,
        $lt2_VAP0207,
        $lt2_VAP0208,
        $lt2_jumlah,

        $no_lt2_VAP0101,
        $no_lt2_VAP0102,
        $no_lt2_VAP0103,
        $no_lt2_VAP0104,
        $no_lt2_VAP0201,
        $no_lt2_VAP0202,
        $no_lt2_VAP0203,
        $no_lt2_VAP0204,
        $no_lt2_VAP0205,
        $no_lt2_VAP0206,
        $no_lt2_VAP0207,
        $no_lt2_VAP0208,
        $no_lt2_jumlah,

        $denominator_lt2,

        $lt4_VAP0101,
        $lt4_VAP0102,
        $lt4_VAP0103,
        $lt4_VAP0104,
        $lt4_VAP0201,
        $lt4_VAP0202,
        $lt4_VAP0203,
        $lt4_VAP0204,
        $lt4_VAP0205,
        $lt4_VAP0206,
        $lt4_VAP0207,
        $lt4_VAP0208,
        $lt4_jumlah,

        $no_lt4_VAP0101,
        $no_lt4_VAP0102,
        $no_lt4_VAP0103,
        $no_lt4_VAP0104,
        $no_lt4_VAP0201,
        $no_lt4_VAP0202,
        $no_lt4_VAP0203,
        $no_lt4_VAP0204,
        $no_lt4_VAP0205,
        $no_lt4_VAP0206,
        $no_lt4_VAP0207,
        $no_lt4_VAP0208,
        $no_lt4_jumlah,

        $denominator_lt4,

        $lt5_VAP0101,
        $lt5_VAP0102,
        $lt5_VAP0103,
        $lt5_VAP0104,
        $lt5_VAP0201,
        $lt5_VAP0202,
        $lt5_VAP0203,
        $lt5_VAP0204,
        $lt5_VAP0205,
        $lt5_VAP0206,
        $lt5_VAP0207,
        $lt5_VAP0208,
        $lt5_jumlah,

        $no_lt5_VAP0101,
        $no_lt5_VAP0102,
        $no_lt5_VAP0103,
        $no_lt5_VAP0104,
        $no_lt5_VAP0201,
        $no_lt5_VAP0202,
        $no_lt5_VAP0203,
        $no_lt5_VAP0204,
        $no_lt5_VAP0205,
        $no_lt5_VAP0206,
        $no_lt5_VAP0207,
        $no_lt5_VAP0208,
        $no_lt5_jumlah,

        $denominator_lt5,

        $vk_VAP0101,
        $vk_VAP0102,
        $vk_VAP0103,
        $vk_VAP0104,
        $vk_VAP0201,
        $vk_VAP0202,
        $vk_VAP0203,
        $vk_VAP0204,
        $vk_VAP0205,
        $vk_VAP0206,
        $vk_VAP0207,
        $vk_VAP0208,
        $vk_jumlah,

        $no_vk_VAP0101,
        $no_vk_VAP0102,
        $no_vk_VAP0103,
        $no_vk_VAP0104,
        $no_vk_VAP0201,
        $no_vk_VAP0202,
        $no_vk_VAP0203,
        $no_vk_VAP0204,
        $no_vk_VAP0205,
        $no_vk_VAP0206,
        $no_vk_VAP0207,
        $no_vk_VAP0208,
        $no_vk_jumlah,

        $denominator_vk,

        $tabel,
        $rekap,
        $tanggal
    ) {
        $this->igd_VAP0101 = $igd_VAP0101;
        $this->igd_VAP0102 = $igd_VAP0102;
        $this->igd_VAP0103 = $igd_VAP0103;
        $this->igd_VAP0104 = $igd_VAP0104;
        $this->igd_VAP0201 = $igd_VAP0201;
        $this->igd_VAP0202 = $igd_VAP0202;
        $this->igd_VAP0203 = $igd_VAP0203;
        $this->igd_VAP0204 = $igd_VAP0204;
        $this->igd_VAP0205 = $igd_VAP0205;
        $this->igd_VAP0206 = $igd_VAP0206;
        $this->igd_VAP0207 = $igd_VAP0207;
        $this->igd_VAP0208 = $igd_VAP0208;
        $this->igd_jumlah = $igd_jumlah;

        $this->no_igd_VAP0101 = $no_igd_VAP0101;
        $this->no_igd_VAP0102 = $no_igd_VAP0102;
        $this->no_igd_VAP0103 = $no_igd_VAP0103;
        $this->no_igd_VAP0104 = $no_igd_VAP0104;
        $this->no_igd_VAP0201 = $no_igd_VAP0201;
        $this->no_igd_VAP0202 = $no_igd_VAP0202;
        $this->no_igd_VAP0203 = $no_igd_VAP0203;
        $this->no_igd_VAP0204 = $no_igd_VAP0204;
        $this->no_igd_VAP0205 = $no_igd_VAP0205;
        $this->no_igd_VAP0206 = $no_igd_VAP0206;
        $this->no_igd_VAP0207 = $no_igd_VAP0207;
        $this->no_igd_VAP0208 = $no_igd_VAP0208;
        $this->no_igd_jumlah = $no_igd_jumlah;

        $this->denominator_igd = $denominator_igd;

        $this->int_VAP0101 = $int_VAP0101;
        $this->int_VAP0102 = $int_VAP0102;
        $this->int_VAP0103 = $int_VAP0103;
        $this->int_VAP0104 = $int_VAP0104;
        $this->int_VAP0201 = $int_VAP0201;
        $this->int_VAP0202 = $int_VAP0202;
        $this->int_VAP0203 = $int_VAP0203;
        $this->int_VAP0204 = $int_VAP0204;
        $this->int_VAP0205 = $int_VAP0205;
        $this->int_VAP0206 = $int_VAP0206;
        $this->int_VAP0207 = $int_VAP0207;
        $this->int_VAP0208 = $int_VAP0208;
        $this->int_jumlah = $int_jumlah;

        $this->no_int_VAP0101 = $no_int_VAP0101;
        $this->no_int_VAP0102 = $no_int_VAP0102;
        $this->no_int_VAP0103 = $no_int_VAP0103;
        $this->no_int_VAP0104 = $no_int_VAP0104;
        $this->no_int_VAP0201 = $no_int_VAP0201;
        $this->no_int_VAP0202 = $no_int_VAP0202;
        $this->no_int_VAP0203 = $no_int_VAP0203;
        $this->no_int_VAP0204 = $no_int_VAP0204;
        $this->no_int_VAP0205 = $no_int_VAP0205;
        $this->no_int_VAP0206 = $no_int_VAP0206;
        $this->no_int_VAP0207 = $no_int_VAP0207;
        $this->no_int_VAP0208 = $no_int_VAP0208;
        $this->no_int_jumlah = $no_int_jumlah;

        $this->denominator_int = $denominator_int;

        $this->ok_VAP0101 = $ok_VAP0101;
        $this->ok_VAP0102 = $ok_VAP0102;
        $this->ok_VAP0103 = $ok_VAP0103;
        $this->ok_VAP0104 = $ok_VAP0104;
        $this->ok_VAP0201 = $ok_VAP0201;
        $this->ok_VAP0202 = $ok_VAP0202;
        $this->ok_VAP0203 = $ok_VAP0203;
        $this->ok_VAP0204 = $ok_VAP0204;
        $this->ok_VAP0205 = $ok_VAP0205;
        $this->ok_VAP0206 = $ok_VAP0206;
        $this->ok_VAP0207 = $ok_VAP0207;
        $this->ok_VAP0208 = $ok_VAP0208;
        $this->ok_jumlah = $ok_jumlah;

        $this->no_ok_VAP0101 = $no_ok_VAP0101;
        $this->no_ok_VAP0102 = $no_ok_VAP0102;
        $this->no_ok_VAP0103 = $no_ok_VAP0103;
        $this->no_ok_VAP0104 = $no_ok_VAP0104;
        $this->no_ok_VAP0201 = $no_ok_VAP0201;
        $this->no_ok_VAP0202 = $no_ok_VAP0202;
        $this->no_ok_VAP0203 = $no_ok_VAP0203;
        $this->no_ok_VAP0204 = $no_ok_VAP0204;
        $this->no_ok_VAP0205 = $no_ok_VAP0205;
        $this->no_ok_VAP0206 = $no_ok_VAP0206;
        $this->no_ok_VAP0207 = $no_ok_VAP0207;
        $this->no_ok_VAP0208 = $no_ok_VAP0208;
        $this->no_ok_jumlah = $no_ok_jumlah;

        $this->denominator_ok = $denominator_ok;

        $this->lt2_VAP0101 = $lt2_VAP0101;
        $this->lt2_VAP0102 = $lt2_VAP0102;
        $this->lt2_VAP0103 = $lt2_VAP0103;
        $this->lt2_VAP0104 = $lt2_VAP0104;
        $this->lt2_VAP0201 = $lt2_VAP0201;
        $this->lt2_VAP0202 = $lt2_VAP0202;
        $this->lt2_VAP0203 = $lt2_VAP0203;
        $this->lt2_VAP0204 = $lt2_VAP0204;
        $this->lt2_VAP0205 = $lt2_VAP0205;
        $this->lt2_VAP0206 = $lt2_VAP0206;
        $this->lt2_VAP0207 = $lt2_VAP0207;
        $this->lt2_VAP0208 = $lt2_VAP0208;
        $this->lt2_jumlah = $lt2_jumlah;

        $this->no_lt2_VAP0101 = $no_lt2_VAP0101;
        $this->no_lt2_VAP0102 = $no_lt2_VAP0102;
        $this->no_lt2_VAP0103 = $no_lt2_VAP0103;
        $this->no_lt2_VAP0104 = $no_lt2_VAP0104;
        $this->no_lt2_VAP0201 = $no_lt2_VAP0201;
        $this->no_lt2_VAP0202 = $no_lt2_VAP0202;
        $this->no_lt2_VAP0203 = $no_lt2_VAP0203;
        $this->no_lt2_VAP0204 = $no_lt2_VAP0204;
        $this->no_lt2_VAP0205 = $no_lt2_VAP0205;
        $this->no_lt2_VAP0206 = $no_lt2_VAP0206;
        $this->no_lt2_VAP0207 = $no_lt2_VAP0207;
        $this->no_lt2_VAP0208 = $no_lt2_VAP0208;
        $this->no_lt2_jumlah = $no_lt2_jumlah;

        $this->denominator_lt2 = $denominator_lt2;

        $this->lt4_VAP0101 = $lt4_VAP0101;
        $this->lt4_VAP0102 = $lt4_VAP0102;
        $this->lt4_VAP0103 = $lt4_VAP0103;
        $this->lt4_VAP0104 = $lt4_VAP0104;
        $this->lt4_VAP0201 = $lt4_VAP0201;
        $this->lt4_VAP0202 = $lt4_VAP0202;
        $this->lt4_VAP0203 = $lt4_VAP0203;
        $this->lt4_VAP0204 = $lt4_VAP0204;
        $this->lt4_VAP0205 = $lt4_VAP0205;
        $this->lt4_VAP0206 = $lt4_VAP0206;
        $this->lt4_VAP0207 = $lt4_VAP0207;
        $this->lt4_VAP0208 = $lt4_VAP0204;
        $this->lt4_jumlah = $lt4_jumlah;

        $this->no_lt4_VAP0101 = $no_lt4_VAP0101;
        $this->no_lt4_VAP0102 = $no_lt4_VAP0102;
        $this->no_lt4_VAP0103 = $no_lt4_VAP0103;
        $this->no_lt4_VAP0104 = $no_lt4_VAP0104;
        $this->no_lt4_VAP0201 = $no_lt4_VAP0201;
        $this->no_lt4_VAP0202 = $no_lt4_VAP0202;
        $this->no_lt4_VAP0203 = $no_lt4_VAP0203;
        $this->no_lt4_VAP0204 = $no_lt4_VAP0204;
        $this->no_lt4_VAP0205 = $no_lt4_VAP0205;
        $this->no_lt4_VAP0206 = $no_lt4_VAP0206;
        $this->no_lt4_VAP0207 = $no_lt4_VAP0207;
        $this->no_lt4_VAP0208 = $no_lt4_VAP0208;
        $this->no_lt4_jumlah = $no_lt4_jumlah;

        $this->denominator_lt4 = $denominator_lt4;

        $this->lt5_VAP0101 = $lt5_VAP0101;
        $this->lt5_VAP0102 = $lt5_VAP0102;
        $this->lt5_VAP0103 = $lt5_VAP0103;
        $this->lt5_VAP0104 = $lt5_VAP0104;
        $this->lt5_VAP0201 = $lt5_VAP0201;
        $this->lt5_VAP0202 = $lt5_VAP0202;
        $this->lt5_VAP0203 = $lt5_VAP0203;
        $this->lt5_VAP0204 = $lt5_VAP0204;
        $this->lt5_VAP0205 = $lt5_VAP0205;
        $this->lt5_VAP0206 = $lt5_VAP0206;
        $this->lt5_VAP0207 = $lt5_VAP0207;
        $this->lt5_VAP0208 = $lt5_VAP0208;
        $this->lt5_jumlah = $lt5_jumlah;

        $this->no_lt5_VAP0101 = $no_lt5_VAP0101;
        $this->no_lt5_VAP0102 = $no_lt5_VAP0102;
        $this->no_lt5_VAP0103 = $no_lt5_VAP0103;
        $this->no_lt5_VAP0104 = $no_lt5_VAP0104;
        $this->no_lt5_VAP0201 = $no_lt5_VAP0201;
        $this->no_lt5_VAP0202 = $no_lt5_VAP0202;
        $this->no_lt5_VAP0203 = $no_lt5_VAP0203;
        $this->no_lt5_VAP0204 = $no_lt5_VAP0204;
        $this->no_lt5_VAP0205 = $no_lt5_VAP0205;
        $this->no_lt5_VAP0206 = $no_lt5_VAP0206;
        $this->no_lt5_VAP0207 = $no_lt5_VAP0207;
        $this->no_lt5_VAP0208 = $no_lt5_VAP0208;
        $this->no_lt5_jumlah = $no_lt5_jumlah;

        $this->denominator_lt5 = $denominator_lt5;

        $this->vk_VAP0101 = $vk_VAP0101;
        $this->vk_VAP0102 = $vk_VAP0102;
        $this->vk_VAP0103 = $vk_VAP0103;
        $this->vk_VAP0104 = $vk_VAP0104;
        $this->vk_VAP0201 = $vk_VAP0201;
        $this->vk_VAP0202 = $vk_VAP0202;
        $this->vk_VAP0203 = $vk_VAP0203;
        $this->vk_VAP0204 = $vk_VAP0204;
        $this->vk_VAP0205 = $vk_VAP0205;
        $this->vk_VAP0206 = $vk_VAP0206;
        $this->vk_VAP0207 = $vk_VAP0207;
        $this->vk_VAP0208 = $vk_VAP0208;
        $this->vk_jumlah = $vk_jumlah;

        $this->no_vk_VAP0101 = $no_vk_VAP0101;
        $this->no_vk_VAP0102 = $no_vk_VAP0102;
        $this->no_vk_VAP0103 = $no_vk_VAP0103;
        $this->no_vk_VAP0104 = $no_vk_VAP0104;
        $this->no_vk_VAP0201 = $no_vk_VAP0201;
        $this->no_vk_VAP0202 = $no_vk_VAP0202;
        $this->no_vk_VAP0203 = $no_vk_VAP0203;
        $this->no_vk_VAP0204 = $no_vk_VAP0204;
        $this->no_vk_VAP0205 = $no_vk_VAP0205;
        $this->no_vk_VAP0206 = $no_vk_VAP0206;
        $this->no_vk_VAP0207 = $no_vk_VAP0207;
        $this->no_vk_VAP0208 = $no_vk_VAP0208;
        $this->no_vk_jumlah = $no_vk_jumlah;

        $this->denominator_vk = $denominator_vk;

        $this->tabel = $tabel;
        $this->rekap = $rekap;
        $this->tanggal = $tanggal;
    }

    public function view(): View
    {
        return view('rekapBundleVAP.excel', [
            'tabel' => $this->tabel,
            'rekap' => $this->rekap,
            'tanggal' => $this->tanggal,

            'igd_VAP0101' => $this->igd_VAP0101,
            'igd_VAP0102' => $this->igd_VAP0102,
            'igd_VAP0103' => $this->igd_VAP0103,
            'igd_VAP0104' => $this->igd_VAP0104,
            'igd_VAP0201' => $this->igd_VAP0201,
            'igd_VAP0202' => $this->igd_VAP0202,
            'igd_VAP0203' => $this->igd_VAP0203,
            'igd_VAP0204' => $this->igd_VAP0204,
            'igd_VAP0205' => $this->igd_VAP0205,
            'igd_VAP0206' => $this->igd_VAP0206,
            'igd_VAP0207' => $this->igd_VAP0207,
            'igd_VAP0208' => $this->igd_VAP0208,
            'igd_jumlah' => $this->igd_jumlah,

            'no_igd_VAP0101' => $this->no_igd_VAP0101,
            'no_igd_VAP0102' => $this->no_igd_VAP0102,
            'no_igd_VAP0103' => $this->no_igd_VAP0103,
            'no_igd_VAP0104' => $this->no_igd_VAP0104,
            'no_igd_VAP0201' => $this->no_igd_VAP0201,
            'no_igd_VAP0202' => $this->no_igd_VAP0202,
            'no_igd_VAP0203' => $this->no_igd_VAP0203,
            'no_igd_VAP0204' => $this->no_igd_VAP0204,
            'no_igd_VAP0205' => $this->no_igd_VAP0205,
            'no_igd_VAP0206' => $this->no_igd_VAP0206,
            'no_igd_VAP0207' => $this->no_igd_VAP0207,
            'no_igd_VAP0208' => $this->no_igd_VAP0208,
            'no_igd_jumlah' => $this->no_igd_jumlah,

            'denominator_igd' => $this->denominator_igd,

            'int_VAP0101' => $this->int_VAP0101,
            'int_VAP0102' => $this->int_VAP0102,
            'int_VAP0103' => $this->int_VAP0103,
            'int_VAP0104' => $this->int_VAP0104,
            'int_VAP0201' => $this->int_VAP0201,
            'int_VAP0202' => $this->int_VAP0202,
            'int_VAP0203' => $this->int_VAP0203,
            'int_VAP0204' => $this->int_VAP0204,
            'int_VAP0205' => $this->int_VAP0205,
            'int_VAP0206' => $this->int_VAP0206,
            'int_VAP0207' => $this->int_VAP0207,
            'int_VAP0208' => $this->int_VAP0208,
            'int_jumlah' => $this->int_jumlah,

            'no_int_VAP0101' => $this->no_int_VAP0101,
            'no_int_VAP0102' => $this->no_int_VAP0102,
            'no_int_VAP0103' => $this->no_int_VAP0103,
            'no_int_VAP0104' => $this->no_int_VAP0104,
            'no_int_VAP0201' => $this->no_int_VAP0201,
            'no_int_VAP0202' => $this->no_int_VAP0202,
            'no_int_VAP0203' => $this->no_int_VAP0203,
            'no_int_VAP0204' => $this->no_int_VAP0204,
            'no_int_VAP0205' => $this->no_int_VAP0205,
            'no_int_VAP0206' => $this->no_int_VAP0206,
            'no_int_VAP0207' => $this->no_int_VAP0207,
            'no_int_VAP0208' => $this->no_int_VAP0208,
            'no_int_jumlah' => $this->no_int_jumlah,

            'denominator_int' => $this->denominator_int,

            'ok_VAP0101' => $this->ok_VAP0101,
            'ok_VAP0102' => $this->ok_VAP0102,
            'ok_VAP0103' => $this->ok_VAP0103,
            'ok_VAP0104' => $this->ok_VAP0104,
            'ok_VAP0201' => $this->ok_VAP0201,
            'ok_VAP0202' => $this->ok_VAP0202,
            'ok_VAP0203' => $this->ok_VAP0203,
            'ok_VAP0204' => $this->ok_VAP0204,
            'ok_VAP0205' => $this->ok_VAP0205,
            'ok_VAP0206' => $this->ok_VAP0206,
            'ok_VAP0207' => $this->ok_VAP0207,
            'ok_VAP0208' => $this->ok_VAP0208,
            'ok_jumlah' => $this->ok_jumlah,

            'no_ok_VAP0101' => $this->no_ok_VAP0101,
            'no_ok_VAP0102' => $this->no_ok_VAP0102,
            'no_ok_VAP0103' => $this->no_ok_VAP0103,
            'no_ok_VAP0104' => $this->no_ok_VAP0104,
            'no_ok_VAP0201' => $this->no_ok_VAP0201,
            'no_ok_VAP0202' => $this->no_ok_VAP0202,
            'no_ok_VAP0203' => $this->no_ok_VAP0203,
            'no_ok_VAP0204' => $this->no_ok_VAP0204,
            'no_ok_VAP0205' => $this->no_ok_VAP0205,
            'no_ok_VAP0206' => $this->no_ok_VAP0206,
            'no_ok_VAP0207' => $this->no_ok_VAP0207,
            'no_ok_VAP0208' => $this->no_ok_VAP0208,
            'no_ok_jumlah' => $this->no_ok_jumlah,

            'denominator_ok' => $this->denominator_ok,

            'lt2_VAP0101' => $this->lt2_VAP0101,
            'lt2_VAP0102' => $this->lt2_VAP0102,
            'lt2_VAP0103' => $this->lt2_VAP0103,
            'lt2_VAP0104' => $this->lt2_VAP0104,
            'lt2_VAP0201' => $this->lt2_VAP0201,
            'lt2_VAP0202' => $this->lt2_VAP0202,
            'lt2_VAP0203' => $this->lt2_VAP0203,
            'lt2_VAP0204' => $this->lt2_VAP0204,
            'lt2_VAP0205' => $this->lt2_VAP0205,
            'lt2_VAP0206' => $this->lt2_VAP0206,
            'lt2_VAP0207' => $this->lt2_VAP0207,
            'lt2_VAP0208' => $this->lt2_VAP0208,
            'lt2_jumlah' => $this->lt2_jumlah,

            'no_lt2_VAP0101' => $this->no_lt2_VAP0101,
            'no_lt2_VAP0102' => $this->no_lt2_VAP0102,
            'no_lt2_VAP0103' => $this->no_lt2_VAP0103,
            'no_lt2_VAP0104' => $this->no_lt2_VAP0104,
            'no_lt2_VAP0201' => $this->no_lt2_VAP0201,
            'no_lt2_VAP0202' => $this->no_lt2_VAP0202,
            'no_lt2_VAP0203' => $this->no_lt2_VAP0203,
            'no_lt2_VAP0204' => $this->no_lt2_VAP0204,
            'no_lt2_VAP0205' => $this->no_lt2_VAP0205,
            'no_lt2_VAP0206' => $this->no_lt2_VAP0206,
            'no_lt2_VAP0207' => $this->no_lt2_VAP0207,
            'no_lt2_VAP0208' => $this->no_lt2_VAP0208,
            'no_lt2_jumlah' => $this->no_lt2_jumlah,

            'denominator_lt2' => $this->denominator_lt2,

            'lt4_VAP0101' => $this->lt4_VAP0101,
            'lt4_VAP0102' => $this->lt4_VAP0102,
            'lt4_VAP0103' => $this->lt4_VAP0103,
            'lt4_VAP0104' => $this->lt4_VAP0104,
            'lt4_VAP0201' => $this->lt4_VAP0201,
            'lt4_VAP0202' => $this->lt4_VAP0202,
            'lt4_VAP0203' => $this->lt4_VAP0203,
            'lt4_VAP0204' => $this->lt4_VAP0204,
            'lt4_VAP0205' => $this->lt4_VAP0205,
            'lt4_VAP0206' => $this->lt4_VAP0206,
            'lt4_VAP0207' => $this->lt4_VAP0207,
            'lt4_VAP0208' => $this->lt4_VAP0208,
            'lt4_jumlah' => $this->lt4_jumlah,

            'no_lt4_VAP0101' => $this->no_lt4_VAP0101,
            'no_lt4_VAP0102' => $this->no_lt4_VAP0102,
            'no_lt4_VAP0103' => $this->no_lt4_VAP0103,
            'no_lt4_VAP0104' => $this->no_lt4_VAP0104,
            'no_lt4_VAP0201' => $this->no_lt4_VAP0201,
            'no_lt4_VAP0202' => $this->no_lt4_VAP0202,
            'no_lt4_VAP0203' => $this->no_lt4_VAP0203,
            'no_lt4_VAP0204' => $this->no_lt4_VAP0204,
            'no_lt4_VAP0205' => $this->no_lt4_VAP0205,
            'no_lt4_VAP0206' => $this->no_lt4_VAP0206,
            'no_lt4_VAP0207' => $this->no_lt4_VAP0207,
            'no_lt4_VAP0208' => $this->no_lt4_VAP0208,
            'no_lt4_jumlah' => $this->no_lt4_jumlah,

            'denominator_lt4' => $this->denominator_lt4,

            'lt5_VAP0101' => $this->lt5_VAP0101,
            'lt5_VAP0102' => $this->lt5_VAP0102,
            'lt5_VAP0103' => $this->lt5_VAP0103,
            'lt5_VAP0104' => $this->lt5_VAP0104,
            'lt5_VAP0201' => $this->lt5_VAP0201,
            'lt5_VAP0202' => $this->lt5_VAP0202,
            'lt5_VAP0203' => $this->lt5_VAP0203,
            'lt5_VAP0204' => $this->lt5_VAP0204,
            'lt5_VAP0205' => $this->lt5_VAP0205,
            'lt5_VAP0206' => $this->lt5_VAP0206,
            'lt5_VAP0207' => $this->lt5_VAP0207,
            'lt5_VAP0208' => $this->lt5_VAP0208,
            'lt5_jumlah' => $this->lt5_jumlah,

            'no_lt5_VAP0101' => $this->no_lt5_VAP0101,
            'no_lt5_VAP0102' => $this->no_lt5_VAP0102,
            'no_lt5_VAP0103' => $this->no_lt5_VAP0103,
            'no_lt5_VAP0104' => $this->no_lt5_VAP0104,
            'no_lt5_VAP0201' => $this->no_lt5_VAP0201,
            'no_lt5_VAP0202' => $this->no_lt5_VAP0202,
            'no_lt5_VAP0203' => $this->no_lt5_VAP0203,
            'no_lt5_VAP0204' => $this->no_lt5_VAP0204,
            'no_lt5_VAP0205' => $this->no_lt5_VAP0205,
            'no_lt5_VAP0206' => $this->no_lt5_VAP0206,
            'no_lt5_VAP0207' => $this->no_lt5_VAP0207,
            'no_lt5_VAP0208' => $this->no_lt5_VAP0208,
            'no_lt5_jumlah' => $this->no_lt5_jumlah,

            'denominator_lt5' => $this->denominator_lt5,

            'vk_VAP0101' => $this->vk_VAP0101,
            'vk_VAP0102' => $this->vk_VAP0102,
            'vk_VAP0103' => $this->vk_VAP0103,
            'vk_VAP0104' => $this->vk_VAP0104,
            'vk_VAP0201' => $this->vk_VAP0201,
            'vk_VAP0202' => $this->vk_VAP0202,
            'vk_VAP0203' => $this->vk_VAP0203,
            'vk_VAP0204' => $this->vk_VAP0204,
            'vk_VAP0205' => $this->vk_VAP0205,
            'vk_VAP0206' => $this->vk_VAP0206,
            'vk_VAP0207' => $this->vk_VAP0207,
            'vk_VAP0208' => $this->vk_VAP0208,
            'vk_jumlah' => $this->vk_jumlah,

            'no_vk_VAP0101' => $this->no_vk_VAP0101,
            'no_vk_VAP0102' => $this->no_vk_VAP0102,
            'no_vk_VAP0103' => $this->no_vk_VAP0103,
            'no_vk_VAP0104' => $this->no_vk_VAP0104,
            'no_vk_VAP0201' => $this->no_vk_VAP0201,
            'no_vk_VAP0202' => $this->no_vk_VAP0202,
            'no_vk_VAP0203' => $this->no_vk_VAP0203,
            'no_vk_VAP0204' => $this->no_vk_VAP0204,
            'no_vk_VAP0205' => $this->no_vk_VAP0205,
            'no_vk_VAP0206' => $this->no_vk_VAP0206,
            'no_vk_VAP0207' => $this->no_vk_VAP0207,
            'no_vk_VAP0208' => $this->no_vk_VAP0208,
            'no_vk_jumlah' => $this->no_vk_jumlah,

            'denominator_vk' => $this->denominator_vk,
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:H2')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $event->sheet->getDelegate()->getStyle('B4:H21')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $event->sheet->getDelegate()->getStyle('A23:H43')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $event->sheet->getDelegate()->getStyle('A5:H5')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $event->sheet->getDelegate()->getStyle('A10:H10')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $event->sheet->getStyle('A1:H1')->applyFromArray([
                    'font' => [
                        'size'      =>  20,
                        'bold'      =>  true,
                    ],
                ]);

                $event->sheet->getStyle('A2:H2')->applyFromArray([
                    'font' => [
                        'size'      =>  15,
                        'bold'      =>  true,
                    ],
                ]);

                $event->sheet->getStyle('A4:H4')->applyFromArray([
                    'font' => [
                        'bold'      =>  true,
                    ],
                ]);

                $event->sheet->getStyle('A23:E23')->applyFromArray([
                    'font' => [
                        'bold'      =>  true,
                    ],
                ]);

                $event->sheet->getStyle('A5:A21')->applyFromArray([
                    'font' => [
                        'bold'      =>  true,
                    ],
                ]);

                $event->sheet->getStyle('A4:H21')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                $event->sheet->getStyle('A23:E24')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                $event->sheet->getDelegate()->getPageSetup()
                    ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);

                $event->sheet->getDelegate()->getPageSetup()->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);

                // $event->sheet->getDelegate()->getPageMargins()->setBottom(0);
            },
        ];
    }
}
