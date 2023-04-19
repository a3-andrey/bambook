<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Arr;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    public $data = [
        'imya' => 'firstname',
        'familiya' => 'lastname',
        'otcestvo' => 'patronymic',
        'strana'  => 'country',
        'gorod'  => 'city',
        'telefon' => 'phone',
        'email'  => 'email',
        'status'  => 'active',
    ];


    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $data = $this->getDataArr($row);

        $data['profile'] = $this->getDataProfile($row);

        $user = User::updateOrCreate(
            [
                'email' => $row['email'],
                'phone' => $row['telefon'],
            ],
            $data
        );

    }

    private function getDataArr(array $row){
        $data = [];

        foreach ($this->data as $key=>$val){
            $data[$val] = Arr::get($row,$key);
        }

        return $data;
    }

    private function getDataProfile(array $row){
        $profileArr = [];

        foreach ($row as $key=>$item) {
            //profile
            foreach (User::PROFILE as $keyProf=>$profile){
                if($key == Arr::get($profile,'excel_row_name')){
                    $profileArr[$keyProf] = $item;
                }
            }
        }
        return $profileArr;
    }

}
