<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class KrsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $krsList;

    public function __construct($krsList)
    {
        $this->krsList = $krsList;
    }

    public function collection()
    {
        return $this->krsList;
    }

    public function headings(): array
    {
        return ['NPM', 'Nama Mahasiswa', 'Kode Matakuliah', 'Nama Matakuliah', 'SKS'];
    }

    public function map($krs): array
    {
        return [
            $krs->npm,
            $krs->mahasiswa->nama ?? '-',
            $krs->kode_matakuliah,
            $krs->matakuliah->nama_matakuliah ?? '-',
            $krs->matakuliah->sks ?? '-',
        ];
    }
}
