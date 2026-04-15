<?php

namespace Application\Ports\In;

use Application\Commands\CreateDocenteCommand;
use Application\Commands\UpdateDocenteCommand;
use Application\Commands\DeleteDocenteCommand;
use Application\Queries\GetDocenteByIdQuery;
use Application\Queries\GetAllDocentesQuery;
use Domain\Models\DocenteModel;

// ── Caso de uso: Crear ────────────────────────────────────────────────────────
interface CreateDocenteUseCase
{
    public function execute(CreateDocenteCommand $command): DocenteModel;
}

// ── Caso de uso: Actualizar ───────────────────────────────────────────────────
interface UpdateDocenteUseCase
{
    public function execute(UpdateDocenteCommand $command): DocenteModel;
}

// ── Caso de uso: Eliminar ─────────────────────────────────────────────────────
interface DeleteDocenteUseCase
{
    public function execute(DeleteDocenteCommand $command): void;
}

// ── Caso de uso: Obtener por ID ───────────────────────────────────────────────
interface GetDocenteByIdUseCase
{
    public function execute(GetDocenteByIdQuery $query): DocenteModel;
}

// ── Caso de uso: Listar todos ─────────────────────────────────────────────────
interface GetAllDocentesUseCase
{
    /** @return DocenteModel[] */
    public function execute(GetAllDocentesQuery $query): array;
}
