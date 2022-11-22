    <!-- Basic Card Example -->
    <?= $this->session->flashdata('message'); ?>
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            <i class="fa fa-filter fa-2x text-gray-300 float-right"></i>
                            <h5>
                                Pilih Aplikasi
                            </h5>
                        </div>
                    </h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">
                        <form method="post" action="<?= base_url('home/data_filter'); ?>">
                            <div class="row g-3 align-items-center mb-2">
                                <div class="col-auto">
                                    <label class="col-form-label">Nama Header :</label>
                                </div>
                                <div class="col-auto">
                                    <select name="nama_header" id="nama_header" class="form-control form-control-user">
                                        <?php foreach ($header_nama as $hn) : ?>
                                            <option><?= $hn['nama_header']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div>
                                    <button class=" btn btn-success" type="submit">Pilih </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
        <!-- ------------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
        <div class="col-lg-6 float-right">
            <div class="card shadow mb-4">
                <!-- Card Header - Accordion -->
                <a href="#collapseCardExample" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="collapseCardExample">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            <i class="fa fa-filter fa-2x text-gray-300 float-right"></i>
                            <h5>
                                Form Filter
                            </h5>
                        </div>
                    </h6>
                </a>
                <!-- Card Content - Collapse -->
                <div class="collapse show" id="collapseCardExample">
                    <div class="card-body">

                        <form method="post" action="<?= base_url('home/data_filter'); ?>">
                            <div class="row g-3 align-items-center mb-2">
                                <div class="col-auto">
                                    <label class="col-form-label">Nama Header :</label>
                                </div>
                                <div class="col-auto">
                                    <input name="nama_header2" id="nama_header2" value="<?= $namaheader; ?>" class="form-control form-control-user" placeholder="aplikasi harus diisi" readonly> </input>
                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-2">
                                <div class="col-auto">
                                    <label class="col-form-label">Nama Device &nbsp;&nbsp;:</label>
                                </div>
                                <div class="col-auto">
                                    <select name="key_device" id="key_device" class="form-control form-control-user">
                                        <?php foreach ($device as $d) : ?>
                                            <option value="<?= $d['key_device']; ?>"><?= $d['nama_device']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row g-3 align-items-center mb-2">
                                <div class="col-auto">
                                    <label class="col-form-label">Waktu Awal &nbsp;&nbsp;&nbsp;:</label>
                                </div>
                                <div class="col-auto">
                                    <input class="form-control form-control-user" type="datetime-local" name="waktu_awal" id="waktu_awal">

                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-2">
                                <div class="col-auto">
                                    <label class="col-form-label">Waktu Akhir &nbsp;&nbsp;&nbsp;:</label>
                                </div>
                                <div class="col-auto">
                                    <input class="form-control form-control-user" type="datetime-local" name="waktu_akhir" id="waktu_akhir">

                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-2">
                                <div class="col-auto">
                                    <input class="form-control form-control-user" type="hidden" name="kode_form" id="kode_form" value="1">

                                </div>
                            </div>
                            <div class="row g-3 align-items-center mb-2">
                                <div class="col-auto">
                                    <label class="col-form-label">Urutan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label>
                                </div>
                                <div class="col-auto">
                                    <select name="urutan" id="urutan" class="form-control form-control-user">

                                        <option value="ASC">Ascending</option>
                                        <option value="DESC">Descending</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-body">Pilih "Proses" untuk melakukan pemfilteran.</div>
                            <div class="modal-footer">
                                <div>
                                    <button class=" btn btn-danger" type="reset">Reset X</button>
                                </div>
                                <div>
                                    <button class=" btn btn-success" type="submit">Proses <i class="fa fa-fw fa-paper-plane"></i> </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    </div>