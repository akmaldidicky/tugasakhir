<!-- Basic Card Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit Your Device</h6>
    </div>
    <div class="card-body">
        <div class="col-lg-6"><?php foreach ($device as $d) : ?>
                <form class="user mx-2" method="post" action="<?= base_url('home/editdevice/') . $d['id']; ?>">


                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-auto">
                            <label class="col-form-label">Chip_id &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;:</label>
                        </div>
                        <div class="col-auto">
                            <fieldset>
                                <input type="text" id="chipid" class="form-control form-control-user" name="chipid" value="<?= $d['chip_id']; ?>">
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-auto">
                            <label class="col-form-label">Nama_device &nbsp; :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="namadevice" class="form-control form-control-user" name="namadevice" value="<?= $d['nama_device']; ?>">
                            <?= form_error('header1', '<small class="text-danger pl-3">', '</small>'); ?>
                        </div>
                    </div>
                    <div class="row g-3 align-items-center mb-2">
                        <div class="col-auto">
                            <label class="col-form-label">Nama_header :</label>
                        </div>
                        <div class="col-auto">
                            <input type="text" id="namaheader" class="form-control form-control-user" name="namaheader" value="<?= $d['nama_header']; ?>" readonly>
                        </div>
                    </div>
                    <div class="modal-body">Pilih "Update" untuk menyimpan pembaruan device.</div>
                    <div class="modal-footer">
                        <a class="btn btn-secondary" type="button" href="<?= base_url('home/device') ?>">Back</a>
                        <button class=" btn btn-success" type="submit">Update</button>
                    </div>
                <?php endforeach; ?>
                </form>
        </div>
    </div>

</div>
<!-- End Basic Card Example -->