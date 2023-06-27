<?php

namespace App\Exports;

use Illuminate\View\View;
use App\Models\CuciTangan;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class ExportCuciTangan implements FromView, ShouldAutoSize, WithEvents
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

        $dapur_sbl_kon_psn,
        $dapur_sbl_tin_aseptik,
        $dapur_stl_kon_cairan,
        $dapur_stl_kon_psn,
        $dapur_stl_kon_ling_psn,
        $dapur_hr,
        $dapur_hw,
        $dapur_gagal,
        $dapur_st,

        $dpjp_sbl_kon_psn,
        $dpjp_sbl_tin_aseptik,
        $dpjp_stl_kon_cairan,
        $dpjp_stl_kon_psn,
        $dpjp_stl_kon_ling_psn,
        $dpjp_hr,
        $dpjp_hw,
        $dpjp_gagal,
        $dpjp_st,

        $farmasi_sbl_kon_psn,
        $farmasi_sbl_tin_aseptik,
        $farmasi_stl_kon_cairan,
        $farmasi_stl_kon_psn,
        $farmasi_stl_kon_ling_psn,
        $farmasi_hr,
        $farmasi_hw,
        $farmasi_gagal,
        $farmasi_st,

        $igd_sbl_kon_psn,
        $igd_sbl_tin_aseptik,
        $igd_stl_kon_cairan,
        $igd_stl_kon_psn,
        $igd_stl_kon_ling_psn,
        $igd_hr,
        $igd_hw,
        $igd_gagal,
        $igd_st,

        $int_sbl_kon_psn,
        $int_sbl_tin_aseptik,
        $int_stl_kon_cairan,
        $int_stl_kon_psn,
        $int_stl_kon_ling_psn,
        $int_hr,
        $int_hw,
        $int_gagal,
        $int_st,

        $kbbl_sbl_kon_psn,
        $kbbl_sbl_tin_aseptik,
        $kbbl_stl_kon_cairan,
        $kbbl_stl_kon_psn,
        $kbbl_stl_kon_ling_psn,
        $kbbl_hr,
        $kbbl_hw,
        $kbbl_gagal,
        $kbbl_st,

        $lab_sbl_kon_psn,
        $lab_sbl_tin_aseptik,
        $lab_stl_kon_cairan,
        $lab_stl_kon_psn,
        $lab_stl_kon_ling_psn,
        $lab_hr,
        $lab_hw,
        $lab_gagal,
        $lab_st,

        $laundry_sbl_kon_psn,
        $laundry_sbl_tin_aseptik,
        $laundry_stl_kon_cairan,
        $laundry_stl_kon_psn,
        $laundry_stl_kon_ling_psn,
        $laundry_hr,
        $laundry_hw,
        $laundry_gagal,
        $laundry_st,

        $ok_sbl_kon_psn,
        $ok_sbl_tin_aseptik,
        $ok_stl_kon_cairan,
        $ok_stl_kon_psn,
        $ok_stl_kon_ling_psn,
        $ok_hr,
        $ok_hw,
        $ok_gagal,
        $ok_st,

        $lt2_sbl_kon_psn,
        $lt2_sbl_tin_aseptik,
        $lt2_stl_kon_cairan,
        $lt2_stl_kon_psn,
        $lt2_stl_kon_ling_psn,
        $lt2_hr,
        $lt2_hw,
        $lt2_gagal,
        $lt2_st,

        $lt4_sbl_kon_psn,
        $lt4_sbl_tin_aseptik,
        $lt4_stl_kon_cairan,
        $lt4_stl_kon_psn,
        $lt4_stl_kon_ling_psn,
        $lt4_hr,
        $lt4_hw,
        $lt4_gagal,
        $lt4_st,

        $lt5_sbl_kon_psn,
        $lt5_sbl_tin_aseptik,
        $lt5_stl_kon_cairan,
        $lt5_stl_kon_psn,
        $lt5_stl_kon_ling_psn,
        $lt5_hr,
        $lt5_hw,
        $lt5_gagal,
        $lt5_st,

        $poli_sbl_kon_psn,
        $poli_sbl_tin_aseptik,
        $poli_stl_kon_cairan,
        $poli_stl_kon_psn,
        $poli_stl_kon_ling_psn,
        $poli_hr,
        $poli_hw,
        $poli_gagal,
        $poli_st,

        $rad_sbl_kon_psn,
        $rad_sbl_tin_aseptik,
        $rad_stl_kon_cairan,
        $rad_stl_kon_psn,
        $rad_stl_kon_ling_psn,
        $rad_hr,
        $rad_hw,
        $rad_gagal,
        $rad_st,

        $vk_sbl_kon_psn,
        $vk_sbl_tin_aseptik,
        $vk_stl_kon_cairan,
        $vk_stl_kon_psn,
        $vk_stl_kon_ling_psn,
        $vk_hr,
        $vk_hw,
        $vk_gagal,
        $vk_st,

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

        $this->dapur_sbl_kon_psn = $dapur_sbl_kon_psn;
        $this->dapur_sbl_tin_aseptik = $dapur_sbl_tin_aseptik;
        $this->dapur_stl_kon_cairan = $dapur_stl_kon_cairan;
        $this->dapur_stl_kon_psn = $dapur_stl_kon_psn;
        $this->dapur_stl_kon_ling_psn = $dapur_stl_kon_ling_psn;
        $this->dapur_hr = $dapur_hr;
        $this->dapur_hw = $dapur_hw;
        $this->dapur_gagal = $dapur_gagal;
        $this->dapur_st = $dapur_st;

        $this->dpjp_sbl_kon_psn = $dpjp_sbl_kon_psn;
        $this->dpjp_sbl_tin_aseptik = $dpjp_sbl_tin_aseptik;
        $this->dpjp_stl_kon_cairan = $dpjp_stl_kon_cairan;
        $this->dpjp_stl_kon_psn = $dpjp_stl_kon_psn;
        $this->dpjp_stl_kon_ling_psn = $dpjp_stl_kon_ling_psn;
        $this->dpjp_hr = $dpjp_hr;
        $this->dpjp_hw = $dpjp_hw;
        $this->dpjp_gagal = $dpjp_gagal;
        $this->dpjp_st = $dpjp_st;

        $this->farmasi_sbl_kon_psn = $farmasi_sbl_kon_psn;
        $this->farmasi_sbl_tin_aseptik = $farmasi_sbl_tin_aseptik;
        $this->farmasi_stl_kon_cairan = $farmasi_stl_kon_cairan;
        $this->farmasi_stl_kon_psn = $farmasi_stl_kon_psn;
        $this->farmasi_stl_kon_ling_psn = $farmasi_stl_kon_ling_psn;
        $this->farmasi_hr = $farmasi_hr;
        $this->farmasi_hw = $farmasi_hw;
        $this->farmasi_gagal = $farmasi_gagal;
        $this->farmasi_st = $farmasi_st;

        $this->igd_sbl_kon_psn = $igd_sbl_kon_psn;
        $this->igd_sbl_tin_aseptik = $igd_sbl_tin_aseptik;
        $this->igd_stl_kon_cairan = $igd_stl_kon_cairan;
        $this->igd_stl_kon_psn = $igd_stl_kon_psn;
        $this->igd_stl_kon_ling_psn = $igd_stl_kon_ling_psn;
        $this->igd_hr = $igd_hr;
        $this->igd_hw = $igd_hw;
        $this->igd_gagal = $igd_gagal;
        $this->igd_st = $igd_st;

        $this->int_sbl_kon_psn = $int_sbl_kon_psn;
        $this->int_sbl_tin_aseptik = $int_sbl_tin_aseptik;
        $this->int_stl_kon_cairan = $int_stl_kon_cairan;
        $this->int_stl_kon_psn = $int_stl_kon_psn;
        $this->int_stl_kon_ling_psn = $int_stl_kon_ling_psn;
        $this->int_hr = $int_hr;
        $this->int_hw = $int_hw;
        $this->int_gagal = $int_gagal;
        $this->int_st = $int_st;

        $this->kbbl_sbl_kon_psn = $kbbl_sbl_kon_psn;
        $this->kbbl_sbl_tin_aseptik = $kbbl_sbl_tin_aseptik;
        $this->kbbl_stl_kon_cairan = $kbbl_stl_kon_cairan;
        $this->kbbl_stl_kon_psn = $kbbl_stl_kon_psn;
        $this->kbbl_stl_kon_ling_psn = $kbbl_stl_kon_ling_psn;
        $this->kbbl_hr = $kbbl_hr;
        $this->kbbl_hw = $kbbl_hw;
        $this->kbbl_gagal = $kbbl_gagal;
        $this->kbbl_st = $kbbl_st;

        $this->lab_sbl_kon_psn = $lab_sbl_kon_psn;
        $this->lab_sbl_tin_aseptik = $lab_sbl_tin_aseptik;
        $this->lab_stl_kon_cairan = $lab_stl_kon_cairan;
        $this->lab_stl_kon_psn = $lab_stl_kon_psn;
        $this->lab_stl_kon_ling_psn = $lab_stl_kon_ling_psn;
        $this->lab_hr = $lab_hr;
        $this->lab_hw = $lab_hw;
        $this->lab_gagal = $lab_gagal;
        $this->lab_st = $lab_st;

        $this->laundry_sbl_kon_psn = $laundry_sbl_kon_psn;
        $this->laundry_sbl_tin_aseptik = $laundry_sbl_tin_aseptik;
        $this->laundry_stl_kon_cairan = $laundry_stl_kon_cairan;
        $this->laundry_stl_kon_psn = $laundry_stl_kon_psn;
        $this->laundry_stl_kon_ling_psn = $laundry_stl_kon_ling_psn;
        $this->laundry_hr = $laundry_hr;
        $this->laundry_hw = $laundry_hw;
        $this->laundry_gagal = $laundry_gagal;
        $this->laundry_st = $laundry_st;

        $this->ok_sbl_kon_psn = $ok_sbl_kon_psn;
        $this->ok_sbl_tin_aseptik = $ok_sbl_tin_aseptik;
        $this->ok_stl_kon_cairan = $ok_stl_kon_cairan;
        $this->ok_stl_kon_psn = $ok_stl_kon_psn;
        $this->ok_stl_kon_ling_psn = $ok_stl_kon_ling_psn;
        $this->ok_hr = $ok_hr;
        $this->ok_hw = $ok_hw;
        $this->ok_gagal = $ok_gagal;
        $this->ok_st = $ok_st;

        $this->lt2_sbl_kon_psn = $lt2_sbl_kon_psn;
        $this->lt2_sbl_tin_aseptik = $lt2_sbl_tin_aseptik;
        $this->lt2_stl_kon_cairan = $lt2_stl_kon_cairan;
        $this->lt2_stl_kon_psn = $lt2_stl_kon_psn;
        $this->lt2_stl_kon_ling_psn = $lt2_stl_kon_ling_psn;
        $this->lt2_hr = $lt2_hr;
        $this->lt2_hw = $lt2_hw;
        $this->lt2_gagal = $lt2_gagal;
        $this->lt2_st = $lt2_st;

        $this->lt4_sbl_kon_psn = $lt4_sbl_kon_psn;
        $this->lt4_sbl_tin_aseptik = $lt4_sbl_tin_aseptik;
        $this->lt4_stl_kon_cairan = $lt4_stl_kon_cairan;
        $this->lt4_stl_kon_psn = $lt4_stl_kon_psn;
        $this->lt4_stl_kon_ling_psn = $lt4_stl_kon_ling_psn;
        $this->lt4_hr = $lt4_hr;
        $this->lt4_hw = $lt4_hw;
        $this->lt4_gagal = $lt4_gagal;
        $this->lt4_st = $lt4_st;

        $this->lt5_sbl_kon_psn = $lt5_sbl_kon_psn;
        $this->lt5_sbl_tin_aseptik = $lt5_sbl_tin_aseptik;
        $this->lt5_stl_kon_cairan = $lt5_stl_kon_cairan;
        $this->lt5_stl_kon_psn = $lt5_stl_kon_psn;
        $this->lt5_stl_kon_ling_psn = $lt5_stl_kon_ling_psn;
        $this->lt5_hr = $lt5_hr;
        $this->lt5_hw = $lt5_hw;
        $this->lt5_gagal = $lt5_gagal;
        $this->lt5_st = $lt5_st;

        $this->poli_sbl_kon_psn = $poli_sbl_kon_psn;
        $this->poli_sbl_tin_aseptik = $poli_sbl_tin_aseptik;
        $this->poli_stl_kon_cairan = $poli_stl_kon_cairan;
        $this->poli_stl_kon_psn = $poli_stl_kon_psn;
        $this->poli_stl_kon_ling_psn = $poli_stl_kon_ling_psn;
        $this->poli_hr = $poli_hr;
        $this->poli_hw = $poli_hw;
        $this->poli_gagal = $poli_gagal;
        $this->poli_st = $poli_st;

        $this->rad_sbl_kon_psn = $rad_sbl_kon_psn;
        $this->rad_sbl_tin_aseptik = $rad_sbl_tin_aseptik;
        $this->rad_stl_kon_cairan = $rad_stl_kon_cairan;
        $this->rad_stl_kon_psn = $rad_stl_kon_psn;
        $this->rad_stl_kon_ling_psn = $rad_stl_kon_ling_psn;
        $this->rad_hr = $rad_hr;
        $this->rad_hw = $rad_hw;
        $this->rad_gagal = $rad_gagal;
        $this->rad_st = $rad_st;

        $this->vk_sbl_kon_psn = $vk_sbl_kon_psn;
        $this->vk_sbl_tin_aseptik = $vk_sbl_tin_aseptik;
        $this->vk_stl_kon_cairan = $vk_stl_kon_cairan;
        $this->vk_stl_kon_psn = $vk_stl_kon_psn;
        $this->vk_stl_kon_ling_psn = $vk_stl_kon_ling_psn;
        $this->vk_hr = $vk_hr;
        $this->vk_hw = $vk_hw;
        $this->vk_gagal = $vk_gagal;
        $this->vk_st = $vk_st;

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

            'dapur_sbl_kon_psn' => $this->dapur_sbl_kon_psn,
            'dapur_sbl_tin_aseptik' => $this->dapur_sbl_tin_aseptik,
            'dapur_stl_kon_cairan' => $this->dapur_stl_kon_cairan,
            'dapur_stl_kon_psn' => $this->dapur_stl_kon_psn,
            'dapur_stl_kon_ling_psn' => $this->dapur_stl_kon_ling_psn,
            'dapur_hr' => $this->dapur_hr,
            'dapur_hw' => $this->dapur_hw,
            'dapur_gagal' => $this->dapur_gagal,
            'dapur_st' => $this->dapur_st,

            'dpjp_sbl_kon_psn' => $this->dpjp_sbl_kon_psn,
            'dpjp_sbl_tin_aseptik' => $this->dpjp_sbl_tin_aseptik,
            'dpjp_stl_kon_cairan' => $this->dpjp_stl_kon_cairan,
            'dpjp_stl_kon_psn' => $this->dpjp_stl_kon_psn,
            'dpjp_stl_kon_ling_psn' => $this->dpjp_stl_kon_ling_psn,
            'dpjp_hr' => $this->dpjp_hr,
            'dpjp_hw' => $this->dpjp_hw,
            'dpjp_gagal' => $this->dpjp_gagal,
            'dpjp_st' => $this->dpjp_st,

            'farmasi_sbl_kon_psn' => $this->farmasi_sbl_kon_psn,
            'farmasi_sbl_tin_aseptik' => $this->farmasi_sbl_tin_aseptik,
            'farmasi_stl_kon_cairan' => $this->farmasi_stl_kon_cairan,
            'farmasi_stl_kon_psn' => $this->farmasi_stl_kon_psn,
            'farmasi_stl_kon_ling_psn' => $this->farmasi_stl_kon_ling_psn,
            'farmasi_hr' => $this->farmasi_hr,
            'farmasi_hw' => $this->farmasi_hw,
            'farmasi_gagal' => $this->farmasi_gagal,
            'farmasi_st' => $this->farmasi_st,

            'igd_sbl_kon_psn' => $this->igd_sbl_kon_psn,
            'igd_sbl_tin_aseptik' => $this->igd_sbl_tin_aseptik,
            'igd_stl_kon_cairan' => $this->igd_stl_kon_cairan,
            'igd_stl_kon_psn' => $this->igd_stl_kon_psn,
            'igd_stl_kon_ling_psn' => $this->igd_stl_kon_ling_psn,
            'igd_hr' => $this->igd_hr,
            'igd_hw' => $this->igd_hw,
            'igd_gagal' => $this->igd_gagal,
            'igd_st' => $this->igd_st,

            'int_sbl_kon_psn' => $this->int_sbl_kon_psn,
            'int_sbl_tin_aseptik' => $this->int_sbl_tin_aseptik,
            'int_stl_kon_cairan' => $this->int_stl_kon_cairan,
            'int_stl_kon_psn' => $this->int_stl_kon_psn,
            'int_stl_kon_ling_psn' => $this->int_stl_kon_ling_psn,
            'int_hr' => $this->int_hr,
            'int_hw' => $this->int_hw,
            'int_gagal' => $this->int_gagal,
            'int_st' => $this->int_st,

            'kbbl_sbl_kon_psn' => $this->kbbl_sbl_kon_psn,
            'kbbl_sbl_tin_aseptik' => $this->kbbl_sbl_tin_aseptik,
            'kbbl_stl_kon_cairan' => $this->kbbl_stl_kon_cairan,
            'kbbl_stl_kon_psn' => $this->kbbl_stl_kon_psn,
            'kbbl_stl_kon_ling_psn' => $this->kbbl_stl_kon_ling_psn,
            'kbbl_hr' => $this->kbbl_hr,
            'kbbl_hw' => $this->kbbl_hw,
            'kbbl_gagal' => $this->kbbl_gagal,
            'kbbl_st' => $this->kbbl_st,

            'lab_sbl_kon_psn' => $this->lab_sbl_kon_psn,
            'lab_sbl_tin_aseptik' => $this->lab_sbl_tin_aseptik,
            'lab_stl_kon_cairan' => $this->lab_stl_kon_cairan,
            'lab_stl_kon_psn' => $this->lab_stl_kon_psn,
            'lab_stl_kon_ling_psn' => $this->lab_stl_kon_ling_psn,
            'lab_hr' => $this->lab_hr,
            'lab_hw' => $this->lab_hw,
            'lab_gagal' => $this->lab_gagal,
            'lab_st' => $this->lab_st,

            'laundry_sbl_kon_psn' => $this->laundry_sbl_kon_psn,
            'laundry_sbl_tin_aseptik' => $this->laundry_sbl_tin_aseptik,
            'laundry_stl_kon_cairan' => $this->laundry_stl_kon_cairan,
            'laundry_stl_kon_psn' => $this->laundry_stl_kon_psn,
            'laundry_stl_kon_ling_psn' => $this->laundry_stl_kon_ling_psn,
            'laundry_hr' => $this->laundry_hr,
            'laundry_hw' => $this->laundry_hw,
            'laundry_gagal' => $this->laundry_gagal,
            'laundry_st' => $this->laundry_st,

            'ok_sbl_kon_psn' => $this->ok_sbl_kon_psn,
            'ok_sbl_tin_aseptik' => $this->ok_sbl_tin_aseptik,
            'ok_stl_kon_cairan' => $this->ok_stl_kon_cairan,
            'ok_stl_kon_psn' => $this->ok_stl_kon_psn,
            'ok_stl_kon_ling_psn' => $this->ok_stl_kon_ling_psn,
            'ok_hr' => $this->ok_hr,
            'ok_hw' => $this->ok_hw,
            'ok_gagal' => $this->ok_gagal,
            'ok_st' => $this->ok_st,

            'lt2_sbl_kon_psn' => $this->lt2_sbl_kon_psn,
            'lt2_sbl_tin_aseptik' => $this->lt2_sbl_tin_aseptik,
            'lt2_stl_kon_cairan' => $this->lt2_stl_kon_cairan,
            'lt2_stl_kon_psn' => $this->lt2_stl_kon_psn,
            'lt2_stl_kon_ling_psn' => $this->lt2_stl_kon_ling_psn,
            'lt2_hr' => $this->lt2_hr,
            'lt2_hw' => $this->lt2_hw,
            'lt2_gagal' => $this->lt2_gagal,
            'lt2_st' => $this->lt2_st,

            'lt4_sbl_kon_psn' => $this->lt4_sbl_kon_psn,
            'lt4_sbl_tin_aseptik' => $this->lt4_sbl_tin_aseptik,
            'lt4_stl_kon_cairan' => $this->lt4_stl_kon_cairan,
            'lt4_stl_kon_psn' => $this->lt4_stl_kon_psn,
            'lt4_stl_kon_ling_psn' => $this->lt4_stl_kon_ling_psn,
            'lt4_hr' => $this->lt4_hr,
            'lt4_hw' => $this->lt4_hw,
            'lt4_gagal' => $this->lt4_gagal,
            'lt4_st' => $this->lt4_st,

            'lt5_sbl_kon_psn' => $this->lt5_sbl_kon_psn,
            'lt5_sbl_tin_aseptik' => $this->lt5_sbl_tin_aseptik,
            'lt5_stl_kon_cairan' => $this->lt5_stl_kon_cairan,
            'lt5_stl_kon_psn' => $this->lt5_stl_kon_psn,
            'lt5_stl_kon_ling_psn' => $this->lt5_stl_kon_ling_psn,
            'lt5_hr' => $this->lt5_hr,
            'lt5_hw' => $this->lt5_hw,
            'lt5_gagal' => $this->lt5_gagal,
            'lt5_st' => $this->lt5_st,

            'poli_sbl_kon_psn' => $this->poli_sbl_kon_psn,
            'poli_sbl_tin_aseptik' => $this->poli_sbl_tin_aseptik,
            'poli_stl_kon_cairan' => $this->poli_stl_kon_cairan,
            'poli_stl_kon_psn' => $this->poli_stl_kon_psn,
            'poli_stl_kon_ling_psn' => $this->poli_stl_kon_ling_psn,
            'poli_hr' => $this->poli_hr,
            'poli_hw' => $this->poli_hw,
            'poli_gagal' => $this->poli_gagal,
            'poli_st' => $this->poli_st,

            'rad_sbl_kon_psn' => $this->rad_sbl_kon_psn,
            'rad_sbl_tin_aseptik' => $this->rad_sbl_tin_aseptik,
            'rad_stl_kon_cairan' => $this->rad_stl_kon_cairan,
            'rad_stl_kon_psn' => $this->rad_stl_kon_psn,
            'rad_stl_kon_ling_psn' => $this->rad_stl_kon_ling_psn,
            'rad_hr' => $this->rad_hr,
            'rad_hw' => $this->rad_hw,
            'rad_gagal' => $this->rad_gagal,
            'rad_st' => $this->rad_st,

            'vk_sbl_kon_psn' => $this->vk_sbl_kon_psn,
            'vk_sbl_tin_aseptik' => $this->vk_sbl_tin_aseptik,
            'vk_stl_kon_cairan' => $this->vk_stl_kon_cairan,
            'vk_stl_kon_psn' => $this->vk_stl_kon_psn,
            'vk_stl_kon_ling_psn' => $this->vk_stl_kon_ling_psn,
            'vk_hr' => $this->vk_hr,
            'vk_hw' => $this->vk_hw,
            'vk_gagal' => $this->vk_gagal,
            'vk_st' => $this->vk_st,
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:J2')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $event->sheet->getDelegate()->getStyle('B4:J20')
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

                $event->sheet->getStyle('A1:J1')->applyFromArray([
                    'font' => [
                        'size'      =>  20,
                        'bold'      =>  true,
                    ],
                ]);

                $event->sheet->getStyle('A2:J2')->applyFromArray([
                    'font' => [
                        'size'      =>  15,
                        'bold'      =>  true,
                    ],
                ]);

                $event->sheet->getStyle('A4:J4')->applyFromArray([
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

                $event->sheet->getStyle('A4:J20')->applyFromArray([
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
