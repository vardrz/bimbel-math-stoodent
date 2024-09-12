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
            <h1>Kelola Tagihan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url('home'); ?>">Home</a></li>
              <li class="breadcrumb-item active">Tagihan</li>
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
                <a href="<?= base_url('tagihan/add') ?>" class="btn btn-primary mb-3">+ Buat Tagihan</a>

                <table id="table" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Nama Siswa</th>
                      <th>Bulan</th>
                      <th>Tahun</th>
                      <th>Biaya</th>
                      <th>Status</th>
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
                        <td><span class="badge text-md <?= $d['status'] == 'lunas' ? 'badge-success' : 'badge-danger' ?>"><?= $d['status']; ?></span></td>
                        <td>
                          <a href="<?= base_url('tagihan/edit/') . $d['id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                          <button onclick="confirmDelete('<?= base_url('tagihan/delete/') . $d['id']; ?>')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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
        "buttons": [
          {
            extend: 'pdf',
            className: 'btn btn-danger',
            exportOptions: {columns: [ 0, 1, 2, 3, 4 ]}
          },
          {
            extend: 'excel',
            className: 'btn btn-success',
            exportOptions: {columns: [ 0, 1, 2, 3, 4 ]},
          },
          {
            extend: 'print',
            className: 'btn btn-dark',
            exportOptions: {columns: [ 0, 1, 2, 3, 4 ]},
          }
        ],
      }).buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
    });

    function confirmDelete(href){
      Swal.fire({
        title: 'Konfirmasi',
        text: 'Yakin akan menghapus tagihan ini?',
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