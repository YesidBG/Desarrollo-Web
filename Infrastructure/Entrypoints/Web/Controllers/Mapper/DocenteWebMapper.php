<?php

namespace Infrastructure\Entrypoints\Web\Controllers\Mapper;

use Application\Commands\CreateDocenteCommand;
use Application\Commands\UpdateDocenteCommand;
use Domain\Models\DocenteModel;
use Infrastructure\Entrypoints\Web\Controllers\Dto\CreateDocenteRequest;
use Infrastructure\Entrypoints\Web\Controllers\Dto\UpdateDocenteRequest;
use Infrastructure\Entrypoints\Web\Controllers\Dto\DocenteResponse;

class DocenteWebMapper
{
    public function requestToCreateCommand(CreateDocenteRequest $req): CreateDocenteCommand
    {
        return new CreateDocenteCommand(
            $req->nombre,
            $req->apellidos,
            $req->email,
            $req->telefono,
            $req->blog,
            $req->profesional,
            $req->escalafon,
            $req->idioma,
            $req->aniosExperiencia,
            $req->areaTrabajo
        );
    }

    public function requestToUpdateCommand(UpdateDocenteRequest $req): UpdateDocenteCommand
    {
        return new UpdateDocenteCommand(
            $req->id,
            $req->nombre,
            $req->apellidos,
            $req->email,
            $req->telefono,
            $req->blog,
            $req->profesional,
            $req->escalafon,
            $req->idioma,
            $req->aniosExperiencia,
            $req->areaTrabajo
        );
    }

    public function modelToResponse(DocenteModel $model): DocenteResponse
    {
        return new DocenteResponse(
            $model->getId()->value(),
            $model->getNombre()->value(),
            $model->getApellidos()->value(),
            $model->getNombreCompleto(),
            $model->getEmail()->value(),
            $model->getTelefono()->value(),
            $model->getBlog()->value() ?? '',
            $model->getProfesional(),
            $model->getEscalafon()->value,
            $model->getIdioma()->value,
            $model->getAniosExperiencia()->value(),
            $model->getAreaTrabajo()
        );
    }

    public function modelsToResponses(array $models): array
    {
        return array_map(function($m) { return $this->modelToResponse($m); }, $models);
    }

    public function postToCreateRequest(array $post): CreateDocenteRequest
    {
        return new CreateDocenteRequest(
            trim($post['nombre'] ?? ''),
            trim($post['apellidos'] ?? ''),
            trim($post['email'] ?? ''),
            trim($post['telefono'] ?? ''),
            trim($post['blog'] ?? ''),
            trim($post['profesional'] ?? ''),
            trim($post['escalafon'] ?? ''),
            trim($post['idioma'] ?? ''),
            (int) ($post['anios_experiencia'] ?? 0),
            trim($post['area_trabajo'] ?? '')
        );
    }

    public function postToUpdateRequest(array $post, int $id): UpdateDocenteRequest
    {
        return new UpdateDocenteRequest(
            $id,
            trim($post['nombre'] ?? ''),
            trim($post['apellidos'] ?? ''),
            trim($post['email'] ?? ''),
            trim($post['telefono'] ?? ''),
            trim($post['blog'] ?? ''),
            trim($post['profesional'] ?? ''),
            trim($post['escalafon'] ?? ''),
            trim($post['idioma'] ?? ''),
            (int) ($post['anios_experiencia'] ?? 0),
            trim($post['area_trabajo'] ?? '')
        );
    }
}
