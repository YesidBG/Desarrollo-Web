<?php
$pageTitle = 'Editar Docente';
require __DIR__ . '/../layouts/header.php';

use Infrastructure\Entrypoints\Web\Presentation\Flash;
?>

<?php if (Flash::has('error')): ?>
    <div class="alert alert-error"><?= htmlspecialchars(Flash::get('error')) ?></div>
<?php endif; ?>

<div class="page-header">
    <h1 class="page-title">Editar Docente</h1>
    <p class="page-sub"><?= htmlspecialchars($docente->nombreCompleto) ?></p>
</div>

<div class="card">
    <div class="card-header">
        <span class="card-title">Actualizar información</span>
        <a href="index.php?route=docentes.index" class="btn btn-secondary btn-sm">← Volver</a>
    </div>
    <div class="card-body">
        <form method="POST" action="index.php?route=docentes.update&id=<?= $docente->id ?>">
            <div class="form-grid">

                <div class="form-group">
                    <label for="nombre">Nombre *</label>
                    <input type="text" id="nombre" name="nombre"
                           value="<?= htmlspecialchars($docente->nombre) ?>" required>
                </div>

                <div class="form-group">
                    <label for="apellidos">Apellidos *</label>
                    <input type="text" id="apellidos" name="apellidos"
                           value="<?= htmlspecialchars($docente->apellidos) ?>" required>
                </div>

                <div class="form-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email"
                           value="<?= htmlspecialchars($docente->email) ?>" required>
                </div>

                <div class="form-group">
                    <label for="telefono">Teléfono *</label>
                    <input type="text" id="telefono" name="telefono"
                           value="<?= htmlspecialchars($docente->telefono) ?>" required>
                </div>

                <div class="form-group full">
                    <label for="blog">Blog / Sitio web (opcional)</label>
                    <input type="url" id="blog" name="blog"
                           value="<?= htmlspecialchars($docente->blog) ?>">
                </div>

                <div class="form-group">
                    <label for="profesional">Título profesional *</label>
                    <input type="text" id="profesional" name="profesional"
                           value="<?= htmlspecialchars($docente->profesional) ?>" required>
                </div>

                <div class="form-group">
                    <label for="area_trabajo">Área de trabajo *</label>
                    <input type="text" id="area_trabajo" name="area_trabajo"
                           value="<?= htmlspecialchars($docente->areaTrabajo) ?>" required>
                </div>

                <div class="form-group">
                    <label for="escalafon">Escalafón *</label>
                    <select id="escalafon" name="escalafon" required>
                        <?php foreach ($escalafones as $e): ?>
                            <option value="<?= htmlspecialchars($e) ?>"
                                <?= $docente->escalafon === $e ? 'selected' : '' ?>>
                                <?= htmlspecialchars($e) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="idioma">Idioma principal *</label>
                    <select id="idioma" name="idioma" required>
                        <?php foreach ($idiomas as $i): ?>
                            <option value="<?= htmlspecialchars($i) ?>"
                                <?= $docente->idioma === $i ? 'selected' : '' ?>>
                                <?= htmlspecialchars($i) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="anios_experiencia">Años de experiencia *</label>
                    <input type="number" id="anios_experiencia" name="anios_experiencia"
                           min="0" max="60"
                           value="<?= $docente->aniosExperiencia ?>" required>
                </div>

            </div><!-- /.form-grid -->

            <div style="margin-top:1.75rem;display:flex;gap:1rem;">
                <button type="submit" class="btn btn-warning">💾 Actualizar</button>
                <a href="index.php?route=docentes.show&id=<?= $docente->id ?>"
                   class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
