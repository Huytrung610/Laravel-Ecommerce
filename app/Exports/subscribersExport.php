<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\NewsletterSubcriber;

class subscribersExport implements WithHeadings,FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {   
        $subscribersData = NewsletterSubcriber::select('id', 'email_subcriber', 'created_at')->where('status','1')->orderBy('id','desc')->get();
        return $subscribersData;
    }
    public function headings(): array {
        return ['ID', 'Email', 'Subscribed on'] ;
    }
}
