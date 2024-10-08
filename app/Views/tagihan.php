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
                <div class="row">
                  <div class="col-6">
                    <a href="<?= base_url('tagihan/add') ?>" class="btn btn-primary mb-3">+ Buat Tagihan</a>
                  </div>
                  <div class="col-6 text-right">
                    <button class="btn btn-success mb-3" data-toggle="modal" data-target="#modal-notif">Kirim Notif Tagihan</button>
                  </div>
                </div>

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
                          <?php if($d['status'] != 'lunas'): ?>
                            <button data-toggle="modal" data-target="#modal-send-notif" onclick="notif('<?= $d['name']; ?>', '<?= $d['bulan']; ?>', '<?= $d['tahun']; ?>', '<?= 'Rp ' . number_format($d['biaya']); ?>', '<?= $d['username']; ?>')" class="btn btn-success btn-sm"><i class="fa fa-bell"></i></button>
                            <a href="<?= base_url('tagihan/edit/') . $d['id']; ?>" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                            <button onclick="confirmDelete('<?= base_url('tagihan/delete/') . $d['id']; ?>')" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
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

    <div class="modal fade" id="modal-notif">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="<?= base_url('tagihan/notif/batch'); ?>" method="post">
          <div class="modal-header">
            <h5 class="modal-title">Kirim Notifikasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Fitur ini akan mengirim notifikasi tagihan ke nomor whatsapp setiap wali siswa yang belum lunas.</p>
            <label for="template">Template Tagihan</label>
<textarea name="template" id="template" class="form-control" rows="8">
Rincian Tagihan Math Stoodent

Nama Siswa : {siswa}
Bulan : {bulan}
Tahun : {tahun}
Biaya : {biaya}

Pembayaran dilakukan melalui transfer ke rekening berikut:
BNI : 20812131212
BCA : 28120123923

Hormat kami,
Math Stoodent</textarea>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Kirim</button>
          </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="modal-send-notif">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="<?= base_url('tagihan/notif/send'); ?>" method="post">
          <div class="modal-header">
            <h5 class="modal-title">Kirim Notifikasi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Kirim whatsapp notifikasi.</p>
            <label for="template-send">Template Tagihan</label>
            <input type="hidden" name="whatsapp" id="whatsapp-send">
            <input type="hidden" name="subject" id="subject-send">
            <textarea name="template" id="template-send" class="form-control" rows="8"></textarea>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Kirim</button>
          </div>
          </form>
        </div>
      </div>
    </div>
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

    function notif(name, bulan, tahun, biaya, whatsapp){
      var template = `Rincian Tagihan Math Stoodent

Nama Siswa : {siswa}
Bulan : {bulan}
Tahun : {tahun}
Biaya : {biaya}

Pembayaran dilakukan melalui transfer ke rekening berikut:
BNI : 20812131212
BCA : 28120123923

Hormat kami,
Math Stoodent`;

      var templateFix = template.replace('{siswa}', name).replace('{bulan}', bulan).replace('{tahun}', tahun).replace('{biaya}', biaya);

      document.getElementById('template-send').innerHTML = templateFix;
      document.getElementById('whatsapp-send').value = whatsapp;
      document.getElementById('subject-send').value = "Tagihan Math Stoodent Bulan " + bulan + " " + tahun;
    }
  </script>
<?= $this->endSection() ?>