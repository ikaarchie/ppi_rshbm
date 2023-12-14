<?php

namespace App\Exports;

use App\Models\Apd;
use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class ExportApd implements FromView, ShouldAutoSize, WithEvents
{
    public function __construct(
        $cssu_sbl_kon_psn,
        $cssu_sbl_tin_aseptik,
        $cssu_stl_kon_cairan,
        $cssu_stl_kon_psn,
        $cssu_stl_kon_ling_psn,
        $cssu_hr,
        $cssu_hw,
        $cssu_gagal,
        $cssu_st,
        $cssu_jumlah,

        $no_cssu_sbl_kon_psn,
        $no_cssu_sbl_tin_aseptik,
        $no_cssu_stl_kon_cairan,
        $no_cssu_stl_kon_psn,
        $no_cssu_stl_kon_ling_psn,
        $no_cssu_hr,
        $no_cssu_hw,
        $no_cssu_gagal,
        $no_cssu_st,
        $no_cssu_jumlah,

        $denominator_cssu,

        $dapur_sbl_kon_psn,
        $dapur_sbl_tin_aseptik,
        $dapur_stl_kon_cairan,
        $dapur_stl_kon_psn,
        $dapur_stl_kon_ling_psn,
        $dapur_hr,
        $dapur_hw,
        $dapur_gagal,
        $dapur_st,
        $dapur_jumlah,

        $no_dapur_sbl_kon_psn,
        $no_dapur_sbl_tin_aseptik,
        $no_dapur_stl_kon_cairan,
        $no_dapur_stl_kon_psn,
        $no_dapur_stl_kon_ling_psn,
        $no_dapur_hr,
        $no_dapur_hw,
        $no_dapur_gagal,
        $no_dapur_st,
        $no_dapur_jumlah,

        $denominator_dapur,

        $dpjp_sbl_kon_psn,
        $dpjp_sbl_tin_aseptik,
        $dpjp_stl_kon_cairan,
        $dpjp_stl_kon_psn,
        $dpjp_stl_kon_ling_psn,
        $dpjp_hr,
        $dpjp_hw,
        $dpjp_gagal,
        $dpjp_st,
        $dpjp_jumlah,

        $no_dpjp_sbl_kon_psn,
        $no_dpjp_sbl_tin_aseptik,
        $no_dpjp_stl_kon_cairan,
        $no_dpjp_stl_kon_psn,
        $no_dpjp_stl_kon_ling_psn,
        $no_dpjp_hr,
        $no_dpjp_hw,
        $no_dpjp_gagal,
        $no_dpjp_st,
        $no_dpjp_jumlah,

        $denominator_dpjp,

        $farmasi_sbl_kon_psn,
        $farmasi_sbl_tin_aseptik,
        $farmasi_stl_kon_cairan,
        $farmasi_stl_kon_psn,
        $farmasi_stl_kon_ling_psn,
        $farmasi_hr,
        $farmasi_hw,
        $farmasi_gagal,
        $farmasi_st,
        $farmasi_jumlah,

        $no_farmasi_sbl_kon_psn,
        $no_farmasi_sbl_tin_aseptik,
        $no_farmasi_stl_kon_cairan,
        $no_farmasi_stl_kon_psn,
        $no_farmasi_stl_kon_ling_psn,
        $no_farmasi_hr,
        $no_farmasi_hw,
        $no_farmasi_gagal,
        $no_farmasi_st,
        $no_farmasi_jumlah,

        $denominator_farmasi,

        $igd_sbl_kon_psn,
        $igd_sbl_tin_aseptik,
        $igd_stl_kon_cairan,
        $igd_stl_kon_psn,
        $igd_stl_kon_ling_psn,
        $igd_hr,
        $igd_hw,
        $igd_gagal,
        $igd_st,
        $igd_jumlah,

        $no_igd_sbl_kon_psn,
        $no_igd_sbl_tin_aseptik,
        $no_igd_stl_kon_cairan,
        $no_igd_stl_kon_psn,
        $no_igd_stl_kon_ling_psn,
        $no_igd_hr,
        $no_igd_hw,
        $no_igd_gagal,
        $no_igd_st,
        $no_igd_jumlah,

        $denominator_igd,

        $int_sbl_kon_psn,
        $int_sbl_tin_aseptik,
        $int_stl_kon_cairan,
        $int_stl_kon_psn,
        $int_stl_kon_ling_psn,
        $int_hr,
        $int_hw,
        $int_gagal,
        $int_st,
        $int_jumlah,

        $no_int_sbl_kon_psn,
        $no_int_sbl_tin_aseptik,
        $no_int_stl_kon_cairan,
        $no_int_stl_kon_psn,
        $no_int_stl_kon_ling_psn,
        $no_int_hr,
        $no_int_hw,
        $no_int_gagal,
        $no_int_st,
        $no_int_jumlah,

        $denominator_int,

        $kbbl_sbl_kon_psn,
        $kbbl_sbl_tin_aseptik,
        $kbbl_stl_kon_cairan,
        $kbbl_stl_kon_psn,
        $kbbl_stl_kon_ling_psn,
        $kbbl_hr,
        $kbbl_hw,
        $kbbl_gagal,
        $kbbl_st,
        $kbbl_jumlah,

        $no_kbbl_sbl_kon_psn,
        $no_kbbl_sbl_tin_aseptik,
        $no_kbbl_stl_kon_cairan,
        $no_kbbl_stl_kon_psn,
        $no_kbbl_stl_kon_ling_psn,
        $no_kbbl_hr,
        $no_kbbl_hw,
        $no_kbbl_gagal,
        $no_kbbl_st,
        $no_kbbl_jumlah,

        $denominator_kbbl,

        $lab_sbl_kon_psn,
        $lab_sbl_tin_aseptik,
        $lab_stl_kon_cairan,
        $lab_stl_kon_psn,
        $lab_stl_kon_ling_psn,
        $lab_hr,
        $lab_hw,
        $lab_gagal,
        $lab_st,
        $lab_jumlah,

        $no_lab_sbl_kon_psn,
        $no_lab_sbl_tin_aseptik,
        $no_lab_stl_kon_cairan,
        $no_lab_stl_kon_psn,
        $no_lab_stl_kon_ling_psn,
        $no_lab_hr,
        $no_lab_hw,
        $no_lab_gagal,
        $no_lab_st,
        $no_lab_jumlah,

        $denominator_lab,

        $laundry_sbl_kon_psn,
        $laundry_sbl_tin_aseptik,
        $laundry_stl_kon_cairan,
        $laundry_stl_kon_psn,
        $laundry_stl_kon_ling_psn,
        $laundry_hr,
        $laundry_hw,
        $laundry_gagal,
        $laundry_st,
        $laundry_jumlah,

        $no_laundry_sbl_kon_psn,
        $no_laundry_sbl_tin_aseptik,
        $no_laundry_stl_kon_cairan,
        $no_laundry_stl_kon_psn,
        $no_laundry_stl_kon_ling_psn,
        $no_laundry_hr,
        $no_laundry_hw,
        $no_laundry_gagal,
        $no_laundry_st,
        $no_laundry_jumlah,

        $denominator_laundry,

        $ok_sbl_kon_psn,
        $ok_sbl_tin_aseptik,
        $ok_stl_kon_cairan,
        $ok_stl_kon_psn,
        $ok_stl_kon_ling_psn,
        $ok_hr,
        $ok_hw,
        $ok_gagal,
        $ok_st,
        $ok_jumlah,

        $no_ok_sbl_kon_psn,
        $no_ok_sbl_tin_aseptik,
        $no_ok_stl_kon_cairan,
        $no_ok_stl_kon_psn,
        $no_ok_stl_kon_ling_psn,
        $no_ok_hr,
        $no_ok_hw,
        $no_ok_gagal,
        $no_ok_st,
        $no_ok_jumlah,

        $denominator_ok,

        $lt2_sbl_kon_psn,
        $lt2_sbl_tin_aseptik,
        $lt2_stl_kon_cairan,
        $lt2_stl_kon_psn,
        $lt2_stl_kon_ling_psn,
        $lt2_hr,
        $lt2_hw,
        $lt2_gagal,
        $lt2_st,
        $lt2_jumlah,

        $no_lt2_sbl_kon_psn,
        $no_lt2_sbl_tin_aseptik,
        $no_lt2_stl_kon_cairan,
        $no_lt2_stl_kon_psn,
        $no_lt2_stl_kon_ling_psn,
        $no_lt2_hr,
        $no_lt2_hw,
        $no_lt2_gagal,
        $no_lt2_st,
        $no_lt2_jumlah,

        $denominator_lt2,

        $lt4_sbl_kon_psn,
        $lt4_sbl_tin_aseptik,
        $lt4_stl_kon_cairan,
        $lt4_stl_kon_psn,
        $lt4_stl_kon_ling_psn,
        $lt4_hr,
        $lt4_hw,
        $lt4_gagal,
        $lt4_st,
        $lt4_jumlah,

        $no_lt4_sbl_kon_psn,
        $no_lt4_sbl_tin_aseptik,
        $no_lt4_stl_kon_cairan,
        $no_lt4_stl_kon_psn,
        $no_lt4_stl_kon_ling_psn,
        $no_lt4_hr,
        $no_lt4_hw,
        $no_lt4_gagal,
        $no_lt4_st,
        $no_lt4_jumlah,

        $denominator_lt4,

        $lt5_sbl_kon_psn,
        $lt5_sbl_tin_aseptik,
        $lt5_stl_kon_cairan,
        $lt5_stl_kon_psn,
        $lt5_stl_kon_ling_psn,
        $lt5_hr,
        $lt5_hw,
        $lt5_gagal,
        $lt5_st,
        $lt5_jumlah,

        $no_lt5_sbl_kon_psn,
        $no_lt5_sbl_tin_aseptik,
        $no_lt5_stl_kon_cairan,
        $no_lt5_stl_kon_psn,
        $no_lt5_stl_kon_ling_psn,
        $no_lt5_hr,
        $no_lt5_hw,
        $no_lt5_gagal,
        $no_lt5_st,
        $no_lt5_jumlah,

        $denominator_lt5,

        $poli_sbl_kon_psn,
        $poli_sbl_tin_aseptik,
        $poli_stl_kon_cairan,
        $poli_stl_kon_psn,
        $poli_stl_kon_ling_psn,
        $poli_hr,
        $poli_hw,
        $poli_gagal,
        $poli_st,
        $poli_jumlah,

        $no_poli_sbl_kon_psn,
        $no_poli_sbl_tin_aseptik,
        $no_poli_stl_kon_cairan,
        $no_poli_stl_kon_psn,
        $no_poli_stl_kon_ling_psn,
        $no_poli_hr,
        $no_poli_hw,
        $no_poli_gagal,
        $no_poli_st,
        $no_poli_jumlah,

        $denominator_poli,

        $rad_sbl_kon_psn,
        $rad_sbl_tin_aseptik,
        $rad_stl_kon_cairan,
        $rad_stl_kon_psn,
        $rad_stl_kon_ling_psn,
        $rad_hr,
        $rad_hw,
        $rad_gagal,
        $rad_st,
        $rad_jumlah,

        $no_rad_sbl_kon_psn,
        $no_rad_sbl_tin_aseptik,
        $no_rad_stl_kon_cairan,
        $no_rad_stl_kon_psn,
        $no_rad_stl_kon_ling_psn,
        $no_rad_hr,
        $no_rad_hw,
        $no_rad_gagal,
        $no_rad_st,
        $no_rad_jumlah,

        $denominator_rad,

        $vk_sbl_kon_psn,
        $vk_sbl_tin_aseptik,
        $vk_stl_kon_cairan,
        $vk_stl_kon_psn,
        $vk_stl_kon_ling_psn,
        $vk_hr,
        $vk_hw,
        $vk_gagal,
        $vk_st,
        $vk_jumlah,

        $no_vk_sbl_kon_psn,
        $no_vk_sbl_tin_aseptik,
        $no_vk_stl_kon_cairan,
        $no_vk_stl_kon_psn,
        $no_vk_stl_kon_ling_psn,
        $no_vk_hr,
        $no_vk_hw,
        $no_vk_gagal,
        $no_vk_st,
        $no_vk_jumlah,

        $denominator_vk,

        $tabel,
        $rekap,
        $tanggal
    ) {
        $this->cssu_sbl_kon_psn = $cssu_sbl_kon_psn;
        $this->cssu_sbl_tin_aseptik = $cssu_sbl_tin_aseptik;
        $this->cssu_stl_kon_cairan = $cssu_stl_kon_cairan;
        $this->cssu_stl_kon_psn = $cssu_stl_kon_psn;
        $this->cssu_stl_kon_ling_psn = $cssu_stl_kon_ling_psn;
        $this->cssu_hr = $cssu_hr;
        $this->cssu_hw = $cssu_hw;
        $this->cssu_gagal = $cssu_gagal;
        $this->cssu_st = $cssu_st;
        $this->cssu_jumlah = $cssu_jumlah;

        $this->no_cssu_sbl_kon_psn = $no_cssu_sbl_kon_psn;
        $this->no_cssu_sbl_tin_aseptik = $no_cssu_sbl_tin_aseptik;
        $this->no_cssu_stl_kon_cairan = $no_cssu_stl_kon_cairan;
        $this->no_cssu_stl_kon_psn = $no_cssu_stl_kon_psn;
        $this->no_cssu_stl_kon_ling_psn = $no_cssu_stl_kon_ling_psn;
        $this->no_cssu_hr = $no_cssu_hr;
        $this->no_cssu_hw = $no_cssu_hw;
        $this->no_cssu_gagal = $no_cssu_gagal;
        $this->no_cssu_st = $no_cssu_st;
        $this->no_cssu_jumlah = $no_cssu_jumlah;

        $this->denominator_cssu = $denominator_cssu;

        $this->dapur_sbl_kon_psn = $dapur_sbl_kon_psn;
        $this->dapur_sbl_tin_aseptik = $dapur_sbl_tin_aseptik;
        $this->dapur_stl_kon_cairan = $dapur_stl_kon_cairan;
        $this->dapur_stl_kon_psn = $dapur_stl_kon_psn;
        $this->dapur_stl_kon_ling_psn = $dapur_stl_kon_ling_psn;
        $this->dapur_hr = $dapur_hr;
        $this->dapur_hw = $dapur_hw;
        $this->dapur_gagal = $dapur_gagal;
        $this->dapur_st = $dapur_st;
        $this->dapur_jumlah = $dapur_jumlah;

        $this->no_dapur_sbl_kon_psn = $no_dapur_sbl_kon_psn;
        $this->no_dapur_sbl_tin_aseptik = $no_dapur_sbl_tin_aseptik;
        $this->no_dapur_stl_kon_cairan = $no_dapur_stl_kon_cairan;
        $this->no_dapur_stl_kon_psn = $no_dapur_stl_kon_psn;
        $this->no_dapur_stl_kon_ling_psn = $no_dapur_stl_kon_ling_psn;
        $this->no_dapur_hr = $no_dapur_hr;
        $this->no_dapur_hw = $no_dapur_hw;
        $this->no_dapur_gagal = $no_dapur_gagal;
        $this->no_dapur_st = $no_dapur_st;
        $this->no_dapur_jumlah = $no_dapur_jumlah;

        $this->denominator_dapur = $denominator_dapur;

        $this->dpjp_sbl_kon_psn = $dpjp_sbl_kon_psn;
        $this->dpjp_sbl_tin_aseptik = $dpjp_sbl_tin_aseptik;
        $this->dpjp_stl_kon_cairan = $dpjp_stl_kon_cairan;
        $this->dpjp_stl_kon_psn = $dpjp_stl_kon_psn;
        $this->dpjp_stl_kon_ling_psn = $dpjp_stl_kon_ling_psn;
        $this->dpjp_hr = $dpjp_hr;
        $this->dpjp_hw = $dpjp_hw;
        $this->dpjp_gagal = $dpjp_gagal;
        $this->dpjp_st = $dpjp_st;
        $this->dpjp_jumlah = $dpjp_jumlah;

        $this->no_dpjp_sbl_kon_psn = $no_dpjp_sbl_kon_psn;
        $this->no_dpjp_sbl_tin_aseptik = $no_dpjp_sbl_tin_aseptik;
        $this->no_dpjp_stl_kon_cairan = $no_dpjp_stl_kon_cairan;
        $this->no_dpjp_stl_kon_psn = $no_dpjp_stl_kon_psn;
        $this->no_dpjp_stl_kon_ling_psn = $no_dpjp_stl_kon_ling_psn;
        $this->no_dpjp_hr = $no_dpjp_hr;
        $this->no_dpjp_hw = $no_dpjp_hw;
        $this->no_dpjp_gagal = $no_dpjp_gagal;
        $this->no_dpjp_st = $no_dpjp_st;
        $this->no_dpjp_jumlah = $no_dpjp_jumlah;

        $this->denominator_dpjp = $denominator_dpjp;

        $this->farmasi_sbl_kon_psn = $farmasi_sbl_kon_psn;
        $this->farmasi_sbl_tin_aseptik = $farmasi_sbl_tin_aseptik;
        $this->farmasi_stl_kon_cairan = $farmasi_stl_kon_cairan;
        $this->farmasi_stl_kon_psn = $farmasi_stl_kon_psn;
        $this->farmasi_stl_kon_ling_psn = $farmasi_stl_kon_ling_psn;
        $this->farmasi_hr = $farmasi_hr;
        $this->farmasi_hw = $farmasi_hw;
        $this->farmasi_gagal = $farmasi_gagal;
        $this->farmasi_st = $farmasi_st;
        $this->farmasi_jumlah = $farmasi_jumlah;

        $this->no_farmasi_sbl_kon_psn = $no_farmasi_sbl_kon_psn;
        $this->no_farmasi_sbl_tin_aseptik = $no_farmasi_sbl_tin_aseptik;
        $this->no_farmasi_stl_kon_cairan = $no_farmasi_stl_kon_cairan;
        $this->no_farmasi_stl_kon_psn = $no_farmasi_stl_kon_psn;
        $this->no_farmasi_stl_kon_ling_psn = $no_farmasi_stl_kon_ling_psn;
        $this->no_farmasi_hr = $no_farmasi_hr;
        $this->no_farmasi_hw = $no_farmasi_hw;
        $this->no_farmasi_gagal = $no_farmasi_gagal;
        $this->no_farmasi_st = $no_farmasi_st;
        $this->no_farmasi_jumlah = $no_farmasi_jumlah;

        $this->denominator_farmasi = $denominator_farmasi;

        $this->igd_sbl_kon_psn = $igd_sbl_kon_psn;
        $this->igd_sbl_tin_aseptik = $igd_sbl_tin_aseptik;
        $this->igd_stl_kon_cairan = $igd_stl_kon_cairan;
        $this->igd_stl_kon_psn = $igd_stl_kon_psn;
        $this->igd_stl_kon_ling_psn = $igd_stl_kon_ling_psn;
        $this->igd_hr = $igd_hr;
        $this->igd_hw = $igd_hw;
        $this->igd_gagal = $igd_gagal;
        $this->igd_st = $igd_st;
        $this->igd_jumlah = $igd_jumlah;

        $this->no_igd_sbl_kon_psn = $no_igd_sbl_kon_psn;
        $this->no_igd_sbl_tin_aseptik = $no_igd_sbl_tin_aseptik;
        $this->no_igd_stl_kon_cairan = $no_igd_stl_kon_cairan;
        $this->no_igd_stl_kon_psn = $no_igd_stl_kon_psn;
        $this->no_igd_stl_kon_ling_psn = $no_igd_stl_kon_ling_psn;
        $this->no_igd_hr = $no_igd_hr;
        $this->no_igd_hw = $no_igd_hw;
        $this->no_igd_gagal = $no_igd_gagal;
        $this->no_igd_st = $no_igd_st;
        $this->no_igd_jumlah = $no_igd_jumlah;

        $this->denominator_igd = $denominator_igd;

        $this->int_sbl_kon_psn = $int_sbl_kon_psn;
        $this->int_sbl_tin_aseptik = $int_sbl_tin_aseptik;
        $this->int_stl_kon_cairan = $int_stl_kon_cairan;
        $this->int_stl_kon_psn = $int_stl_kon_psn;
        $this->int_stl_kon_ling_psn = $int_stl_kon_ling_psn;
        $this->int_hr = $int_hr;
        $this->int_hw = $int_hw;
        $this->int_gagal = $int_gagal;
        $this->int_st = $int_st;
        $this->int_jumlah = $int_jumlah;

        $this->no_int_sbl_kon_psn = $no_int_sbl_kon_psn;
        $this->no_int_sbl_tin_aseptik = $no_int_sbl_tin_aseptik;
        $this->no_int_stl_kon_cairan = $no_int_stl_kon_cairan;
        $this->no_int_stl_kon_psn = $no_int_stl_kon_psn;
        $this->no_int_stl_kon_ling_psn = $no_int_stl_kon_ling_psn;
        $this->no_int_hr = $no_int_hr;
        $this->no_int_hw = $no_int_hw;
        $this->no_int_gagal = $no_int_gagal;
        $this->no_int_st = $no_int_st;
        $this->no_int_jumlah = $no_int_jumlah;

        $this->denominator_int = $denominator_int;

        $this->kbbl_sbl_kon_psn = $kbbl_sbl_kon_psn;
        $this->kbbl_sbl_tin_aseptik = $kbbl_sbl_tin_aseptik;
        $this->kbbl_stl_kon_cairan = $kbbl_stl_kon_cairan;
        $this->kbbl_stl_kon_psn = $kbbl_stl_kon_psn;
        $this->kbbl_stl_kon_ling_psn = $kbbl_stl_kon_ling_psn;
        $this->kbbl_hr = $kbbl_hr;
        $this->kbbl_hw = $kbbl_hw;
        $this->kbbl_gagal = $kbbl_gagal;
        $this->kbbl_st = $kbbl_st;
        $this->kbbl_jumlah = $kbbl_jumlah;

        $this->no_kbbl_sbl_kon_psn = $no_kbbl_sbl_kon_psn;
        $this->no_kbbl_sbl_tin_aseptik = $no_kbbl_sbl_tin_aseptik;
        $this->no_kbbl_stl_kon_cairan = $no_kbbl_stl_kon_cairan;
        $this->no_kbbl_stl_kon_psn = $no_kbbl_stl_kon_psn;
        $this->no_kbbl_stl_kon_ling_psn = $no_kbbl_stl_kon_ling_psn;
        $this->no_kbbl_hr = $no_kbbl_hr;
        $this->no_kbbl_hw = $no_kbbl_hw;
        $this->no_kbbl_gagal = $no_kbbl_gagal;
        $this->no_kbbl_st = $no_kbbl_st;
        $this->no_kbbl_jumlah = $no_kbbl_jumlah;

        $this->denominator_kbbl = $denominator_kbbl;

        $this->lab_sbl_kon_psn = $lab_sbl_kon_psn;
        $this->lab_sbl_tin_aseptik = $lab_sbl_tin_aseptik;
        $this->lab_stl_kon_cairan = $lab_stl_kon_cairan;
        $this->lab_stl_kon_psn = $lab_stl_kon_psn;
        $this->lab_stl_kon_ling_psn = $lab_stl_kon_ling_psn;
        $this->lab_hr = $lab_hr;
        $this->lab_hw = $lab_hw;
        $this->lab_gagal = $lab_gagal;
        $this->lab_st = $lab_st;
        $this->lab_jumlah = $lab_jumlah;

        $this->no_lab_sbl_kon_psn = $no_lab_sbl_kon_psn;
        $this->no_lab_sbl_tin_aseptik = $no_lab_sbl_tin_aseptik;
        $this->no_lab_stl_kon_cairan = $no_lab_stl_kon_cairan;
        $this->no_lab_stl_kon_psn = $no_lab_stl_kon_psn;
        $this->no_lab_stl_kon_ling_psn = $no_lab_stl_kon_ling_psn;
        $this->no_lab_hr = $no_lab_hr;
        $this->no_lab_hw = $no_lab_hw;
        $this->no_lab_gagal = $no_lab_gagal;
        $this->no_lab_st = $no_lab_st;
        $this->no_lab_jumlah = $no_lab_jumlah;

        $this->denominator_lab = $denominator_lab;

        $this->laundry_sbl_kon_psn = $laundry_sbl_kon_psn;
        $this->laundry_sbl_tin_aseptik = $laundry_sbl_tin_aseptik;
        $this->laundry_stl_kon_cairan = $laundry_stl_kon_cairan;
        $this->laundry_stl_kon_psn = $laundry_stl_kon_psn;
        $this->laundry_stl_kon_ling_psn = $laundry_stl_kon_ling_psn;
        $this->laundry_hr = $laundry_hr;
        $this->laundry_hw = $laundry_hw;
        $this->laundry_gagal = $laundry_gagal;
        $this->laundry_st = $laundry_st;
        $this->laundry_jumlah = $laundry_jumlah;

        $this->no_laundry_sbl_kon_psn = $no_laundry_sbl_kon_psn;
        $this->no_laundry_sbl_tin_aseptik = $no_laundry_sbl_tin_aseptik;
        $this->no_laundry_stl_kon_cairan = $no_laundry_stl_kon_cairan;
        $this->no_laundry_stl_kon_psn = $no_laundry_stl_kon_psn;
        $this->no_laundry_stl_kon_ling_psn = $no_laundry_stl_kon_ling_psn;
        $this->no_laundry_hr = $no_laundry_hr;
        $this->no_laundry_hw = $no_laundry_hw;
        $this->no_laundry_gagal = $no_laundry_gagal;
        $this->no_laundry_st = $no_laundry_st;
        $this->no_laundry_jumlah = $no_laundry_jumlah;

        $this->denominator_laundry = $denominator_laundry;

        $this->ok_sbl_kon_psn = $ok_sbl_kon_psn;
        $this->ok_sbl_tin_aseptik = $ok_sbl_tin_aseptik;
        $this->ok_stl_kon_cairan = $ok_stl_kon_cairan;
        $this->ok_stl_kon_psn = $ok_stl_kon_psn;
        $this->ok_stl_kon_ling_psn = $ok_stl_kon_ling_psn;
        $this->ok_hr = $ok_hr;
        $this->ok_hw = $ok_hw;
        $this->ok_gagal = $ok_gagal;
        $this->ok_st = $ok_st;
        $this->ok_jumlah = $ok_jumlah;

        $this->no_ok_sbl_kon_psn = $no_ok_sbl_kon_psn;
        $this->no_ok_sbl_tin_aseptik = $no_ok_sbl_tin_aseptik;
        $this->no_ok_stl_kon_cairan = $no_ok_stl_kon_cairan;
        $this->no_ok_stl_kon_psn = $no_ok_stl_kon_psn;
        $this->no_ok_stl_kon_ling_psn = $no_ok_stl_kon_ling_psn;
        $this->no_ok_hr = $no_ok_hr;
        $this->no_ok_hw = $no_ok_hw;
        $this->no_ok_gagal = $no_ok_gagal;
        $this->no_ok_st = $no_ok_st;
        $this->no_ok_jumlah = $no_ok_jumlah;

        $this->denominator_ok = $denominator_ok;

        $this->lt2_sbl_kon_psn = $lt2_sbl_kon_psn;
        $this->lt2_sbl_tin_aseptik = $lt2_sbl_tin_aseptik;
        $this->lt2_stl_kon_cairan = $lt2_stl_kon_cairan;
        $this->lt2_stl_kon_psn = $lt2_stl_kon_psn;
        $this->lt2_stl_kon_ling_psn = $lt2_stl_kon_ling_psn;
        $this->lt2_hr = $lt2_hr;
        $this->lt2_hw = $lt2_hw;
        $this->lt2_gagal = $lt2_gagal;
        $this->lt2_st = $lt2_st;
        $this->lt2_jumlah = $lt2_jumlah;

        $this->no_lt2_sbl_kon_psn = $no_lt2_sbl_kon_psn;
        $this->no_lt2_sbl_tin_aseptik = $no_lt2_sbl_tin_aseptik;
        $this->no_lt2_stl_kon_cairan = $no_lt2_stl_kon_cairan;
        $this->no_lt2_stl_kon_psn = $no_lt2_stl_kon_psn;
        $this->no_lt2_stl_kon_ling_psn = $no_lt2_stl_kon_ling_psn;
        $this->no_lt2_hr = $no_lt2_hr;
        $this->no_lt2_hw = $no_lt2_hw;
        $this->no_lt2_gagal = $no_lt2_gagal;
        $this->no_lt2_st = $no_lt2_st;
        $this->no_lt2_jumlah = $no_lt2_jumlah;

        $this->denominator_lt2 = $denominator_lt2;

        $this->lt4_sbl_kon_psn = $lt4_sbl_kon_psn;
        $this->lt4_sbl_tin_aseptik = $lt4_sbl_tin_aseptik;
        $this->lt4_stl_kon_cairan = $lt4_stl_kon_cairan;
        $this->lt4_stl_kon_psn = $lt4_stl_kon_psn;
        $this->lt4_stl_kon_ling_psn = $lt4_stl_kon_ling_psn;
        $this->lt4_hr = $lt4_hr;
        $this->lt4_hw = $lt4_hw;
        $this->lt4_gagal = $lt4_gagal;
        $this->lt4_st = $lt4_st;
        $this->lt4_jumlah = $lt4_jumlah;

        $this->no_lt4_sbl_kon_psn = $no_lt4_sbl_kon_psn;
        $this->no_lt4_sbl_tin_aseptik = $no_lt4_sbl_tin_aseptik;
        $this->no_lt4_stl_kon_cairan = $no_lt4_stl_kon_cairan;
        $this->no_lt4_stl_kon_psn = $no_lt4_stl_kon_psn;
        $this->no_lt4_stl_kon_ling_psn = $no_lt4_stl_kon_ling_psn;
        $this->no_lt4_hr = $no_lt4_hr;
        $this->no_lt4_hw = $no_lt4_hw;
        $this->no_lt4_gagal = $no_lt4_gagal;
        $this->no_lt4_st = $no_lt4_st;
        $this->no_lt4_jumlah = $no_lt4_jumlah;

        $this->denominator_lt4 = $denominator_lt4;

        $this->lt5_sbl_kon_psn = $lt5_sbl_kon_psn;
        $this->lt5_sbl_tin_aseptik = $lt5_sbl_tin_aseptik;
        $this->lt5_stl_kon_cairan = $lt5_stl_kon_cairan;
        $this->lt5_stl_kon_psn = $lt5_stl_kon_psn;
        $this->lt5_stl_kon_ling_psn = $lt5_stl_kon_ling_psn;
        $this->lt5_hr = $lt5_hr;
        $this->lt5_hw = $lt5_hw;
        $this->lt5_gagal = $lt5_gagal;
        $this->lt5_st = $lt5_st;
        $this->lt5_jumlah = $lt5_jumlah;

        $this->no_lt5_sbl_kon_psn = $no_lt5_sbl_kon_psn;
        $this->no_lt5_sbl_tin_aseptik = $no_lt5_sbl_tin_aseptik;
        $this->no_lt5_stl_kon_cairan = $no_lt5_stl_kon_cairan;
        $this->no_lt5_stl_kon_psn = $no_lt5_stl_kon_psn;
        $this->no_lt5_stl_kon_ling_psn = $no_lt5_stl_kon_ling_psn;
        $this->no_lt5_hr = $no_lt5_hr;
        $this->no_lt5_hw = $no_lt5_hw;
        $this->no_lt5_gagal = $no_lt5_gagal;
        $this->no_lt5_st = $no_lt5_st;
        $this->no_lt5_jumlah = $no_lt5_jumlah;

        $this->denominator_lt5 = $denominator_lt5;

        $this->poli_sbl_kon_psn = $poli_sbl_kon_psn;
        $this->poli_sbl_tin_aseptik = $poli_sbl_tin_aseptik;
        $this->poli_stl_kon_cairan = $poli_stl_kon_cairan;
        $this->poli_stl_kon_psn = $poli_stl_kon_psn;
        $this->poli_stl_kon_ling_psn = $poli_stl_kon_ling_psn;
        $this->poli_hr = $poli_hr;
        $this->poli_hw = $poli_hw;
        $this->poli_gagal = $poli_gagal;
        $this->poli_st = $poli_st;
        $this->poli_jumlah = $poli_jumlah;

        $this->no_poli_sbl_kon_psn = $no_poli_sbl_kon_psn;
        $this->no_poli_sbl_tin_aseptik = $no_poli_sbl_tin_aseptik;
        $this->no_poli_stl_kon_cairan = $no_poli_stl_kon_cairan;
        $this->no_poli_stl_kon_psn = $no_poli_stl_kon_psn;
        $this->no_poli_stl_kon_ling_psn = $no_poli_stl_kon_ling_psn;
        $this->no_poli_hr = $no_poli_hr;
        $this->no_poli_hw = $no_poli_hw;
        $this->no_poli_gagal = $no_poli_gagal;
        $this->no_poli_st = $no_poli_st;
        $this->no_poli_jumlah = $no_poli_jumlah;

        $this->denominator_poli = $denominator_poli;

        $this->rad_sbl_kon_psn = $rad_sbl_kon_psn;
        $this->rad_sbl_tin_aseptik = $rad_sbl_tin_aseptik;
        $this->rad_stl_kon_cairan = $rad_stl_kon_cairan;
        $this->rad_stl_kon_psn = $rad_stl_kon_psn;
        $this->rad_stl_kon_ling_psn = $rad_stl_kon_ling_psn;
        $this->rad_hr = $rad_hr;
        $this->rad_hw = $rad_hw;
        $this->rad_gagal = $rad_gagal;
        $this->rad_st = $rad_st;
        $this->rad_jumlah = $rad_jumlah;

        $this->no_rad_sbl_kon_psn = $no_rad_sbl_kon_psn;
        $this->no_rad_sbl_tin_aseptik = $no_rad_sbl_tin_aseptik;
        $this->no_rad_stl_kon_cairan = $no_rad_stl_kon_cairan;
        $this->no_rad_stl_kon_psn = $no_rad_stl_kon_psn;
        $this->no_rad_stl_kon_ling_psn = $no_rad_stl_kon_ling_psn;
        $this->no_rad_hr = $no_rad_hr;
        $this->no_rad_hw = $no_rad_hw;
        $this->no_rad_gagal = $no_rad_gagal;
        $this->no_rad_st = $no_rad_st;
        $this->no_rad_jumlah = $no_rad_jumlah;

        $this->denominator_rad = $denominator_rad;

        $this->vk_sbl_kon_psn = $vk_sbl_kon_psn;
        $this->vk_sbl_tin_aseptik = $vk_sbl_tin_aseptik;
        $this->vk_stl_kon_cairan = $vk_stl_kon_cairan;
        $this->vk_stl_kon_psn = $vk_stl_kon_psn;
        $this->vk_stl_kon_ling_psn = $vk_stl_kon_ling_psn;
        $this->vk_hr = $vk_hr;
        $this->vk_hw = $vk_hw;
        $this->vk_gagal = $vk_gagal;
        $this->vk_st = $vk_st;
        $this->vk_jumlah = $vk_jumlah;

        $this->no_vk_sbl_kon_psn = $no_vk_sbl_kon_psn;
        $this->no_vk_sbl_tin_aseptik = $no_vk_sbl_tin_aseptik;
        $this->no_vk_stl_kon_cairan = $no_vk_stl_kon_cairan;
        $this->no_vk_stl_kon_psn = $no_vk_stl_kon_psn;
        $this->no_vk_stl_kon_ling_psn = $no_vk_stl_kon_ling_psn;
        $this->no_vk_hr = $no_vk_hr;
        $this->no_vk_hw = $no_vk_hw;
        $this->no_vk_gagal = $no_vk_gagal;
        $this->no_vk_st = $no_vk_st;
        $this->no_vk_jumlah = $no_vk_jumlah;

        $this->denominator_vk = $denominator_vk;

        $this->tabel = $tabel;
        $this->rekap = $rekap;
        $this->tanggal = $tanggal;
    }

    public function view(): View
    {
        return view('rekapCuciTangan.excel', [
            'tabel' => $this->tabel,
            'rekap' => $this->rekap,
            'tanggal' => $this->tanggal,

            'cssu_sbl_kon_psn' => $this->cssu_sbl_kon_psn,
            'cssu_sbl_tin_aseptik' => $this->cssu_sbl_tin_aseptik,
            'cssu_stl_kon_cairan' => $this->cssu_stl_kon_cairan,
            'cssu_stl_kon_psn' => $this->cssu_stl_kon_psn,
            'cssu_stl_kon_ling_psn' => $this->cssu_stl_kon_ling_psn,
            'cssu_hr' => $this->cssu_hr,
            'cssu_hw' => $this->cssu_hw,
            'cssu_gagal' => $this->cssu_gagal,
            'cssu_st' => $this->cssu_st,
            'cssu_jumlah' => $this->cssu_jumlah,

            'no_cssu_sbl_kon_psn' => $this->no_cssu_sbl_kon_psn,
            'no_cssu_sbl_tin_aseptik' => $this->no_cssu_sbl_tin_aseptik,
            'no_cssu_stl_kon_cairan' => $this->no_cssu_stl_kon_cairan,
            'no_cssu_stl_kon_psn' => $this->no_cssu_stl_kon_psn,
            'no_cssu_stl_kon_ling_psn' => $this->no_cssu_stl_kon_ling_psn,
            'no_cssu_hr' => $this->no_cssu_hr,
            'no_cssu_hw' => $this->no_cssu_hw,
            'no_cssu_gagal' => $this->no_cssu_gagal,
            'no_cssu_st' => $this->no_cssu_st,
            'no_cssu_jumlah' => $this->no_cssu_jumlah,

            'denominator_cssu' => $this->denominator_cssu,

            'dapur_sbl_kon_psn' => $this->dapur_sbl_kon_psn,
            'dapur_sbl_tin_aseptik' => $this->dapur_sbl_tin_aseptik,
            'dapur_stl_kon_cairan' => $this->dapur_stl_kon_cairan,
            'dapur_stl_kon_psn' => $this->dapur_stl_kon_psn,
            'dapur_stl_kon_ling_psn' => $this->dapur_stl_kon_ling_psn,
            'dapur_hr' => $this->dapur_hr,
            'dapur_hw' => $this->dapur_hw,
            'dapur_gagal' => $this->dapur_gagal,
            'dapur_st' => $this->dapur_st,
            'dapur_jumlah' => $this->dapur_jumlah,

            'no_dapur_sbl_kon_psn' => $this->no_dapur_sbl_kon_psn,
            'no_dapur_sbl_tin_aseptik' => $this->no_dapur_sbl_tin_aseptik,
            'no_dapur_stl_kon_cairan' => $this->no_dapur_stl_kon_cairan,
            'no_dapur_stl_kon_psn' => $this->no_dapur_stl_kon_psn,
            'no_dapur_stl_kon_ling_psn' => $this->no_dapur_stl_kon_ling_psn,
            'no_dapur_hr' => $this->no_dapur_hr,
            'no_dapur_hw' => $this->no_dapur_hw,
            'no_dapur_gagal' => $this->no_dapur_gagal,
            'no_dapur_st' => $this->no_dapur_st,
            'no_dapur_jumlah' => $this->no_dapur_jumlah,

            'denominator_dapur' => $this->denominator_dapur,

            'dpjp_sbl_kon_psn' => $this->dpjp_sbl_kon_psn,
            'dpjp_sbl_tin_aseptik' => $this->dpjp_sbl_tin_aseptik,
            'dpjp_stl_kon_cairan' => $this->dpjp_stl_kon_cairan,
            'dpjp_stl_kon_psn' => $this->dpjp_stl_kon_psn,
            'dpjp_stl_kon_ling_psn' => $this->dpjp_stl_kon_ling_psn,
            'dpjp_hr' => $this->dpjp_hr,
            'dpjp_hw' => $this->dpjp_hw,
            'dpjp_gagal' => $this->dpjp_gagal,
            'dpjp_st' => $this->dpjp_st,
            'dpjp_jumlah' => $this->dpjp_jumlah,

            'no_dpjp_sbl_kon_psn' => $this->no_dpjp_sbl_kon_psn,
            'no_dpjp_sbl_tin_aseptik' => $this->no_dpjp_sbl_tin_aseptik,
            'no_dpjp_stl_kon_cairan' => $this->no_dpjp_stl_kon_cairan,
            'no_dpjp_stl_kon_psn' => $this->no_dpjp_stl_kon_psn,
            'no_dpjp_stl_kon_ling_psn' => $this->no_dpjp_stl_kon_ling_psn,
            'no_dpjp_hr' => $this->no_dpjp_hr,
            'no_dpjp_hw' => $this->no_dpjp_hw,
            'no_dpjp_gagal' => $this->no_dpjp_gagal,
            'no_dpjp_st' => $this->no_dpjp_st,
            'no_dpjp_jumlah' => $this->no_dpjp_jumlah,

            'denominator_dpjp' => $this->denominator_dpjp,

            'farmasi_sbl_kon_psn' => $this->farmasi_sbl_kon_psn,
            'farmasi_sbl_tin_aseptik' => $this->farmasi_sbl_tin_aseptik,
            'farmasi_stl_kon_cairan' => $this->farmasi_stl_kon_cairan,
            'farmasi_stl_kon_psn' => $this->farmasi_stl_kon_psn,
            'farmasi_stl_kon_ling_psn' => $this->farmasi_stl_kon_ling_psn,
            'farmasi_hr' => $this->farmasi_hr,
            'farmasi_hw' => $this->farmasi_hw,
            'farmasi_gagal' => $this->farmasi_gagal,
            'farmasi_st' => $this->farmasi_st,
            'farmasi_jumlah' => $this->farmasi_jumlah,

            'no_farmasi_sbl_kon_psn' => $this->no_farmasi_sbl_kon_psn,
            'no_farmasi_sbl_tin_aseptik' => $this->no_farmasi_sbl_tin_aseptik,
            'no_farmasi_stl_kon_cairan' => $this->no_farmasi_stl_kon_cairan,
            'no_farmasi_stl_kon_psn' => $this->no_farmasi_stl_kon_psn,
            'no_farmasi_stl_kon_ling_psn' => $this->no_farmasi_stl_kon_ling_psn,
            'no_farmasi_hr' => $this->no_farmasi_hr,
            'no_farmasi_hw' => $this->no_farmasi_hw,
            'no_farmasi_gagal' => $this->no_farmasi_gagal,
            'no_farmasi_st' => $this->no_farmasi_st,
            'no_farmasi_jumlah' => $this->no_farmasi_jumlah,

            'denominator_farmasi' => $this->denominator_farmasi,

            'igd_sbl_kon_psn' => $this->igd_sbl_kon_psn,
            'igd_sbl_tin_aseptik' => $this->igd_sbl_tin_aseptik,
            'igd_stl_kon_cairan' => $this->igd_stl_kon_cairan,
            'igd_stl_kon_psn' => $this->igd_stl_kon_psn,
            'igd_stl_kon_ling_psn' => $this->igd_stl_kon_ling_psn,
            'igd_hr' => $this->igd_hr,
            'igd_hw' => $this->igd_hw,
            'igd_gagal' => $this->igd_gagal,
            'igd_st' => $this->igd_st,
            'igd_jumlah' => $this->igd_jumlah,

            'no_igd_sbl_kon_psn' => $this->no_igd_sbl_kon_psn,
            'no_igd_sbl_tin_aseptik' => $this->no_igd_sbl_tin_aseptik,
            'no_igd_stl_kon_cairan' => $this->no_igd_stl_kon_cairan,
            'no_igd_stl_kon_psn' => $this->no_igd_stl_kon_psn,
            'no_igd_stl_kon_ling_psn' => $this->no_igd_stl_kon_ling_psn,
            'no_igd_hr' => $this->no_igd_hr,
            'no_igd_hw' => $this->no_igd_hw,
            'no_igd_gagal' => $this->no_igd_gagal,
            'no_igd_st' => $this->no_igd_st,
            'no_igd_jumlah' => $this->no_igd_jumlah,

            'denominator_igd' => $this->denominator_igd,

            'int_sbl_kon_psn' => $this->int_sbl_kon_psn,
            'int_sbl_tin_aseptik' => $this->int_sbl_tin_aseptik,
            'int_stl_kon_cairan' => $this->int_stl_kon_cairan,
            'int_stl_kon_psn' => $this->int_stl_kon_psn,
            'int_stl_kon_ling_psn' => $this->int_stl_kon_ling_psn,
            'int_hr' => $this->int_hr,
            'int_hw' => $this->int_hw,
            'int_gagal' => $this->int_gagal,
            'int_st' => $this->int_st,
            'int_jumlah' => $this->int_jumlah,

            'no_int_sbl_kon_psn' => $this->no_int_sbl_kon_psn,
            'no_int_sbl_tin_aseptik' => $this->no_int_sbl_tin_aseptik,
            'no_int_stl_kon_cairan' => $this->no_int_stl_kon_cairan,
            'no_int_stl_kon_psn' => $this->no_int_stl_kon_psn,
            'no_int_stl_kon_ling_psn' => $this->no_int_stl_kon_ling_psn,
            'no_int_hr' => $this->no_int_hr,
            'no_int_hw' => $this->no_int_hw,
            'no_int_gagal' => $this->no_int_gagal,
            'no_int_st' => $this->no_int_st,
            'no_int_jumlah' => $this->no_int_jumlah,

            'denominator_int' => $this->denominator_int,

            'kbbl_sbl_kon_psn' => $this->kbbl_sbl_kon_psn,
            'kbbl_sbl_tin_aseptik' => $this->kbbl_sbl_tin_aseptik,
            'kbbl_stl_kon_cairan' => $this->kbbl_stl_kon_cairan,
            'kbbl_stl_kon_psn' => $this->kbbl_stl_kon_psn,
            'kbbl_stl_kon_ling_psn' => $this->kbbl_stl_kon_ling_psn,
            'kbbl_hr' => $this->kbbl_hr,
            'kbbl_hw' => $this->kbbl_hw,
            'kbbl_gagal' => $this->kbbl_gagal,
            'kbbl_st' => $this->kbbl_st,
            'kbbl_jumlah' => $this->kbbl_jumlah,

            'no_kbbl_sbl_kon_psn' => $this->no_kbbl_sbl_kon_psn,
            'no_kbbl_sbl_tin_aseptik' => $this->no_kbbl_sbl_tin_aseptik,
            'no_kbbl_stl_kon_cairan' => $this->no_kbbl_stl_kon_cairan,
            'no_kbbl_stl_kon_psn' => $this->no_kbbl_stl_kon_psn,
            'no_kbbl_stl_kon_ling_psn' => $this->no_kbbl_stl_kon_ling_psn,
            'no_kbbl_hr' => $this->no_kbbl_hr,
            'no_kbbl_hw' => $this->no_kbbl_hw,
            'no_kbbl_gagal' => $this->no_kbbl_gagal,
            'no_kbbl_st' => $this->no_kbbl_st,
            'no_kbbl_jumlah' => $this->no_kbbl_jumlah,

            'denominator_kbbl' => $this->denominator_kbbl,

            'lab_sbl_kon_psn' => $this->lab_sbl_kon_psn,
            'lab_sbl_tin_aseptik' => $this->lab_sbl_tin_aseptik,
            'lab_stl_kon_cairan' => $this->lab_stl_kon_cairan,
            'lab_stl_kon_psn' => $this->lab_stl_kon_psn,
            'lab_stl_kon_ling_psn' => $this->lab_stl_kon_ling_psn,
            'lab_hr' => $this->lab_hr,
            'lab_hw' => $this->lab_hw,
            'lab_gagal' => $this->lab_gagal,
            'lab_st' => $this->lab_st,
            'lab_jumlah' => $this->lab_jumlah,

            'no_lab_sbl_kon_psn' => $this->no_lab_sbl_kon_psn,
            'no_lab_sbl_tin_aseptik' => $this->no_lab_sbl_tin_aseptik,
            'no_lab_stl_kon_cairan' => $this->no_lab_stl_kon_cairan,
            'no_lab_stl_kon_psn' => $this->no_lab_stl_kon_psn,
            'no_lab_stl_kon_ling_psn' => $this->no_lab_stl_kon_ling_psn,
            'no_lab_hr' => $this->no_lab_hr,
            'no_lab_hw' => $this->no_lab_hw,
            'no_lab_gagal' => $this->no_lab_gagal,
            'no_lab_st' => $this->no_lab_st,
            'no_lab_jumlah' => $this->no_lab_jumlah,

            'denominator_lab' => $this->denominator_lab,

            'laundry_sbl_kon_psn' => $this->laundry_sbl_kon_psn,
            'laundry_sbl_tin_aseptik' => $this->laundry_sbl_tin_aseptik,
            'laundry_stl_kon_cairan' => $this->laundry_stl_kon_cairan,
            'laundry_stl_kon_psn' => $this->laundry_stl_kon_psn,
            'laundry_stl_kon_ling_psn' => $this->laundry_stl_kon_ling_psn,
            'laundry_hr' => $this->laundry_hr,
            'laundry_hw' => $this->laundry_hw,
            'laundry_gagal' => $this->laundry_gagal,
            'laundry_st' => $this->laundry_st,
            'laundry_jumlah' => $this->laundry_jumlah,

            'no_laundry_sbl_kon_psn' => $this->no_laundry_sbl_kon_psn,
            'no_laundry_sbl_tin_aseptik' => $this->no_laundry_sbl_tin_aseptik,
            'no_laundry_stl_kon_cairan' => $this->no_laundry_stl_kon_cairan,
            'no_laundry_stl_kon_psn' => $this->no_laundry_stl_kon_psn,
            'no_laundry_stl_kon_ling_psn' => $this->no_laundry_stl_kon_ling_psn,
            'no_laundry_hr' => $this->no_laundry_hr,
            'no_laundry_hw' => $this->no_laundry_hw,
            'no_laundry_gagal' => $this->no_laundry_gagal,
            'no_laundry_st' => $this->no_laundry_st,
            'no_laundry_jumlah' => $this->no_laundry_jumlah,

            'denominator_laundry' => $this->denominator_laundry,

            'ok_sbl_kon_psn' => $this->ok_sbl_kon_psn,
            'ok_sbl_tin_aseptik' => $this->ok_sbl_tin_aseptik,
            'ok_stl_kon_cairan' => $this->ok_stl_kon_cairan,
            'ok_stl_kon_psn' => $this->ok_stl_kon_psn,
            'ok_stl_kon_ling_psn' => $this->ok_stl_kon_ling_psn,
            'ok_hr' => $this->ok_hr,
            'ok_hw' => $this->ok_hw,
            'ok_gagal' => $this->ok_gagal,
            'ok_st' => $this->ok_st,
            'ok_jumlah' => $this->ok_jumlah,

            'no_ok_sbl_kon_psn' => $this->no_ok_sbl_kon_psn,
            'no_ok_sbl_tin_aseptik' => $this->no_ok_sbl_tin_aseptik,
            'no_ok_stl_kon_cairan' => $this->no_ok_stl_kon_cairan,
            'no_ok_stl_kon_psn' => $this->no_ok_stl_kon_psn,
            'no_ok_stl_kon_ling_psn' => $this->no_ok_stl_kon_ling_psn,
            'no_ok_hr' => $this->no_ok_hr,
            'no_ok_hw' => $this->no_ok_hw,
            'no_ok_gagal' => $this->no_ok_gagal,
            'no_ok_st' => $this->no_ok_st,
            'no_ok_jumlah' => $this->no_ok_jumlah,

            'denominator_ok' => $this->denominator_ok,

            'lt2_sbl_kon_psn' => $this->lt2_sbl_kon_psn,
            'lt2_sbl_tin_aseptik' => $this->lt2_sbl_tin_aseptik,
            'lt2_stl_kon_cairan' => $this->lt2_stl_kon_cairan,
            'lt2_stl_kon_psn' => $this->lt2_stl_kon_psn,
            'lt2_stl_kon_ling_psn' => $this->lt2_stl_kon_ling_psn,
            'lt2_hr' => $this->lt2_hr,
            'lt2_hw' => $this->lt2_hw,
            'lt2_gagal' => $this->lt2_gagal,
            'lt2_st' => $this->lt2_st,
            'lt2_jumlah' => $this->lt2_jumlah,

            'no_lt2_sbl_kon_psn' => $this->no_lt2_sbl_kon_psn,
            'no_lt2_sbl_tin_aseptik' => $this->no_lt2_sbl_tin_aseptik,
            'no_lt2_stl_kon_cairan' => $this->no_lt2_stl_kon_cairan,
            'no_lt2_stl_kon_psn' => $this->no_lt2_stl_kon_psn,
            'no_lt2_stl_kon_ling_psn' => $this->no_lt2_stl_kon_ling_psn,
            'no_lt2_hr' => $this->no_lt2_hr,
            'no_lt2_hw' => $this->no_lt2_hw,
            'no_lt2_gagal' => $this->no_lt2_gagal,
            'no_lt2_st' => $this->no_lt2_st,
            'no_lt2_jumlah' => $this->no_lt2_jumlah,

            'denominator_lt2' => $this->denominator_lt2,

            'lt4_sbl_kon_psn' => $this->lt4_sbl_kon_psn,
            'lt4_sbl_tin_aseptik' => $this->lt4_sbl_tin_aseptik,
            'lt4_stl_kon_cairan' => $this->lt4_stl_kon_cairan,
            'lt4_stl_kon_psn' => $this->lt4_stl_kon_psn,
            'lt4_stl_kon_ling_psn' => $this->lt4_stl_kon_ling_psn,
            'lt4_hr' => $this->lt4_hr,
            'lt4_hw' => $this->lt4_hw,
            'lt4_gagal' => $this->lt4_gagal,
            'lt4_st' => $this->lt4_st,
            'lt4_jumlah' => $this->lt4_jumlah,

            'no_lt4_sbl_kon_psn' => $this->no_lt4_sbl_kon_psn,
            'no_lt4_sbl_tin_aseptik' => $this->no_lt4_sbl_tin_aseptik,
            'no_lt4_stl_kon_cairan' => $this->no_lt4_stl_kon_cairan,
            'no_lt4_stl_kon_psn' => $this->no_lt4_stl_kon_psn,
            'no_lt4_stl_kon_ling_psn' => $this->no_lt4_stl_kon_ling_psn,
            'no_lt4_hr' => $this->no_lt4_hr,
            'no_lt4_hw' => $this->no_lt4_hw,
            'no_lt4_gagal' => $this->no_lt4_gagal,
            'no_lt4_st' => $this->no_lt4_st,
            'no_lt4_jumlah' => $this->no_lt4_jumlah,

            'denominator_lt4' => $this->denominator_lt4,

            'lt5_sbl_kon_psn' => $this->lt5_sbl_kon_psn,
            'lt5_sbl_tin_aseptik' => $this->lt5_sbl_tin_aseptik,
            'lt5_stl_kon_cairan' => $this->lt5_stl_kon_cairan,
            'lt5_stl_kon_psn' => $this->lt5_stl_kon_psn,
            'lt5_stl_kon_ling_psn' => $this->lt5_stl_kon_ling_psn,
            'lt5_hr' => $this->lt5_hr,
            'lt5_hw' => $this->lt5_hw,
            'lt5_gagal' => $this->lt5_gagal,
            'lt5_st' => $this->lt5_st,
            'lt5_jumlah' => $this->lt5_jumlah,

            'no_lt5_sbl_kon_psn' => $this->no_lt5_sbl_kon_psn,
            'no_lt5_sbl_tin_aseptik' => $this->no_lt5_sbl_tin_aseptik,
            'no_lt5_stl_kon_cairan' => $this->no_lt5_stl_kon_cairan,
            'no_lt5_stl_kon_psn' => $this->no_lt5_stl_kon_psn,
            'no_lt5_stl_kon_ling_psn' => $this->no_lt5_stl_kon_ling_psn,
            'no_lt5_hr' => $this->no_lt5_hr,
            'no_lt5_hw' => $this->no_lt5_hw,
            'no_lt5_gagal' => $this->no_lt5_gagal,
            'no_lt5_st' => $this->no_lt5_st,
            'no_lt5_jumlah' => $this->no_lt5_jumlah,

            'denominator_lt5' => $this->denominator_lt5,

            'poli_sbl_kon_psn' => $this->poli_sbl_kon_psn,
            'poli_sbl_tin_aseptik' => $this->poli_sbl_tin_aseptik,
            'poli_stl_kon_cairan' => $this->poli_stl_kon_cairan,
            'poli_stl_kon_psn' => $this->poli_stl_kon_psn,
            'poli_stl_kon_ling_psn' => $this->poli_stl_kon_ling_psn,
            'poli_hr' => $this->poli_hr,
            'poli_hw' => $this->poli_hw,
            'poli_gagal' => $this->poli_gagal,
            'poli_st' => $this->poli_st,
            'poli_jumlah' => $this->poli_jumlah,

            'no_poli_sbl_kon_psn' => $this->no_poli_sbl_kon_psn,
            'no_poli_sbl_tin_aseptik' => $this->no_poli_sbl_tin_aseptik,
            'no_poli_stl_kon_cairan' => $this->no_poli_stl_kon_cairan,
            'no_poli_stl_kon_psn' => $this->no_poli_stl_kon_psn,
            'no_poli_stl_kon_ling_psn' => $this->no_poli_stl_kon_ling_psn,
            'no_poli_hr' => $this->no_poli_hr,
            'no_poli_hw' => $this->no_poli_hw,
            'no_poli_gagal' => $this->no_poli_gagal,
            'no_poli_st' => $this->no_poli_st,
            'no_poli_jumlah' => $this->no_poli_jumlah,

            'denominator_poli' => $this->denominator_poli,

            'rad_sbl_kon_psn' => $this->rad_sbl_kon_psn,
            'rad_sbl_tin_aseptik' => $this->rad_sbl_tin_aseptik,
            'rad_stl_kon_cairan' => $this->rad_stl_kon_cairan,
            'rad_stl_kon_psn' => $this->rad_stl_kon_psn,
            'rad_stl_kon_ling_psn' => $this->rad_stl_kon_ling_psn,
            'rad_hr' => $this->rad_hr,
            'rad_hw' => $this->rad_hw,
            'rad_gagal' => $this->rad_gagal,
            'rad_st' => $this->rad_st,
            'rad_jumlah' => $this->rad_jumlah,

            'no_rad_sbl_kon_psn' => $this->no_rad_sbl_kon_psn,
            'no_rad_sbl_tin_aseptik' => $this->no_rad_sbl_tin_aseptik,
            'no_rad_stl_kon_cairan' => $this->no_rad_stl_kon_cairan,
            'no_rad_stl_kon_psn' => $this->no_rad_stl_kon_psn,
            'no_rad_stl_kon_ling_psn' => $this->no_rad_stl_kon_ling_psn,
            'no_rad_hr' => $this->no_rad_hr,
            'no_rad_hw' => $this->no_rad_hw,
            'no_rad_gagal' => $this->no_rad_gagal,
            'no_rad_st' => $this->no_rad_st,
            'no_rad_jumlah' => $this->no_rad_jumlah,

            'denominator_rad' => $this->denominator_rad,

            'vk_sbl_kon_psn' => $this->vk_sbl_kon_psn,
            'vk_sbl_tin_aseptik' => $this->vk_sbl_tin_aseptik,
            'vk_stl_kon_cairan' => $this->vk_stl_kon_cairan,
            'vk_stl_kon_psn' => $this->vk_stl_kon_psn,
            'vk_stl_kon_ling_psn' => $this->vk_stl_kon_ling_psn,
            'vk_hr' => $this->vk_hr,
            'vk_hw' => $this->vk_hw,
            'vk_gagal' => $this->vk_gagal,
            'vk_st' => $this->vk_st,
            'vk_jumlah' => $this->vk_jumlah,

            'no_vk_sbl_kon_psn' => $this->no_vk_sbl_kon_psn,
            'no_vk_sbl_tin_aseptik' => $this->no_vk_sbl_tin_aseptik,
            'no_vk_stl_kon_cairan' => $this->no_vk_stl_kon_cairan,
            'no_vk_stl_kon_psn' => $this->no_vk_stl_kon_psn,
            'no_vk_stl_kon_ling_psn' => $this->no_vk_stl_kon_ling_psn,
            'no_vk_hr' => $this->no_vk_hr,
            'no_vk_hw' => $this->no_vk_hw,
            'no_vk_gagal' => $this->no_vk_gagal,
            'no_vk_st' => $this->no_vk_st,
            'no_vk_jumlah' => $this->no_vk_jumlah,

            'denominator_vk' => $this->denominator_vk,
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:L2')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $event->sheet->getDelegate()->getStyle('B4:L20')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $event->sheet->getDelegate()->getStyle('A22:D22')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $event->sheet->getDelegate()->getStyle('A25:J42')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                // $event->sheet->getDelegate()->getStyle('A29:S29')
                //     ->getAlignment()
                //     ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                // $event->sheet->getDelegate()->getStyle('A35:S35')
                //     ->getAlignment()
                //     ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                // $event->sheet->getDelegate()->getStyle('A38:S38')
                //     ->getAlignment()
                //     ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                // $event->sheet->getDelegate()->getStyle('A44:S44')
                //     ->getAlignment()
                //     ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $event->sheet->getStyle('A1:L1')->applyFromArray([
                    'font' => [
                        'size'      =>  20,
                        'bold'      =>  true,
                    ],
                ]);

                $event->sheet->getStyle('A2:L2')->applyFromArray([
                    'font' => [
                        'size'      =>  15,
                        'bold'      =>  true,
                    ],
                ]);

                $event->sheet->getStyle('A4:L4')->applyFromArray([
                    'font' => [
                        'bold'      =>  true,
                    ],
                ]);

                $event->sheet->getStyle('A22:D22')->applyFromArray([
                    'font' => [
                        'bold'      =>  true,
                    ],
                ]);

                $event->sheet->getStyle('A5:A20')->applyFromArray([
                    'font' => [
                        'bold'      =>  true,
                    ],
                ]);

                $event->sheet->getStyle('A4:L20')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                $event->sheet->getStyle('A22:D23')->applyFromArray([
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
