<?php

namespace App\Exports;

use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class ExportBundleIDO implements FromView, ShouldAutoSize, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function __construct(
        $igd_IDO04A01,
        $igd_IDO04A02,
        $igd_IDO04A03,
        $igd_IDO04A04,
        $igd_IDO04A05,
        $igd_IDO04A06,
        $igd_IDO04A07,
        $igd_IDO04A08,
        $igd_IDO04B01,
        $igd_IDO04B02,
        $igd_IDO04B03,
        $igd_IDO05A01,
        $igd_IDO05A02,
        $igd_IDO05A03,
        $igd_IDO05A04,
        $igd_IDO05B01,
        $igd_IDO05B02,
        $igd_IDO05B03,
        $igd_IDO05B04,
        $igd_IDO0601,
        $igd_IDO0602,
        $igd_IDO0603,
        $igd_IDO0604,
        $igd_jumlah,

        $no_igd_IDO04A01,
        $no_igd_IDO04A02,
        $no_igd_IDO04A03,
        $no_igd_IDO04A04,
        $no_igd_IDO04A05,
        $no_igd_IDO04A06,
        $no_igd_IDO04A07,
        $no_igd_IDO04A08,
        $no_igd_IDO04B01,
        $no_igd_IDO04B02,
        $no_igd_IDO04B03,
        $no_igd_IDO05A01,
        $no_igd_IDO05A02,
        $no_igd_IDO05A03,
        $no_igd_IDO05A04,
        $no_igd_IDO05B01,
        $no_igd_IDO05B02,
        $no_igd_IDO05B03,
        $no_igd_IDO05B04,
        $no_igd_IDO0601,
        $no_igd_IDO0602,
        $no_igd_IDO0603,
        $no_igd_IDO0604,
        $no_igd_jumlah,

        $denominator_igd,

        $int_IDO04A01,
        $int_IDO04A02,
        $int_IDO04A03,
        $int_IDO04A04,
        $int_IDO04A05,
        $int_IDO04A06,
        $int_IDO04A07,
        $int_IDO04A08,
        $int_IDO04B01,
        $int_IDO04B02,
        $int_IDO04B03,
        $int_IDO05A01,
        $int_IDO05A02,
        $int_IDO05A03,
        $int_IDO05A04,
        $int_IDO05B01,
        $int_IDO05B02,
        $int_IDO05B03,
        $int_IDO05B04,
        $int_IDO0601,
        $int_IDO0602,
        $int_IDO0603,
        $int_IDO0604,
        $int_jumlah,

        $no_int_IDO04A01,
        $no_int_IDO04A02,
        $no_int_IDO04A03,
        $no_int_IDO04A04,
        $no_int_IDO04A05,
        $no_int_IDO04A06,
        $no_int_IDO04A07,
        $no_int_IDO04A08,
        $no_int_IDO04B01,
        $no_int_IDO04B02,
        $no_int_IDO04B03,
        $no_int_IDO05A01,
        $no_int_IDO05A02,
        $no_int_IDO05A03,
        $no_int_IDO05A04,
        $no_int_IDO05B01,
        $no_int_IDO05B02,
        $no_int_IDO05B03,
        $no_int_IDO05B04,
        $no_int_IDO0601,
        $no_int_IDO0602,
        $no_int_IDO0603,
        $no_int_IDO0604,
        $no_int_jumlah,

        $denominator_int,

        $ok_IDO04A01,
        $ok_IDO04A02,
        $ok_IDO04A03,
        $ok_IDO04A04,
        $ok_IDO04A05,
        $ok_IDO04A06,
        $ok_IDO04A07,
        $ok_IDO04A08,
        $ok_IDO04B01,
        $ok_IDO04B02,
        $ok_IDO04B03,
        $ok_IDO05A01,
        $ok_IDO05A02,
        $ok_IDO05A03,
        $ok_IDO05A04,
        $ok_IDO05B01,
        $ok_IDO05B02,
        $ok_IDO05B03,
        $ok_IDO05B04,
        $ok_IDO0601,
        $ok_IDO0602,
        $ok_IDO0603,
        $ok_IDO0604,
        $ok_jumlah,

        $no_ok_IDO04A01,
        $no_ok_IDO04A02,
        $no_ok_IDO04A03,
        $no_ok_IDO04A04,
        $no_ok_IDO04A05,
        $no_ok_IDO04A06,
        $no_ok_IDO04A07,
        $no_ok_IDO04A08,
        $no_ok_IDO04B01,
        $no_ok_IDO04B02,
        $no_ok_IDO04B03,
        $no_ok_IDO05A01,
        $no_ok_IDO05A02,
        $no_ok_IDO05A03,
        $no_ok_IDO05A04,
        $no_ok_IDO05B01,
        $no_ok_IDO05B02,
        $no_ok_IDO05B03,
        $no_ok_IDO05B04,
        $no_ok_IDO0601,
        $no_ok_IDO0602,
        $no_ok_IDO0603,
        $no_ok_IDO0604,
        $no_ok_jumlah,

        $denominator_ok,

        $lt2_IDO04A01,
        $lt2_IDO04A02,
        $lt2_IDO04A03,
        $lt2_IDO04A04,
        $lt2_IDO04A05,
        $lt2_IDO04A06,
        $lt2_IDO04A07,
        $lt2_IDO04A08,
        $lt2_IDO04B01,
        $lt2_IDO04B02,
        $lt2_IDO04B03,
        $lt2_IDO05A01,
        $lt2_IDO05A02,
        $lt2_IDO05A03,
        $lt2_IDO05A04,
        $lt2_IDO05B01,
        $lt2_IDO05B02,
        $lt2_IDO05B03,
        $lt2_IDO05B04,
        $lt2_IDO0601,
        $lt2_IDO0602,
        $lt2_IDO0603,
        $lt2_IDO0604,
        $lt2_jumlah,

        $no_lt2_IDO04A01,
        $no_lt2_IDO04A02,
        $no_lt2_IDO04A03,
        $no_lt2_IDO04A04,
        $no_lt2_IDO04A05,
        $no_lt2_IDO04A06,
        $no_lt2_IDO04A07,
        $no_lt2_IDO04A08,
        $no_lt2_IDO04B01,
        $no_lt2_IDO04B02,
        $no_lt2_IDO04B03,
        $no_lt2_IDO05A01,
        $no_lt2_IDO05A02,
        $no_lt2_IDO05A03,
        $no_lt2_IDO05A04,
        $no_lt2_IDO05B01,
        $no_lt2_IDO05B02,
        $no_lt2_IDO05B03,
        $no_lt2_IDO05B04,
        $no_lt2_IDO0601,
        $no_lt2_IDO0602,
        $no_lt2_IDO0603,
        $no_lt2_IDO0604,
        $no_lt2_jumlah,

        $denominator_lt2,

        $lt4_IDO04A01,
        $lt4_IDO04A02,
        $lt4_IDO04A03,
        $lt4_IDO04A04,
        $lt4_IDO04A05,
        $lt4_IDO04A06,
        $lt4_IDO04A07,
        $lt4_IDO04A08,
        $lt4_IDO04B01,
        $lt4_IDO04B02,
        $lt4_IDO04B03,
        $lt4_IDO05A01,
        $lt4_IDO05A02,
        $lt4_IDO05A03,
        $lt4_IDO05A04,
        $lt4_IDO05B01,
        $lt4_IDO05B02,
        $lt4_IDO05B03,
        $lt4_IDO05B04,
        $lt4_IDO0601,
        $lt4_IDO0602,
        $lt4_IDO0603,
        $lt4_IDO0604,
        $lt4_jumlah,

        $no_lt4_IDO04A01,
        $no_lt4_IDO04A02,
        $no_lt4_IDO04A03,
        $no_lt4_IDO04A04,
        $no_lt4_IDO04A05,
        $no_lt4_IDO04A06,
        $no_lt4_IDO04A07,
        $no_lt4_IDO04A08,
        $no_lt4_IDO04B01,
        $no_lt4_IDO04B02,
        $no_lt4_IDO04B03,
        $no_lt4_IDO05A01,
        $no_lt4_IDO05A02,
        $no_lt4_IDO05A03,
        $no_lt4_IDO05A04,
        $no_lt4_IDO05B01,
        $no_lt4_IDO05B02,
        $no_lt4_IDO05B03,
        $no_lt4_IDO05B04,
        $no_lt4_IDO0601,
        $no_lt4_IDO0602,
        $no_lt4_IDO0603,
        $no_lt4_IDO0604,
        $no_lt4_jumlah,

        $denominator_lt4,

        $lt5_IDO04A01,
        $lt5_IDO04A02,
        $lt5_IDO04A03,
        $lt5_IDO04A04,
        $lt5_IDO04A05,
        $lt5_IDO04A06,
        $lt5_IDO04A07,
        $lt5_IDO04A08,
        $lt5_IDO04B01,
        $lt5_IDO04B02,
        $lt5_IDO04B03,
        $lt5_IDO05A01,
        $lt5_IDO05A02,
        $lt5_IDO05A03,
        $lt5_IDO05A04,
        $lt5_IDO05B01,
        $lt5_IDO05B02,
        $lt5_IDO05B03,
        $lt5_IDO05B04,
        $lt5_IDO0601,
        $lt5_IDO0602,
        $lt5_IDO0603,
        $lt5_IDO0604,
        $lt5_jumlah,

        $no_lt5_IDO04A01,
        $no_lt5_IDO04A02,
        $no_lt5_IDO04A03,
        $no_lt5_IDO04A04,
        $no_lt5_IDO04A05,
        $no_lt5_IDO04A06,
        $no_lt5_IDO04A07,
        $no_lt5_IDO04A08,
        $no_lt5_IDO04B01,
        $no_lt5_IDO04B02,
        $no_lt5_IDO04B03,
        $no_lt5_IDO05A01,
        $no_lt5_IDO05A02,
        $no_lt5_IDO05A03,
        $no_lt5_IDO05A04,
        $no_lt5_IDO05B01,
        $no_lt5_IDO05B02,
        $no_lt5_IDO05B03,
        $no_lt5_IDO05B04,
        $no_lt5_IDO0601,
        $no_lt5_IDO0602,
        $no_lt5_IDO0603,
        $no_lt5_IDO0604,
        $no_lt5_jumlah,

        $denominator_lt5,

        $vk_IDO04A01,
        $vk_IDO04A02,
        $vk_IDO04A03,
        $vk_IDO04A04,
        $vk_IDO04A05,
        $vk_IDO04A06,
        $vk_IDO04A07,
        $vk_IDO04A08,
        $vk_IDO04B01,
        $vk_IDO04B02,
        $vk_IDO04B03,
        $vk_IDO05A01,
        $vk_IDO05A02,
        $vk_IDO05A03,
        $vk_IDO05A04,
        $vk_IDO05B01,
        $vk_IDO05B02,
        $vk_IDO05B03,
        $vk_IDO05B04,
        $vk_IDO0601,
        $vk_IDO0602,
        $vk_IDO0603,
        $vk_IDO0604,
        $vk_jumlah,

        $no_vk_IDO04A01,
        $no_vk_IDO04A02,
        $no_vk_IDO04A03,
        $no_vk_IDO04A04,
        $no_vk_IDO04A05,
        $no_vk_IDO04A06,
        $no_vk_IDO04A07,
        $no_vk_IDO04A08,
        $no_vk_IDO04B01,
        $no_vk_IDO04B02,
        $no_vk_IDO04B03,
        $no_vk_IDO05A01,
        $no_vk_IDO05A02,
        $no_vk_IDO05A03,
        $no_vk_IDO05A04,
        $no_vk_IDO05B01,
        $no_vk_IDO05B02,
        $no_vk_IDO05B03,
        $no_vk_IDO05B04,
        $no_vk_IDO0601,
        $no_vk_IDO0602,
        $no_vk_IDO0603,
        $no_vk_IDO0604,
        $no_vk_jumlah,

        $denominator_vk,

        $tabel,
        $rekap,
        $tanggal
    ) {
        $this->igd_IDO04A01 = $igd_IDO04A01;
        $this->igd_IDO04A02 = $igd_IDO04A02;
        $this->igd_IDO04A03 = $igd_IDO04A03;
        $this->igd_IDO04A04 = $igd_IDO04A04;
        $this->igd_IDO04A05 = $igd_IDO04A05;
        $this->igd_IDO04A06 = $igd_IDO04A06;
        $this->igd_IDO04A07 = $igd_IDO04A07;
        $this->igd_IDO04A08 = $igd_IDO04A08;
        $this->igd_IDO04B01 = $igd_IDO04B01;
        $this->igd_IDO04B02 = $igd_IDO04B02;
        $this->igd_IDO04B03 = $igd_IDO04B03;
        $this->igd_IDO05A01 = $igd_IDO05A01;
        $this->igd_IDO05A02 = $igd_IDO05A02;
        $this->igd_IDO05A03 = $igd_IDO05A03;
        $this->igd_IDO05A04 = $igd_IDO05A04;
        $this->igd_IDO05B01 = $igd_IDO05B01;
        $this->igd_IDO05B02 = $igd_IDO05B02;
        $this->igd_IDO05B03 = $igd_IDO05B03;
        $this->igd_IDO05B04 = $igd_IDO05B04;
        $this->igd_IDO0601  = $igd_IDO0601;
        $this->igd_IDO0602  = $igd_IDO0602;
        $this->igd_IDO0603  = $igd_IDO0603;
        $this->igd_IDO0604  = $igd_IDO0604;
        $this->igd_jumlah = $igd_jumlah;

        $this->no_igd_IDO04A01 = $no_igd_IDO04A01;
        $this->no_igd_IDO04A02 = $no_igd_IDO04A02;
        $this->no_igd_IDO04A03 = $no_igd_IDO04A03;
        $this->no_igd_IDO04A04 = $no_igd_IDO04A04;
        $this->no_igd_IDO04A05 = $no_igd_IDO04A05;
        $this->no_igd_IDO04A06 = $no_igd_IDO04A06;
        $this->no_igd_IDO04A07 = $no_igd_IDO04A07;
        $this->no_igd_IDO04A08 = $no_igd_IDO04A08;
        $this->no_igd_IDO04B01 = $no_igd_IDO04B01;
        $this->no_igd_IDO04B02 = $no_igd_IDO04B02;
        $this->no_igd_IDO04B03 = $no_igd_IDO04B03;
        $this->no_igd_IDO05A01 = $no_igd_IDO05A01;
        $this->no_igd_IDO05A02 = $no_igd_IDO05A02;
        $this->no_igd_IDO05A03 = $no_igd_IDO05A03;
        $this->no_igd_IDO05A04 = $no_igd_IDO05A04;
        $this->no_igd_IDO05B01 = $no_igd_IDO05B01;
        $this->no_igd_IDO05B02 = $no_igd_IDO05B02;
        $this->no_igd_IDO05B03 = $no_igd_IDO05B03;
        $this->no_igd_IDO05B04 = $no_igd_IDO05B04;
        $this->no_igd_IDO0601  = $no_igd_IDO0601;
        $this->no_igd_IDO0602  = $no_igd_IDO0602;
        $this->no_igd_IDO0603  = $no_igd_IDO0603;
        $this->no_igd_IDO0604  = $no_igd_IDO0604;
        $this->no_igd_jumlah = $no_igd_jumlah;

        $this->denominator_igd = $denominator_igd;

        $this->int_IDO04A01 = $int_IDO04A01;
        $this->int_IDO04A02 = $int_IDO04A02;
        $this->int_IDO04A03 = $int_IDO04A03;
        $this->int_IDO04A04 = $int_IDO04A04;
        $this->int_IDO04A05 = $int_IDO04A05;
        $this->int_IDO04A06 = $int_IDO04A06;
        $this->int_IDO04A07 = $int_IDO04A07;
        $this->int_IDO04A08 = $int_IDO04A08;
        $this->int_IDO04B01 = $int_IDO04B01;
        $this->int_IDO04B02 = $int_IDO04B02;
        $this->int_IDO04B03 = $int_IDO04B03;
        $this->int_IDO05A01 = $int_IDO05A01;
        $this->int_IDO05A02 = $int_IDO05A02;
        $this->int_IDO05A03 = $int_IDO05A03;
        $this->int_IDO05A04 = $int_IDO05A04;
        $this->int_IDO05B01 = $int_IDO05B01;
        $this->int_IDO05B02 = $int_IDO05B02;
        $this->int_IDO05B03 = $int_IDO05B03;
        $this->int_IDO05B04 = $int_IDO05B04;
        $this->int_IDO0601  = $int_IDO0601;
        $this->int_IDO0602  = $int_IDO0602;
        $this->int_IDO0603  = $int_IDO0603;
        $this->int_IDO0604  = $int_IDO0604;
        $this->int_jumlah = $int_jumlah;

        $this->no_int_IDO04A01 = $no_int_IDO04A01;
        $this->no_int_IDO04A02 = $no_int_IDO04A02;
        $this->no_int_IDO04A03 = $no_int_IDO04A03;
        $this->no_int_IDO04A04 = $no_int_IDO04A04;
        $this->no_int_IDO04A05 = $no_int_IDO04A05;
        $this->no_int_IDO04A06 = $no_int_IDO04A06;
        $this->no_int_IDO04A07 = $no_int_IDO04A07;
        $this->no_int_IDO04A08 = $no_int_IDO04A08;
        $this->no_int_IDO04B01 = $no_int_IDO04B01;
        $this->no_int_IDO04B02 = $no_int_IDO04B02;
        $this->no_int_IDO04B03 = $no_int_IDO04B03;
        $this->no_int_IDO05A01 = $no_int_IDO05A01;
        $this->no_int_IDO05A02 = $no_int_IDO05A02;
        $this->no_int_IDO05A03 = $no_int_IDO05A03;
        $this->no_int_IDO05A04 = $no_int_IDO05A04;
        $this->no_int_IDO05B01 = $no_int_IDO05B01;
        $this->no_int_IDO05B02 = $no_int_IDO05B02;
        $this->no_int_IDO05B03 = $no_int_IDO05B03;
        $this->no_int_IDO05B04 = $no_int_IDO05B04;
        $this->no_int_IDO0601  = $no_int_IDO0601;
        $this->no_int_IDO0602  = $no_int_IDO0602;
        $this->no_int_IDO0603  = $no_int_IDO0603;
        $this->no_int_IDO0604  = $no_int_IDO0604;
        $this->no_int_jumlah = $no_int_jumlah;

        $this->denominator_int = $denominator_int;

        $this->ok_IDO04A01 = $ok_IDO04A01;
        $this->ok_IDO04A02 = $ok_IDO04A02;
        $this->ok_IDO04A03 = $ok_IDO04A03;
        $this->ok_IDO04A04 = $ok_IDO04A04;
        $this->ok_IDO04A05 = $ok_IDO04A05;
        $this->ok_IDO04A06 = $ok_IDO04A06;
        $this->ok_IDO04A07 = $ok_IDO04A07;
        $this->ok_IDO04A08 = $ok_IDO04A08;
        $this->ok_IDO04B01 = $ok_IDO04B01;
        $this->ok_IDO04B02 = $ok_IDO04B02;
        $this->ok_IDO04B03 = $ok_IDO04B03;
        $this->ok_IDO05A01 = $ok_IDO05A01;
        $this->ok_IDO05A02 = $ok_IDO05A02;
        $this->ok_IDO05A03 = $ok_IDO05A03;
        $this->ok_IDO05A04 = $ok_IDO05A04;
        $this->ok_IDO05B01 = $ok_IDO05B01;
        $this->ok_IDO05B02 = $ok_IDO05B02;
        $this->ok_IDO05B03 = $ok_IDO05B03;
        $this->ok_IDO05B04 = $ok_IDO05B04;
        $this->ok_IDO0601  = $ok_IDO0601;
        $this->ok_IDO0602  = $ok_IDO0602;
        $this->ok_IDO0603  = $ok_IDO0603;
        $this->ok_IDO0604  = $ok_IDO0604;
        $this->ok_jumlah = $ok_jumlah;

        $this->no_ok_IDO04A01 = $no_ok_IDO04A01;
        $this->no_ok_IDO04A02 = $no_ok_IDO04A02;
        $this->no_ok_IDO04A03 = $no_ok_IDO04A03;
        $this->no_ok_IDO04A04 = $no_ok_IDO04A04;
        $this->no_ok_IDO04A05 = $no_ok_IDO04A05;
        $this->no_ok_IDO04A06 = $no_ok_IDO04A06;
        $this->no_ok_IDO04A07 = $no_ok_IDO04A07;
        $this->no_ok_IDO04A08 = $no_ok_IDO04A08;
        $this->no_ok_IDO04B01 = $no_ok_IDO04B01;
        $this->no_ok_IDO04B02 = $no_ok_IDO04B02;
        $this->no_ok_IDO04B03 = $no_ok_IDO04B03;
        $this->no_ok_IDO05A01 = $no_ok_IDO05A01;
        $this->no_ok_IDO05A02 = $no_ok_IDO05A02;
        $this->no_ok_IDO05A03 = $no_ok_IDO05A03;
        $this->no_ok_IDO05A04 = $no_ok_IDO05A04;
        $this->no_ok_IDO05B01 = $no_ok_IDO05B01;
        $this->no_ok_IDO05B02 = $no_ok_IDO05B02;
        $this->no_ok_IDO05B03 = $no_ok_IDO05B03;
        $this->no_ok_IDO05B04 = $no_ok_IDO05B04;
        $this->no_ok_IDO0601  = $no_ok_IDO0601;
        $this->no_ok_IDO0602  = $no_ok_IDO0602;
        $this->no_ok_IDO0603  = $no_ok_IDO0603;
        $this->no_ok_IDO0604  = $no_ok_IDO0604;
        $this->no_ok_jumlah = $no_ok_jumlah;

        $this->denominator_ok = $denominator_ok;

        $this->lt2_IDO04A01 = $lt2_IDO04A01;
        $this->lt2_IDO04A02 = $lt2_IDO04A02;
        $this->lt2_IDO04A03 = $lt2_IDO04A03;
        $this->lt2_IDO04A04 = $lt2_IDO04A04;
        $this->lt2_IDO04A05 = $lt2_IDO04A05;
        $this->lt2_IDO04A06 = $lt2_IDO04A06;
        $this->lt2_IDO04A07 = $lt2_IDO04A07;
        $this->lt2_IDO04A08 = $lt2_IDO04A08;
        $this->lt2_IDO04B01 = $lt2_IDO04B01;
        $this->lt2_IDO04B02 = $lt2_IDO04B02;
        $this->lt2_IDO04B03 = $lt2_IDO04B03;
        $this->lt2_IDO05A01 = $lt2_IDO05A01;
        $this->lt2_IDO05A02 = $lt2_IDO05A02;
        $this->lt2_IDO05A03 = $lt2_IDO05A03;
        $this->lt2_IDO05A04 = $lt2_IDO05A04;
        $this->lt2_IDO05B01 = $lt2_IDO05B01;
        $this->lt2_IDO05B02 = $lt2_IDO05B02;
        $this->lt2_IDO05B03 = $lt2_IDO05B03;
        $this->lt2_IDO05B04 = $lt2_IDO05B04;
        $this->lt2_IDO0601  = $lt2_IDO0601;
        $this->lt2_IDO0602  = $lt2_IDO0602;
        $this->lt2_IDO0603  = $lt2_IDO0603;
        $this->lt2_IDO0604  = $lt2_IDO0604;
        $this->lt2_jumlah = $lt2_jumlah;

        $this->no_lt2_IDO04A01 = $no_lt2_IDO04A01;
        $this->no_lt2_IDO04A02 = $no_lt2_IDO04A02;
        $this->no_lt2_IDO04A03 = $no_lt2_IDO04A03;
        $this->no_lt2_IDO04A04 = $no_lt2_IDO04A04;
        $this->no_lt2_IDO04A05 = $no_lt2_IDO04A05;
        $this->no_lt2_IDO04A06 = $no_lt2_IDO04A06;
        $this->no_lt2_IDO04A07 = $no_lt2_IDO04A07;
        $this->no_lt2_IDO04A08 = $no_lt2_IDO04A08;
        $this->no_lt2_IDO04B01 = $no_lt2_IDO04B01;
        $this->no_lt2_IDO04B02 = $no_lt2_IDO04B02;
        $this->no_lt2_IDO04B03 = $no_lt2_IDO04B03;
        $this->no_lt2_IDO05A01 = $no_lt2_IDO05A01;
        $this->no_lt2_IDO05A02 = $no_lt2_IDO05A02;
        $this->no_lt2_IDO05A03 = $no_lt2_IDO05A03;
        $this->no_lt2_IDO05A04 = $no_lt2_IDO05A04;
        $this->no_lt2_IDO05B01 = $no_lt2_IDO05B01;
        $this->no_lt2_IDO05B02 = $no_lt2_IDO05B02;
        $this->no_lt2_IDO05B03 = $no_lt2_IDO05B03;
        $this->no_lt2_IDO05B04 = $no_lt2_IDO05B04;
        $this->no_lt2_IDO0601  = $no_lt2_IDO0601;
        $this->no_lt2_IDO0602  = $no_lt2_IDO0602;
        $this->no_lt2_IDO0603  = $no_lt2_IDO0603;
        $this->no_lt2_IDO0604  = $no_lt2_IDO0604;
        $this->no_lt2_jumlah = $no_lt2_jumlah;

        $this->denominator_lt2 = $denominator_lt2;

        $this->lt4_IDO04A01 = $lt4_IDO04A01;
        $this->lt4_IDO04A02 = $lt4_IDO04A02;
        $this->lt4_IDO04A03 = $lt4_IDO04A03;
        $this->lt4_IDO04A04 = $lt4_IDO04A04;
        $this->lt4_IDO04A05 = $lt4_IDO04A05;
        $this->lt4_IDO04A06 = $lt4_IDO04A06;
        $this->lt4_IDO04A07 = $lt4_IDO04A07;
        $this->lt4_IDO04A08 = $lt4_IDO04A08;
        $this->lt4_IDO04B01 = $lt4_IDO04B01;
        $this->lt4_IDO04B02 = $lt4_IDO04B02;
        $this->lt4_IDO04B03 = $lt4_IDO04B03;
        $this->lt4_IDO05A01 = $lt4_IDO05A01;
        $this->lt4_IDO05A02 = $lt4_IDO05A02;
        $this->lt4_IDO05A03 = $lt4_IDO05A03;
        $this->lt4_IDO05A04 = $lt4_IDO05A04;
        $this->lt4_IDO05B01 = $lt4_IDO05B01;
        $this->lt4_IDO05B02 = $lt4_IDO05B02;
        $this->lt4_IDO05B03 = $lt4_IDO05B03;
        $this->lt4_IDO05B04 = $lt4_IDO05B04;
        $this->lt4_IDO0601  = $lt4_IDO0601;
        $this->lt4_IDO0602  = $lt4_IDO0602;
        $this->lt4_IDO0603  = $lt4_IDO0603;
        $this->lt4_IDO0604  = $lt4_IDO0604;
        $this->lt4_jumlah = $lt4_jumlah;

        $this->no_lt4_IDO04A01 = $no_lt4_IDO04A01;
        $this->no_lt4_IDO04A02 = $no_lt4_IDO04A02;
        $this->no_lt4_IDO04A03 = $no_lt4_IDO04A03;
        $this->no_lt4_IDO04A04 = $no_lt4_IDO04A04;
        $this->no_lt4_IDO04A05 = $no_lt4_IDO04A05;
        $this->no_lt4_IDO04A06 = $no_lt4_IDO04A06;
        $this->no_lt4_IDO04A07 = $no_lt4_IDO04A07;
        $this->no_lt4_IDO04A08 = $no_lt4_IDO04A08;
        $this->no_lt4_IDO04B01 = $no_lt4_IDO04B01;
        $this->no_lt4_IDO04B02 = $no_lt4_IDO04B02;
        $this->no_lt4_IDO04B03 = $no_lt4_IDO04B03;
        $this->no_lt4_IDO05A01 = $no_lt4_IDO05A01;
        $this->no_lt4_IDO05A02 = $no_lt4_IDO05A02;
        $this->no_lt4_IDO05A03 = $no_lt4_IDO05A03;
        $this->no_lt4_IDO05A04 = $no_lt4_IDO05A04;
        $this->no_lt4_IDO05B01 = $no_lt4_IDO05B01;
        $this->no_lt4_IDO05B02 = $no_lt4_IDO05B02;
        $this->no_lt4_IDO05B03 = $no_lt4_IDO05B03;
        $this->no_lt4_IDO05B04 = $no_lt4_IDO05B04;
        $this->no_lt4_IDO0601  = $no_lt4_IDO0601;
        $this->no_lt4_IDO0602  = $no_lt4_IDO0602;
        $this->no_lt4_IDO0603  = $no_lt4_IDO0603;
        $this->no_lt4_IDO0604  = $no_lt4_IDO0604;
        $this->no_lt4_jumlah = $no_lt4_jumlah;

        $this->denominator_lt4 = $denominator_lt4;

        $this->lt5_IDO04A01 = $lt5_IDO04A01;
        $this->lt5_IDO04A02 = $lt5_IDO04A02;
        $this->lt5_IDO04A03 = $lt5_IDO04A03;
        $this->lt5_IDO04A04 = $lt5_IDO04A04;
        $this->lt5_IDO04A05 = $lt5_IDO04A05;
        $this->lt5_IDO04A06 = $lt5_IDO04A06;
        $this->lt5_IDO04A07 = $lt5_IDO04A07;
        $this->lt5_IDO04A08 = $lt5_IDO04A08;
        $this->lt5_IDO04B01 = $lt5_IDO04B01;
        $this->lt5_IDO04B02 = $lt5_IDO04B02;
        $this->lt5_IDO04B03 = $lt5_IDO04B03;
        $this->lt5_IDO05A01 = $lt5_IDO05A01;
        $this->lt5_IDO05A02 = $lt5_IDO05A02;
        $this->lt5_IDO05A03 = $lt5_IDO05A03;
        $this->lt5_IDO05A04 = $lt5_IDO05A04;
        $this->lt5_IDO05B01 = $lt5_IDO05B01;
        $this->lt5_IDO05B02 = $lt5_IDO05B02;
        $this->lt5_IDO05B03 = $lt5_IDO05B03;
        $this->lt5_IDO05B04 = $lt5_IDO05B04;
        $this->lt5_IDO0601  = $lt5_IDO0601;
        $this->lt5_IDO0602  = $lt5_IDO0602;
        $this->lt5_IDO0603  = $lt5_IDO0603;
        $this->lt5_IDO0604  = $lt5_IDO0604;
        $this->lt5_jumlah = $lt5_jumlah;

        $this->no_lt5_IDO04A01 = $no_lt5_IDO04A01;
        $this->no_lt5_IDO04A02 = $no_lt5_IDO04A02;
        $this->no_lt5_IDO04A03 = $no_lt5_IDO04A03;
        $this->no_lt5_IDO04A04 = $no_lt5_IDO04A04;
        $this->no_lt5_IDO04A05 = $no_lt5_IDO04A05;
        $this->no_lt5_IDO04A06 = $no_lt5_IDO04A06;
        $this->no_lt5_IDO04A07 = $no_lt5_IDO04A07;
        $this->no_lt5_IDO04A08 = $no_lt5_IDO04A08;
        $this->no_lt5_IDO04B01 = $no_lt5_IDO04B01;
        $this->no_lt5_IDO04B02 = $no_lt5_IDO04B02;
        $this->no_lt5_IDO04B03 = $no_lt5_IDO04B03;
        $this->no_lt5_IDO05A01 = $no_lt5_IDO05A01;
        $this->no_lt5_IDO05A02 = $no_lt5_IDO05A02;
        $this->no_lt5_IDO05A03 = $no_lt5_IDO05A03;
        $this->no_lt5_IDO05A04 = $no_lt5_IDO05A04;
        $this->no_lt5_IDO05B01 = $no_lt5_IDO05B01;
        $this->no_lt5_IDO05B02 = $no_lt5_IDO05B02;
        $this->no_lt5_IDO05B03 = $no_lt5_IDO05B03;
        $this->no_lt5_IDO05B04 = $no_lt5_IDO05B04;
        $this->no_lt5_IDO0601  = $no_lt5_IDO0601;
        $this->no_lt5_IDO0602  = $no_lt5_IDO0602;
        $this->no_lt5_IDO0603  = $no_lt5_IDO0603;
        $this->no_lt5_IDO0604  = $no_lt5_IDO0604;
        $this->no_lt5_jumlah = $no_lt5_jumlah;

        $this->denominator_lt5 = $denominator_lt5;

        $this->vk_IDO04A01 = $vk_IDO04A01;
        $this->vk_IDO04A02 = $vk_IDO04A02;
        $this->vk_IDO04A03 = $vk_IDO04A03;
        $this->vk_IDO04A04 = $vk_IDO04A04;
        $this->vk_IDO04A05 = $vk_IDO04A05;
        $this->vk_IDO04A06 = $vk_IDO04A06;
        $this->vk_IDO04A07 = $vk_IDO04A07;
        $this->vk_IDO04A08 = $vk_IDO04A08;
        $this->vk_IDO04B01 = $vk_IDO04B01;
        $this->vk_IDO04B02 = $vk_IDO04B02;
        $this->vk_IDO04B03 = $vk_IDO04B03;
        $this->vk_IDO05A01 = $vk_IDO05A01;
        $this->vk_IDO05A02 = $vk_IDO05A02;
        $this->vk_IDO05A03 = $vk_IDO05A03;
        $this->vk_IDO05A04 = $vk_IDO05A04;
        $this->vk_IDO05B01 = $vk_IDO05B01;
        $this->vk_IDO05B02 = $vk_IDO05B02;
        $this->vk_IDO05B03 = $vk_IDO05B03;
        $this->vk_IDO05B04 = $vk_IDO05B04;
        $this->vk_IDO0601  = $vk_IDO0601;
        $this->vk_IDO0602  = $vk_IDO0602;
        $this->vk_IDO0603  = $vk_IDO0603;
        $this->vk_IDO0604  = $vk_IDO0604;
        $this->vk_jumlah = $vk_jumlah;

        $this->no_vk_IDO04A01 = $no_vk_IDO04A01;
        $this->no_vk_IDO04A02 = $no_vk_IDO04A02;
        $this->no_vk_IDO04A03 = $no_vk_IDO04A03;
        $this->no_vk_IDO04A04 = $no_vk_IDO04A04;
        $this->no_vk_IDO04A05 = $no_vk_IDO04A05;
        $this->no_vk_IDO04A06 = $no_vk_IDO04A06;
        $this->no_vk_IDO04A07 = $no_vk_IDO04A07;
        $this->no_vk_IDO04A08 = $no_vk_IDO04A08;
        $this->no_vk_IDO04B01 = $no_vk_IDO04B01;
        $this->no_vk_IDO04B02 = $no_vk_IDO04B02;
        $this->no_vk_IDO04B03 = $no_vk_IDO04B03;
        $this->no_vk_IDO05A01 = $no_vk_IDO05A01;
        $this->no_vk_IDO05A02 = $no_vk_IDO05A02;
        $this->no_vk_IDO05A03 = $no_vk_IDO05A03;
        $this->no_vk_IDO05A04 = $no_vk_IDO05A04;
        $this->no_vk_IDO05B01 = $no_vk_IDO05B01;
        $this->no_vk_IDO05B02 = $no_vk_IDO05B02;
        $this->no_vk_IDO05B03 = $no_vk_IDO05B03;
        $this->no_vk_IDO05B04 = $no_vk_IDO05B04;
        $this->no_vk_IDO0601  = $no_vk_IDO0601;
        $this->no_vk_IDO0602  = $no_vk_IDO0602;
        $this->no_vk_IDO0603  = $no_vk_IDO0603;
        $this->no_vk_IDO0604  = $no_vk_IDO0604;
        $this->no_vk_jumlah = $no_vk_jumlah;

        $this->denominator_vk = $denominator_vk;

        $this->tabel = $tabel;
        $this->rekap = $rekap;
        $this->tanggal = $tanggal;
    }

    public function view(): View
    {
        return view('rekapBundleIDO.excel', [
            'tabel' => $this->tabel,
            'rekap' => $this->rekap,
            'tanggal' => $this->tanggal,

            'igd_IDO04A01' => $this->igd_IDO04A01,
            'igd_IDO04A02' => $this->igd_IDO04A02,
            'igd_IDO04A03' => $this->igd_IDO04A03,
            'igd_IDO04A04' => $this->igd_IDO04A04,
            'igd_IDO04A05' => $this->igd_IDO04A05,
            'igd_IDO04A06' => $this->igd_IDO04A06,
            'igd_IDO04A07' => $this->igd_IDO04A07,
            'igd_IDO04A08' => $this->igd_IDO04A08,
            'igd_IDO04B01' => $this->igd_IDO04B01,
            'igd_IDO04B02' => $this->igd_IDO04B02,
            'igd_IDO04B03' => $this->igd_IDO04B03,
            'igd_IDO05A01' => $this->igd_IDO05A01,
            'igd_IDO05A02' => $this->igd_IDO05A02,
            'igd_IDO05A03' => $this->igd_IDO05A03,
            'igd_IDO05A04' => $this->igd_IDO05A04,
            'igd_IDO05B01' => $this->igd_IDO05B01,
            'igd_IDO05B02' => $this->igd_IDO05B02,
            'igd_IDO05B03' => $this->igd_IDO05B03,
            'igd_IDO05B04' => $this->igd_IDO05B04,
            'igd_IDO0601' => $this->igd_IDO0601,
            'igd_IDO0602' => $this->igd_IDO0602,
            'igd_IDO0603' => $this->igd_IDO0603,
            'igd_IDO0604' => $this->igd_IDO0604,
            'igd_jumlah' => $this->igd_jumlah,

            'no_igd_IDO04A01' => $this->no_igd_IDO04A01,
            'no_igd_IDO04A02' => $this->no_igd_IDO04A02,
            'no_igd_IDO04A03' => $this->no_igd_IDO04A03,
            'no_igd_IDO04A04' => $this->no_igd_IDO04A04,
            'no_igd_IDO04A05' => $this->no_igd_IDO04A05,
            'no_igd_IDO04A06' => $this->no_igd_IDO04A06,
            'no_igd_IDO04A07' => $this->no_igd_IDO04A07,
            'no_igd_IDO04A08' => $this->no_igd_IDO04A08,
            'no_igd_IDO04B01' => $this->no_igd_IDO04B01,
            'no_igd_IDO04B02' => $this->no_igd_IDO04B02,
            'no_igd_IDO04B03' => $this->no_igd_IDO04B03,
            'no_igd_IDO05A01' => $this->no_igd_IDO05A01,
            'no_igd_IDO05A02' => $this->no_igd_IDO05A02,
            'no_igd_IDO05A03' => $this->no_igd_IDO05A03,
            'no_igd_IDO05A04' => $this->no_igd_IDO05A04,
            'no_igd_IDO05B01' => $this->no_igd_IDO05B01,
            'no_igd_IDO05B02' => $this->no_igd_IDO05B02,
            'no_igd_IDO05B03' => $this->no_igd_IDO05B03,
            'no_igd_IDO05B04' => $this->no_igd_IDO05B04,
            'no_igd_IDO0601' => $this->no_igd_IDO0601,
            'no_igd_IDO0602' => $this->no_igd_IDO0602,
            'no_igd_IDO0603' => $this->no_igd_IDO0603,
            'no_igd_IDO0604' => $this->no_igd_IDO0604,
            'no_igd_jumlah' => $this->no_igd_jumlah,

            'denominator_igd' => $this->denominator_igd,

            'int_IDO04A01' => $this->int_IDO04A01,
            'int_IDO04A02' => $this->int_IDO04A02,
            'int_IDO04A03' => $this->int_IDO04A03,
            'int_IDO04A04' => $this->int_IDO04A04,
            'int_IDO04A05' => $this->int_IDO04A05,
            'int_IDO04A06' => $this->int_IDO04A06,
            'int_IDO04A07' => $this->int_IDO04A07,
            'int_IDO04A08' => $this->int_IDO04A08,
            'int_IDO04B01' => $this->int_IDO04B01,
            'int_IDO04B02' => $this->int_IDO04B02,
            'int_IDO04B03' => $this->int_IDO04B03,
            'int_IDO05A01' => $this->int_IDO05A01,
            'int_IDO05A02' => $this->int_IDO05A02,
            'int_IDO05A03' => $this->int_IDO05A03,
            'int_IDO05A04' => $this->int_IDO05A04,
            'int_IDO05B01' => $this->int_IDO05B01,
            'int_IDO05B02' => $this->int_IDO05B02,
            'int_IDO05B03' => $this->int_IDO05B03,
            'int_IDO05B04' => $this->int_IDO05B04,
            'int_IDO0601' => $this->int_IDO0601,
            'int_IDO0602' => $this->int_IDO0602,
            'int_IDO0603' => $this->int_IDO0603,
            'int_IDO0604' => $this->int_IDO0604,
            'int_jumlah' => $this->int_jumlah,

            'no_int_IDO04A01' => $this->no_int_IDO04A01,
            'no_int_IDO04A02' => $this->no_int_IDO04A02,
            'no_int_IDO04A03' => $this->no_int_IDO04A03,
            'no_int_IDO04A04' => $this->no_int_IDO04A04,
            'no_int_IDO04A05' => $this->no_int_IDO04A05,
            'no_int_IDO04A06' => $this->no_int_IDO04A06,
            'no_int_IDO04A07' => $this->no_int_IDO04A07,
            'no_int_IDO04A08' => $this->no_int_IDO04A08,
            'no_int_IDO04B01' => $this->no_int_IDO04B01,
            'no_int_IDO04B02' => $this->no_int_IDO04B02,
            'no_int_IDO04B03' => $this->no_int_IDO04B03,
            'no_int_IDO05A01' => $this->no_int_IDO05A01,
            'no_int_IDO05A02' => $this->no_int_IDO05A02,
            'no_int_IDO05A03' => $this->no_int_IDO05A03,
            'no_int_IDO05A04' => $this->no_int_IDO05A04,
            'no_int_IDO05B01' => $this->no_int_IDO05B01,
            'no_int_IDO05B02' => $this->no_int_IDO05B02,
            'no_int_IDO05B03' => $this->no_int_IDO05B03,
            'no_int_IDO05B04' => $this->no_int_IDO05B04,
            'no_int_IDO0601' => $this->no_int_IDO0601,
            'no_int_IDO0602' => $this->no_int_IDO0602,
            'no_int_IDO0603' => $this->no_int_IDO0603,
            'no_int_IDO0604' => $this->no_int_IDO0604,
            'no_int_jumlah' => $this->no_int_jumlah,

            'denominator_int' => $this->denominator_int,

            'ok_IDO04A01' => $this->ok_IDO04A01,
            'ok_IDO04A02' => $this->ok_IDO04A02,
            'ok_IDO04A03' => $this->ok_IDO04A03,
            'ok_IDO04A04' => $this->ok_IDO04A04,
            'ok_IDO04A05' => $this->ok_IDO04A05,
            'ok_IDO04A06' => $this->ok_IDO04A06,
            'ok_IDO04A07' => $this->ok_IDO04A07,
            'ok_IDO04A08' => $this->ok_IDO04A08,
            'ok_IDO04B01' => $this->ok_IDO04B01,
            'ok_IDO04B02' => $this->ok_IDO04B02,
            'ok_IDO04B03' => $this->ok_IDO04B03,
            'ok_IDO05A01' => $this->ok_IDO05A01,
            'ok_IDO05A02' => $this->ok_IDO05A02,
            'ok_IDO05A03' => $this->ok_IDO05A03,
            'ok_IDO05A04' => $this->ok_IDO05A04,
            'ok_IDO05B01' => $this->ok_IDO05B01,
            'ok_IDO05B02' => $this->ok_IDO05B02,
            'ok_IDO05B03' => $this->ok_IDO05B03,
            'ok_IDO05B04' => $this->ok_IDO05B04,
            'ok_IDO0601' => $this->ok_IDO0601,
            'ok_IDO0602' => $this->ok_IDO0602,
            'ok_IDO0603' => $this->ok_IDO0603,
            'ok_IDO0604' => $this->ok_IDO0604,
            'ok_jumlah' => $this->ok_jumlah,

            'no_ok_IDO04A01' => $this->no_ok_IDO04A01,
            'no_ok_IDO04A02' => $this->no_ok_IDO04A02,
            'no_ok_IDO04A03' => $this->no_ok_IDO04A03,
            'no_ok_IDO04A04' => $this->no_ok_IDO04A04,
            'no_ok_IDO04A05' => $this->no_ok_IDO04A05,
            'no_ok_IDO04A06' => $this->no_ok_IDO04A06,
            'no_ok_IDO04A07' => $this->no_ok_IDO04A07,
            'no_ok_IDO04A08' => $this->no_ok_IDO04A08,
            'no_ok_IDO04B01' => $this->no_ok_IDO04B01,
            'no_ok_IDO04B02' => $this->no_ok_IDO04B02,
            'no_ok_IDO04B03' => $this->no_ok_IDO04B03,
            'no_ok_IDO05A01' => $this->no_ok_IDO05A01,
            'no_ok_IDO05A02' => $this->no_ok_IDO05A02,
            'no_ok_IDO05A03' => $this->no_ok_IDO05A03,
            'no_ok_IDO05A04' => $this->no_ok_IDO05A04,
            'no_ok_IDO05B01' => $this->no_ok_IDO05B01,
            'no_ok_IDO05B02' => $this->no_ok_IDO05B02,
            'no_ok_IDO05B03' => $this->no_ok_IDO05B03,
            'no_ok_IDO05B04' => $this->no_ok_IDO05B04,
            'no_ok_IDO0601' => $this->no_ok_IDO0601,
            'no_ok_IDO0602' => $this->no_ok_IDO0602,
            'no_ok_IDO0603' => $this->no_ok_IDO0603,
            'no_ok_IDO0604' => $this->no_ok_IDO0604,
            'no_ok_jumlah' => $this->no_ok_jumlah,

            'denominator_ok' => $this->denominator_ok,

            'lt2_IDO04A01' => $this->lt2_IDO04A01,
            'lt2_IDO04A02' => $this->lt2_IDO04A02,
            'lt2_IDO04A03' => $this->lt2_IDO04A03,
            'lt2_IDO04A04' => $this->lt2_IDO04A04,
            'lt2_IDO04A05' => $this->lt2_IDO04A05,
            'lt2_IDO04A06' => $this->lt2_IDO04A06,
            'lt2_IDO04A07' => $this->lt2_IDO04A07,
            'lt2_IDO04A08' => $this->lt2_IDO04A08,
            'lt2_IDO04B01' => $this->lt2_IDO04B01,
            'lt2_IDO04B02' => $this->lt2_IDO04B02,
            'lt2_IDO04B03' => $this->lt2_IDO04B03,
            'lt2_IDO05A01' => $this->lt2_IDO05A01,
            'lt2_IDO05A02' => $this->lt2_IDO05A02,
            'lt2_IDO05A03' => $this->lt2_IDO05A03,
            'lt2_IDO05A04' => $this->lt2_IDO05A04,
            'lt2_IDO05B01' => $this->lt2_IDO05B01,
            'lt2_IDO05B02' => $this->lt2_IDO05B02,
            'lt2_IDO05B03' => $this->lt2_IDO05B03,
            'lt2_IDO05B04' => $this->lt2_IDO05B04,
            'lt2_IDO0601' => $this->lt2_IDO0601,
            'lt2_IDO0602' => $this->lt2_IDO0602,
            'lt2_IDO0603' => $this->lt2_IDO0603,
            'lt2_IDO0604' => $this->lt2_IDO0604,
            'lt2_jumlah' => $this->lt2_jumlah,

            'no_lt2_IDO04A01' => $this->no_lt2_IDO04A01,
            'no_lt2_IDO04A02' => $this->no_lt2_IDO04A02,
            'no_lt2_IDO04A03' => $this->no_lt2_IDO04A03,
            'no_lt2_IDO04A04' => $this->no_lt2_IDO04A04,
            'no_lt2_IDO04A05' => $this->no_lt2_IDO04A05,
            'no_lt2_IDO04A06' => $this->no_lt2_IDO04A06,
            'no_lt2_IDO04A07' => $this->no_lt2_IDO04A07,
            'no_lt2_IDO04A08' => $this->no_lt2_IDO04A08,
            'no_lt2_IDO04B01' => $this->no_lt2_IDO04B01,
            'no_lt2_IDO04B02' => $this->no_lt2_IDO04B02,
            'no_lt2_IDO04B03' => $this->no_lt2_IDO04B03,
            'no_lt2_IDO05A01' => $this->no_lt2_IDO05A01,
            'no_lt2_IDO05A02' => $this->no_lt2_IDO05A02,
            'no_lt2_IDO05A03' => $this->no_lt2_IDO05A03,
            'no_lt2_IDO05A04' => $this->no_lt2_IDO05A04,
            'no_lt2_IDO05B01' => $this->no_lt2_IDO05B01,
            'no_lt2_IDO05B02' => $this->no_lt2_IDO05B02,
            'no_lt2_IDO05B03' => $this->no_lt2_IDO05B03,
            'no_lt2_IDO05B04' => $this->no_lt2_IDO05B04,
            'no_lt2_IDO0601' => $this->no_lt2_IDO0601,
            'no_lt2_IDO0602' => $this->no_lt2_IDO0602,
            'no_lt2_IDO0603' => $this->no_lt2_IDO0603,
            'no_lt2_IDO0604' => $this->no_lt2_IDO0604,
            'no_lt2_jumlah' => $this->no_lt2_jumlah,

            'denominator_lt2' => $this->denominator_lt2,

            'lt4_IDO04A01' => $this->lt4_IDO04A01,
            'lt4_IDO04A02' => $this->lt4_IDO04A02,
            'lt4_IDO04A03' => $this->lt4_IDO04A03,
            'lt4_IDO04A04' => $this->lt4_IDO04A04,
            'lt4_IDO04A05' => $this->lt4_IDO04A05,
            'lt4_IDO04A06' => $this->lt4_IDO04A06,
            'lt4_IDO04A07' => $this->lt4_IDO04A07,
            'lt4_IDO04A08' => $this->lt4_IDO04A08,
            'lt4_IDO04B01' => $this->lt4_IDO04B01,
            'lt4_IDO04B02' => $this->lt4_IDO04B02,
            'lt4_IDO04B03' => $this->lt4_IDO04B03,
            'lt4_IDO05A01' => $this->lt4_IDO05A01,
            'lt4_IDO05A02' => $this->lt4_IDO05A02,
            'lt4_IDO05A03' => $this->lt4_IDO05A03,
            'lt4_IDO05A04' => $this->lt4_IDO05A04,
            'lt4_IDO05B01' => $this->lt4_IDO05B01,
            'lt4_IDO05B02' => $this->lt4_IDO05B02,
            'lt4_IDO05B03' => $this->lt4_IDO05B03,
            'lt4_IDO05B04' => $this->lt4_IDO05B04,
            'lt4_IDO0601' => $this->lt4_IDO0601,
            'lt4_IDO0602' => $this->lt4_IDO0602,
            'lt4_IDO0603' => $this->lt4_IDO0603,
            'lt4_IDO0604' => $this->lt4_IDO0604,
            'lt4_jumlah' => $this->lt4_jumlah,

            'no_lt4_IDO04A01' => $this->no_lt4_IDO04A01,
            'no_lt4_IDO04A02' => $this->no_lt4_IDO04A02,
            'no_lt4_IDO04A03' => $this->no_lt4_IDO04A03,
            'no_lt4_IDO04A04' => $this->no_lt4_IDO04A04,
            'no_lt4_IDO04A05' => $this->no_lt4_IDO04A05,
            'no_lt4_IDO04A06' => $this->no_lt4_IDO04A06,
            'no_lt4_IDO04A07' => $this->no_lt4_IDO04A07,
            'no_lt4_IDO04A08' => $this->no_lt4_IDO04A08,
            'no_lt4_IDO04B01' => $this->no_lt4_IDO04B01,
            'no_lt4_IDO04B02' => $this->no_lt4_IDO04B02,
            'no_lt4_IDO04B03' => $this->no_lt4_IDO04B03,
            'no_lt4_IDO05A01' => $this->no_lt4_IDO05A01,
            'no_lt4_IDO05A02' => $this->no_lt4_IDO05A02,
            'no_lt4_IDO05A03' => $this->no_lt4_IDO05A03,
            'no_lt4_IDO05A04' => $this->no_lt4_IDO05A04,
            'no_lt4_IDO05B01' => $this->no_lt4_IDO05B01,
            'no_lt4_IDO05B02' => $this->no_lt4_IDO05B02,
            'no_lt4_IDO05B03' => $this->no_lt4_IDO05B03,
            'no_lt4_IDO05B04' => $this->no_lt4_IDO05B04,
            'no_lt4_IDO0601' => $this->no_lt4_IDO0601,
            'no_lt4_IDO0602' => $this->no_lt4_IDO0602,
            'no_lt4_IDO0603' => $this->no_lt4_IDO0603,
            'no_lt4_IDO0604' => $this->no_lt4_IDO0604,
            'no_lt4_jumlah' => $this->no_lt4_jumlah,

            'denominator_lt4' => $this->denominator_lt4,

            'lt5_IDO04A01' => $this->lt5_IDO04A01,
            'lt5_IDO04A02' => $this->lt5_IDO04A02,
            'lt5_IDO04A03' => $this->lt5_IDO04A03,
            'lt5_IDO04A04' => $this->lt5_IDO04A04,
            'lt5_IDO04A05' => $this->lt5_IDO04A05,
            'lt5_IDO04A06' => $this->lt5_IDO04A06,
            'lt5_IDO04A07' => $this->lt5_IDO04A07,
            'lt5_IDO04A08' => $this->lt5_IDO04A08,
            'lt5_IDO04B01' => $this->lt5_IDO04B01,
            'lt5_IDO04B02' => $this->lt5_IDO04B02,
            'lt5_IDO04B03' => $this->lt5_IDO04B03,
            'lt5_IDO05A01' => $this->lt5_IDO05A01,
            'lt5_IDO05A02' => $this->lt5_IDO05A02,
            'lt5_IDO05A03' => $this->lt5_IDO05A03,
            'lt5_IDO05A04' => $this->lt5_IDO05A04,
            'lt5_IDO05B01' => $this->lt5_IDO05B01,
            'lt5_IDO05B02' => $this->lt5_IDO05B02,
            'lt5_IDO05B03' => $this->lt5_IDO05B03,
            'lt5_IDO05B04' => $this->lt5_IDO05B04,
            'lt5_IDO0601' => $this->lt5_IDO0601,
            'lt5_IDO0602' => $this->lt5_IDO0602,
            'lt5_IDO0603' => $this->lt5_IDO0603,
            'lt5_IDO0604' => $this->lt5_IDO0604,
            'lt5_jumlah' => $this->lt5_jumlah,

            'no_lt5_IDO04A01' => $this->no_lt5_IDO04A01,
            'no_lt5_IDO04A02' => $this->no_lt5_IDO04A02,
            'no_lt5_IDO04A03' => $this->no_lt5_IDO04A03,
            'no_lt5_IDO04A04' => $this->no_lt5_IDO04A04,
            'no_lt5_IDO04A05' => $this->no_lt5_IDO04A05,
            'no_lt5_IDO04A06' => $this->no_lt5_IDO04A06,
            'no_lt5_IDO04A07' => $this->no_lt5_IDO04A07,
            'no_lt5_IDO04A08' => $this->no_lt5_IDO04A08,
            'no_lt5_IDO04B01' => $this->no_lt5_IDO04B01,
            'no_lt5_IDO04B02' => $this->no_lt5_IDO04B02,
            'no_lt5_IDO04B03' => $this->no_lt5_IDO04B03,
            'no_lt5_IDO05A01' => $this->no_lt5_IDO05A01,
            'no_lt5_IDO05A02' => $this->no_lt5_IDO05A02,
            'no_lt5_IDO05A03' => $this->no_lt5_IDO05A03,
            'no_lt5_IDO05A04' => $this->no_lt5_IDO05A04,
            'no_lt5_IDO05B01' => $this->no_lt5_IDO05B01,
            'no_lt5_IDO05B02' => $this->no_lt5_IDO05B02,
            'no_lt5_IDO05B03' => $this->no_lt5_IDO05B03,
            'no_lt5_IDO05B04' => $this->no_lt5_IDO05B04,
            'no_lt5_IDO0601' => $this->no_lt5_IDO0601,
            'no_lt5_IDO0602' => $this->no_lt5_IDO0602,
            'no_lt5_IDO0603' => $this->no_lt5_IDO0603,
            'no_lt5_IDO0604' => $this->no_lt5_IDO0604,
            'no_lt5_jumlah' => $this->no_lt5_jumlah,

            'denominator_lt5' => $this->denominator_lt5,

            'vk_IDO04A01' => $this->vk_IDO04A01,
            'vk_IDO04A02' => $this->vk_IDO04A02,
            'vk_IDO04A03' => $this->vk_IDO04A03,
            'vk_IDO04A04' => $this->vk_IDO04A04,
            'vk_IDO04A05' => $this->vk_IDO04A05,
            'vk_IDO04A06' => $this->vk_IDO04A06,
            'vk_IDO04A07' => $this->vk_IDO04A07,
            'vk_IDO04A08' => $this->vk_IDO04A08,
            'vk_IDO04B01' => $this->vk_IDO04B01,
            'vk_IDO04B02' => $this->vk_IDO04B02,
            'vk_IDO04B03' => $this->vk_IDO04B03,
            'vk_IDO05A01' => $this->vk_IDO05A01,
            'vk_IDO05A02' => $this->vk_IDO05A02,
            'vk_IDO05A03' => $this->vk_IDO05A03,
            'vk_IDO05A04' => $this->vk_IDO05A04,
            'vk_IDO05B01' => $this->vk_IDO05B01,
            'vk_IDO05B02' => $this->vk_IDO05B02,
            'vk_IDO05B03' => $this->vk_IDO05B03,
            'vk_IDO05B04' => $this->vk_IDO05B04,
            'vk_IDO0601' => $this->vk_IDO0601,
            'vk_IDO0602' => $this->vk_IDO0602,
            'vk_IDO0603' => $this->vk_IDO0603,
            'vk_IDO0604' => $this->vk_IDO0604,
            'vk_jumlah' => $this->vk_jumlah,

            'no_vk_IDO04A01' => $this->no_vk_IDO04A01,
            'no_vk_IDO04A02' => $this->no_vk_IDO04A02,
            'no_vk_IDO04A03' => $this->no_vk_IDO04A03,
            'no_vk_IDO04A04' => $this->no_vk_IDO04A04,
            'no_vk_IDO04A05' => $this->no_vk_IDO04A05,
            'no_vk_IDO04A06' => $this->no_vk_IDO04A06,
            'no_vk_IDO04A07' => $this->no_vk_IDO04A07,
            'no_vk_IDO04A08' => $this->no_vk_IDO04A08,
            'no_vk_IDO04B01' => $this->no_vk_IDO04B01,
            'no_vk_IDO04B02' => $this->no_vk_IDO04B02,
            'no_vk_IDO04B03' => $this->no_vk_IDO04B03,
            'no_vk_IDO05A01' => $this->no_vk_IDO05A01,
            'no_vk_IDO05A02' => $this->no_vk_IDO05A02,
            'no_vk_IDO05A03' => $this->no_vk_IDO05A03,
            'no_vk_IDO05A04' => $this->no_vk_IDO05A04,
            'no_vk_IDO05B01' => $this->no_vk_IDO05B01,
            'no_vk_IDO05B02' => $this->no_vk_IDO05B02,
            'no_vk_IDO05B03' => $this->no_vk_IDO05B03,
            'no_vk_IDO05B04' => $this->no_vk_IDO05B04,
            'no_vk_IDO0601' => $this->no_vk_IDO0601,
            'no_vk_IDO0602' => $this->no_vk_IDO0602,
            'no_vk_IDO0603' => $this->no_vk_IDO0603,
            'no_vk_IDO0604' => $this->no_vk_IDO0604,
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
