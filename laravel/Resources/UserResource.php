<?php


namespace App\Http\Resources;

use App\Http\Resources\LocationResource;
use App\Repositories\LocationRepository;
use App\User;
use Phobo\Broth\Editables\EditableResource;


class UserResource extends EditableResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $ret = [
            'id' => $this->id,
            'email' => $this->email,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'name' => $this->first_name . ' ' . $this->last_name,
            'phone' => $this->phone,
            'role' => $this->role,
            'email_hash' => $this->emailHash($this->email),
        ];

        if (in_array($this->role['name'], ['responsible', 'nurse', 'collector', 'patient'])) {
            $location = $this->roles[0]['target_id'];
            $locationRepository = new LocationRepository();
            $ret += [
                'location' => LocationResource::make($locationRepository->find($location))
            ];
        }

        if ($this->role['name'] == 'patient') {
            $caregiver = UserResource::make(
                User::query()->select('users.*')
                ->join('user_roles as ur', 'ur.user_id', '=', 'users.id')
                ->where('ur.role', '=', 'caregiver')
                ->where('ur.target_id', '=', $this->id)
                ->first()
            );

            $ret += [
                'caregiver' => $caregiver
            ];
        }

        return $ret;
    }
}
