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
        <i><?= $nama_depan; ?> <?= $nama_belakang; ?> </i><br>
        Jakarta, Indonesia
    </p>
    <hr>
    <p>
        Data Peminjam<br>
        Nama Lengkap : <?= $nama_depan; ?> <?= $nama_belakang; ?> <br>
        Subbagian : <?= $nm_subbagian; ?>
    </p>
    <p></p>
    <table cellpadding="6">
        <tr>
            <th><strong>Barang</strong></th> 
            <th><strong>Jumlah</strong></th>
            <th><strong>Tanggal Pinjam</strong></th>
        </tr>
        <tr>
            <td><?= $nm_barang ?></td>
            <td><?= $jml_pinjam ?></td>
            <td><?= $tgl_pinjam ?></td>
        </tr>
    </table>
</body>


    <p style="font-size:10px; color:'#dddddd'">
        Tanggal cetak : <?= date('Y-m-d', strtotime($now)) ?><br>
    </p>
</html>