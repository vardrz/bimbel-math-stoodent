<?= $this->extend('layout/wali') ?>

<?= $this->section('head') ?>
  <link rel="stylesheet" href="<?= base_url('assets/')?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/')?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?= base_url('assets/')?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <style>
    @media  print {
      body {
        -webkit-print-color-adjust: exact;
      }
    }
  </style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Welcome wali siswa <?= $siswa['name'] ?></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- Default box -->
            <div class="card">
              <div class="card-body">
                <div class="mb-5">
                    <h3>Informasi Pembayaran Tagihan</h3>
                    Harap membayar tagihan hanya ke nomor rekening dibawah ini :
                    <br><span class="font-weight-bold">BNI </span> a/n Math Stoodent : <span class="font-weight-bold">110021323</span>
                    <br><span class="font-weight-bold">BCA </span> a/n Math Stoodent : <span class="font-weight-bold">102912122</span>
                </div>
                <h4 class="mb-2">Tagihan Siswa : <?= $siswa['name'] ?></h4>
                <!-- List Tagihan -->
                <table id="table" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>Tahun</th>
                        <th>Bulan</th>
                        <th>Biaya</th>
                        <th>Status</th>
                        <th>#</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data as $d): ?>
                      <tr>
                        <td><?= $d['tahun']; ?></td>
                        <td><?= $d['bulan']; ?></td>
                        <td><?= "Rp " . number_format($d['biaya'], 0, ".", ","); ?></td>
                        <td><span class="badge text-md <?= $d['status'] == 'lunas' ? 'badge-success' : 'badge-danger' ?>"><?= $d['status']; ?></span></td>
                        <td><a href="<?= base_url('wali/bayar/') . $d['id'] ?>" class="btn btn-sm btn-success">Upload Pembayaran</a></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-footer-->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
<?= $this->endSection() ?>

<?= $this->section('script') ?>
  <script src="<?= base_url('assets/') ?>plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/jszip/jszip.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/pdfmake/pdfmake.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/pdfmake/vfs_fonts.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="<?= base_url('assets/') ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

  <script>
    $(function () {
      $("#table").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
      }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
    });
  </script>
<?= $this->endSection() ?>