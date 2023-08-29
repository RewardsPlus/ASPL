<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AttendanceReportImport implements WithMultipleSheets
{
    use Exportable;
    public $employee,$attendance,$from,$to;
    public function __construct($employee,$attendance,$from,$to)
    {
        $this->employee=$employee;
        $this->attendance=$attendance;
        $this->from=$from;
        $this->to=$to;
    }
    /**
    * @param Collection $collection
    */
    public function sheets(): array
    {
        return 
        [
            new AttendanceImport($this->attendance,$this->from,$this->to),
            new ConsolidateAttendanceImport($this->employee,$this->from,$this->to)
        ];
    }
}
