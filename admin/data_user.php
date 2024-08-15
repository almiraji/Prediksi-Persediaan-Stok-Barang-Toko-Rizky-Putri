<?php include 'src/header.php'; ?>

<div class="row column2 graph margin_bottom_30">
  <div class="col-md-l2 col-lg-12">
    <div class="white_shd full">
      <div class="full graph_head">
        <div class="heading1 margin_0">
          <h2>DATA USER</h2>
        </div>
      </div>
      <div class="full graph_head">
        <div class="row">
          <div class="col-md-12">
            <div class="content">
              <?php if ($_SESSION['level'] == 'admin') { ?>
                <a href="data_user_tambah.php"><button data-toggle="tooltip" data-placement="top" title="Tambah Data" type="button" class='d-sm-inline-block btn btn-sm btn-success shadow-sm'><span class="fa fa-plus" aria-hidden="true"></span></button></a>
              <?php } ?>
              <hr>
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="tabel-data">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama User</th>
                      <th>Username</th>
                      <th>Password</th>
                      <th>Level</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    $query = mysqli_query($koneksi, "SELECT * FROM data_user");
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data['nama_user'] ?></td>
                        <td><?= $data['username'] ?></td>
                        <td><?= $data['password'] ?></td>
                        <td><?= ucfirst($data['level']) ?></td>
                        <td>
                          <a href="data_user_edit.php?id_user=<?= $data['id_user'] ?>"><button data-toggle="tooltip" data-placement="top" title="Edit Data" type="button" class='d-sm-inline-block btn btn-sm btn-primary shadow-sm'><span class="fa fa-pencil" aria-hidden="true"></span></button></a>
                          <?php if ($data['id_user'] == 1) {
                          } else { ?>
                            <a href="data_user_hapus.php?id_user=<?= $data['id_user'] ?>"><button data-toggle="tooltip" data-placement="top" title="Hapus Data" type="button" class='d-sm-inline-block btn btn-sm btn-danger shadow-sm' onclick="return confirm('Yakin Ingin Menghapus Data Ini?')"><span class="fa fa-trash" aria-hidden="true"></span></button></a>
                          <?php } ?>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'src/footer.php'; ?>