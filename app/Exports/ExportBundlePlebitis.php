<?php

namespace App\Exports;

use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class ExportBundlePlebitis implements FromView, ShouldAutoSize, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct(
        $igd_PLB0301,
        $igd_PLB0302,
        $igd_PLB0303,
        $igd_PLB0304,
        $igd_PLB0201,
        $igd_PLB0202,
        $igd_PLB0203,
        $igd_PLB0204,
        $igd_jumlah,

        $no_igd_PLB0301,
        $no_igd_PLB0302,
        $no_igd_PLB0303,
        $no_igd_PLB0304,
        $no_igd_PLB0201,
        $no_igd_PLB0202,
        $no_igd_PLB0203,
        $no_igd_PLB0204,
        $no_igd_jumlah,

        $denominator_igd,

        $int_PLB0301,
        $int_PLB0302,
        $int_PLB0303,
        $int_PLB0304,
        $int_PLB0201,
        $int_PLB0202,
        $int_PLB0203,
        $int_PLB0204,
        $int_jumlah,

        $no_int_PLB0301,
        $no_int_PLB0302,
        $no_int_PLB0303,
        $no_int_PLB0304,
        $no_int_PLB0201,
        $no_int_PLB0202,
        $no_int_PLB0203,
        $no_int_PLB0204,
        $no_int_jumlah,

        $denominator_int,

        $ok_PLB0301,
        $ok_PLB0302,
        $ok_PLB0303,
        $ok_PLB0304,
        $ok_PLB0201,
        $ok_PLB0202,
        $ok_PLB0203,
        $ok_PLB0204,
        $ok_jumlah,

        $no_ok_PLB0301,
        $no_ok_PLB0302,
        $no_ok_PLB0303,
        $no_ok_PLB0304,
        $no_ok_PLB0201,
        $no_ok_PLB0202,
        $no_ok_PLB0203,
        $no_ok_PLB0204,
        $no_ok_jumlah,

        $denominator_ok,

        $lt2_PLB0301,
        $lt2_PLB0302,
        $lt2_PLB0303,
        $lt2_PLB0304,
        $lt2_PLB0201,
        $lt2_PLB0202,
        $lt2_PLB0203,
        $lt2_PLB0204,
        $lt2_jumlah,

        $no_lt2_PLB0301,
        $no_lt2_PLB0302,
        $no_lt2_PLB0303,
        $no_lt2_PLB0304,
        $no_lt2_PLB0201,
        $no_lt2_PLB0202,
        $no_lt2_PLB0203,
        $no_lt2_PLB0204,
        $no_lt2_jumlah,

        $denominator_lt2,

        $lt4_PLB0301,
        $lt4_PLB0302,
        $lt4_PLB0303,
        $lt4_PLB0304,
        $lt4_PLB0201,
        $lt4_PLB0202,
        $lt4_PLB0203,
        $lt4_PLB0204,
        $lt4_jumlah,

        $no_lt4_PLB0301,
        $no_lt4_PLB0302,
        $no_lt4_PLB0303,
        $no_lt4_PLB0304,
        $no_lt4_PLB0201,
        $no_lt4_PLB0202,
        $no_lt4_PLB0203,
        $no_lt4_PLB0204,
        $no_lt4_jumlah,

        $denominator_lt4,

        $lt5_PLB0301,
        $lt5_PLB0302,
        $lt5_PLB0303,
        $lt5_PLB0304,
        $lt5_PLB0201,
        $lt5_PLB0202,
        $lt5_PLB0203,
        $lt5_PLB0204,
        $lt5_jumlah,

        $no_lt5_PLB0301,
        $no_lt5_PLB0302,
        $no_lt5_PLB0303,
        $no_lt5_PLB0304,
        $no_lt5_PLB0201,
        $no_lt5_PLB0202,
        $no_lt5_PLB0203,
        $no_lt5_PLB0204,
        $no_lt5_jumlah,

        $denominator_lt5,

        $vk_PLB0301,
        $vk_PLB0302,
        $vk_PLB0303,
        $vk_PLB0304,
        $vk_PLB0201,
        $vk_PLB0202,
        $vk_PLB0203,
        $vk_PLB0204,
        $vk_jumlah,

        $no_vk_PLB0301,
        $no_vk_PLB0302,
        $no_vk_PLB0303,
        $no_vk_PLB0304,
        $no_vk_PLB0201,
        $no_vk_PLB0202,
        $no_vk_PLB0203,
        $no_vk_PLB0204,
        $no_vk_jumlah,

        $denominator_vk,

        $tabel,
        $rekap,
        $tanggal
    ) {
        $this->igd_PLB0301 = $igd_PLB0301;
        $this->igd_PLB0302 = $igd_PLB0302;
        $this->igd_PLB0303 = $igd_PLB0303;
        $this->igd_PLB0304 = $igd_PLB0304;
        $this->igd_PLB0201 = $igd_PLB0201;
        $this->igd_PLB0202 = $igd_PLB0202;
        $this->igd_PLB0203 = $igd_PLB0203;
        $this->igd_PLB0204 = $igd_PLB0204;
        $this->igd_jumlah = $igd_jumlah;

        $this->no_igd_PLB0301 = $no_igd_PLB0301;
        $this->no_igd_PLB0302 = $no_igd_PLB0302;
        $this->no_igd_PLB0303 = $no_igd_PLB0303;
        $this->no_igd_PLB0304 = $no_igd_PLB0304;
        $this->no_igd_PLB0201 = $no_igd_PLB0201;
        $this->no_igd_PLB0202 = $no_igd_PLB0202;
        $this->no_igd_PLB0203 = $no_igd_PLB0203;
        $this->no_igd_PLB0204 = $no_igd_PLB0204;
        $this->no_igd_jumlah = $no_igd_jumlah;

        $this->denominator_igd = $denominator_igd;

        $this->int_PLB0301 = $int_PLB0301;
        $this->int_PLB0302 = $int_PLB0302;
        $this->int_PLB0303 = $int_PLB0303;
        $this->int_PLB0304 = $int_PLB0304;
        $this->int_PLB0201 = $int_PLB0201;
        $this->int_PLB0202 = $int_PLB0202;
        $this->int_PLB0203 = $int_PLB0203;
        $this->int_PLB0204 = $int_PLB0204;
        $this->int_jumlah = $int_jumlah;

        $this->no_int_PLB0301 = $no_int_PLB0301;
        $this->no_int_PLB0302 = $no_int_PLB0302;
        $this->no_int_PLB0303 = $no_int_PLB0303;
        $this->no_int_PLB0304 = $no_int_PLB0304;
        $this->no_int_PLB0201 = $no_int_PLB0201;
        $this->no_int_PLB0202 = $no_int_PLB0202;
        $this->no_int_PLB0203 = $no_int_PLB0203;
        $this->no_int_PLB0204 = $no_int_PLB0204;
        $this->no_int_jumlah = $no_int_jumlah;

        $this->denominator_int = $denominator_int;

        $this->ok_PLB0301 = $ok_PLB0301;
        $this->ok_PLB0302 = $ok_PLB0302;
        $this->ok_PLB0303 = $ok_PLB0303;
        $this->ok_PLB0304 = $ok_PLB0304;
        $this->ok_PLB0201 = $ok_PLB0201;
        $this->ok_PLB0202 = $ok_PLB0202;
        $this->ok_PLB0203 = $ok_PLB0203;
        $this->ok_PLB0204 = $ok_PLB0204;
        $this->ok_jumlah = $ok_jumlah;

        $this->no_ok_PLB0301 = $no_ok_PLB0301;
        $this->no_ok_PLB0302 = $no_ok_PLB0302;
        $this->no_ok_PLB0303 = $no_ok_PLB0303;
        $this->no_ok_PLB0304 = $no_ok_PLB0304;
        $this->no_ok_PLB0201 = $no_ok_PLB0201;
        $this->no_ok_PLB0202 = $no_ok_PLB0202;
        $this->no_ok_PLB0203 = $no_ok_PLB0203;
        $this->no_ok_PLB0204 = $no_ok_PLB0204;
        $this->no_ok_jumlah = $no_ok_jumlah;

        $this->denominator_ok = $denominator_ok;

        $this->lt2_PLB0301 = $lt2_PLB0301;
        $this->lt2_PLB0302 = $lt2_PLB0302;
        $this->lt2_PLB0303 = $lt2_PLB0303;
        $this->lt2_PLB0304 = $lt2_PLB0304;
        $this->lt2_PLB0201 = $lt2_PLB0201;
        $this->lt2_PLB0202 = $lt2_PLB0202;
        $this->lt2_PLB0203 = $lt2_PLB0203;
        $this->lt2_PLB0204 = $lt2_PLB0204;
        $this->lt2_jumlah = $lt2_jumlah;

        $this->no_lt2_PLB0301 = $no_lt2_PLB0301;
        $this->no_lt2_PLB0302 = $no_lt2_PLB0302;
        $this->no_lt2_PLB0303 = $no_lt2_PLB0303;
        $this->no_lt2_PLB0304 = $no_lt2_PLB0304;
        $this->no_lt2_PLB0201 = $no_lt2_PLB0201;
        $this->no_lt2_PLB0202 = $no_lt2_PLB0202;
        $this->no_lt2_PLB0203 = $no_lt2_PLB0203;
        $this->no_lt2_PLB0204 = $no_lt2_PLB0204;
        $this->no_lt2_jumlah = $no_lt2_jumlah;

        $this->denominator_lt2 = $denominator_lt2;

        $this->lt4_PLB0301 = $lt4_PLB0301;
        $this->lt4_PLB0302 = $lt4_PLB0302;
        $this->lt4_PLB0303 = $lt4_PLB0303;
        $this->lt4_PLB0304 = $lt4_PLB0304;
        $this->lt4_PLB0201 = $lt4_PLB0201;
        $this->lt4_PLB0202 = $lt4_PLB0202;
        $this->lt4_PLB0203 = $lt4_PLB0203;
        $this->lt4_PLB0204 = $lt4_PLB0204;
        $this->lt4_jumlah = $lt4_jumlah;

        $this->no_lt4_PLB0301 = $no_lt4_PLB0301;
        $this->no_lt4_PLB0302 = $no_lt4_PLB0302;
        $this->no_lt4_PLB0303 = $no_lt4_PLB0303;
        $this->no_lt4_PLB0304 = $no_lt4_PLB0304;
        $this->no_lt4_PLB0201 = $no_lt4_PLB0201;
        $this->no_lt4_PLB0202 = $no_lt4_PLB0202;
        $this->no_lt4_PLB0203 = $no_lt4_PLB0203;
        $this->no_lt4_PLB0204 = $no_lt4_PLB0204;
        $this->no_lt4_jumlah = $no_lt4_jumlah;

        $this->denominator_lt4 = $denominator_lt4;

        $this->lt5_PLB0301 = $lt5_PLB0301;
        $this->lt5_PLB0302 = $lt5_PLB0302;
        $this->lt5_PLB0303 = $lt5_PLB0303;
        $this->lt5_PLB0304 = $lt5_PLB0304;
        $this->lt5_PLB0201 = $lt5_PLB0201;
        $this->lt5_PLB0202 = $lt5_PLB0202;
        $this->lt5_PLB0203 = $lt5_PLB0203;
        $this->lt5_PLB0204 = $lt5_PLB0204;
        $this->lt5_jumlah = $lt5_jumlah;

        $this->no_lt5_PLB0301 = $no_lt5_PLB0301;
        $this->no_lt5_PLB0302 = $no_lt5_PLB0302;
        $this->no_lt5_PLB0303 = $no_lt5_PLB0303;
        $this->no_lt5_PLB0304 = $no_lt5_PLB0304;
        $this->no_lt5_PLB0201 = $no_lt5_PLB0201;
        $this->no_lt5_PLB0202 = $no_lt5_PLB0202;
        $this->no_lt5_PLB0203 = $no_lt5_PLB0203;
        $this->no_lt5_PLB0204 = $no_lt5_PLB0204;
        $this->no_lt5_jumlah = $no_lt5_jumlah;

        $this->denominator_lt5 = $denominator_lt5;

        $this->vk_PLB0301 = $vk_PLB0301;
        $this->vk_PLB0302 = $vk_PLB0302;
        $this->vk_PLB0303 = $vk_PLB0303;
        $this->vk_PLB0304 = $vk_PLB0304;
        $this->vk_PLB0201 = $vk_PLB0201;
        $this->vk_PLB0202 = $vk_PLB0202;
        $this->vk_PLB0203 = $vk_PLB0203;
        $this->vk_PLB0204 = $vk_PLB0204;
        $this->vk_jumlah = $vk_jumlah;

        $this->no_vk_PLB0301 = $no_vk_PLB0301;
        $this->no_vk_PLB0302 = $no_vk_PLB0302;
        $this->no_vk_PLB0303 = $no_vk_PLB0303;
        $this->no_vk_PLB0304 = $no_vk_PLB0304;
        $this->no_vk_PLB0201 = $no_vk_PLB0201;
        $this->no_vk_PLB0202 = $no_vk_PLB0202;
        $this->no_vk_PLB0203 = $no_vk_PLB0203;
        $this->no_vk_PLB0204 = $no_vk_PLB0204;
        $this->no_vk_jumlah = $no_vk_jumlah;

        $this->denominator_vk = $denominator_vk;

        $this->tabel = $tabel;
        $this->rekap = $rekap;
        $this->tanggal = $tanggal;
    }

    public function view(): View
    {
        return view('rekapBundlePlebitis.excel', [
            'tabel' => $this->tabel,
            'rekap' => $this->rekap,
            'tanggal' => $this->tanggal,

            'igd_PLB0301' => $this->igd_PLB0301,
            'igd_PLB0302' => $this->igd_PLB0302,
            'igd_PLB0303' => $this->igd_PLB0303,
            'igd_PLB0304' => $this->igd_PLB0304,
            'igd_PLB0201' => $this->igd_PLB0201,
            'igd_PLB0202' => $this->igd_PLB0202,
            'igd_PLB0203' => $this->igd_PLB0203,
            'igd_PLB0204' => $this->igd_PLB0204,
            'igd_jumlah' => $this->igd_jumlah,

            'no_igd_PLB0301' => $this->no_igd_PLB0301,
            'no_igd_PLB0302' => $this->no_igd_PLB0302,
            'no_igd_PLB0303' => $this->no_igd_PLB0303,
            'no_igd_PLB0304' => $this->no_igd_PLB0304,
            'no_igd_PLB0201' => $this->no_igd_PLB0201,
            'no_igd_PLB0202' => $this->no_igd_PLB0202,
            'no_igd_PLB0203' => $this->no_igd_PLB0203,
            'no_igd_PLB0204' => $this->no_igd_PLB0204,
            'no_igd_jumlah' => $this->no_igd_jumlah,

            'denominator_igd' => $this->denominator_igd,

            'int_PLB0301' => $this->int_PLB0301,
            'int_PLB0302' => $this->int_PLB0302,
            'int_PLB0303' => $this->int_PLB0303,
            'int_PLB0304' => $this->int_PLB0304,
            'int_PLB0201' => $this->int_PLB0201,
            'int_PLB0202' => $this->int_PLB0202,
            'int_PLB0203' => $this->int_PLB0203,
            'int_PLB0204' => $this->int_PLB0204,
            'int_jumlah' => $this->int_jumlah,

            'no_int_PLB0301' => $this->no_int_PLB0301,
            'no_int_PLB0302' => $this->no_int_PLB0302,
            'no_int_PLB0303' => $this->no_int_PLB0303,
            'no_int_PLB0304' => $this->no_int_PLB0304,
            'no_int_PLB0201' => $this->no_int_PLB0201,
            'no_int_PLB0202' => $this->no_int_PLB0202,
            'no_int_PLB0203' => $this->no_int_PLB0203,
            'no_int_PLB0204' => $this->no_int_PLB0204,
            'no_int_jumlah' => $this->no_int_jumlah,

            'denominator_int' => $this->denominator_int,

            'ok_PLB0301' => $this->ok_PLB0301,
            'ok_PLB0302' => $this->ok_PLB0302,
            'ok_PLB0303' => $this->ok_PLB0303,
            'ok_PLB0304' => $this->ok_PLB0304,
            'ok_PLB0201' => $this->ok_PLB0201,
            'ok_PLB0202' => $this->ok_PLB0202,
            'ok_PLB0203' => $this->ok_PLB0203,
            'ok_PLB0204' => $this->ok_PLB0204,
            'ok_jumlah' => $this->ok_jumlah,

            'no_ok_PLB0301' => $this->no_ok_PLB0301,
            'no_ok_PLB0302' => $this->no_ok_PLB0302,
            'no_ok_PLB0303' => $this->no_ok_PLB0303,
            'no_ok_PLB0304' => $this->no_ok_PLB0304,
            'no_ok_PLB0201' => $this->no_ok_PLB0201,
            'no_ok_PLB0202' => $this->no_ok_PLB0202,
            'no_ok_PLB0203' => $this->no_ok_PLB0203,
            'no_ok_PLB0204' => $this->no_ok_PLB0204,
            'no_ok_jumlah' => $this->no_ok_jumlah,

            'denominator_ok' => $this->denominator_ok,

            'lt2_PLB0301' => $this->lt2_PLB0301,
            'lt2_PLB0302' => $this->lt2_PLB0302,
            'lt2_PLB0303' => $this->lt2_PLB0303,
            'lt2_PLB0304' => $this->lt2_PLB0304,
            'lt2_PLB0201' => $this->lt2_PLB0201,
            'lt2_PLB0202' => $this->lt2_PLB0202,
            'lt2_PLB0203' => $this->lt2_PLB0203,
            'lt2_PLB0204' => $this->lt2_PLB0204,
            'lt2_jumlah' => $this->lt2_jumlah,

            'no_lt2_PLB0301' => $this->no_lt2_PLB0301,
            'no_lt2_PLB0302' => $this->no_lt2_PLB0302,
            'no_lt2_PLB0303' => $this->no_lt2_PLB0303,
            'no_lt2_PLB0304' => $this->no_lt2_PLB0304,
            'no_lt2_PLB0201' => $this->no_lt2_PLB0201,
            'no_lt2_PLB0202' => $this->no_lt2_PLB0202,
            'no_lt2_PLB0203' => $this->no_lt2_PLB0203,
            'no_lt2_PLB0204' => $this->no_lt2_PLB0204,
            'no_lt2_jumlah' => $this->no_lt2_jumlah,

            'denominator_lt2' => $this->denominator_lt2,

            'lt4_PLB0301' => $this->lt4_PLB0301,
            'lt4_PLB0302' => $this->lt4_PLB0302,
            'lt4_PLB0303' => $this->lt4_PLB0303,
            'lt4_PLB0304' => $this->lt4_PLB0304,
            'lt4_PLB0201' => $this->lt4_PLB0201,
            'lt4_PLB0202' => $this->lt4_PLB0202,
            'lt4_PLB0203' => $this->lt4_PLB0203,
            'lt4_PLB0204' => $this->lt4_PLB0204,
            'lt4_jumlah' => $this->lt4_jumlah,

            'no_lt4_PLB0301' => $this->no_lt4_PLB0301,
            'no_lt4_PLB0302' => $this->no_lt4_PLB0302,
            'no_lt4_PLB0303' => $this->no_lt4_PLB0303,
            'no_lt4_PLB0304' => $this->no_lt4_PLB0304,
            'no_lt4_PLB0201' => $this->no_lt4_PLB0201,
            'no_lt4_PLB0202' => $this->no_lt4_PLB0202,
            'no_lt4_PLB0203' => $this->no_lt4_PLB0203,
            'no_lt4_PLB0204' => $this->no_lt4_PLB0204,
            'no_lt4_jumlah' => $this->no_lt4_jumlah,

            'denominator_lt4' => $this->denominator_lt4,

            'lt5_PLB0301' => $this->lt5_PLB0301,
            'lt5_PLB0302' => $this->lt5_PLB0302,
            'lt5_PLB0303' => $this->lt5_PLB0303,
            'lt5_PLB0304' => $this->lt5_PLB0304,
            'lt5_PLB0201' => $this->lt5_PLB0201,
            'lt5_PLB0202' => $this->lt5_PLB0202,
            'lt5_PLB0203' => $this->lt5_PLB0203,
            'lt5_PLB0204' => $this->lt5_PLB0204,
            'lt5_jumlah' => $this->lt5_jumlah,

            'no_lt5_PLB0301' => $this->no_lt5_PLB0301,
            'no_lt5_PLB0302' => $this->no_lt5_PLB0302,
            'no_lt5_PLB0303' => $this->no_lt5_PLB0303,
            'no_lt5_PLB0304' => $this->no_lt5_PLB0304,
            'no_lt5_PLB0201' => $this->no_lt5_PLB0201,
            'no_lt5_PLB0202' => $this->no_lt5_PLB0202,
            'no_lt5_PLB0203' => $this->no_lt5_PLB0203,
            'no_lt5_PLB0204' => $this->no_lt5_PLB0204,
            'no_lt5_jumlah' => $this->no_lt5_jumlah,

            'denominator_lt5' => $this->denominator_lt5,

            'vk_PLB0301' => $this->vk_PLB0301,
            'vk_PLB0302' => $this->vk_PLB0302,
            'vk_PLB0303' => $this->vk_PLB0303,
            'vk_PLB0304' => $this->vk_PLB0304,
            'vk_PLB0201' => $this->vk_PLB0201,
            'vk_PLB0202' => $this->vk_PLB0202,
            'vk_PLB0203' => $this->vk_PLB0203,
            'vk_PLB0204' => $this->vk_PLB0204,
            'vk_jumlah' => $this->vk_jumlah,

            'no_vk_PLB0301' => $this->no_vk_PLB0301,
            'no_vk_PLB0302' => $this->no_vk_PLB0302,
            'no_vk_PLB0303' => $this->no_vk_PLB0303,
            'no_vk_PLB0304' => $this->no_vk_PLB0304,
            'no_vk_PLB0201' => $this->no_vk_PLB0201,
            'no_vk_PLB0202' => $this->no_vk_PLB0202,
            'no_vk_PLB0203' => $this->no_vk_PLB0203,
            'no_vk_PLB0204' => $this->no_vk_PLB0204,
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

                $event->sheet->getDelegate()->getStyle('B4:H17')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $event->sheet->getDelegate()->getStyle('A19:H39')
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

                $event->sheet->getStyle('A19:E19')->applyFromArray([
                    'font' => [
                        'bold'      =>  true,
                    ],
                ]);

                $event->sheet->getStyle('A5:A17')->applyFromArray([
                    'font' => [
                        'bold'      =>  true,
                    ],
                ]);

                $event->sheet->getStyle('A4:H17')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                $event->sheet->getStyle('A19:E20')->applyFromArray([
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
