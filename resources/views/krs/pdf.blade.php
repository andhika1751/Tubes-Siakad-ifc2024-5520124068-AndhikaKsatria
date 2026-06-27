<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Data KRS</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #222; }
        h2 { text-align: center; margin-bottom: 4px; }
        p.sub { text-align: center; margin-top: 0; margin-bottom: 20px; color: #555; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #999; padding: 6px 8px; text-align: left; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h2>Data Kartu Rencana Studi (KRS)</h2>
    <p class="sub">Dicetak pada {{ now()->format('d M Y, H:i') }} WIB</p>

    <table>
        <thead>
            <tr>
                <th style="width:30px">No</th>
                <th>NPM</th>
                <th>Nama Mahasiswa</th>
                <th>Kode MK</th>
                <th>Nama Matakuliah</th>
                <th style="width:40px">SKS</th>
            </tr>
        </thead>
        <tbody>
            @forelse($krsList as $i => $krs)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $krs->npm }}</td>
                <td>{{ $krs->mahasiswa->nama ?? '-' }}</td>
                <td>{{ $krs->kode_matakuliah }}</td>
                <td>{{ $krs->matakuliah->nama_matakuliah ?? '-' }}</td>
                <td>{{ $krs->matakuliah->sks ?? '-' }}</td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center;">Belum ada data KRS.</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
