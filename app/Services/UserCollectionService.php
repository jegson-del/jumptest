<?php


namespace App\Services;


use App\Models\User;


class UserCollectionService implements UserCollectionServiceInterface
{
    public function createUser($users)
    {

        foreach ($users->data as $data){

//check if Api data already exists

            if (User::where('id', '=', $data->id)->exists()) {

                exit('users from this api already exist on database');
            }
            $user = new User;
            $user->id = $data->id;
            $user->first_name = $data->first_name;
            $user->last_name = $data->last_name;
            $user->email = $data->email;
            $user->avatar = $data->avatar;
            $user->save();
        }
    }
}
