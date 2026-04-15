<?php

namespace Infrastructure\Entrypoints\Web\Controllers;

use Application\Ports\In\CreateDocenteUseCase;
use Application\Ports\In\UpdateDocenteUseCase;
use Application\Ports\In\DeleteDocenteUseCase;
use Application\Ports\In\GetDocenteByIdUseCase;
use Application\Ports\In\GetAllDocentesUseCase;
use Application\Commands\DeleteDocenteCommand;
use Application\Queries\GetDocenteByIdQuery;
use Application\Queries\GetAllDocentesQuery;
use Infrastructure\Entrypoints\Web\Controllers\Mapper\DocenteWebMapper;
use Infrastructure\Entrypoints\Web\Presentation\Flash;
use Infrastructure\Entrypoints\Web\Presentation\View;
use Domain\Enums\EscalafonDocente;
use Domain\Enums\IdiomaDocente;

class DocenteController
{
    private $createUC;
    private $updateUC;
    private $deleteUC;
    private $getByIdUC;
    private $getAllUC;
    private $mapper;

    public function __construct(
        CreateDocenteUseCase  $createUC,
        UpdateDocenteUseCase  $updateUC,
        DeleteDocenteUseCase  $deleteUC,
        GetDocenteByIdUseCase $getByIdUC,
        GetAllDocentesUseCase $getAllUC,
        DocenteWebMapper      $mapper
    ) {
        $this->createUC  = $createUC;
        $this->updateUC  = $updateUC;
        $this->deleteUC  = $deleteUC;
        $this->getByIdUC = $getByIdUC;
        $this->getAllUC   = $getAllUC;
        $this->mapper    = $mapper;
    }

    public function index(): void
    {
        $modelos  = $this->getAllUC->execute(new GetAllDocentesQuery());
        $docentes = $this->mapper->modelsToResponses($modelos);
        View::render('docentes/list', array('docentes' => $docentes));
    }

    public function create(): void
    {
        View::render('docentes/create', array(
            'escalafones' => EscalafonDocente::values(),
            'idiomas'     => IdiomaDocente::values(),
        ));
    }

    public function store(): void
    {
        try {
            $request = $this->mapper->postToCreateRequest($_POST);
            $command = $this->mapper->requestToCreateCommand($request);
            $this->createUC->execute($command);
            Flash::set('success', 'Docente creado exitosamente.');
            View::redirect('docentes.index');
        } catch (\Throwable $e) {
            Flash::set('error', $e->getMessage());
            View::redirect('docentes.create');
        }
    }

    public function show(): void
    {
        try {
            $id      = (int) ($_GET['id'] ?? 0);
            $modelo  = $this->getByIdUC->execute(new GetDocenteByIdQuery($id));
            $docente = $this->mapper->modelToResponse($modelo);
            View::render('docentes/show', array('docente' => $docente));
        } catch (\Throwable $e) {
            Flash::set('error', $e->getMessage());
            View::redirect('docentes.index');
        }
    }

    public function edit(): void
    {
        try {
            $id      = (int) ($_GET['id'] ?? 0);
            $modelo  = $this->getByIdUC->execute(new GetDocenteByIdQuery($id));
            $docente = $this->mapper->modelToResponse($modelo);
            View::render('docentes/edit', array(
                'docente'     => $docente,
                'escalafones' => EscalafonDocente::values(),
                'idiomas'     => IdiomaDocente::values(),
            ));
        } catch (\Throwable $e) {
            Flash::set('error', $e->getMessage());
            View::redirect('docentes.index');
        }
    }

    public function update(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        try {
            $request = $this->mapper->postToUpdateRequest($_POST, $id);
            $command = $this->mapper->requestToUpdateCommand($request);
            $this->updateUC->execute($command);
            Flash::set('success', 'Docente actualizado correctamente.');
            View::redirect('docentes.index');
        } catch (\Throwable $e) {
            Flash::set('error', $e->getMessage());
            View::redirect('docentes.edit', array('id' => $id));
        }
    }

    public function destroy(): void
    {
        $id = (int) ($_GET['id'] ?? 0);
        try {
            $this->deleteUC->execute(new DeleteDocenteCommand($id));
            Flash::set('success', 'Docente eliminado correctamente.');
        } catch (\Throwable $e) {
            Flash::set('error', $e->getMessage());
        }
        View::redirect('docentes.index');
    }

    public function home(): void
    {
        $total = count($this->getAllUC->execute(new GetAllDocentesQuery()));
        View::render('home', array('totalDocentes' => $total));
    }
}
