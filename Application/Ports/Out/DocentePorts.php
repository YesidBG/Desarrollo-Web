<?php

namespace Application\Ports\Out;

use Domain\Models\DocenteModel;
use Domain\ValueObjects\DocenteId;
use Domain\ValueObjects\DocenteEmail;

// ── Puerto: guardar (INSERT) ──────────────────────────────────────────────────
interface SaveDocentePort
{
    /**
     * Persiste un nuevo docente y retorna el modelo con el ID generado.
     */
    public function save(DocenteModel $docente): DocenteModel;
}

// ── Puerto: buscar por ID ─────────────────────────────────────────────────────
interface GetDocenteByIdPort
{
    /**
     * Retorna el docente con ese ID, o null si no existe.
     */
    public function find(DocenteId $id): DocenteModel;
}

// ── Puerto: buscar por email ──────────────────────────────────────────────────
interface GetDocenteByEmailPort
{
    /**
     * Retorna el docente con ese email, o null si no existe.
     */
    public function findByEmail(DocenteEmail $email): DocenteModel;
}

// ── Puerto: listar todos ──────────────────────────────────────────────────────
interface GetAllDocentesPort
{
    /**
     * Retorna todos los docentes registrados.
     *
     * @return DocenteModel[]
     */
    public function findAll(): array;
}

// ── Puerto: actualizar (UPDATE) ───────────────────────────────────────────────
interface UpdateDocentePort
{
    /**
     * Actualiza un docente existente y retorna el modelo actualizado.
     */
    public function update(DocenteModel $docente): DocenteModel;
}

// ── Puerto: eliminar ──────────────────────────────────────────────────────────
interface DeleteDocentePort
{
    /**
     * Elimina el docente con ese ID.
     */
    public function delete(DocenteId $id): void;
}
