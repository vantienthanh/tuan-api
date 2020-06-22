<?php


namespace Modules\User\Transformers;


use Illuminate\Http\Resources\Json\Resource;

class UserInformationTransformers extends Resource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'full_name' => $this->info ? $this->info->full_name : '',
            'birthday' => $this->info ? $this->info->birthday : '',
            'phone_number' => $this->info ? $this->info->phone_number : '',
            'skype' => $this->info ? $this->info->skype : '',
            'email' =>  $this->email,
            'marital' => $this->info ? $this->info->marital : '',
            'hobby' => $this->info ? $this->info->hobby : '',
            'avatar' => '',
        ];
    }
}