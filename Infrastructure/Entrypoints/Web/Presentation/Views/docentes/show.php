<?php
$pageTitle = 'Detalle Docente';
require __DIR__ . '/../layouts/header.php';
?>

<div class="page-header" style="display:flex;align-items:center;justify-content:space-between;">
    <div>
        <h1 class="page-title"><?= htmlspecialchars($docente->nombreCompleto) ?></h1>
        <p class="page-sub"><?= htmlspecialchars($docente->profesional) ?></p>
    </div>
    <div style="display:flex;gap:.6rem;">
        <a href="index.php?route=docentes.edit&id=<?= $docente->id ?>" class="btn btn-warning">✏️ Editar</a>
        <a href="index.php?route=docentes.index" class="btn btn-secondary">← Volver</a>
    </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.25rem;">

    <div class="card">
        <div class="card-header"><span class="card-title">Datos personales</span></div>
        <div class="card-body">
            <table style="width:100%">
                <tr>
                    <td style="color:var(--text-muted);padding:.5rem 0;font-size:.85rem;width:40%">Nombre</td>
                    <td><?= htmlspecialchars($docente->nombre) ?></td>
                </tr>
                <tr>
                    <td style="color:var(--text-muted);padding:.5rem 0;font-size:.85rem">Apellidos</td>
                    <td><?= htmlspecialchars($docente->apellidos) ?></td>
                </tr>
                <tr>
                    <td style="color:var(--text-muted);padding:.5rem 0;font-size:.85rem">Email</td>
                    <td><?= htmlspecialchars($docente->email) ?></td>
                </tr>
                <tr>
                    <td style="color:var(--text-muted);padding:.5rem 0;font-size:.85rem">Teléfono</td>
                    <td><?= htmlspecialchars($docente->telefono) ?></td>
                </tr>
                <tr>
                    <td style="color:var(--text-muted);padding:.5rem 0;font-size:.85rem">Blog</td>
                    <td>
                        <?php if ($docente->blog): ?>
                            <a href="<?= htmlspecialchars($docente->blog) ?>" target="_blank"
                               style="color:var(--accent);">
                                <?= htmlspecialchars($docente->blog) ?>
                            </a>
                        <?php else: ?>
                            <span style="color:var(--text-muted)">—</span>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><span class="card-title">Datos académicos</span></div>
        <div class="card-body">
            <table style="width:100%">
                <tr>
                    <td style="color:var(--text-muted);padding:.5rem 0;font-size:.85rem;width:45%">Título profesional</td>
                    <td><?= htmlspecialchars($docente->profesional) ?></td>
                </tr>
                <tr>
                    <td style="color:var(--text-muted);padding:.5rem 0;font-size:.85rem">Escalafón</td>
                    <td><span class="badge badge-blue"><?= htmlspecialchars($docente->escalafon) ?></span></td>
                </tr>
                <tr>
                    <td style="color:var(--text-muted);padding:.5rem 0;font-size:.85rem">Idioma</td>
                    <td><span class="badge badge-purple"><?= htmlspecialchars($docente->idioma) ?></span></td>
                </tr>
                <tr>
                    <td style="color:var(--text-muted);padding:.5rem 0;font-size:.85rem">Experiencia</td>
                    <td><?= $docente->aniosExperiencia ?> año(s)</td>
                </tr>
                <tr>
                    <td style="color:var(--text-muted);padding:.5rem 0;font-size:.85rem">Área de trabajo</td>
                    <td><?= htmlspecialchars($docente->areaTrabajo) ?></td>
                </tr>
            </table>
        </div>
    </div>

</div>

<?php require __DIR__ . '/../layouts/footer.php'; ?>
