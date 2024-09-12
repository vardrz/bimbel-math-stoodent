<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Tambah Data Tagihan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>">Home</a></li>
              <li class="breadcrumb-item"><a href="<?= base_url('tagihan'); ?>">Tagihan</a></li>
              <li class="breadcrumb-item active">Tambah</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="<?= base_url('tagihan/add'); ?>" method="post">
            <div class="row">
                <div class="col-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Siswa</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="siswa">Siswa</label>
                                <select name="siswa" id="siswa" class="form-control" required>
                                    <?php foreach($siswa as $s): ?>
                                        <option value="<?= $s['id']; ?>"><?= $s['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="biaya">Biaya</label>
                                <input type="text" name="biaya" class="form-control" id="biaya" placeholder="0" required>
                                <span class="text-danger">*</span><span class="text-secondary text-sm"> Tanpa titik tanpa koma</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Periode Tagihan</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="bulan">Bulan</label>
                                <select name="bulan" id="bulan" class="form-control" required>
                                    <?php foreach($bulan as $b): ?>
                                        <option value="<?= $b['value']; ?>"><?= $b['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="tahun">Tahun</label>
                                <select name="tahun" id="tahun" class="form-control" required>
                                    <?php foreach($tahun as $b): ?>
                                        <option value="<?= $b['value']; ?>"><?= $b['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>
            </form>
        </div>
    </section>
    <!-- /.content -->

<?= $this->endSection() ?>