<?php

namespace App\Exports;

use App\Models\User;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithDrawings;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class UserExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithStyles, WithCustomStartCell, WithDrawings
{
    protected $users;

    public function __construct()
    {
        $this->users = User::all(); 
    }

    public function collection()
    {
        return $this->users;
    }

    public function startCell(): string
    {
        return 'A7';
    }

    public function headings(): array
    {
        return [
            'Nombre del usuario',
            'Correo',
            'Rol',
            'Foto',
            'Estado',
        ];
    }

    public function map($users): array
    {
        return [
            $users->name . ' ' . $users->lastname,
            $users->email,
            \Util::role($users->role),
            '', 
            \Util::estado($users->status),
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A7:E7')->getFont()->setBold(true)->setSize(12)->getColor()->setARGB('000000');
        $sheet->getStyle('A7:E7')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('edb339');
        $sheet->setShowGridlines(false);

        $totalRows = $sheet->getHighestRow();

        $estilo = [
            'alignment' => ['wrapText' => true],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => 'edb339'],
                ]
            ],
            'font' => ['size' => 12],
        ];

        $estilo2 = [
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => 'fdfdfd'],
                ]
            ]
        ];

        $sheet->getStyle("A7:E{$totalRows}")->applyFromArray($estilo);
        $sheet->getStyle("A7:E7")->applyFromArray($estilo2);

        for ($i = 8; $i <= $totalRows; $i++) {
            $sheet->getRowDimension($i)->setRowHeight(50);
        }
    }

    public function drawings()
    {
        $drawings = [];
        $logo = new Drawing();
        $logo->setName('Logo');
        $logo->setDescription('This is my logo');
        $logo->setPath(public_path('/companies/' . session('logoCompany')));
        $logo->setHeight(90);
        $logo->setCoordinates('C1');
        $drawings[] = $logo;

        $row = 8; 
        foreach ($this->users as $user) {
            if (!empty($user->image) && file_exists(public_path('user/' . $user->image))) {
                $drawing = new Drawing();
                $drawing->setName('User Image');
                $drawing->setDescription('Imagen de usuario');
                $drawing->setPath(public_path('user/' . $user->image)); 
                $drawing->setHeight(50); 
                $drawing->setCoordinates('D' . $row); 
                $drawings[] = $drawing;
            }
            $row++;
        }
        return $drawings;
    }
}
