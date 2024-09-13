<?= $this->extend('layout/wali') ?>

<?= $this->section('content') ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Upload Pembayaran Tagihan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('wali/home'); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('wali/home'); ?>">Tagihan</a></li>
              <li class="breadcrumb-item active">Upload Pembayaran</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Tagihan</h3>
                        </div>
                        <div class="card-body">
                            <table class="w-50">
                                <tr>
                                    <td>Siswa</td>
                                    <td>:</td>
                                    <td><?= $siswa['name'] ?></td>
                                </tr>
                                <tr>
                                    <td>Biaya</td>
                                    <td>:</td>
                                    <td><?= "Rp " . number_format($data['biaya']) ?></td>
                                </tr>
                                <tr>
                                    <td>Bulan</td>
                                    <td>:</td>
                                    <td><?= $data['bulan'] ?></td>
                                </tr>
                                <tr>
                                    <td>Tahun</td>
                                    <td>:</td>
                                    <td><?= $data['tahun'] ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Bukti Pembayaran</h3>
                        </div>
                        <form action="<?= base_url('wali/bayar'); ?>" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="bukti">Bulan</label>
                                <input type="file" accept="image/*" onchange="loadFile(event)" name="bukti" class="form-control" id="bukti" required>
                            </div>
                            <input type="hidden" name="id" value="<?= $data['id'] ?>">
                            <img class="w-50" id="output"/>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6 <?= count($pembayaran) < 1 ? 'd-none' : '' ?>">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Pembayaran</h3>
                        </div>
                        <div class="card-body">
                            <p>
                                <span class="text-danger">*</span>
                                Jika status pembayaran tidak valid silahkan upload ulang bukti pembayaran yang valid.
                                <br><span class="text-danger">*</span>
                                Jika ada pertanyaan/keluhan terkait pembayaran, hubungi admin lewat whatsapp berikut : +62815002100
                            </p>
                            <table class="w-100 table-bordered mt-4">
                                <tr class="font-weight-bold">
                                    <td class="px-2">Waktu</td>
                                    <td class="px-2">Foto</td>
                                    <td class="px-2">Status</td>
                                </tr>
                                <?php foreach($pembayaran as $p): ?>
                                    <tr>
                                        <td class="px-2"><?= $p['waktu'] ?></td>
                                        <td class="px-2"><img src="<?= base_url('bukti/') . $p['foto'] ?>" class="w-50"></td>
                                        <td class="px-2">
                                            <span class="badge text-md <?= $p['status'] == 'valid' ? 'badge-success' : ($p['status'] == 'tidak valid' ? 'badge-danger' : 'badge-primary') ?>">
                                                <?= $p['status'] ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
    var loadFile = function(event) {
        var output = document.getElementById('output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };
</script>
<?= $this->endSection() ?>