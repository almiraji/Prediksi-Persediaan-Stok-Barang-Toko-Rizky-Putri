<?php include 'src/header.php'; ?>

<div class="row column2 graph margin_bottom_30">
   <div class="col-md-l2 col-lg-12">
      <div class="white_shd full">
         <div class="full graph_head">
            <div class="heading1 margin_0">
               <h2>VIEW DATA HASIL PREDIKSI</h2>
            </div>
         </div>

         <div class="full graph_head">
            <div class="row">
               <div class="col-md-12">
                  <div class="content">
                     <div class="table-responsive-sm">
                        <form action="prediksi.php" method="post">
                           <div class="form-group">
                              <label class="form-control-label" for="nama_barang">Nama Barang</label>
                              <input type="text" class="form-control" value="<?= $_GET['nama_barang'] ?>" name="nama_barang" readonly>
                           </div>
                           <div class="form-group">
                              <label class="form-control-label" for="ukuran">Ukuran</label>
                              <input type="text" class="form-control" value="<?= $_GET['ukuran'] ?>" name="ukuran" readonly>
                           </div>
                           <div class="form-group">
                              <label class="form-control-label" for="harga">Harga</label>
                              <input type="number" class="form-control" name="harga" value="<?= $_GET['harga'] ?>" autocomplete="off" readonly>
                           </div>
                           <div class="form-group">
                              <label class="form-control-label" for="stok">Stok</label>
                              <input type="number" class="form-control" name="stok" id="stok" value="<?= $_GET['stok'] ?>" placeholder="Harga" autocomplete="off" readonly>
                           </div>
                           <div class="form-group">
                              <label class="form-control-label" for="terjual">Stok Terjual</label>
                              <input type="number" class="form-control" name="terjual" value="<?= $_GET['terjual'] ?>" id="jumlah_beli" autocomplete="off" readonly>
                           </div>
                           <div class="form-group">
                              <label class="form-control-label" for="hasil">Hasil Prediksi</label>
                              <input type="text" class="form-control" name="hasil" id="hasil" value="<?= $_GET['hasil'] ?>" autocomplete="off" readonly>
                           </div>
                           <div class="form-group">
                              <label class="form-control-label" for="selisih">Jumlah Sisa Stok</label>
                              <input type="number" class="form-control" name="selisih" id="selisih" value="<?= $_GET['selisih'] ?>" autocomplete="off" readonly>
                           </div>
                           <div class="form-group">
                              <label class="form-control-label" for="restock">Jumlah Restock</label>
                              <input type="number" class="form-control" name="restock" id="restock" value="<?= $_GET['restock'] ?>" autocomplete="off" readonly>
                           </div>
                           <div class="form-group">
                              <label class="form-control-label" for="harga_siapkan">Harga yang Disiapkan</label>
                              <input type="text" class="form-control" name="harga_siapkan" id="harga_siapkan" value="<?= $_GET['harga_siapkan'] ?>" autocomplete="off" readonly>
                           </div>
                           <div class="form-group">
                              <label class="form-control-label" for="keterangan">Keterangan</label>
                              <textarea class="form-control" name="keterangan" id="keterangan" readonly><?= $_GET['hasil'] == 'kurang' ? 'Stok barang ini kurang dan perlu ditambah. Permintaan tinggi ini menunjukkan bahwa produk ini populer. Pertimbangkan untuk menambah stok untuk bulan berikutnya.' : 'Stok barang ini cukup untuk bulan ini. Pertimbangkan untuk mempertahankan jumlah stok atau menyesuaikan sedikit berdasarkan penjualan selanjutnya.' ?></textarea>
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