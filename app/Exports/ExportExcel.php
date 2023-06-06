<?php

namespace App\Exports;

use Illuminate\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class ExportExcel implements FromView, ShouldAutoSize, WithEvents
// class ExportExcel implements FromCollection
{
    public function __construct(
        $int_pa_ivl,
        $int_pa_dc,
        $int_pa_vent,
        $int_pa_iad,
        $int_hais_plebitis,
        $int_hais_isk,
        $int_hais_vap,
        $int_hais_iad,
        $int_hais_deku,
        $int_hais_hap,
        $int_hais_ido,
        $int_terpajan,
        $int_tirah_baring,

        $lt2_pa_ivl,
        $lt2_pa_dc,
        $lt2_pa_vent,
        $lt2_pa_iad,
        $lt2_hais_plebitis,
        $lt2_hais_isk,
        $lt2_hais_vap,
        $lt2_hais_iad,
        $lt2_hais_deku,
        $lt2_hais_hap,
        $lt2_hais_ido,
        $lt2_terpajan,
        $lt2_tirah_baring,

        $lt4_pa_ivl,
        $lt4_pa_dc,
        $lt4_pa_vent,
        $lt4_pa_iad,
        $lt4_hais_plebitis,
        $lt4_hais_isk,
        $lt4_hais_vap,
        $lt4_hais_iad,
        $lt4_hais_deku,
        $lt4_hais_hap,
        $lt4_hais_ido,
        $lt4_terpajan,
        $lt4_tirah_baring,

        $lt5_pa_ivl,
        $lt5_pa_dc,
        $lt5_pa_vent,
        $lt5_pa_iad,
        $lt5_hais_plebitis,
        $lt5_hais_isk,
        $lt5_hais_vap,
        $lt5_hais_iad,
        $lt5_hais_deku,
        $lt5_hais_hap,
        $lt5_hais_ido,
        $lt5_terpajan,
        $lt5_tirah_baring,

        $vk_pa_ivl,
        $vk_pa_dc,
        $vk_pa_vent,
        $vk_pa_iad,
        $vk_hais_plebitis,
        $vk_hais_isk,
        $vk_hais_vap,
        $vk_hais_iad,
        $vk_hais_deku,
        $vk_hais_hap,
        $vk_hais_ido,
        $vk_terpajan,
        $vk_tirah_baring,

        $tabel,
        $rekap,
        $tanggal
    ) {
        $this->int_pa_ivl = $int_pa_ivl;
        $this->int_pa_dc = $int_pa_dc;
        $this->int_pa_vent = $int_pa_vent;
        $this->int_pa_iad = $int_pa_iad;
        $this->int_hais_plebitis = $int_hais_plebitis;
        $this->int_hais_isk = $int_hais_isk;
        $this->int_hais_vap = $int_hais_vap;
        $this->int_hais_iad = $int_hais_iad;
        $this->int_hais_deku = $int_hais_deku;
        $this->int_hais_hap = $int_hais_hap;
        $this->int_hais_ido = $int_hais_ido;
        $this->int_terpajan = $int_terpajan;
        $this->int_tirah_baring = $int_tirah_baring;

        $this->lt2_pa_ivl = $lt2_pa_ivl;
        $this->lt2_pa_dc = $lt2_pa_dc;
        $this->lt2_pa_vent = $lt2_pa_vent;
        $this->lt2_pa_iad = $lt2_pa_iad;
        $this->lt2_hais_plebitis = $lt2_hais_plebitis;
        $this->lt2_hais_isk = $lt2_hais_isk;
        $this->lt2_hais_vap = $lt2_hais_vap;
        $this->lt2_hais_iad = $lt2_hais_iad;
        $this->lt2_hais_deku = $lt2_hais_deku;
        $this->lt2_hais_hap = $lt2_hais_hap;
        $this->lt2_hais_ido = $lt2_hais_ido;
        $this->lt2_terpajan = $lt2_terpajan;
        $this->lt2_tirah_baring = $lt2_tirah_baring;

        $this->lt4_pa_ivl = $lt4_pa_ivl;
        $this->lt4_pa_dc = $lt4_pa_dc;
        $this->lt4_pa_vent = $lt4_pa_vent;
        $this->lt4_pa_iad = $lt4_pa_iad;
        $this->lt4_hais_plebitis = $lt4_hais_plebitis;
        $this->lt4_hais_isk = $lt4_hais_isk;
        $this->lt4_hais_vap = $lt4_hais_vap;
        $this->lt4_hais_iad = $lt4_hais_iad;
        $this->lt4_hais_deku = $lt4_hais_deku;
        $this->lt4_hais_hap = $lt4_hais_hap;
        $this->lt4_hais_ido = $lt4_hais_ido;
        $this->lt4_terpajan = $lt4_terpajan;
        $this->lt4_tirah_baring = $lt4_tirah_baring;

        $this->lt5_pa_ivl = $lt5_pa_ivl;
        $this->lt5_pa_dc = $lt5_pa_dc;
        $this->lt5_pa_vent = $lt5_pa_vent;
        $this->lt5_pa_iad = $lt5_pa_iad;
        $this->lt5_hais_plebitis = $lt5_hais_plebitis;
        $this->lt5_hais_isk = $lt5_hais_isk;
        $this->lt5_hais_vap = $lt5_hais_vap;
        $this->lt5_hais_iad = $lt5_hais_iad;
        $this->lt5_hais_deku = $lt5_hais_deku;
        $this->lt5_hais_hap = $lt5_hais_hap;
        $this->lt5_hais_ido = $lt5_hais_ido;
        $this->lt5_terpajan = $lt5_terpajan;
        $this->lt5_tirah_baring = $lt5_tirah_baring;

        $this->vk_pa_ivl = $vk_pa_ivl;
        $this->vk_pa_dc = $vk_pa_dc;
        $this->vk_pa_vent = $vk_pa_vent;
        $this->vk_pa_iad = $vk_pa_iad;
        $this->vk_hais_plebitis = $vk_hais_plebitis;
        $this->vk_hais_isk = $vk_hais_isk;
        $this->vk_hais_vap = $vk_hais_vap;
        $this->vk_hais_iad = $vk_hais_iad;
        $this->vk_hais_deku = $vk_hais_deku;
        $this->vk_hais_hap = $vk_hais_hap;
        $this->vk_hais_ido = $vk_hais_ido;
        $this->vk_terpajan = $vk_terpajan;
        $this->vk_tirah_baring = $vk_tirah_baring;

        $this->tabel = $tabel;
        $this->rekap = $rekap;
        $this->tanggal = $tanggal;
    }

    public function view(): View
    {
        return view('surveilansPPI.excel', [
            'tabel' => $this->tabel,
            'rekap' => $this->rekap,
            'tanggal' => $this->tanggal,

            'int_pa_ivl' => $this->int_pa_ivl,
            'int_pa_dc' => $this->int_pa_dc,
            'int_pa_vent' => $this->int_pa_vent,
            'int_pa_iad' => $this->int_pa_iad,
            'int_hais_plebitis' => $this->int_hais_plebitis,
            'int_hais_isk' => $this->int_hais_isk,
            'int_hais_vap' => $this->int_hais_vap,
            'int_hais_iad' => $this->int_hais_iad,
            'int_hais_deku' => $this->int_hais_deku,
            'int_hais_hap' => $this->int_hais_hap,
            'int_hais_ido' => $this->int_hais_ido,
            'int_terpajan' => $this->int_terpajan,
            'int_tirah_baring' => $this->int_tirah_baring,

            'lt2_pa_ivl' => $this->lt2_pa_ivl,
            'lt2_pa_dc' => $this->lt2_pa_dc,
            'lt2_pa_vent' => $this->lt2_pa_vent,
            'lt2_pa_iad' => $this->lt2_pa_iad,
            'lt2_hais_plebitis' => $this->lt2_hais_plebitis,
            'lt2_hais_isk' => $this->lt2_hais_isk,
            'lt2_hais_vap' => $this->lt2_hais_vap,
            'lt2_hais_iad' => $this->lt2_hais_iad,
            'lt2_hais_deku' => $this->lt2_hais_deku,
            'lt2_hais_hap' => $this->lt2_hais_hap,
            'lt2_hais_ido' => $this->lt2_hais_ido,
            'lt2_terpajan' => $this->lt2_terpajan,
            'lt2_tirah_baring' => $this->lt2_tirah_baring,

            'lt4_pa_ivl' => $this->lt4_pa_ivl,
            'lt4_pa_dc' => $this->lt4_pa_dc,
            'lt4_pa_vent' => $this->lt4_pa_vent,
            'lt4_pa_iad' => $this->lt4_pa_iad,
            'lt4_hais_plebitis' => $this->lt4_hais_plebitis,
            'lt4_hais_isk' => $this->lt4_hais_isk,
            'lt4_hais_vap' => $this->lt4_hais_vap,
            'lt4_hais_iad' => $this->lt4_hais_iad,
            'lt4_hais_deku' => $this->lt4_hais_deku,
            'lt4_hais_hap' => $this->lt4_hais_hap,
            'lt4_hais_ido' => $this->lt4_hais_ido,
            'lt4_terpajan' => $this->lt4_terpajan,
            'lt4_tirah_baring' => $this->lt4_tirah_baring,

            'lt5_pa_ivl' => $this->lt5_pa_ivl,
            'lt5_pa_dc' => $this->lt5_pa_dc,
            'lt5_pa_vent' => $this->lt5_pa_vent,
            'lt5_pa_iad' => $this->lt5_pa_iad,
            'lt5_hais_plebitis' => $this->lt5_hais_plebitis,
            'lt5_hais_isk' => $this->lt5_hais_isk,
            'lt5_hais_vap' => $this->lt5_hais_vap,
            'lt5_hais_iad' => $this->lt5_hais_iad,
            'lt5_hais_deku' => $this->lt5_hais_deku,
            'lt5_hais_hap' => $this->lt5_hais_hap,
            'lt5_hais_ido' => $this->lt5_hais_ido,
            'lt5_terpajan' => $this->lt5_terpajan,
            'lt5_tirah_baring' => $this->lt5_tirah_baring,

            'vk_pa_ivl' => $this->vk_pa_ivl,
            'vk_pa_dc' => $this->vk_pa_dc,
            'vk_pa_vent' => $this->vk_pa_vent,
            'vk_pa_iad' => $this->vk_pa_iad,
            'vk_hais_plebitis' => $this->vk_hais_plebitis,
            'vk_hais_isk' => $this->vk_hais_isk,
            'vk_hais_vap' => $this->vk_hais_vap,
            'vk_hais_iad' => $this->vk_hais_iad,
            'vk_hais_deku' => $this->vk_hais_deku,
            'vk_hais_hap' => $this->vk_hais_hap,
            'vk_hais_ido' => $this->vk_hais_ido,
            'vk_terpajan' => $this->vk_terpajan,
            'vk_tirah_baring' => $this->vk_tirah_baring,
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getDelegate()->getStyle('A1:N2')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $event->sheet->getDelegate()->getStyle('A4:N5')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $event->sheet->getDelegate()->getStyle('A12:F12')
                    ->getAlignment()
                    ->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

                $event->sheet->getDelegate()->getStyle('A15:N32')
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

                $event->sheet->getStyle('A1:S1')->applyFromArray([
                    'font' => [
                        'size'      =>  20,
                        'bold'      =>  true,
                    ],
                ]);

                $event->sheet->getStyle('A2:S2')->applyFromArray([
                    'font' => [
                        'size'      =>  15,
                        'bold'      =>  true,
                    ],
                ]);

                $event->sheet->getStyle('A4:N5')->applyFromArray([
                    'font' => [
                        'bold'      =>  true,
                    ],
                ]);

                $event->sheet->getStyle('A12:F12')->applyFromArray([
                    'font' => [
                        'bold'      =>  true,
                    ],
                ]);

                // $event->sheet->getStyle('A26:H26')->applyFromArray([
                //     'font' => [
                //         'bold'      =>  true,
                //     ],
                // ]);

                $event->sheet->getStyle('A4:N10')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                $event->sheet->getStyle('A12:F13')->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                $event->sheet->getDelegate()->getPageSetup()
                    ->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);

                $event->sheet->getDelegate()->getStyle('A1:N32')
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            },
        ];
    }
}
