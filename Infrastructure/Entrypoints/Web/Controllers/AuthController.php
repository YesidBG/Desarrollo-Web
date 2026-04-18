<?php

namespace Infrastructure\Entrypoints\Web\Controllers;

use Application\Commands\LoginCommand;
use Application\Commands\ForgotPasswordCommand;
use Application\Services\LoginService;
use Application\Services\ForgotPasswordService;
use Infrastructure\Entrypoints\Web\Presentation\View;
use Infrastructure\Entrypoints\Web\Presentation\Flash;

class AuthController
{
    private $loginService;
    private $forgotService;

    public function __construct(LoginService $loginService, ForgotPasswordService $forgotService)
    {
        $this->loginService  = $loginService;
        $this->forgotService = $forgotService;
    }

    // GET — mostrar formulario de login
   public function showLogin(): void
{
    // Si ya hay sesión activa, ir al home
    if (isset($_SESSION['auth'])) {
        View::redirect('home');
        return;
    }
    // Sin sesión — mostrar formulario directamente
    View::render('auth/login', array());
}
    // POST — procesar login
    public function authenticate(): void
    {
        try {
            $cmd     = new LoginCommand(
                trim($_POST['email']    ?? ''),
                trim($_POST['password'] ?? '')
            );
            $docente = $this->loginService->execute($cmd);

            // Guardar sesión
            $_SESSION['auth'] = array(
                'id'     => $docente->getId()->value(),
                'nombre' => $docente->getNombreCompleto(),
                'email'  => $docente->getEmail()->value(),
            );

            View::redirect('home');
        } catch (\Throwable $e) {
            Flash::set('error', $e->getMessage());
            View::redirect('auth.login');
        }
    }

    // GET — cerrar sesión
    public function logout(): void
    {
        session_destroy();
        View::redirect('auth.login');
    }

    // GET — mostrar formulario de recuperación
    public function showForgot(): void
    {
        View::render('auth/forgot', array());
    }

    // POST — procesar recuperación
    public function processForgot(): void
    {
        try {
            $cmd      = new ForgotPasswordCommand(trim($_POST['email'] ?? ''));
            $newPass  = $this->forgotService->execute($cmd);

            // Mostrar la nueva clave en pantalla (simulación de correo)
            View::render('auth/forgot-success', array(
                'email'   => trim($_POST['email'] ?? ''),
                'newPass' => $newPass,
            ));
        } catch (\Throwable $e) {
            Flash::set('error', $e->getMessage());
            View::redirect('auth.forgot');
        }
    }
}