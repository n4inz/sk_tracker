<?php

namespace App\Exports;

use App\Models\User;

use Maatwebsite\Excel\Concerns\FromCollection;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class UsersExport implements FromView , WithHeadings ,ShouldAutoSize
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('exports.key_value', [
            'data' => collect($this->flattenArray($this->data))
        ]);
    }



    public function headings(): array
    {
        return ['Key', 'Value'];
    }

    protected function flattenArray($array, $prefix = ''): array
    {
        $arrayDatas = [];
       
        foreach($array as $jawaban){
            $data = json_decode($jawaban->jawaban, true);
            $result = [];
            foreach ($data as $key => $value) {
                if (is_array($value)) {
                    if (isset($value[0]) && is_array($value[0])) {
                        $formattedValue = implode(', ', array_column($value, 'jawaban'));
                    } else {
                        $formattedValue = $value['jawaban'];
                    }
                } else {
                    $formattedValue = $value;
                }
                
                $result[] = [
                    'Key' => $key,
                    'Value' => $formattedValue
                ];
            }


            array_push($arrayDatas,$result);
        }

        return $arrayDatas;


        $result = [
        
            [
                [
                'Key' =>  "Siapa nama anda",
                'Value' =>  "Nainz"
                ],
                [
                'Key' =>  "Bererpa umur anda",
                'Value' =>  "26"
                ],
                [
                'Key' =>  "Fakultas",
                'Value' =>  "Teknik"
                ],
                [
                'Key' =>  "Riwayat penyakit",
                'Value' =>  "Flue, Tipus"
                ]
            ],

            [
                [
                'Key' =>  "Siapa nama anda",
                'Value' =>  "fadil"
                ],
                [
                'Key' =>  "Bererpa umur anda",
                'Value' =>  "23"
                ],
                [
                'Key' =>  "Fakultas",
                'Value' =>  "Ekonomi"
                ],
                [
                'Key' =>  "Riwayat penyakit",
                'Value' =>  "Flue, Tipus ,Covid"
                ]
            ]
        ];
        

        return $result;
    }

 
}