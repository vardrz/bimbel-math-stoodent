<?= $this->extend('layout/template') ?>

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
            <h1>Kelola Pembayaran</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Pembayaran</li>
            </ol>
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
                <a href="<?= base_url('pembayaran?status=check'); ?>" class="btn btn-sm btn-primary btn-flat">Perlu Dicek</a>
                <a href="<?= base_url('pembayaran?status=valid'); ?>" class="btn btn-sm btn-success btn-flat">Pembayaran Diterima</a>
                <a href="<?= base_url('pembayaran?status=invalid'); ?>" class="btn btn-sm btn-danger btn-flat">Pembayaran Ditolak</a>
                <table id="table" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Nama Siswa</th>
                      <th>Bulan</th>
                      <th>Tahun</th>
                      <th>Biaya</th>
                      <th>Waktu</th>
                      <th>Foto</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach($data as $d): ?>
                      <tr>
                        <td><?= $d['name']; ?></td>
                        <td><?= $d['bulan']; ?></td>
                        <td><?= $d['tahun']; ?></td>
                        <td><?= "Rp " . number_format($d['biaya'], 0, ".", ","); ?></td>
                        <td><?= $d['waktu']; ?></td>
                        <td style="width: 200px"><img src="<?= base_url('bukti/') . $d['foto'] ?>" class="img-fluid"></td>
                        <td>
                          <?php if($d['status'] == 'sedang dicek'): ?>
                            <button onclick="confirmAccept('<?= base_url('pembayaran/accept/' . $d['id'] . '/' . $d['tagihan_id']); ?>')" class="btn btn-success btn-sm"><i class="fas fa-check"></i></button>
                            <button onclick="confirmReject('<?= base_url('pembayaran/reject/' . $d['id']); ?>')" class="btn btn-danger btn-sm"><i class="fa fa-ban"></i></button>
                          <?php elseif($d['status'] == 'tidak valid'): ?>
                            <button onclick="confirmAccept('<?= base_url('pembayaran/accept/' . $d['id'] . '/' . $d['tagihan_id']); ?>')" class="btn btn-success btn-sm"><i class="fas fa-check"></i></button>
                          <?php else: ?>
                            -
                          <?php endif; ?>
                        </td>
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

    function confirmAccept(href){
      Swal.fire({
        title: 'Konfirmasi',
        text: 'Apakah anda yakin bukti pembayaran ini valid?',
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonText: 'Ya',
      }).then((val) => {
        val['isConfirmed'] && (window.location.href = href)
      })
    }

    function confirmReject(href){
      Swal.fire({
        title: 'Konfirmasi',
        text: 'Tolak bukti pembayaran ini?',
        icon: 'question',
        showCancelButton: true,
        cancelButtonText: 'Batal',
        confirmButtonText: 'Ya',
      }).then((val) => {
        val['isConfirmed'] && (window.location.href = href)
      })
    }
  </script>
<?= $this->endSection() ?>