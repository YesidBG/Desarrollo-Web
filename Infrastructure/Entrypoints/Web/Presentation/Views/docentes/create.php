<?php
$pageTitle = 'Nuevo Docente';
require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR . 'header.php';

use Infrastructure\Entrypoints\Web\Presentation\Flash;
?>

<?php if (Flash::has('error')): ?>
    <div class="alert alert-error"><?= htmlspecialchars(Flash::get('error')) ?></div>
<?php endif; ?>

<div class="page-header">
    <h1 class="page-title">Registrar Docente</h1>
    <p class="page-sub">Complete todos los campos obligatorios</p>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-title">Información del docente</span>
        <a href="index.php?route=docentes.index" class="btn btn-secondary btn-sm">← Volver</a>
    </div>
    <div class="card-body">
        <form method="POST" action="index.php?route=docentes.store">
            <div class="form-grid">

                <div class="form-group">
                    <label for="nombre">Nombre *</label>
                    <input type="text" id="nombre" name="nombre"
                           placeholder="Ej: Carlos" required>
                </div>

                <div class="form-group">
                    <label for="apellidos">Apellidos *</label>
                    <input type="text" id="apellidos" name="apellidos"
                           placeholder="Ej: Arrieta Pérez" required>
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email"
                           placeholder="docente@universidad.edu.co" required>
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono *</label>
                    <input type="text" id="telefono" name="telefono"
                           placeholder="Ej: +57 3001234567" required>
                </div>

                <div class="form-group full">
                    <label for="blog">Blog / Sitio web (opcional)</label>
                    <input type="url" id="blog" name="blog"
                           placeholder="https://mi-blog.com">
                </div>

                <div class="form-group">
                    <label for="profesional">Título profesional *</label>
                    <input type="text" id="profesional" name="profesional"
                           placeholder="Ej: Ingeniero de Sistemas" required>
                </div>

                <div class="form-group">
                    <label for="area_trabajo">Área de trabajo *</label>
                    <input type="text" id="area_trabajo" name="area_trabajo"
                           placeholder="Ej: Ciencias de la Computación" required>
                </div>

                <div class="form-group">
                    <label for="escalafon">Escalafón *</label>
                    <select id="escalafon" name="escalafon" required>
                        <option value="">-- Seleccione --</option>
                        <?php foreach ($escalafones as $e): ?>
                            <option value="<?= htmlspecialchars($e) ?>"><?= htmlspecialchars($e) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="idioma">Idioma principal *</label>
                    <select id="idioma" name="idioma" required>
                        <option value="">-- Seleccione --</option>
                        <?php foreach ($idiomas as $i): ?>
                            <option value="<?= htmlspecialchars($i) ?>"><?= htmlspecialchars($i) ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="anios_experiencia">Años de experiencia *</label>
                    <input type="number" id="anios_experiencia" name="anios_experiencia"
                           min="0" max="60" value="0" required>
                </div>

            </div><!-- /.form-grid -->

            <div style="margin-top:1.75rem;display:flex;gap:1rem;">
                <button type="submit" class="btn btn-primary">💾 Guardar docente</button>
                <a href="index.php?route=docentes.index" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?php require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR . 'footer.php'; ?>
