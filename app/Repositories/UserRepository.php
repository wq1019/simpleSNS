<?php

/*
 * add .styleci.yml
 */

namespace App\Repositories;

use Hash;
use App\Models\User;
use Faker\Generator as Faker;

class UserRepository extends BaseRepository
{
    public function model()
    {
        return User::class;
    }

    public function preCreate(array &$data)
    {
        if (! isset($data['nickname'])) {
            $data['nickname'] = app(Faker::class)->userName;
        }
        if (! isset($data['avatar'])) {
            $data['avatar'] = app(Faker::class)->imageUrl(640, 480, 'people');
        }

        return $this->filterData($data);
    }

    public function filterData(array &$data)
    {
        if (isset($data['nickname'])) {
            $data['nickname'] = e($data['nickname']);
        }
        if (isset($data['email'])) {
            $data['email'] = e($data['email']);
        }
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }
        if (isset($data['introduction'])) {
            $data['introduction'] = e($data['introduction']);
        }

        return $data;
    }

    public function preUpdate(array &$data)
    {
        return $this->filterData($data);
    }
}
