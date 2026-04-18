<?php

namespace Application\Ports\Out;

use Domain\Models\DocenteModel;
use Domain\ValueObjects\DocenteId;
use Domain\ValueObjects\DocenteEmail;

interface SaveDocentePort
{
    public function save(DocenteModel $docente): DocenteModel;
}

interface GetDocenteByIdPort
{
    public function find(DocenteId $id): ?DocenteModel;
}

interface GetDocenteByEmailPort
{
    public function findByEmail(DocenteEmail $email): ?DocenteModel;
}

interface GetAllDocentesPort
{
    public function findAll(): array;
}

interface UpdateDocentePort
{
    public function update(DocenteModel $docente): DocenteModel;
}

interface DeleteDocentePort
{
    public function delete(DocenteId $id): void;
}