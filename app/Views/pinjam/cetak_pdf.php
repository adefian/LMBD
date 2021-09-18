<html>

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #000000;
            text-align: center;
            margin: 8px;
        }
    </style>
</head>

<body>
    <div style="font-size:32px; color:'#dddddd'"><i>LMBD</i></div>
    <p>
        <i><?= $nama_admin; ?></i><br>
        Jakarta, Indonesia
    </p>
    <hr>
    <p>
        Data Peminjam dari <?= date('Y-m-d', strtotime($mulai)) ?> sampai <?= date('Y-m-d', strtotime($akhir)) ?>
    </p>
    <table cellpadding="6">
        <tr>
            <th><strong>No</strong></th>
            <th><strong>Nama Pegawai</strong></th>
            <th><strong>Subbagian</strong></th>
            <th><strong>Nama Barang</strong></th> 
            <th><strong>Tanggal Pinjam</strong></th>
            <th><strong>Jumlah</strong></th>
        </tr>
        <?php $i = 1;?>
        <?php foreach($pinjam as $row): ?>
        <tr>
            <td scope="row"> <?= $i; ?> </td>
            <td><?= $row->nama_depan ?> <?= $row->nama_belakang ?></td>
            <td><?= $row->nm_subbagian ?></td>
            <td><?= $row->nm_barang ?></td>
            <td><?= $row->tgl_pinjam ?></td>
            <td><?= $row->jml_pinjam ?></td>
        </tr>
        <?php $i++ ?>
        <?php endforeach; ?>
    </table>
</body>


    <p style="font-size:10px; color:'#dddddd'">
        Tanggal cetak : <?= date('Y-m-d', strtotime($now)) ?><br>
    </p>
</html>