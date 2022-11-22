<?= $this->session->flashdata('message'); ?>
<div class="col lg-8">
    <button type="button" class="btn btn-success mb-2 " data-toggle="modal" data-target="#tambahHeader">Tambah Aplikasi +</button>
    <button type="button" class="btn btn-success mb-2 " data-toggle="modal" data-target="#tambahVariabel">Tambah Variabel +</button>
    <button type="button" class="btn btn-warning mb-2 float-right" data-toggle="modal" data-target="#kelompokHeader">Aplikasi</button>
</div>
<table class="table">
    <thead>
        <tr>

            <th scope="col">#</th>
            <th scope="col">Nama aplikasi</th>
            <th scope="col">Variabel</th>
            <th scope="col">Code</th>
            <th scope="col">Waktu dibuat</th>
            <th scope="col">Edit</th>

    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($header as $h) : ?>

            <tr>
                <th scope="row"><?= $i; ?></th>
                <td><?= $h['nama_header']; ?></td>
                <td><?= $h['variabel']; ?></td>
                <td><?= $h['code']; ?></td>
                <td><?= date("d M Y", strtotime($h['date_created'])); ?></td>
                <td>
                    <a href="<?= base_url('home/edit/') . $h['id']; ?>"><span class=" badge rounded-pill bg-primary text-light">Edit</span></a>
                    <a href="<?= base_url('home/hapus/') . $h['id']; ?>"><span class="badge rounded-pill bg-danger text-light" onclick="return confirm('yakin?');">Hapus</span></a>
                </td>
            </tr>
            <?php $i++ ?>
        <?php endforeach; ?>
    </tbody>
</table>
<!-- tabel data -->


<!-- Tambah Header-->
<div class="modal fade" id="tambahHeader" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Aplikasi</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!-- FORM TAMBAH -->
            <form method="post" action="<?= base_url('home/tambah'); ?>">
                <div class="row  align-items-center mt-1">
                    <div class="col-auto">
                        <label class="col-form-label mx-2">Nama Aplikasi &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;</label>
                    </div>
                    <div class="form-group">
                        <input type="text" id="nama_header" class="form-control form-control-user mt-3" name="nama_header" placeholder="Masukan nama aplikasi">
                    </div>
                </div>
                <input type="hidden" id="kode_form" name="kode_form" value="1">
                <div class="modal-body">Pilih "Tambah" untuk menmbahkan aplikasi.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button class="btn btn-success" type="submit">Tambah</button>
                </div>
            </form>


        </div>
    </div>
</div>
<!-- END OF TAMBAH HEADER-->
<!-- Tambah Variabel-->
<div class="modal fade" id="tambahVariabel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah variabel</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!-- FORM TAMBAH -->
            <form method="post" action="<?= base_url('home/tambah'); ?>">
                <div class="row  align-items-center mt-1">
                    <div class="col-auto">
                        <label class="col-form-label mx-2">Nama Header &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                        <select name="nama_header2" id="nama_header2">
                            <?php foreach ($kelompok_header as $k) : ?>
                                <option><?= $k['nama_header']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="row g-3 align-items-center mb-2">
                    <div class="col-auto">
                        <label class="col-form-label mx-2">Variabel &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                    </div>
                    <div class="col-auto">
                        <input type="text" id="variabel" class="form-control form-control-user" name="variabel" placeholder="masukan variabel">
                    </div>
                </div>
                <input type="hidden" id="kode_form" name="kode_form" value="2">
                <div class="modal-body">Pilih "Tambah" untuk menmbahkan variabel.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <button class="btn btn-success" type="submit">Tambah</button>
                </div>
            </form>


        </div>
    </div>
</div>
<!-- END OF TAMBAH Modal-->
<!--  kelompok header-->
<div class="modal fade" id="kelompokHeader" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Aplikasi</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!-- TABLE TAMBAH -->
            <table class="table">
                <thead>
                    <tr>

                        <th scope="col">#</th>
                        <th scope="col">nama aplikasi</th>
                        <th scope="col">waktu dibuat</th>
                        <th scope="col">hapus</th>

                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($kelompok_header as $k) : ?>

                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $k['nama_header']; ?></td>
                            <td><?= date("d M Y", strtotime($k['time_created']));; ?></td>
                            <td>
                                <a href="<?= base_url('home/hapusk_header/') . $k['id']; ?>"><span class="badge rounded-pill bg-danger text-light" onclick="return confirm('yakin?');">Hapus</span></a>
                            </td>
                        </tr>
                        <?php $i++ ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <!-- tabel data -->


        </div>
    </div>
</div>
<!-- END OF kelompok header Modal-->
</div>