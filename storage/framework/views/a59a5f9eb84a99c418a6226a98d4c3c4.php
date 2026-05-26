<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .card { background: #ffffff; border-radius: 8px; padding: 32px; max-width: 480px; margin: 0 auto; }
        h2 { color: #1a1a2e; margin-top: 0; }
        .label { color: #666; font-size: 13px; }
        .value { font-weight: 600; color: #111; }
        .btn { display: inline-block; margin-top: 24px; padding: 12px 24px; background: #c9960f; color: #fff; text-decoration: none; border-radius: 6px; font-weight: 700; }
    </style>
</head>
<body>
    <div class="card">
        <h2>Cerere nouă de înregistrare</h2>
        <p>Un elev nou s-a înregistrat și așteaptă aprobarea ta:</p>
        <p><span class="label">Nume:</span><br><span class="value"><?php echo e($student->name); ?></span></p>
        <p><span class="label">Email:</span><br><span class="value"><?php echo e($student->email); ?></span></p>
        <p><span class="label">Data înregistrării:</span><br><span class="value"><?php echo e($student->created_at->format('d.m.Y H:i')); ?></span></p>
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="btn">Gestionează elevii</a>
    </div>
</body>
</html>
<?php /**PATH /var/www/html/resources/views/emails/student-pending-approval.blade.php ENDPATH**/ ?>