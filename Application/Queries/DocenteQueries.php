<?php

namespace Application\Queries;

// ── Query: Obtener docente por ID ─────────────────────────────────────────────
class GetDocenteByIdQuery
{
    public $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }
}

// ── Query: Listar todos los docentes ──────────────────────────────────────────
class GetAllDocentesQuery
{
    // Sin parámetros: lista completa
}
