<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'jenis_kelamin' => $this->jenis_kelamin,
            'nomor_telephone' => $this->nomor_telephone,
            'foto_profil' => $this->foto_profil,
            'role' => $this->role
        ];
    }
}
