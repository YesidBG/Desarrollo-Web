<?php

namespace Infrastructure\Persistence\Mappers;

use Domain\Models\DocenteModel;
use Domain\ValueObjects\DocenteId;
use Domain\ValueObjects\DocenteNombre;
use Domain\ValueObjects\DocenteEmail;
use Domain\ValueObjects\DocenteTelefono;
use Domain\ValueObjects\DocenteBlog;
use Domain\ValueObjects\DocenteAniosExperiencia;
use Domain\Enums\EscalafonDocente;
use Domain\Enums\IdiomaDocente;

class DocentePersistenceMapper
{
    public function entityToModel(array $row): DocenteModel
    {
        return DocenteModel::create(
            DocenteId::from((int) $row['id']),
            DocenteNombre::from($row['nombre']),
            DocenteNombre::from($row['apellidos']),
            DocenteEmail::from($row['email']),
            DocenteTelefono::from($row['telefono']),
            DocenteBlog::from($row['blog'] ?? null),
            $row['profesional'],
            EscalafonDocente::from($row['escalafon']),
            IdiomaDocente::from($row['idioma']),
            DocenteAniosExperiencia::from((int) $row['anios_experiencia']),
            $row['area_trabajo'],
            $row['password'] ?? ''
        );
    }

    public function modelToEntity(DocenteModel $model): array
    {
        return array(
            ':nombre'            => $model->getNombre()->value(),
            ':apellidos'         => $model->getApellidos()->value(),
            ':email'             => $model->getEmail()->value(),
            ':telefono'          => $model->getTelefono()->value(),
            ':blog'              => $model->getBlog()->value(),
            ':profesional'       => $model->getProfesional(),
            ':escalafon'         => $model->getEscalafon()->value,
            ':idioma'            => $model->getIdioma()->value,
            ':anios_experiencia' => $model->getAniosExperiencia()->value(),
            ':area_trabajo'      => $model->getAreaTrabajo(),
        );
    }
}