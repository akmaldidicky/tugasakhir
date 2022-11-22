<div class="overflow-auto">
    <!-- Basic Card Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <h4 class="mx-2"><?= $subtitle; ?></h4>
            </h6>
        </div>
        <div class="card-body">

            <table class="table">
                <thead>


                    <tr>
                        <th scope="col">#</th>

                        <th scope="col">Time Add</th>
                        <?php foreach ($header as $h) : ?>
                            <th scope="col"><?= $h['besaran_sensor']; ?></th>


                        <?php endforeach; ?>
                </thead>
                <tbody>
                    <?php $i = 1; ?>

                    <?php foreach ($nilai as $n) : ?>

                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $n['time_add']; ?></td>

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
    <div class="modal-footer">
        <a class="btn btn-secondary" type="button" href="<?= base_url('home/device') ?>">Back</a>
    </div>



</div>

</div>