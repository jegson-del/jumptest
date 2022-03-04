<?php


namespace App\Services;


class ModelCollectionService implements ModelCollectionServiceInterface
{

    public function modelCollection($model,  $httpRes)
    {
        foreach ($httpRes->data as $data){

            // check if Api data already exists

            $check = ($model::where('email', '=', $data->email));
            if ($check->exists())
            {
                exit('data from this api already exist on database');

            }

                $model = new $model;
                $model->first_name = $data->first_name;
                $model->last_name = $data->last_name;
                $model->email = $data->email;
                $model->avatar = $data->avatar;

                $model->save();

        }
    }

}
