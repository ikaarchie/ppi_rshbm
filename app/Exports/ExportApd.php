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
        $cssu_pntp_kpl,
        $cssu_masker,
        $cssu_pntp_wjh,
        $cssu_apron,
        $cssu_srg_tgn,
        $cssu_alas_kaki,
        $cssu_lps_apd,
        $cssu_tdk_gtg_masker,
        $cssu_tdk_guna_srg_tgn,
        $cssu_jumlah,

        $no_cssu_pntp_kpl,
        $no_cssu_masker,
        $no_cssu_pntp_wjh,
        $no_cssu_apron,
        $no_cssu_srg_tgn,
        $no_cssu_alas_kaki,
        $no_cssu_lps_apd,
        $no_cssu_tdk_gtg_masker,
        $no_cssu_tdk_guna_srg_tgn,
        $no_cssu_jumlah,

        $denominator_cssu,

        $dapur_pntp_kpl,
        $dapur_masker,
        $dapur_pntp_wjh,
        $dapur_apron,
        $dapur_srg_tgn,
        $dapur_alas_kaki,
        $dapur_lps_apd,
        $dapur_tdk_gtg_masker,
        $dapur_tdk_guna_srg_tgn,
        $dapur_jumlah,

        $no_dapur_pntp_kpl,
        $no_dapur_masker,
        $no_dapur_pntp_wjh,
        $no_dapur_apron,
        $no_dapur_srg_tgn,
        $no_dapur_alas_kaki,
        $no_dapur_lps_apd,
        $no_dapur_tdk_gtg_masker,
        $no_dapur_tdk_guna_srg_tgn,
        $no_dapur_jumlah,

        $denominator_dapur,

        $dpjp_pntp_kpl,
        $dpjp_masker,
        $dpjp_pntp_wjh,
        $dpjp_apron,
        $dpjp_srg_tgn,
        $dpjp_alas_kaki,
        $dpjp_lps_apd,
        $dpjp_tdk_gtg_masker,
        $dpjp_tdk_guna_srg_tgn,
        $dpjp_jumlah,

        $no_dpjp_pntp_kpl,
        $no_dpjp_masker,
        $no_dpjp_pntp_wjh,
        $no_dpjp_apron,
        $no_dpjp_srg_tgn,
        $no_dpjp_alas_kaki,
        $no_dpjp_lps_apd,
        $no_dpjp_tdk_gtg_masker,
        $no_dpjp_tdk_guna_srg_tgn,
        $no_dpjp_jumlah,

        $denominator_dpjp,

        $farmasi_pntp_kpl,
        $farmasi_masker,
        $farmasi_pntp_wjh,
        $farmasi_apron,
        $farmasi_srg_tgn,
        $farmasi_alas_kaki,
        $farmasi_lps_apd,
        $farmasi_tdk_gtg_masker,
        $farmasi_tdk_guna_srg_tgn,
        $farmasi_jumlah,

        $no_farmasi_pntp_kpl,
        $no_farmasi_masker,
        $no_farmasi_pntp_wjh,
        $no_farmasi_apron,
        $no_farmasi_srg_tgn,
        $no_farmasi_alas_kaki,
        $no_farmasi_lps_apd,
        $no_farmasi_tdk_gtg_masker,
        $no_farmasi_tdk_guna_srg_tgn,
        $no_farmasi_jumlah,

        $denominator_farmasi,

        $igd_pntp_kpl,
        $igd_masker,
        $igd_pntp_wjh,
        $igd_apron,
        $igd_srg_tgn,
        $igd_alas_kaki,
        $igd_lps_apd,
        $igd_tdk_gtg_masker,
        $igd_tdk_guna_srg_tgn,
        $igd_jumlah,

        $no_igd_pntp_kpl,
        $no_igd_masker,
        $no_igd_pntp_wjh,
        $no_igd_apron,
        $no_igd_srg_tgn,
        $no_igd_alas_kaki,
        $no_igd_lps_apd,
        $no_igd_tdk_gtg_masker,
        $no_igd_tdk_guna_srg_tgn,
        $no_igd_jumlah,

        $denominator_igd,

        $int_pntp_kpl,
        $int_masker,
        $int_pntp_wjh,
        $int_apron,
        $int_srg_tgn,
        $int_alas_kaki,
        $int_lps_apd,
        $int_tdk_gtg_masker,
        $int_tdk_guna_srg_tgn,
        $int_jumlah,

        $no_int_pntp_kpl,
        $no_int_masker,
        $no_int_pntp_wjh,
        $no_int_apron,
        $no_int_srg_tgn,
        $no_int_alas_kaki,
        $no_int_lps_apd,
        $no_int_tdk_gtg_masker,
        $no_int_tdk_guna_srg_tgn,
        $no_int_jumlah,

        $denominator_int,

        $kbbl_pntp_kpl,
        $kbbl_masker,
        $kbbl_pntp_wjh,
        $kbbl_apron,
        $kbbl_srg_tgn,
        $kbbl_alas_kaki,
        $kbbl_lps_apd,
        $kbbl_tdk_gtg_masker,
        $kbbl_tdk_guna_srg_tgn,
        $kbbl_jumlah,

        $no_kbbl_pntp_kpl,
        $no_kbbl_masker,
        $no_kbbl_pntp_wjh,
        $no_kbbl_apron,
        $no_kbbl_srg_tgn,
        $no_kbbl_alas_kaki,
        $no_kbbl_lps_apd,
        $no_kbbl_tdk_gtg_masker,
        $no_kbbl_tdk_guna_srg_tgn,
        $no_kbbl_jumlah,

        $denominator_kbbl,

        $lab_pntp_kpl,
        $lab_masker,
        $lab_pntp_wjh,
        $lab_apron,
        $lab_srg_tgn,
        $lab_alas_kaki,
        $lab_lps_apd,
        $lab_tdk_gtg_masker,
        $lab_tdk_guna_srg_tgn,
        $lab_jumlah,

        $no_lab_pntp_kpl,
        $no_lab_masker,
        $no_lab_pntp_wjh,
        $no_lab_apron,
        $no_lab_srg_tgn,
        $no_lab_alas_kaki,
        $no_lab_lps_apd,
        $no_lab_tdk_gtg_masker,
        $no_lab_tdk_guna_srg_tgn,
        $no_lab_jumlah,

        $denominator_lab,

        $laundry_pntp_kpl,
        $laundry_masker,
        $laundry_pntp_wjh,
        $laundry_apron,
        $laundry_srg_tgn,
        $laundry_alas_kaki,
        $laundry_lps_apd,
        $laundry_tdk_gtg_masker,
        $laundry_tdk_guna_srg_tgn,
        $laundry_jumlah,

        $no_laundry_pntp_kpl,
        $no_laundry_masker,
        $no_laundry_pntp_wjh,
        $no_laundry_apron,
        $no_laundry_srg_tgn,
        $no_laundry_alas_kaki,
        $no_laundry_lps_apd,
        $no_laundry_tdk_gtg_masker,
        $no_laundry_tdk_guna_srg_tgn,
        $no_laundry_jumlah,

        $denominator_laundry,

        $ok_pntp_kpl,
        $ok_masker,
        $ok_pntp_wjh,
        $ok_apron,
        $ok_srg_tgn,
        $ok_alas_kaki,
        $ok_lps_apd,
        $ok_tdk_gtg_masker,
        $ok_tdk_guna_srg_tgn,
        $ok_jumlah,

        $no_ok_pntp_kpl,
        $no_ok_masker,
        $no_ok_pntp_wjh,
        $no_ok_apron,
        $no_ok_srg_tgn,
        $no_ok_alas_kaki,
        $no_ok_lps_apd,
        $no_ok_tdk_gtg_masker,
        $no_ok_tdk_guna_srg_tgn,
        $no_ok_jumlah,

        $denominator_ok,

        $lt2_pntp_kpl,
        $lt2_masker,
        $lt2_pntp_wjh,
        $lt2_apron,
        $lt2_srg_tgn,
        $lt2_alas_kaki,
        $lt2_lps_apd,
        $lt2_tdk_gtg_masker,
        $lt2_tdk_guna_srg_tgn,
        $lt2_jumlah,

        $no_lt2_pntp_kpl,
        $no_lt2_masker,
        $no_lt2_pntp_wjh,
        $no_lt2_apron,
        $no_lt2_srg_tgn,
        $no_lt2_alas_kaki,
        $no_lt2_lps_apd,
        $no_lt2_tdk_gtg_masker,
        $no_lt2_tdk_guna_srg_tgn,
        $no_lt2_jumlah,

        $denominator_lt2,

        $lt4_pntp_kpl,
        $lt4_masker,
        $lt4_pntp_wjh,
        $lt4_apron,
        $lt4_srg_tgn,
        $lt4_alas_kaki,
        $lt4_lps_apd,
        $lt4_tdk_gtg_masker,
        $lt4_tdk_guna_srg_tgn,
        $lt4_jumlah,

        $no_lt4_pntp_kpl,
        $no_lt4_masker,
        $no_lt4_pntp_wjh,
        $no_lt4_apron,
        $no_lt4_srg_tgn,
        $no_lt4_alas_kaki,
        $no_lt4_lps_apd,
        $no_lt4_tdk_gtg_masker,
        $no_lt4_tdk_guna_srg_tgn,
        $no_lt4_jumlah,

        $denominator_lt4,

        $lt5_pntp_kpl,
        $lt5_masker,
        $lt5_pntp_wjh,
        $lt5_apron,
        $lt5_srg_tgn,
        $lt5_alas_kaki,
        $lt5_lps_apd,
        $lt5_tdk_gtg_masker,
        $lt5_tdk_guna_srg_tgn,
        $lt5_jumlah,

        $no_lt5_pntp_kpl,
        $no_lt5_masker,
        $no_lt5_pntp_wjh,
        $no_lt5_apron,
        $no_lt5_srg_tgn,
        $no_lt5_alas_kaki,
        $no_lt5_lps_apd,
        $no_lt5_tdk_gtg_masker,
        $no_lt5_tdk_guna_srg_tgn,
        $no_lt5_jumlah,

        $denominator_lt5,

        $poli_pntp_kpl,
        $poli_masker,
        $poli_pntp_wjh,
        $poli_apron,
        $poli_srg_tgn,
        $poli_alas_kaki,
        $poli_lps_apd,
        $poli_tdk_gtg_masker,
        $poli_tdk_guna_srg_tgn,
        $poli_jumlah,

        $no_poli_pntp_kpl,
        $no_poli_masker,
        $no_poli_pntp_wjh,
        $no_poli_apron,
        $no_poli_srg_tgn,
        $no_poli_alas_kaki,
        $no_poli_lps_apd,
        $no_poli_tdk_gtg_masker,
        $no_poli_tdk_guna_srg_tgn,
        $no_poli_jumlah,

        $denominator_poli,

        $rad_pntp_kpl,
        $rad_masker,
        $rad_pntp_wjh,
        $rad_apron,
        $rad_srg_tgn,
        $rad_alas_kaki,
        $rad_lps_apd,
        $rad_tdk_gtg_masker,
        $rad_tdk_guna_srg_tgn,
        $rad_jumlah,

        $no_rad_pntp_kpl,
        $no_rad_masker,
        $no_rad_pntp_wjh,
        $no_rad_apron,
        $no_rad_srg_tgn,
        $no_rad_alas_kaki,
        $no_rad_lps_apd,
        $no_rad_tdk_gtg_masker,
        $no_rad_tdk_guna_srg_tgn,
        $no_rad_jumlah,

        $denominator_rad,

        $vk_pntp_kpl,
        $vk_masker,
        $vk_pntp_wjh,
        $vk_apron,
        $vk_srg_tgn,
        $vk_alas_kaki,
        $vk_lps_apd,
        $vk_tdk_gtg_masker,
        $vk_tdk_guna_srg_tgn,
        $vk_jumlah,

        $no_vk_pntp_kpl,
        $no_vk_masker,
        $no_vk_pntp_wjh,
        $no_vk_apron,
        $no_vk_srg_tgn,
        $no_vk_alas_kaki,
        $no_vk_lps_apd,
        $no_vk_tdk_gtg_masker,
        $no_vk_tdk_guna_srg_tgn,
        $no_vk_jumlah,

        $denominator_vk,

        $tabel,
        $rekap,
        $tanggal
    ) {
        $this->cssu_pntp_kpl = $cssu_pntp_kpl;
        $this->cssu_masker = $cssu_masker;
        $this->cssu_pntp_wjh = $cssu_pntp_wjh;
        $this->cssu_apron = $cssu_apron;
        $this->cssu_srg_tgn = $cssu_srg_tgn;
        $this->cssu_alas_kaki = $cssu_alas_kaki;
        $this->cssu_lps_apd = $cssu_lps_apd;
        $this->cssu_tdk_gtg_masker = $cssu_tdk_gtg_masker;
        $this->cssu_tdk_guna_srg_tgn = $cssu_tdk_guna_srg_tgn;
        $this->cssu_jumlah = $cssu_jumlah;

        $this->no_cssu_pntp_kpl = $no_cssu_pntp_kpl;
        $this->no_cssu_masker = $no_cssu_masker;
        $this->no_cssu_pntp_wjh = $no_cssu_pntp_wjh;
        $this->no_cssu_apron = $no_cssu_apron;
        $this->no_cssu_srg_tgn = $no_cssu_srg_tgn;
        $this->no_cssu_alas_kaki = $no_cssu_alas_kaki;
        $this->no_cssu_lps_apd = $no_cssu_lps_apd;
        $this->no_cssu_tdk_gtg_masker = $no_cssu_tdk_gtg_masker;
        $this->no_cssu_tdk_guna_srg_tgn = $no_cssu_tdk_guna_srg_tgn;
        $this->no_cssu_jumlah = $no_cssu_jumlah;

        $this->denominator_cssu = $denominator_cssu;

        $this->dapur_pntp_kpl = $dapur_pntp_kpl;
        $this->dapur_masker = $dapur_masker;
        $this->dapur_pntp_wjh = $dapur_pntp_wjh;
        $this->dapur_apron = $dapur_apron;
        $this->dapur_srg_tgn = $dapur_srg_tgn;
        $this->dapur_alas_kaki = $dapur_alas_kaki;
        $this->dapur_lps_apd = $dapur_lps_apd;
        $this->dapur_tdk_gtg_masker = $dapur_tdk_gtg_masker;
        $this->dapur_tdk_guna_srg_tgn = $dapur_tdk_guna_srg_tgn;
        $this->dapur_jumlah = $dapur_jumlah;

        $this->no_dapur_pntp_kpl = $no_dapur_pntp_kpl;
        $this->no_dapur_masker = $no_dapur_masker;
        $this->no_dapur_pntp_wjh = $no_dapur_pntp_wjh;
        $this->no_dapur_apron = $no_dapur_apron;
        $this->no_dapur_srg_tgn = $no_dapur_srg_tgn;
        $this->no_dapur_alas_kaki = $no_dapur_alas_kaki;
        $this->no_dapur_lps_apd = $no_dapur_lps_apd;
        $this->no_dapur_tdk_gtg_masker = $no_dapur_tdk_gtg_masker;
        $this->no_dapur_tdk_guna_srg_tgn = $no_dapur_tdk_guna_srg_tgn;
        $this->no_dapur_jumlah = $no_dapur_jumlah;

        $this->denominator_dapur = $denominator_dapur;

        $this->dpjp_pntp_kpl = $dpjp_pntp_kpl;
        $this->dpjp_masker = $dpjp_masker;
        $this->dpjp_pntp_wjh = $dpjp_pntp_wjh;
        $this->dpjp_apron = $dpjp_apron;
        $this->dpjp_srg_tgn = $dpjp_srg_tgn;
        $this->dpjp_alas_kaki = $dpjp_alas_kaki;
        $this->dpjp_lps_apd = $dpjp_lps_apd;
        $this->dpjp_tdk_gtg_masker = $dpjp_tdk_gtg_masker;
        $this->dpjp_tdk_guna_srg_tgn = $dpjp_tdk_guna_srg_tgn;
        $this->dpjp_jumlah = $dpjp_jumlah;

        $this->no_dpjp_pntp_kpl = $no_dpjp_pntp_kpl;
        $this->no_dpjp_masker = $no_dpjp_masker;
        $this->no_dpjp_pntp_wjh = $no_dpjp_pntp_wjh;
        $this->no_dpjp_apron = $no_dpjp_apron;
        $this->no_dpjp_srg_tgn = $no_dpjp_srg_tgn;
        $this->no_dpjp_alas_kaki = $no_dpjp_alas_kaki;
        $this->no_dpjp_lps_apd = $no_dpjp_lps_apd;
        $this->no_dpjp_tdk_gtg_masker = $no_dpjp_tdk_gtg_masker;
        $this->no_dpjp_tdk_guna_srg_tgn = $no_dpjp_tdk_guna_srg_tgn;
        $this->no_dpjp_jumlah = $no_dpjp_jumlah;

        $this->denominator_dpjp = $denominator_dpjp;

        $this->farmasi_pntp_kpl = $farmasi_pntp_kpl;
        $this->farmasi_masker = $farmasi_masker;
        $this->farmasi_pntp_wjh = $farmasi_pntp_wjh;
        $this->farmasi_apron = $farmasi_apron;
        $this->farmasi_srg_tgn = $farmasi_srg_tgn;
        $this->farmasi_alas_kaki = $farmasi_alas_kaki;
        $this->farmasi_lps_apd = $farmasi_lps_apd;
        $this->farmasi_tdk_gtg_masker = $farmasi_tdk_gtg_masker;
        $this->farmasi_tdk_guna_srg_tgn = $farmasi_tdk_guna_srg_tgn;
        $this->farmasi_jumlah = $farmasi_jumlah;

        $this->no_farmasi_pntp_kpl = $no_farmasi_pntp_kpl;
        $this->no_farmasi_masker = $no_farmasi_masker;
        $this->no_farmasi_pntp_wjh = $no_farmasi_pntp_wjh;
        $this->no_farmasi_apron = $no_farmasi_apron;
        $this->no_farmasi_srg_tgn = $no_farmasi_srg_tgn;
        $this->no_farmasi_alas_kaki = $no_farmasi_alas_kaki;
        $this->no_farmasi_lps_apd = $no_farmasi_lps_apd;
        $this->no_farmasi_tdk_gtg_masker = $no_farmasi_tdk_gtg_masker;
        $this->no_farmasi_tdk_guna_srg_tgn = $no_farmasi_tdk_guna_srg_tgn;
        $this->no_farmasi_jumlah = $no_farmasi_jumlah;

        $this->denominator_farmasi = $denominator_farmasi;

        $this->igd_pntp_kpl = $igd_pntp_kpl;
        $this->igd_masker = $igd_masker;
        $this->igd_pntp_wjh = $igd_pntp_wjh;
        $this->igd_apron = $igd_apron;
        $this->igd_srg_tgn = $igd_srg_tgn;
        $this->igd_alas_kaki = $igd_alas_kaki;
        $this->igd_lps_apd = $igd_lps_apd;
        $this->igd_tdk_gtg_masker = $igd_tdk_gtg_masker;
        $this->igd_tdk_guna_srg_tgn = $igd_tdk_guna_srg_tgn;
        $this->igd_jumlah = $igd_jumlah;

        $this->no_igd_pntp_kpl = $no_igd_pntp_kpl;
        $this->no_igd_masker = $no_igd_masker;
        $this->no_igd_pntp_wjh = $no_igd_pntp_wjh;
        $this->no_igd_apron = $no_igd_apron;
        $this->no_igd_srg_tgn = $no_igd_srg_tgn;
        $this->no_igd_alas_kaki = $no_igd_alas_kaki;
        $this->no_igd_lps_apd = $no_igd_lps_apd;
        $this->no_igd_tdk_gtg_masker = $no_igd_tdk_gtg_masker;
        $this->no_igd_tdk_guna_srg_tgn = $no_igd_tdk_guna_srg_tgn;
        $this->no_igd_jumlah = $no_igd_jumlah;

        $this->denominator_igd = $denominator_igd;

        $this->int_pntp_kpl = $int_pntp_kpl;
        $this->int_masker = $int_masker;
        $this->int_pntp_wjh = $int_pntp_wjh;
        $this->int_apron = $int_apron;
        $this->int_srg_tgn = $int_srg_tgn;
        $this->int_alas_kaki = $int_alas_kaki;
        $this->int_lps_apd = $int_lps_apd;
        $this->int_tdk_gtg_masker = $int_tdk_gtg_masker;
        $this->int_tdk_guna_srg_tgn = $int_tdk_guna_srg_tgn;
        $this->int_jumlah = $int_jumlah;

        $this->no_int_pntp_kpl = $no_int_pntp_kpl;
        $this->no_int_masker = $no_int_masker;
        $this->no_int_pntp_wjh = $no_int_pntp_wjh;
        $this->no_int_apron = $no_int_apron;
        $this->no_int_srg_tgn = $no_int_srg_tgn;
        $this->no_int_alas_kaki = $no_int_alas_kaki;
        $this->no_int_lps_apd = $no_int_lps_apd;
        $this->no_int_tdk_gtg_masker = $no_int_tdk_gtg_masker;
        $this->no_int_tdk_guna_srg_tgn = $no_int_tdk_guna_srg_tgn;
        $this->no_int_jumlah = $no_int_jumlah;

        $this->denominator_int = $denominator_int;

        $this->kbbl_pntp_kpl = $kbbl_pntp_kpl;
        $this->kbbl_masker = $kbbl_masker;
        $this->kbbl_pntp_wjh = $kbbl_pntp_wjh;
        $this->kbbl_apron = $kbbl_apron;
        $this->kbbl_srg_tgn = $kbbl_srg_tgn;
        $this->kbbl_alas_kaki = $kbbl_alas_kaki;
        $this->kbbl_lps_apd = $kbbl_lps_apd;
        $this->kbbl_tdk_gtg_masker = $kbbl_tdk_gtg_masker;
        $this->kbbl_tdk_guna_srg_tgn = $kbbl_tdk_guna_srg_tgn;
        $this->kbbl_jumlah = $kbbl_jumlah;

        $this->no_kbbl_pntp_kpl = $no_kbbl_pntp_kpl;
        $this->no_kbbl_masker = $no_kbbl_masker;
        $this->no_kbbl_pntp_wjh = $no_kbbl_pntp_wjh;
        $this->no_kbbl_apron = $no_kbbl_apron;
        $this->no_kbbl_srg_tgn = $no_kbbl_srg_tgn;
        $this->no_kbbl_alas_kaki = $no_kbbl_alas_kaki;
        $this->no_kbbl_lps_apd = $no_kbbl_lps_apd;
        $this->no_kbbl_tdk_gtg_masker = $no_kbbl_tdk_gtg_masker;
        $this->no_kbbl_tdk_guna_srg_tgn = $no_kbbl_tdk_guna_srg_tgn;
        $this->no_kbbl_jumlah = $no_kbbl_jumlah;

        $this->denominator_kbbl = $denominator_kbbl;

        $this->lab_pntp_kpl = $lab_pntp_kpl;
        $this->lab_masker = $lab_masker;
        $this->lab_pntp_wjh = $lab_pntp_wjh;
        $this->lab_apron = $lab_apron;
        $this->lab_srg_tgn = $lab_srg_tgn;
        $this->lab_alas_kaki = $lab_alas_kaki;
        $this->lab_lps_apd = $lab_lps_apd;
        $this->lab_tdk_gtg_masker = $lab_tdk_gtg_masker;
        $this->lab_tdk_guna_srg_tgn = $lab_tdk_guna_srg_tgn;
        $this->lab_jumlah = $lab_jumlah;

        $this->no_lab_pntp_kpl = $no_lab_pntp_kpl;
        $this->no_lab_masker = $no_lab_masker;
        $this->no_lab_pntp_wjh = $no_lab_pntp_wjh;
        $this->no_lab_apron = $no_lab_apron;
        $this->no_lab_srg_tgn = $no_lab_srg_tgn;
        $this->no_lab_alas_kaki = $no_lab_alas_kaki;
        $this->no_lab_lps_apd = $no_lab_lps_apd;
        $this->no_lab_tdk_gtg_masker = $no_lab_tdk_gtg_masker;
        $this->no_lab_tdk_guna_srg_tgn = $no_lab_tdk_guna_srg_tgn;
        $this->no_lab_jumlah = $no_lab_jumlah;

        $this->denominator_lab = $denominator_lab;

        $this->laundry_pntp_kpl = $laundry_pntp_kpl;
        $this->laundry_masker = $laundry_masker;
        $this->laundry_pntp_wjh = $laundry_pntp_wjh;
        $this->laundry_apron = $laundry_apron;
        $this->laundry_srg_tgn = $laundry_srg_tgn;
        $this->laundry_alas_kaki = $laundry_alas_kaki;
        $this->laundry_lps_apd = $laundry_lps_apd;
        $this->laundry_tdk_gtg_masker = $laundry_tdk_gtg_masker;
        $this->laundry_tdk_guna_srg_tgn = $laundry_tdk_guna_srg_tgn;
        $this->laundry_jumlah = $laundry_jumlah;

        $this->no_laundry_pntp_kpl = $no_laundry_pntp_kpl;
        $this->no_laundry_masker = $no_laundry_masker;
        $this->no_laundry_pntp_wjh = $no_laundry_pntp_wjh;
        $this->no_laundry_apron = $no_laundry_apron;
        $this->no_laundry_srg_tgn = $no_laundry_srg_tgn;
        $this->no_laundry_alas_kaki = $no_laundry_alas_kaki;
        $this->no_laundry_lps_apd = $no_laundry_lps_apd;
        $this->no_laundry_tdk_gtg_masker = $no_laundry_tdk_gtg_masker;
        $this->no_laundry_tdk_guna_srg_tgn = $no_laundry_tdk_guna_srg_tgn;
        $this->no_laundry_jumlah = $no_laundry_jumlah;

        $this->denominator_laundry = $denominator_laundry;

        $this->ok_pntp_kpl = $ok_pntp_kpl;
        $this->ok_masker = $ok_masker;
        $this->ok_pntp_wjh = $ok_pntp_wjh;
        $this->ok_apron = $ok_apron;
        $this->ok_srg_tgn = $ok_srg_tgn;
        $this->ok_alas_kaki = $ok_alas_kaki;
        $this->ok_lps_apd = $ok_lps_apd;
        $this->ok_tdk_gtg_masker = $ok_tdk_gtg_masker;
        $this->ok_tdk_guna_srg_tgn = $ok_tdk_guna_srg_tgn;
        $this->ok_jumlah = $ok_jumlah;

        $this->no_ok_pntp_kpl = $no_ok_pntp_kpl;
        $this->no_ok_masker = $no_ok_masker;
        $this->no_ok_pntp_wjh = $no_ok_pntp_wjh;
        $this->no_ok_apron = $no_ok_apron;
        $this->no_ok_srg_tgn = $no_ok_srg_tgn;
        $this->no_ok_alas_kaki = $no_ok_alas_kaki;
        $this->no_ok_lps_apd = $no_ok_lps_apd;
        $this->no_ok_tdk_gtg_masker = $no_ok_tdk_gtg_masker;
        $this->no_ok_tdk_guna_srg_tgn = $no_ok_tdk_guna_srg_tgn;
        $this->no_ok_jumlah = $no_ok_jumlah;

        $this->denominator_ok = $denominator_ok;

        $this->lt2_pntp_kpl = $lt2_pntp_kpl;
        $this->lt2_masker = $lt2_masker;
        $this->lt2_pntp_wjh = $lt2_pntp_wjh;
        $this->lt2_apron = $lt2_apron;
        $this->lt2_srg_tgn = $lt2_srg_tgn;
        $this->lt2_alas_kaki = $lt2_alas_kaki;
        $this->lt2_lps_apd = $lt2_lps_apd;
        $this->lt2_tdk_gtg_masker = $lt2_tdk_gtg_masker;
        $this->lt2_tdk_guna_srg_tgn = $lt2_tdk_guna_srg_tgn;
        $this->lt2_jumlah = $lt2_jumlah;

        $this->no_lt2_pntp_kpl = $no_lt2_pntp_kpl;
        $this->no_lt2_masker = $no_lt2_masker;
        $this->no_lt2_pntp_wjh = $no_lt2_pntp_wjh;
        $this->no_lt2_apron = $no_lt2_apron;
        $this->no_lt2_srg_tgn = $no_lt2_srg_tgn;
        $this->no_lt2_alas_kaki = $no_lt2_alas_kaki;
        $this->no_lt2_lps_apd = $no_lt2_lps_apd;
        $this->no_lt2_tdk_gtg_masker = $no_lt2_tdk_gtg_masker;
        $this->no_lt2_tdk_guna_srg_tgn = $no_lt2_tdk_guna_srg_tgn;
        $this->no_lt2_jumlah = $no_lt2_jumlah;

        $this->denominator_lt2 = $denominator_lt2;

        $this->lt4_pntp_kpl = $lt4_pntp_kpl;
        $this->lt4_masker = $lt4_masker;
        $this->lt4_pntp_wjh = $lt4_pntp_wjh;
        $this->lt4_apron = $lt4_apron;
        $this->lt4_srg_tgn = $lt4_srg_tgn;
        $this->lt4_alas_kaki = $lt4_alas_kaki;
        $this->lt4_lps_apd = $lt4_lps_apd;
        $this->lt4_tdk_gtg_masker = $lt4_tdk_gtg_masker;
        $this->lt4_tdk_guna_srg_tgn = $lt4_tdk_guna_srg_tgn;
        $this->lt4_jumlah = $lt4_jumlah;

        $this->no_lt4_pntp_kpl = $no_lt4_pntp_kpl;
        $this->no_lt4_masker = $no_lt4_masker;
        $this->no_lt4_pntp_wjh = $no_lt4_pntp_wjh;
        $this->no_lt4_apron = $no_lt4_apron;
        $this->no_lt4_srg_tgn = $no_lt4_srg_tgn;
        $this->no_lt4_alas_kaki = $no_lt4_alas_kaki;
        $this->no_lt4_lps_apd = $no_lt4_lps_apd;
        $this->no_lt4_tdk_gtg_masker = $no_lt4_tdk_gtg_masker;
        $this->no_lt4_tdk_guna_srg_tgn = $no_lt4_tdk_guna_srg_tgn;
        $this->no_lt4_jumlah = $no_lt4_jumlah;

        $this->denominator_lt4 = $denominator_lt4;

        $this->lt5_pntp_kpl = $lt5_pntp_kpl;
        $this->lt5_masker = $lt5_masker;
        $this->lt5_pntp_wjh = $lt5_pntp_wjh;
        $this->lt5_apron = $lt5_apron;
        $this->lt5_srg_tgn = $lt5_srg_tgn;
        $this->lt5_alas_kaki = $lt5_alas_kaki;
        $this->lt5_lps_apd = $lt5_lps_apd;
        $this->lt5_tdk_gtg_masker = $lt5_tdk_gtg_masker;
        $this->lt5_tdk_guna_srg_tgn = $lt5_tdk_guna_srg_tgn;
        $this->lt5_jumlah = $lt5_jumlah;

        $this->no_lt5_pntp_kpl = $no_lt5_pntp_kpl;
        $this->no_lt5_masker = $no_lt5_masker;
        $this->no_lt5_pntp_wjh = $no_lt5_pntp_wjh;
        $this->no_lt5_apron = $no_lt5_apron;
        $this->no_lt5_srg_tgn = $no_lt5_srg_tgn;
        $this->no_lt5_alas_kaki = $no_lt5_alas_kaki;
        $this->no_lt5_lps_apd = $no_lt5_lps_apd;
        $this->no_lt5_tdk_gtg_masker = $no_lt5_tdk_gtg_masker;
        $this->no_lt5_tdk_guna_srg_tgn = $no_lt5_tdk_guna_srg_tgn;
        $this->no_lt5_jumlah = $no_lt5_jumlah;

        $this->denominator_lt5 = $denominator_lt5;

        $this->poli_pntp_kpl = $poli_pntp_kpl;
        $this->poli_masker = $poli_masker;
        $this->poli_pntp_wjh = $poli_pntp_wjh;
        $this->poli_apron = $poli_apron;
        $this->poli_srg_tgn = $poli_srg_tgn;
        $this->poli_alas_kaki = $poli_alas_kaki;
        $this->poli_lps_apd = $poli_lps_apd;
        $this->poli_tdk_gtg_masker = $poli_tdk_gtg_masker;
        $this->poli_tdk_guna_srg_tgn = $poli_tdk_guna_srg_tgn;
        $this->poli_jumlah = $poli_jumlah;

        $this->no_poli_pntp_kpl = $no_poli_pntp_kpl;
        $this->no_poli_masker = $no_poli_masker;
        $this->no_poli_pntp_wjh = $no_poli_pntp_wjh;
        $this->no_poli_apron = $no_poli_apron;
        $this->no_poli_srg_tgn = $no_poli_srg_tgn;
        $this->no_poli_alas_kaki = $no_poli_alas_kaki;
        $this->no_poli_lps_apd = $no_poli_lps_apd;
        $this->no_poli_tdk_gtg_masker = $no_poli_tdk_gtg_masker;
        $this->no_poli_tdk_guna_srg_tgn = $no_poli_tdk_guna_srg_tgn;
        $this->no_poli_jumlah = $no_poli_jumlah;

        $this->denominator_poli = $denominator_poli;

        $this->rad_pntp_kpl = $rad_pntp_kpl;
        $this->rad_masker = $rad_masker;
        $this->rad_pntp_wjh = $rad_pntp_wjh;
        $this->rad_apron = $rad_apron;
        $this->rad_srg_tgn = $rad_srg_tgn;
        $this->rad_alas_kaki = $rad_alas_kaki;
        $this->rad_lps_apd = $rad_lps_apd;
        $this->rad_tdk_gtg_masker = $rad_tdk_gtg_masker;
        $this->rad_tdk_guna_srg_tgn = $rad_tdk_guna_srg_tgn;
        $this->rad_jumlah = $rad_jumlah;

        $this->no_rad_pntp_kpl = $no_rad_pntp_kpl;
        $this->no_rad_masker = $no_rad_masker;
        $this->no_rad_pntp_wjh = $no_rad_pntp_wjh;
        $this->no_rad_apron = $no_rad_apron;
        $this->no_rad_srg_tgn = $no_rad_srg_tgn;
        $this->no_rad_alas_kaki = $no_rad_alas_kaki;
        $this->no_rad_lps_apd = $no_rad_lps_apd;
        $this->no_rad_tdk_gtg_masker = $no_rad_tdk_gtg_masker;
        $this->no_rad_tdk_guna_srg_tgn = $no_rad_tdk_guna_srg_tgn;
        $this->no_rad_jumlah = $no_rad_jumlah;

        $this->denominator_rad = $denominator_rad;

        $this->vk_pntp_kpl = $vk_pntp_kpl;
        $this->vk_masker = $vk_masker;
        $this->vk_pntp_wjh = $vk_pntp_wjh;
        $this->vk_apron = $vk_apron;
        $this->vk_srg_tgn = $vk_srg_tgn;
        $this->vk_alas_kaki = $vk_alas_kaki;
        $this->vk_lps_apd = $vk_lps_apd;
        $this->vk_tdk_gtg_masker = $vk_tdk_gtg_masker;
        $this->vk_tdk_guna_srg_tgn = $vk_tdk_guna_srg_tgn;
        $this->vk_jumlah = $vk_jumlah;

        $this->no_vk_pntp_kpl = $no_vk_pntp_kpl;
        $this->no_vk_masker = $no_vk_masker;
        $this->no_vk_pntp_wjh = $no_vk_pntp_wjh;
        $this->no_vk_apron = $no_vk_apron;
        $this->no_vk_srg_tgn = $no_vk_srg_tgn;
        $this->no_vk_alas_kaki = $no_vk_alas_kaki;
        $this->no_vk_lps_apd = $no_vk_lps_apd;
        $this->no_vk_tdk_gtg_masker = $no_vk_tdk_gtg_masker;
        $this->no_vk_tdk_guna_srg_tgn = $no_vk_tdk_guna_srg_tgn;
        $this->no_vk_jumlah = $no_vk_jumlah;

        $this->denominator_vk = $denominator_vk;

        $this->tabel = $tabel;
        $this->rekap = $rekap;
        $this->tanggal = $tanggal;
    }

    public function view(): View
    {
        return view('rekapAPD.excel', [
            'tabel' => $this->tabel,
            'rekap' => $this->rekap,
            'tanggal' => $this->tanggal,

            'cssu_pntp_kpl' => $this->cssu_pntp_kpl,
            'cssu_masker' => $this->cssu_masker,
            'cssu_pntp_wjh' => $this->cssu_pntp_wjh,
            'cssu_apron' => $this->cssu_apron,
            'cssu_srg_tgn' => $this->cssu_srg_tgn,
            'cssu_alas_kaki' => $this->cssu_alas_kaki,
            'cssu_lps_apd' => $this->cssu_lps_apd,
            'cssu_tdk_gtg_masker' => $this->cssu_tdk_gtg_masker,
            'cssu_tdk_guna_srg_tgn' => $this->cssu_tdk_guna_srg_tgn,
            'cssu_jumlah' => $this->cssu_jumlah,

            'no_cssu_pntp_kpl' => $this->no_cssu_pntp_kpl,
            'no_cssu_masker' => $this->no_cssu_masker,
            'no_cssu_pntp_wjh' => $this->no_cssu_pntp_wjh,
            'no_cssu_apron' => $this->no_cssu_apron,
            'no_cssu_srg_tgn' => $this->no_cssu_srg_tgn,
            'no_cssu_alas_kaki' => $this->no_cssu_alas_kaki,
            'no_cssu_lps_apd' => $this->no_cssu_lps_apd,
            'no_cssu_tdk_gtg_masker' => $this->no_cssu_tdk_gtg_masker,
            'no_cssu_tdk_guna_srg_tgn' => $this->no_cssu_tdk_guna_srg_tgn,
            'no_cssu_jumlah' => $this->no_cssu_jumlah,

            'denominator_cssu' => $this->denominator_cssu,

            'dapur_pntp_kpl' => $this->dapur_pntp_kpl,
            'dapur_masker' => $this->dapur_masker,
            'dapur_pntp_wjh' => $this->dapur_pntp_wjh,
            'dapur_apron' => $this->dapur_apron,
            'dapur_srg_tgn' => $this->dapur_srg_tgn,
            'dapur_alas_kaki' => $this->dapur_alas_kaki,
            'dapur_lps_apd' => $this->dapur_lps_apd,
            'dapur_tdk_gtg_masker' => $this->dapur_tdk_gtg_masker,
            'dapur_tdk_guna_srg_tgn' => $this->dapur_tdk_guna_srg_tgn,
            'dapur_jumlah' => $this->dapur_jumlah,

            'no_dapur_pntp_kpl' => $this->no_dapur_pntp_kpl,
            'no_dapur_masker' => $this->no_dapur_masker,
            'no_dapur_pntp_wjh' => $this->no_dapur_pntp_wjh,
            'no_dapur_apron' => $this->no_dapur_apron,
            'no_dapur_srg_tgn' => $this->no_dapur_srg_tgn,
            'no_dapur_alas_kaki' => $this->no_dapur_alas_kaki,
            'no_dapur_lps_apd' => $this->no_dapur_lps_apd,
            'no_dapur_tdk_gtg_masker' => $this->no_dapur_tdk_gtg_masker,
            'no_dapur_tdk_guna_srg_tgn' => $this->no_dapur_tdk_guna_srg_tgn,
            'no_dapur_jumlah' => $this->no_dapur_jumlah,

            'denominator_dapur' => $this->denominator_dapur,

            'dpjp_pntp_kpl' => $this->dpjp_pntp_kpl,
            'dpjp_masker' => $this->dpjp_masker,
            'dpjp_pntp_wjh' => $this->dpjp_pntp_wjh,
            'dpjp_apron' => $this->dpjp_apron,
            'dpjp_srg_tgn' => $this->dpjp_srg_tgn,
            'dpjp_alas_kaki' => $this->dpjp_alas_kaki,
            'dpjp_lps_apd' => $this->dpjp_lps_apd,
            'dpjp_tdk_gtg_masker' => $this->dpjp_tdk_gtg_masker,
            'dpjp_tdk_guna_srg_tgn' => $this->dpjp_tdk_guna_srg_tgn,
            'dpjp_jumlah' => $this->dpjp_jumlah,

            'no_dpjp_pntp_kpl' => $this->no_dpjp_pntp_kpl,
            'no_dpjp_masker' => $this->no_dpjp_masker,
            'no_dpjp_pntp_wjh' => $this->no_dpjp_pntp_wjh,
            'no_dpjp_apron' => $this->no_dpjp_apron,
            'no_dpjp_srg_tgn' => $this->no_dpjp_srg_tgn,
            'no_dpjp_alas_kaki' => $this->no_dpjp_alas_kaki,
            'no_dpjp_lps_apd' => $this->no_dpjp_lps_apd,
            'no_dpjp_tdk_gtg_masker' => $this->no_dpjp_tdk_gtg_masker,
            'no_dpjp_tdk_guna_srg_tgn' => $this->no_dpjp_tdk_guna_srg_tgn,
            'no_dpjp_jumlah' => $this->no_dpjp_jumlah,

            'denominator_dpjp' => $this->denominator_dpjp,

            'farmasi_pntp_kpl' => $this->farmasi_pntp_kpl,
            'farmasi_masker' => $this->farmasi_masker,
            'farmasi_pntp_wjh' => $this->farmasi_pntp_wjh,
            'farmasi_apron' => $this->farmasi_apron,
            'farmasi_srg_tgn' => $this->farmasi_srg_tgn,
            'farmasi_alas_kaki' => $this->farmasi_alas_kaki,
            'farmasi_lps_apd' => $this->farmasi_lps_apd,
            'farmasi_tdk_gtg_masker' => $this->farmasi_tdk_gtg_masker,
            'farmasi_tdk_guna_srg_tgn' => $this->farmasi_tdk_guna_srg_tgn,
            'farmasi_jumlah' => $this->farmasi_jumlah,

            'no_farmasi_pntp_kpl' => $this->no_farmasi_pntp_kpl,
            'no_farmasi_masker' => $this->no_farmasi_masker,
            'no_farmasi_pntp_wjh' => $this->no_farmasi_pntp_wjh,
            'no_farmasi_apron' => $this->no_farmasi_apron,
            'no_farmasi_srg_tgn' => $this->no_farmasi_srg_tgn,
            'no_farmasi_alas_kaki' => $this->no_farmasi_alas_kaki,
            'no_farmasi_lps_apd' => $this->no_farmasi_lps_apd,
            'no_farmasi_tdk_gtg_masker' => $this->no_farmasi_tdk_gtg_masker,
            'no_farmasi_tdk_guna_srg_tgn' => $this->no_farmasi_tdk_guna_srg_tgn,
            'no_farmasi_jumlah' => $this->no_farmasi_jumlah,

            'denominator_farmasi' => $this->denominator_farmasi,

            'igd_pntp_kpl' => $this->igd_pntp_kpl,
            'igd_masker' => $this->igd_masker,
            'igd_pntp_wjh' => $this->igd_pntp_wjh,
            'igd_apron' => $this->igd_apron,
            'igd_srg_tgn' => $this->igd_srg_tgn,
            'igd_alas_kaki' => $this->igd_alas_kaki,
            'igd_lps_apd' => $this->igd_lps_apd,
            'igd_tdk_gtg_masker' => $this->igd_tdk_gtg_masker,
            'igd_tdk_guna_srg_tgn' => $this->igd_tdk_guna_srg_tgn,
            'igd_jumlah' => $this->igd_jumlah,

            'no_igd_pntp_kpl' => $this->no_igd_pntp_kpl,
            'no_igd_masker' => $this->no_igd_masker,
            'no_igd_pntp_wjh' => $this->no_igd_pntp_wjh,
            'no_igd_apron' => $this->no_igd_apron,
            'no_igd_srg_tgn' => $this->no_igd_srg_tgn,
            'no_igd_alas_kaki' => $this->no_igd_alas_kaki,
            'no_igd_lps_apd' => $this->no_igd_lps_apd,
            'no_igd_tdk_gtg_masker' => $this->no_igd_tdk_gtg_masker,
            'no_igd_tdk_guna_srg_tgn' => $this->no_igd_tdk_guna_srg_tgn,
            'no_igd_jumlah' => $this->no_igd_jumlah,

            'denominator_igd' => $this->denominator_igd,

            'int_pntp_kpl' => $this->int_pntp_kpl,
            'int_masker' => $this->int_masker,
            'int_pntp_wjh' => $this->int_pntp_wjh,
            'int_apron' => $this->int_apron,
            'int_srg_tgn' => $this->int_srg_tgn,
            'int_alas_kaki' => $this->int_alas_kaki,
            'int_lps_apd' => $this->int_lps_apd,
            'int_tdk_gtg_masker' => $this->int_tdk_gtg_masker,
            'int_tdk_guna_srg_tgn' => $this->int_tdk_guna_srg_tgn,
            'int_jumlah' => $this->int_jumlah,

            'no_int_pntp_kpl' => $this->no_int_pntp_kpl,
            'no_int_masker' => $this->no_int_masker,
            'no_int_pntp_wjh' => $this->no_int_pntp_wjh,
            'no_int_apron' => $this->no_int_apron,
            'no_int_srg_tgn' => $this->no_int_srg_tgn,
            'no_int_alas_kaki' => $this->no_int_alas_kaki,
            'no_int_lps_apd' => $this->no_int_lps_apd,
            'no_int_tdk_gtg_masker' => $this->no_int_tdk_gtg_masker,
            'no_int_tdk_guna_srg_tgn' => $this->no_int_tdk_guna_srg_tgn,
            'no_int_jumlah' => $this->no_int_jumlah,

            'denominator_int' => $this->denominator_int,

            'kbbl_pntp_kpl' => $this->kbbl_pntp_kpl,
            'kbbl_masker' => $this->kbbl_masker,
            'kbbl_pntp_wjh' => $this->kbbl_pntp_wjh,
            'kbbl_apron' => $this->kbbl_apron,
            'kbbl_srg_tgn' => $this->kbbl_srg_tgn,
            'kbbl_alas_kaki' => $this->kbbl_alas_kaki,
            'kbbl_lps_apd' => $this->kbbl_lps_apd,
            'kbbl_tdk_gtg_masker' => $this->kbbl_tdk_gtg_masker,
            'kbbl_tdk_guna_srg_tgn' => $this->kbbl_tdk_guna_srg_tgn,
            'kbbl_jumlah' => $this->kbbl_jumlah,

            'no_kbbl_pntp_kpl' => $this->no_kbbl_pntp_kpl,
            'no_kbbl_masker' => $this->no_kbbl_masker,
            'no_kbbl_pntp_wjh' => $this->no_kbbl_pntp_wjh,
            'no_kbbl_apron' => $this->no_kbbl_apron,
            'no_kbbl_srg_tgn' => $this->no_kbbl_srg_tgn,
            'no_kbbl_alas_kaki' => $this->no_kbbl_alas_kaki,
            'no_kbbl_lps_apd' => $this->no_kbbl_lps_apd,
            'no_kbbl_tdk_gtg_masker' => $this->no_kbbl_tdk_gtg_masker,
            'no_kbbl_tdk_guna_srg_tgn' => $this->no_kbbl_tdk_guna_srg_tgn,
            'no_kbbl_jumlah' => $this->no_kbbl_jumlah,

            'denominator_kbbl' => $this->denominator_kbbl,

            'lab_pntp_kpl' => $this->lab_pntp_kpl,
            'lab_masker' => $this->lab_masker,
            'lab_pntp_wjh' => $this->lab_pntp_wjh,
            'lab_apron' => $this->lab_apron,
            'lab_srg_tgn' => $this->lab_srg_tgn,
            'lab_alas_kaki' => $this->lab_alas_kaki,
            'lab_lps_apd' => $this->lab_lps_apd,
            'lab_tdk_gtg_masker' => $this->lab_tdk_gtg_masker,
            'lab_tdk_guna_srg_tgn' => $this->lab_tdk_guna_srg_tgn,
            'lab_jumlah' => $this->lab_jumlah,

            'no_lab_pntp_kpl' => $this->no_lab_pntp_kpl,
            'no_lab_masker' => $this->no_lab_masker,
            'no_lab_pntp_wjh' => $this->no_lab_pntp_wjh,
            'no_lab_apron' => $this->no_lab_apron,
            'no_lab_srg_tgn' => $this->no_lab_srg_tgn,
            'no_lab_alas_kaki' => $this->no_lab_alas_kaki,
            'no_lab_lps_apd' => $this->no_lab_lps_apd,
            'no_lab_tdk_gtg_masker' => $this->no_lab_tdk_gtg_masker,
            'no_lab_tdk_guna_srg_tgn' => $this->no_lab_tdk_guna_srg_tgn,
            'no_lab_jumlah' => $this->no_lab_jumlah,

            'denominator_lab' => $this->denominator_lab,

            'laundry_pntp_kpl' => $this->laundry_pntp_kpl,
            'laundry_masker' => $this->laundry_masker,
            'laundry_pntp_wjh' => $this->laundry_pntp_wjh,
            'laundry_apron' => $this->laundry_apron,
            'laundry_srg_tgn' => $this->laundry_srg_tgn,
            'laundry_alas_kaki' => $this->laundry_alas_kaki,
            'laundry_lps_apd' => $this->laundry_lps_apd,
            'laundry_tdk_gtg_masker' => $this->laundry_tdk_gtg_masker,
            'laundry_tdk_guna_srg_tgn' => $this->laundry_tdk_guna_srg_tgn,
            'laundry_jumlah' => $this->laundry_jumlah,

            'no_laundry_pntp_kpl' => $this->no_laundry_pntp_kpl,
            'no_laundry_masker' => $this->no_laundry_masker,
            'no_laundry_pntp_wjh' => $this->no_laundry_pntp_wjh,
            'no_laundry_apron' => $this->no_laundry_apron,
            'no_laundry_srg_tgn' => $this->no_laundry_srg_tgn,
            'no_laundry_alas_kaki' => $this->no_laundry_alas_kaki,
            'no_laundry_lps_apd' => $this->no_laundry_lps_apd,
            'no_laundry_tdk_gtg_masker' => $this->no_laundry_tdk_gtg_masker,
            'no_laundry_tdk_guna_srg_tgn' => $this->no_laundry_tdk_guna_srg_tgn,
            'no_laundry_jumlah' => $this->no_laundry_jumlah,

            'denominator_laundry' => $this->denominator_laundry,

            'ok_pntp_kpl' => $this->ok_pntp_kpl,
            'ok_masker' => $this->ok_masker,
            'ok_pntp_wjh' => $this->ok_pntp_wjh,
            'ok_apron' => $this->ok_apron,
            'ok_srg_tgn' => $this->ok_srg_tgn,
            'ok_alas_kaki' => $this->ok_alas_kaki,
            'ok_lps_apd' => $this->ok_lps_apd,
            'ok_tdk_gtg_masker' => $this->ok_tdk_gtg_masker,
            'ok_tdk_guna_srg_tgn' => $this->ok_tdk_guna_srg_tgn,
            'ok_jumlah' => $this->ok_jumlah,

            'no_ok_pntp_kpl' => $this->no_ok_pntp_kpl,
            'no_ok_masker' => $this->no_ok_masker,
            'no_ok_pntp_wjh' => $this->no_ok_pntp_wjh,
            'no_ok_apron' => $this->no_ok_apron,
            'no_ok_srg_tgn' => $this->no_ok_srg_tgn,
            'no_ok_alas_kaki' => $this->no_ok_alas_kaki,
            'no_ok_lps_apd' => $this->no_ok_lps_apd,
            'no_ok_tdk_gtg_masker' => $this->no_ok_tdk_gtg_masker,
            'no_ok_tdk_guna_srg_tgn' => $this->no_ok_tdk_guna_srg_tgn,
            'no_ok_jumlah' => $this->no_ok_jumlah,

            'denominator_ok' => $this->denominator_ok,

            'lt2_pntp_kpl' => $this->lt2_pntp_kpl,
            'lt2_masker' => $this->lt2_masker,
            'lt2_pntp_wjh' => $this->lt2_pntp_wjh,
            'lt2_apron' => $this->lt2_apron,
            'lt2_srg_tgn' => $this->lt2_srg_tgn,
            'lt2_alas_kaki' => $this->lt2_alas_kaki,
            'lt2_lps_apd' => $this->lt2_lps_apd,
            'lt2_tdk_gtg_masker' => $this->lt2_tdk_gtg_masker,
            'lt2_tdk_guna_srg_tgn' => $this->lt2_tdk_guna_srg_tgn,
            'lt2_jumlah' => $this->lt2_jumlah,

            'no_lt2_pntp_kpl' => $this->no_lt2_pntp_kpl,
            'no_lt2_masker' => $this->no_lt2_masker,
            'no_lt2_pntp_wjh' => $this->no_lt2_pntp_wjh,
            'no_lt2_apron' => $this->no_lt2_apron,
            'no_lt2_srg_tgn' => $this->no_lt2_srg_tgn,
            'no_lt2_alas_kaki' => $this->no_lt2_alas_kaki,
            'no_lt2_lps_apd' => $this->no_lt2_lps_apd,
            'no_lt2_tdk_gtg_masker' => $this->no_lt2_tdk_gtg_masker,
            'no_lt2_tdk_guna_srg_tgn' => $this->no_lt2_tdk_guna_srg_tgn,
            'no_lt2_jumlah' => $this->no_lt2_jumlah,

            'denominator_lt2' => $this->denominator_lt2,

            'lt4_pntp_kpl' => $this->lt4_pntp_kpl,
            'lt4_masker' => $this->lt4_masker,
            'lt4_pntp_wjh' => $this->lt4_pntp_wjh,
            'lt4_apron' => $this->lt4_apron,
            'lt4_srg_tgn' => $this->lt4_srg_tgn,
            'lt4_alas_kaki' => $this->lt4_alas_kaki,
            'lt4_lps_apd' => $this->lt4_lps_apd,
            'lt4_tdk_gtg_masker' => $this->lt4_tdk_gtg_masker,
            'lt4_tdk_guna_srg_tgn' => $this->lt4_tdk_guna_srg_tgn,
            'lt4_jumlah' => $this->lt4_jumlah,

            'no_lt4_pntp_kpl' => $this->no_lt4_pntp_kpl,
            'no_lt4_masker' => $this->no_lt4_masker,
            'no_lt4_pntp_wjh' => $this->no_lt4_pntp_wjh,
            'no_lt4_apron' => $this->no_lt4_apron,
            'no_lt4_srg_tgn' => $this->no_lt4_srg_tgn,
            'no_lt4_alas_kaki' => $this->no_lt4_alas_kaki,
            'no_lt4_lps_apd' => $this->no_lt4_lps_apd,
            'no_lt4_tdk_gtg_masker' => $this->no_lt4_tdk_gtg_masker,
            'no_lt4_tdk_guna_srg_tgn' => $this->no_lt4_tdk_guna_srg_tgn,
            'no_lt4_jumlah' => $this->no_lt4_jumlah,

            'denominator_lt4' => $this->denominator_lt4,

            'lt5_pntp_kpl' => $this->lt5_pntp_kpl,
            'lt5_masker' => $this->lt5_masker,
            'lt5_pntp_wjh' => $this->lt5_pntp_wjh,
            'lt5_apron' => $this->lt5_apron,
            'lt5_srg_tgn' => $this->lt5_srg_tgn,
            'lt5_alas_kaki' => $this->lt5_alas_kaki,
            'lt5_lps_apd' => $this->lt5_lps_apd,
            'lt5_tdk_gtg_masker' => $this->lt5_tdk_gtg_masker,
            'lt5_tdk_guna_srg_tgn' => $this->lt5_tdk_guna_srg_tgn,
            'lt5_jumlah' => $this->lt5_jumlah,

            'no_lt5_pntp_kpl' => $this->no_lt5_pntp_kpl,
            'no_lt5_masker' => $this->no_lt5_masker,
            'no_lt5_pntp_wjh' => $this->no_lt5_pntp_wjh,
            'no_lt5_apron' => $this->no_lt5_apron,
            'no_lt5_srg_tgn' => $this->no_lt5_srg_tgn,
            'no_lt5_alas_kaki' => $this->no_lt5_alas_kaki,
            'no_lt5_lps_apd' => $this->no_lt5_lps_apd,
            'no_lt5_tdk_gtg_masker' => $this->no_lt5_tdk_gtg_masker,
            'no_lt5_tdk_guna_srg_tgn' => $this->no_lt5_tdk_guna_srg_tgn,
            'no_lt5_jumlah' => $this->no_lt5_jumlah,

            'denominator_lt5' => $this->denominator_lt5,

            'poli_pntp_kpl' => $this->poli_pntp_kpl,
            'poli_masker' => $this->poli_masker,
            'poli_pntp_wjh' => $this->poli_pntp_wjh,
            'poli_apron' => $this->poli_apron,
            'poli_srg_tgn' => $this->poli_srg_tgn,
            'poli_alas_kaki' => $this->poli_alas_kaki,
            'poli_lps_apd' => $this->poli_lps_apd,
            'poli_tdk_gtg_masker' => $this->poli_tdk_gtg_masker,
            'poli_tdk_guna_srg_tgn' => $this->poli_tdk_guna_srg_tgn,
            'poli_jumlah' => $this->poli_jumlah,

            'no_poli_pntp_kpl' => $this->no_poli_pntp_kpl,
            'no_poli_masker' => $this->no_poli_masker,
            'no_poli_pntp_wjh' => $this->no_poli_pntp_wjh,
            'no_poli_apron' => $this->no_poli_apron,
            'no_poli_srg_tgn' => $this->no_poli_srg_tgn,
            'no_poli_alas_kaki' => $this->no_poli_alas_kaki,
            'no_poli_lps_apd' => $this->no_poli_lps_apd,
            'no_poli_tdk_gtg_masker' => $this->no_poli_tdk_gtg_masker,
            'no_poli_tdk_guna_srg_tgn' => $this->no_poli_tdk_guna_srg_tgn,
            'no_poli_jumlah' => $this->no_poli_jumlah,

            'denominator_poli' => $this->denominator_poli,

            'rad_pntp_kpl' => $this->rad_pntp_kpl,
            'rad_masker' => $this->rad_masker,
            'rad_pntp_wjh' => $this->rad_pntp_wjh,
            'rad_apron' => $this->rad_apron,
            'rad_srg_tgn' => $this->rad_srg_tgn,
            'rad_alas_kaki' => $this->rad_alas_kaki,
            'rad_lps_apd' => $this->rad_lps_apd,
            'rad_tdk_gtg_masker' => $this->rad_tdk_gtg_masker,
            'rad_tdk_guna_srg_tgn' => $this->rad_tdk_guna_srg_tgn,
            'rad_jumlah' => $this->rad_jumlah,

            'no_rad_pntp_kpl' => $this->no_rad_pntp_kpl,
            'no_rad_masker' => $this->no_rad_masker,
            'no_rad_pntp_wjh' => $this->no_rad_pntp_wjh,
            'no_rad_apron' => $this->no_rad_apron,
            'no_rad_srg_tgn' => $this->no_rad_srg_tgn,
            'no_rad_alas_kaki' => $this->no_rad_alas_kaki,
            'no_rad_lps_apd' => $this->no_rad_lps_apd,
            'no_rad_tdk_gtg_masker' => $this->no_rad_tdk_gtg_masker,
            'no_rad_tdk_guna_srg_tgn' => $this->no_rad_tdk_guna_srg_tgn,
            'no_rad_jumlah' => $this->no_rad_jumlah,

            'denominator_rad' => $this->denominator_rad,

            'vk_pntp_kpl' => $this->vk_pntp_kpl,
            'vk_masker' => $this->vk_masker,
            'vk_pntp_wjh' => $this->vk_pntp_wjh,
            'vk_apron' => $this->vk_apron,
            'vk_srg_tgn' => $this->vk_srg_tgn,
            'vk_alas_kaki' => $this->vk_alas_kaki,
            'vk_lps_apd' => $this->vk_lps_apd,
            'vk_tdk_gtg_masker' => $this->vk_tdk_gtg_masker,
            'vk_tdk_guna_srg_tgn' => $this->vk_tdk_guna_srg_tgn,
            'vk_jumlah' => $this->vk_jumlah,

            'no_vk_pntp_kpl' => $this->no_vk_pntp_kpl,
            'no_vk_masker' => $this->no_vk_masker,
            'no_vk_pntp_wjh' => $this->no_vk_pntp_wjh,
            'no_vk_apron' => $this->no_vk_apron,
            'no_vk_srg_tgn' => $this->no_vk_srg_tgn,
            'no_vk_alas_kaki' => $this->no_vk_alas_kaki,
            'no_vk_lps_apd' => $this->no_vk_lps_apd,
            'no_vk_tdk_gtg_masker' => $this->no_vk_tdk_gtg_masker,
            'no_vk_tdk_guna_srg_tgn' => $this->no_vk_tdk_guna_srg_tgn,
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
