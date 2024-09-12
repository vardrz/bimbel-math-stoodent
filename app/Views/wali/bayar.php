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
            <form action="<?= base_url('wali/bayar'); ?>" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-6">
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
                <div class="col-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Bukti Pembayaran</h3>
                        </div>
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
                    </div>
                </div>
            </div>
            </form>
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