<?php


namespace App\Repository;


use App\Entity\User;

interface UserRepositoryInterface
{
//    public function findAll():array ;

    public function save(User $user): void ;

    public function delete(User $user): void ;

//    public function find($id, $lockMode = null, $lockVersion = null):?User;
//    public function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null):?array ;
}
