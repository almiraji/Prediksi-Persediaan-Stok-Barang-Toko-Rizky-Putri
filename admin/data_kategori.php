<?php include 'src/header.php'; ?>

<div class="row column2 graph margin_bottom_30">
  <div class="col-md-l2 col-lg-12">
    <div class="white_shd full">
      <div class="full graph_head">
        <div class="heading1 margin_0 fw-bold">
          <h2>DATA KATEGORI</h2>
        </div>
      </div>
      <div class="full graph_head">
        <div class="row">
          <div class="col-md-12">
            <div class="content">
              <?php if ($_SESSION['level'] == 'admin') : ?>
                <a href="data_kategori_tambah.php"><button data-toggle="tooltip" data-placement="top" title="Tambah Data" type="button" class='d-sm-inline-block btn btn-sm btn-success shadow-sm'><span class="fa fa-plus" aria-hidden="true"></span></button></a>
              <?php endif; ?>
              <hr>
              <div class="table-responsive">
                <table class="table table-striped table-bordered" id="tabel-data">
                  <thead>
                    <tr>
                      <th class="text-dark">No</th>
                      <th class="text-dark">Kategori Barang</th>
                      <th class="text-dark">Pengisi Data</th>
                      <?php if ($_SESSION['level'] == 'admin2') : ?>
                        <th class="text-dark">Action</th>
                      <?php endif; ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    $query = mysqli_query($koneksi, "SELECT * FROM data_kategori ORDER BY id_kategori DESC");
                    while ($data = mysqli_fetch_array($query)) {
                    ?>
                      <tr>
                        <td class="text-dark"><?= $no++ ?></td>
                        <td class="text-dark"><?= $data['kategori'] ?></td>
                        <td class="text-dark"><?= $data['pengisi'] ?></td>
                        <?php if ($_SESSION['level'] == 'admin2') : ?>
                          <td>
                            <a href="data_kategori_edit.php?id_kategori=<?= $data['id_kategori'] ?>"><button data-toggle="tooltip" data-placement="top" title="Edit Data" type="button" class='d-sm-inline-block btn btn-sm btn-primary shadow-sm'><span class="fa fa-pencil" aria-hidden="true"></span></button></a>
                            <a href="data_kategori_hapus.php?id_kategori=<?= $data['id_kategori'] ?>"><button data-toggle="tooltip" data-placement="top" title="Hapus Data" type="button" class='d-sm-inline-block btn btn-sm btn-danger shadow-sm' onclick="return confirm('Yakin Ingin Menghapus Data Ini?')"><span class="fa fa-trash" aria-hidden="true"></span></button></a>
                          </td>
                        <?php endif; ?>
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