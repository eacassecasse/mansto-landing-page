<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserService
 *
 * @author edmilson.cassecasse
 * 
 * @createdOn 08-Jun-2021
 */
class UserService {

    private $repository;

    public function __construct() {
        $this->repository = new UserRepository();
    }

    public function insert(User $user): User {

        $found = $this->toUser($this->repository->
                        findByEmail($user->getEmail()));

        if (($user !== null) && ($found->equals($user))) {
            throw new BusinessException("Already exists a user with the "
                    . "given email");
        }

        return $this->toUser($this->repository->insert($user));
        
    }

    public function findAll(): array {
        $users = array();

        foreach ($this->repository->findAll() as $value) {
            array_push($users, $this->toUser($value));
        }

        return $users;
    }

    public function findById(int $id): User {
        return $this->toUser($this->repository->findById($id));
    }

    public function update(User $user): User {
        return $this->toUser($this->repository->update($user));
    }

    public function deleteById(int $id) {
        $this->repository->deleteById($id);
    }

    private function toUser($database_result): User {
        $user = new User();

        if (!empty($database_result)) {
            $user->setId($database_result['id']);
            $user->setEmail($database_result['email']);
            $user->setPassword($database_result['password']);
        }

        return $user;
    }

}
