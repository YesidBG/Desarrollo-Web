<?php

namespace Infrastructure\Persistence\MySQL;

use Application\Ports\Out\SaveDocentePort;
use Application\Ports\Out\GetDocenteByIdPort;
use Application\Ports\Out\GetDocenteByEmailPort;
use Application\Ports\Out\GetAllDocentesPort;
use Application\Ports\Out\UpdateDocentePort;
use Application\Ports\Out\DeleteDocentePort;
use Domain\Models\DocenteModel;
use Domain\ValueObjects\DocenteId;
use Domain\ValueObjects\DocenteEmail;
use Infrastructure\Persistence\Mappers\DocentePersistenceMapper;

class DocenteRepositoryMySQL implements
    SaveDocentePort,
    GetDocenteByIdPort,
    GetDocenteByEmailPort,
    GetAllDocentesPort,
    UpdateDocentePort,
    DeleteDocentePort
{
    private $pdo;
    private $mapper;

    public function __construct(\PDO $pdo, DocentePersistenceMapper $mapper)
    {
        $this->pdo    = $pdo;
        $this->mapper = $mapper;
    }

    public function save(DocenteModel $docente): DocenteModel
    {
        $sql = "INSERT INTO docentes
                    (nombre, apellidos, email, telefono, blog, profesional,
                     escalafon, idioma, anios_experiencia, area_trabajo)
                VALUES
                    (:nombre, :apellidos, :email, :telefono, :blog, :profesional,
                     :escalafon, :idioma, :anios_experiencia, :area_trabajo)";
        $stmt   = $this->pdo->prepare($sql);
        $entity = $this->mapper->modelToEntity($docente);
        $stmt->execute($entity);
        $newId = (int) $this->pdo->lastInsertId();
        return $this->find(DocenteId::from($newId));
    }

    public function find(DocenteId $id): ?DocenteModel
    {
        $stmt = $this->pdo->prepare("SELECT * FROM docentes WHERE id = :id");
        $stmt->execute(array(':id' => $id->value()));
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$row) return null;
        return $this->mapper->entityToModel($row);
    }

    public function findByEmail(DocenteEmail $email): ?DocenteModel
    {
        $stmt = $this->pdo->prepare("SELECT * FROM docentes WHERE email = :email");
        $stmt->execute(array(':email' => $email->value()));
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if (!$row) return null;
        return $this->mapper->entityToModel($row);
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM docentes ORDER BY apellidos, nombre");
        $rows = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        return array_map(function($row) { return $this->mapper->entityToModel($row); }, $rows);
    }

    public function update(DocenteModel $docente): DocenteModel
    {
        $sql = "UPDATE docentes SET
                    nombre            = :nombre,
                    apellidos         = :apellidos,
                    email             = :email,
                    telefono          = :telefono,
                    blog              = :blog,
                    profesional       = :profesional,
                    escalafon         = :escalafon,
                    idioma            = :idioma,
                    anios_experiencia = :anios_experiencia,
                    area_trabajo      = :area_trabajo
                WHERE id = :id";
        $stmt   = $this->pdo->prepare($sql);
        $entity = $this->mapper->modelToEntity($docente);
        $entity[':id'] = $docente->getId()->value();
        $stmt->execute($entity);
        return $this->find($docente->getId());
    }

    public function delete(DocenteId $id): void
    {
        $stmt = $this->pdo->prepare("DELETE FROM docentes WHERE id = :id");
        $stmt->execute(array(':id' => $id->value()));
    }
}
