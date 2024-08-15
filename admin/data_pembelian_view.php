<?php include 'src/header.php'; ?>

<div class="row column2 graph margin_bottom_30">
   <div class="col-md-l2 col-lg-12">
      <div class="white_shd full">
         <div class="full graph_head">
            <div class="heading1 margin_0">
               <h2>VIEW DATA PEMBELIAN</h2>
            </div>
         </div>

         <?php
         $id_pembelian = $_GET['id_pembelian'];
         $query        = mysqli_query($koneksi, "SELECT  * FROM data_barang b, data_pembelian c, data_kategori d WHERE c.id_barang = b.id_barang AND b.id_kategori = d.id_kategori AND c.id_pembelian = '$id_pembelian'");
         $data         = mysqli_fetch_array($query);
         ?>

         <div class="full graph_head">
            <div class="row">
               <div class="col-md-12">
                  <div class="content">
                     <div class="table-responsive-sm">
                        <form action="data_pembelian.php" method="POST">
                           <div class="form-group">
                              <label class="form-control-label" for="id_barang">Tanggal Pembelian</label>
                              <input type="text" class="form-control" value="<?= $data['tanggal_beli'] ?>" name="id_barang" readonly>
                           </div>
                           <div class="form-group">
                              <label class="form-control-label" for="id_barang">Kategori Barang</label>
                              <input type="text" class="form-control" value="<?= $data['kategori'] ?>" name="id_barang" readonly>
                           </div>
                           <div class="form-group">
                              <label class="form-control-label" for="id_barang">Nama Barang</label>
                              <input type="text" class="form-control" value="<?= $data['nama_barang'] ?>" name="id_barang" readonly>
                           </div>
                           <div class="form-group">
                              <label class="form-control-label" for="tanggal_beli">Tanggal Pembelian</label>
                              <input type="date" class="form-control" name="tanggal_beli" value="<?= $data['tanggal_beli'] ?>" autocomplete="off" readonly>
                           </div>
                           <div class="form-group">
                              <label class="form-control-label" for="harga_beli">Harga</label>
                              <input type="number" class="form-control" name="harga_beli" id="harga_beli" value="<?= $data['harga_beli'] ?>" placeholder="Harga" autocomplete="off" readonly>
                           </div>
                           <div class="form-group">
                              <label class="form-control-label" for="jumlah_beli">Jumlah Pembelian</label>
                              <input type="number" class="form-control" name="jumlah_beli" value="<?= $data['jumlah_beli'] ?>" onkeyup="perkalian();" id="jumlah_beli" placeholder="Jumlah Pembelian" autocomplete="off" readonly>
                           </div>
                           <div class="form-group">
                              <label class="form-control-label" for="total_harga">Total Harga</label>
                              <input type="number" class="form-control" name="total_harga" id="total_harga" value="<?= $data['total_harga'] ?>" placeholder="Harga" autocomplete="off" readonly>
                           </div>
                           <div class="form-group">
                              <label class="form-control-label" for="pengisi">Pengisi Data</label>
                              <input type="text" class="form-control" name="pengisi" id="pengisi" value="<?= $data['pengisi'] ?>" placeholder="Pengisi Data" autocomplete="off" readonly>
                           </div>
                           <div class="form-group">
                              <button type="submit" class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm' name="simpan"><span aria-hidden="true"></span>Kembali</button>
                           </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?php include 'src/footer.php'; ?>