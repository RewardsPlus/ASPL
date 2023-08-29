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

class AttendanceImport implements FromCollection, WithMapping, WithHeadings,WithStyles,WithEvents,WithTitle 
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public $data,$from,$to;
    public function __construct($data,$from=null,$to=null)
    {
        $this->data=$data;
        $this->from=$from;
        $this->to=$to;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function map($row): array
    {
        $role='';
        foreach($row->employee->getRoleNames() as $r){
            $role .=Helper::roleName($r).', ';
        }
        return [
            Carbon::parse($row->date)->format('d-M-Y'),
            $row->employee->employee->emp_code??'N/A',
            $row->employee->name,
            $role,
            $row->uan_no,
            $row->employee->store->detail->code,
            $row->clock_in,
            $row->clock_out,
            ucwords($row->status),
            $row->today_sale,
        ];
    }
    public function headings(): array
    {
        return [['From    '.Carbon::parse($this->from)->format('d-m-Y').'                        To    '.Carbon::parse($this->to)->format('d-m-Y')],[
            'Date',
            'Employee Code',
            'Employee Name',
            'Designation',
            'UAN ID',
            'Store Code',
            'Clock In',
            'Clock Out',
            'Status',
            'Sales Value',
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
                $event->sheet->getStyle('A2:Z2')->applyFromArray([
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
        return 'Attendance List';
    }

}
