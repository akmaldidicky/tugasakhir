<!-- Basic Card Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Your Header</h6>
    </div>
    <div class="card-body">
    </div>

    <div class="col-lg-6"><?php foreach ($head as $h) : ?>

            <form class="user mx-2" method="post" action="<?= base_url('home/edit/') . $h['id']; ?>">


                <div class="row g-3 align-items-center mb-2">
                    <div class="col-auto">
                        <label class="col-form-label">Code &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                    </div>
                    <div class="col-auto">
                        <input type="text" id="codeheader" class="form-control form-control-user" name="codeheader" value="<?= $h['code']; ?>" readonly>
                    </div>
                </div>
                <div class="row g-3 align-items-center mb-2">
                    <div class="col-auto">
                        <label class="col-form-label">nama_header&nbsp;&nbsp; :</label>
                    </div>
                    <div class="col-auto">
                        <input type="text" id="namaheader" class="form-control form-control-user" name="namaheader" value="<?= $h['nama_header']; ?>" readonly>
                        <?= form_error('header1', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="row g-3 align-items-center mb-2">
                    <div class="col-auto">
                        <label class="col-form-label">Variabel &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;:</label>
                    </div>
                    <div class="col-auto">
                        <input type="text" id="variabel" class="form-control form-control-user" name="variabel" value="<?= $h['variabel']; ?>">
                        <?= form_error('variabel', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                </div>
                <div class="modal-body">Pilih "Update" untuk menyimpan pembaruan header.</div>
                <div class="modal-footer">
                    <a class="btn btn-secondary" type="button" href="<?= base_url('home/mydevice') ?>">Back</a>
                    <button class=" btn btn-success" type="submit">Update</button>
                </div>
            <?php endforeach; ?>
            </form>
    </div>
</div>

<!--END Basic Card Example -->