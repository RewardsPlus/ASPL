<?php

namespace App\Imports;

use App\Helpers\Helper;
use App\Models\Attendance;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;

class ConsolidateAttendanceImport implements FromCollection, WithMapping, WithHeadings,WithStyles,WithEvents,WithTitle 
{
    /**
    * @param Collection $collection
    */
    public $employee;
    public $from;
    public $to;
    public function __construct($employee,$from,$to)
    {
       $this->employee=$employee;
       $this->from=$from;
       $this->to=$to; 
    }
    public function collection()
    {
        return collect($this->employee);
    }

    public function map($row): array
    {
        $role='';
        foreach($row->getRoleNames() as $r){
            $role .=Helper::roleName($r).', ';
        }
        return [
            $row->employee->emp_code??'N/A',
            $row->name,
            $role,
            $row->uan_no,
            $row->store->detail->code,
            $row->attendances()->whereDate('date','>=',$this->from)->where('date','<=',$this->to)->sum('today_sale'),
            $row->attendances()->whereDate('date','>=',$this->from)->where('date','<=',$this->to)->where('status','present')->count()??0,
            $row->attendances()->whereDate('date','>=',$this->from)->where('date','<=',$this->to)->where('status','absent')->count()??0,
            $row->attendances()->whereDate('date','>=',$this->from)->where('date','<=',$this->to)->where('status','half-day')->count()??0,
            $row->attendances()->whereDate('date','>=',$this->from)->where('date','<=',$this->to)->where('status','paid-leave')->count()??0,
            $row->attendances()->whereDate('date','>=',$this->from)->where('date','<=',$this->to)->where('status','unpaid-leave')->count()??0,
            $row->attendances()->whereDate('date','>=',$this->from)->where('date','<=',$this->to)->where('status','na')->count()??0,

        ];
    }
    public function headings(): array
    {
        return [[' Attendance Sheet'
        ],['Period :       '.Carbon::parse($this->from)->format('d-m-Y').'                        To    '.Carbon::parse($this->to)->format('d-m-Y')],[
            'Employee Code',
            'Employee Name',
            'Designation',
            'UAN ID',
            'Store Code',
            'Gross Sales Value',
            'Presnt',
            'Absent',
            'Half-day',
            'Paid Leave',
            'Non-Paid Leave',
            'NA'
            ]
            // Add more headings as needed
        ];
    }
    public function styles(Worksheet $sheet)
    {
        return [
            // Style for the heading row
            1 => ['font' => ['bold' => true, 'size' => 14]],
        ];
    }

    public function registerEvents(): array
    {
        
        return [
            
            AfterSheet::class => function (AfterSheet $event) {
                $highestRow = $event->sheet->getHighestRow();
                $event->sheet->getDelegate()->mergeCells('A1:H1');
                $event->sheet->getDelegate()->mergeCells('A2:H2');
                $event->sheet->getStyle('A3:Z3')->applyFromArray([
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'color' => ['rgb' => '5c61f2'], // Change the color code as desired
                    ],
                    'font' => [
                        'color' => ['rgb' => 'FFFFFF'], // Set the text color to white
                    ],
                ]);
            },
        ];
    }

    public function title(): string
    {
        return 'Consolidate Report';
    }
}
