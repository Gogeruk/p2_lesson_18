<?php

namespace App\Service;

use App\Repository\Profile\DbProfileRepository;
use App\Repository\Profile\ProfileRepositoryInterface;

class ProfileService
{
    protected $repository;

    public function __construct(ProfileRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }


    public function showProfile($user_id)
    {
        return view('pages/profile', ['user' => $this->repository->profile($user_id)]);
    }
{
