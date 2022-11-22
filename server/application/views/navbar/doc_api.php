<!-- Begin Page Content -->

<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">URL</th>
            <th scope="col">Method</th>
            <th scope="col">Parameter</th>
            <th scope="col">Deskripsi</th>
            <th scope="col">Detail</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row">1</th>
            <td>http://103.9.22.227/api/mestakung</td>
            <td><a href="<?= base_url('home/ex_api#mestakungget'); ?>">GET</a>, <a href="<?= base_url('home/ex_api#mestakungpost'); ?>">POST</a>,<br><a href="<?= base_url('home/ex_api#mestakungput'); ?>">PUT</a>, <a href="<?= base_url('home/ex_api#mestakungdelete'); ?>">DELETE</a> </td>
            <td> key_device, id_user, chip_id, nama_device, urutan</td>
            <td>Dengan URL ini anda akan mendapatkan <br>
                data nilai sensor berdasarkan 'key_device',<br>
                mendaftarkan menghapus device dan juga<br>
                update nama device.
            </td>
            <td> <a class="btn btn-success" type="button" href="<?= base_url('home/ex_api#mestakung'); ?>">Go</a></td>
        </tr>
        <tr>
            </td>
            <th scope="row">2</th>
            <td>http://103.9.22.227/api/mestakung/realtime</td>
            <td><a href="<?= base_url('home/ex_api#mestakunggetrealtimeget'); ?>">GET</a></td>
            <td> key_device</td>
            <td>Dengan URL ini anda akan mendapatkan <br>
                data nilai sensor (per device) terakhir yang<br>
                masuk dalam database berdasarkan 'key_device'.
            </td>
            <td> <a class="btn btn-success" type="button" href="<?= base_url('home/ex_api#mestakungrealtime'); ?>">Go</a></td>
        </tr>
        <tr>
            </td>
            <th scope="row">3</th>
            <td>http://103.9.22.227/api/mestakung/w</td>
            <td><a href="<?= base_url('home/ex_api#mestakungwget'); ?>">GET</a></td>
            <td> key_device, urutan, limit</td>
            <td>Dengan URL ini anda akan mendapatkan <br>
                data nilai sensor dengan limit yang <br>
                anda bisa tentukan berdasarkan 'key_device'.
            </td>
            <td> <a class="btn btn-success" type="button" href="<?= base_url('home/ex_api#mestakungw'); ?>">Go</a></td>
        </tr>
        <tr>
            <th scope="row">4</th>
            <td>http://103.9.22.227/api/mesta</td>
            <td><a href="<?= base_url('home/ex_api#mestaget'); ?>">GET</a>, <a href="<?= base_url('home/ex_api#mestapost'); ?>">POST</a>,<br><a href="<?= base_url('home/ex_api#mestaput'); ?>">PUT</a>, <a href="<?= base_url('home/ex_api#mestadelete'); ?>">DELETE</a> </td>
            <td>key_device, waktu_awal, waktu_akhir, urutan, <br>
                nama_header, id_user.</td>
            <td>Dengan URL ini anda dapat memeperoleh <br>
                data nilai sensor berdasarkan rentang waktu <br>
                tertentu, memperoleh device/header/variabel yang
                andda miliki dan juga membuat, mengubah dan <br> menghapus header/apliaksi.
            </td>
            <td> <a class="btn btn-success" type="button" href="<?= base_url('home/ex_api#mesta'); ?>">Go</a></td>
        </tr>
        <tr>
            <th scope="row">5</th>
            <td>http://103.9.22.227/api/mesta/v</td>
            <td><a href="<?= base_url('home/ex_api#mestavget'); ?>">GET</a>, <a href="<?= base_url('home/ex_api#mestavpost'); ?>">POST</a>,<br><a href="<?= base_url('home/ex_api#mestavput'); ?>">PUT</a>, <a href="<?= base_url('home/ex_api#mestavdelete'); ?>">DELETE</a> </td>
            <td> key_device, id_user, chip_id, nama_device, urutan</td>
            <td>Dengan URL ini anda dapat menambahkan,<br>
                mengubah dan juga menghapus variabel <br>
                yang anda buat.
            </td>
            <td> <a class="btn btn-success" type="button" href="<?= base_url('home/ex_api#mestav'); ?>">Go</a></td>
        </tr>
    </tbody>
</table>
</div>
<!-- End of Main Content -->
