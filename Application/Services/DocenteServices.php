<?php

namespace Application\Services;

use Application\Commands\CreateDocenteCommand;
use Application\Commands\UpdateDocenteCommand;
use Application\Commands\DeleteDocenteCommand;
use Application\Queries\GetDocenteByIdQuery;
use Application\Queries\GetAllDocentesQuery;
use Application\Ports\In\CreateDocenteUseCase;
use Application\Ports\In\UpdateDocenteUseCase;
use Application\Ports\In\DeleteDocenteUseCase;
use Application\Ports\In\GetDocenteByIdUseCase;
use Application\Ports\In\GetAllDocentesUseCase;
use Application\Ports\Out\SaveDocentePort;
use Application\Ports\Out\GetDocenteByIdPort;
use Application\Ports\Out\GetDocenteByEmailPort;
use Application\Ports\Out\GetAllDocentesPort;
use Application\Ports\Out\UpdateDocentePort;
use Application\Ports\Out\DeleteDocentePort;
use Domain\Models\DocenteModel;
use Domain\ValueObjects\DocenteId;
use Domain\ValueObjects\DocenteNombre;
use Domain\ValueObjects\DocenteEmail;
use Domain\ValueObjects\DocenteTelefono;
use Domain\ValueObjects\DocenteBlog;
use Domain\ValueObjects\DocenteAniosExperiencia;
use Domain\Enums\EscalafonDocente;
use Domain\Enums\IdiomaDocente;
use Domain\Exceptions\DocenteNotFoundException;
use Domain\Exceptions\DocenteEmailDuplicadoException;

class CreateDocenteService implements CreateDocenteUseCase
{
    private $savePort;
    private $byEmailPort;

    public function __construct(SaveDocentePort $savePort, GetDocenteByEmailPort $byEmailPort)
    {
        $this->savePort    = $savePort;
        $this->byEmailPort = $byEmailPort;
    }

    public function execute(CreateDocenteCommand $cmd): DocenteModel
    {
        $email = DocenteEmail::from($cmd->email);
        if ($this->byEmailPort->findByEmail($email) !== null) {
            throw new DocenteEmailDuplicadoException($cmd->email);
        }
        $docente = DocenteModel::create(
            null,
            DocenteNombre::from($cmd->nombre),
            DocenteNombre::from($cmd->apellidos),
            $email,
            DocenteTelefono::from($cmd->telefono),
            DocenteBlog::from($cmd->blog),
            trim($cmd->profesional),
            EscalafonDocente::from($cmd->escalafon),
            IdiomaDocente::from($cmd->idioma),
            DocenteAniosExperiencia::from($cmd->aniosExperiencia),
            trim($cmd->areaTrabajo)
        );
        return $this->savePort->save($docente);
    }
}

class UpdateDocenteService implements UpdateDocenteUseCase
{
    private $byIdPort;
    private $byEmailPort;
    private $updatePort;

    public function __construct(
        GetDocenteByIdPort    $byIdPort,
        GetDocenteByEmailPort $byEmailPort,
        UpdateDocentePort     $updatePort
    ) {
        $this->byIdPort    = $byIdPort;
        $this->byEmailPort = $byEmailPort;
        $this->updatePort  = $updatePort;
    }

    public function execute(UpdateDocenteCommand $cmd): DocenteModel
    {
        $id = DocenteId::from($cmd->id);
        if ($this->byIdPort->find($id) === null) {
            throw new DocenteNotFoundException($cmd->id);
        }
        $email    = DocenteEmail::from($cmd->email);
        $existing = $this->byEmailPort->findByEmail($email);
        if ($existing !== null && $existing->getId()->value() !== $cmd->id) {
            throw new DocenteEmailDuplicadoException($cmd->email);
        }
        $docente = DocenteModel::create(
            $id,
            DocenteNombre::from($cmd->nombre),
            DocenteNombre::from($cmd->apellidos),
            $email,
            DocenteTelefono::from($cmd->telefono),
            DocenteBlog::from($cmd->blog),
            trim($cmd->profesional),
            EscalafonDocente::from($cmd->escalafon),
            IdiomaDocente::from($cmd->idioma),
            DocenteAniosExperiencia::from($cmd->aniosExperiencia),
            trim($cmd->areaTrabajo)
        );
        return $this->updatePort->update($docente);
    }
}

class DeleteDocenteService implements DeleteDocenteUseCase
{
    private $byIdPort;
    private $deletePort;

    public function __construct(GetDocenteByIdPort $byIdPort, DeleteDocentePort $deletePort)
    {
        $this->byIdPort   = $byIdPort;
        $this->deletePort = $deletePort;
    }

    public function execute(DeleteDocenteCommand $cmd): void
    {
        $id = DocenteId::from($cmd->id);
        if ($this->byIdPort->find($id) === null) {
            throw new DocenteNotFoundException($cmd->id);
        }
        $this->deletePort->delete($id);
    }
}

class GetDocenteByIdService implements GetDocenteByIdUseCase
{
    private $byIdPort;

    public function __construct(GetDocenteByIdPort $byIdPort)
    {
        $this->byIdPort = $byIdPort;
    }

    public function execute(GetDocenteByIdQuery $query): DocenteModel
    {
        $model = $this->byIdPort->find(DocenteId::from($query->id));
        if ($model === null) {
            throw new DocenteNotFoundException($query->id);
        }
        return $model;
    }
}

class GetAllDocentesService implements GetAllDocentesUseCase
{
    private $allPort;

    public function __construct(GetAllDocentesPort $allPort)
    {
        $this->allPort = $allPort;
    }

    public function execute(GetAllDocentesQuery $query): array
    {
        return $this->allPort->findAll();
    }
}
