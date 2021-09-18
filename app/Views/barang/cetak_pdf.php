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
    <!-- <img src="<?= base_url('/assets/img/logop4.jpg'); ?>" style="height:10px;"> -->
    <p> 
        <i><?= $nama_admin; ?></i><br>
        Jakarta, Indonesia
    </p>
    <hr>
    <p>
        Data barang dari <?= date('Y-m-d', strtotime($mulai)) ?> sampai <?= date('Y-m-d', strtotime($akhir)) ?>
    </p>
    <table cellpadding="6">
        <tr style="text:center">
            <th><strong>No</strong></th>
            <th><strong>Nama Barang</strong></th>
            <th><strong>Jenis Barang</strong></th>
            <th><strong>Tanggal Masuk</strong></th>
            <th><strong>Stok</strong></th>
            <th><strong>Satuan</strong></th>
            <th width="15%"><strong>Keterangan</strong></th>
        </tr>
        <?php $i = 1;?>
        <?php foreach($barang as $row): ?>
        <tr>
            <td scope="row"> <?= $i; ?> </td>
            <td><?= $row->nm_barang ?></td>
            <td><?= $row->jns_barang ?></td>
            <td><?= $row->tgl_masuk_barang ?></td>
            <td><?= $row->jml_barang ?></td>
            <td><?= $row->nama_satuan ?></td>
            <td><?= $row->ket_barang ?></td>
        </tr>
        <?php $i++ ?>
        <?php endforeach; ?>
    </table>
</body>


    <p style="font-size:10px; color:'#dddddd'">
        Tanggal cetak : <?= date('Y-m-d', strtotime($now)) ?><br>
    </p>

    <img src="<?= base_url('/assets/img/qr_code_admin/Ade.jpg'); ?>" height="20">

</html>