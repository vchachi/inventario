<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromArray;

class ExportPlantilla implements FromArray
{
    protected $plantilla;

    public function __construct(array $plantilla)
    {
        $this->plantilla = $plantilla;
    }

    public function array(): array
    {
        return $this->plantilla;
    }
}
