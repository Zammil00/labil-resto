<!DOCTYPE html>
<html>
<head>
    <title><?= $title ?></title>
    <style>
        body { font-family: sans-serif; }
        h2 { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        table th, table td { border: 1px solid #000; padding: 6px; text-align: center; }
    </style>
</head>
<body>
    <h2><?= $title ?></h2>
    <table>
        <thead>
            <tr>
                <th><?= $periode ?></th>
                <th>Tahun</th>
                <th>Total Omzet</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($laporan as $row): ?>
                <tr>
                    <td><?= $row['periode'] ?></td>
                    <td><?= $row['tahun'] ?? ($row['periode']) ?></td>
                    <td>Rp <?= number_format($row['total'], 0, ',', '.') ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>
</html>
