    <!-- Basic Card Example -->

    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">

                <a class="btn btn-secondary" type="button" href="<?= base_url('home/data_filter') ?>">Back</a>
                <form method="post" action="<?= base_url('home/hapus_data'); ?>">
                    <input type="hidden" name="keydevice" id="keydevice" value="<?= $key_device; ?>">
                    <input type="hidden" name="waktuawal" id="waktuawal" value="<?= $waktuawal; ?>">
                    <input type="hidden" name="waktuakhir" id="waktuakhir" value="<?= $waktuakhir; ?>">
                    <button class=" btn btn-danger float-right mx-2" type="submit" onclick="return confirm('yakin? Jika data dihapus anda tidak akan bisa melihatnya lagi ');">Hapus<i class="fa fa-fw fa-trash"></i> </button>
                </form>
                <form method="post" action="<?= base_url('home/export'); ?>">
                    <input type="hidden" name="keydevice_export" id="keydevice_export" value="<?= $key_device; ?>">
                    <input type="hidden" name="header_export" id="header_export" value="<?= $namaheader2; ?>">
                    <input type="hidden" name="waktuawal_export" id="waktuawal_export" value="<?= $waktuawal; ?>">
                    <input type="hidden" name="waktuakhir_export" id="waktuakhir_export" value="<?= $waktuakhir; ?>">
                    <input type="hidden" name="urutan_export" id="urutan_export" value="<?= $urutan2; ?>">
                    <input class="form-control form-control-user" type="hidden" name="kode_form" id="kode_form" value="2">
                    <button class=" btn btn-success float-right" type="submit">Export<i class="fa fa-fw fa-print"></i> </button>
                </form>

            </div>
            <h6 class="m-0 font-weight-bold text-primary"> <br> <?= $device_2['nama_device']; ?>
            </h6>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>


                    <tr>
                        <th scope="col">#</th>

                        <th scope="col">Time Add</th>
                        <?php foreach ($header as $h) : ?>
                            <th scope="col"><?= $h['variabel']; ?></th>
                        <?php endforeach; ?>
                </thead>
                <tbody>
                    <?php $i = 1; ?>

                    <?php foreach ($nilai as $n) : ?>

                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= date("d M Y  H:i:sa", strtotime($n['time_add'])); ?></td>

                            <?php foreach ($header as $h) : ?>
                                <td><?= $n['data_' . $h['code']]; ?></td>
                            <?php endforeach; ?>



                        </tr>
                        <?php $i++ ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    </div>