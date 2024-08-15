</div>
</div>
<!-- footer -->
<div class="container-fluid">
   <div class="footer">
   <br><center><strong>Copyright &copy; 2022 <a>Start Bootstrap</a>.</strong>
   All rights reserved.</center>
   </div>
</div>
</div>
<!-- end dashboard inner -->
</div>
</div>
</div>

<script src="../assets/admin/js/jquery.min.js"></script>
<script src="../assets/admin/js/popper.min.js"></script>
<script src="../assets/admin/js/bootstrap.min.js"></script>
<script src="../assets/admin/js/animate.js"></script>
<script src="../assets/admin/js/bootstrap-select.js"></script>
<script src="../assets/admin/js/owl.carousel.js"></script>

<script src="../assets/admin/js/utils.js"></script>
<script src="../assets/admin/js/analyser.js"></script>
<script src="../assets/admin/js/perfect-scrollbar.min.js"></script>
<script>
   var ps = new PerfectScrollbar('#sidebar');
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script src="../assets/admin/js/jquery.fancybox.min.js"></script>
<script src="../assets/admin/js/custom.js"></script>
<script src="../assets/admin/js/semantic.min.js"></script>

<script>
   $(document).ready(function() {
      $('#tabel-data').DataTable();
   });
</script>
<script>
   $(document).ready(function() {
      $('#tabel1').DataTable();
   });
</script>
<script>
   $(document).ready(function() {
      $('#tabel2').DataTable();
   });
</script>
<script>
   $(document).ready(function() {
      $('#tabel3').DataTable();
   });
</script>
<script>
   $(document).ready(function() {
      $('#tabel4').DataTable();
   });
</script>
<script>
   $(document).ready(function() {
      $('#tabel5').DataTable();
   });
</script>
<script>
   $(document).ready(function() {
      $('#tabel6').DataTable();
   });
</script>
<script>
   $(document).ready(function() {
      $('#tabel7').DataTable();
   });
</script>
<script>
   $(document).ready(function() {
      $('#tabel8').DataTable();
   });
</script>
<script>
   $(document).ready(function() {
      $('#tabel9').DataTable();
   });
</script>
<script>
   $(document).ready(function() {
      $('#tabel10').DataTable();
   });
</script>
<script>
   $(document).ready(function() {
      $('#tabel11').DataTable();
   });
</script>
<script>
   $(document).ready(function() {
      var table = $('#tabel-data').DataTable();

      table.on('search.dt', function() {
         updateFooter();
      });

      function updateFooter() {
         var data = table.rows({
            search: 'applied'
         }).data();
         var restocks = 0;
         var jumlah_harga_siapkan = 0;

         data.each(function(value, index) {
            restocks += parseInt(value[7]); // Indeks 7 adalah kolom "Jumlah Sisa Stok"
            jumlah_harga_siapkan += parseInt(value[9].replace(/\./g, '')); // Indeks 9 adalah kolom "Harga yang Disiapkan", perlu mengganti format ribuan
         });

         // Perbarui tfoot
         $('#tabel-data tfoot td').eq(1).html(restocks);
         $('#tabel-data tfoot td').eq(2).html(jumlah_harga_siapkan.toLocaleString('id-ID'));
      }

      // Panggil updateFooter saat halaman dimuat
      updateFooter();
   });
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script type="text/javascript">
   $(document).ready(function() {
      $('#tahun_tebit').select2({
         placeholder: 'Pilih Tahun Terbit',
         allowClear: true
      });
   });
</script>
<script>
   // Data yang akan digunakan untuk chart
   const labels = ['Akurasi (%)', 'Presisi (%)', 'Recall (%)'];
   const data = [
      <?php
      echo $accuracy . ', ';
      echo $precision . ', ';
      echo $recall . ', ';
      ?>
   ];

   // Menggambar chart menggunakan Chart.js
   const ctx = document.getElementById('myChart').getContext('2d');
   const myChart = new Chart(ctx, {
      type: 'bar',
      data: {
         labels: labels,
         datasets: [{
            label: 'Performance Metrics',
            data: data,
            backgroundColor: [
               'rgba(220, 53, 69, 1)', // Akurasi - Merah
               'rgba(40, 167, 69, 1)', // Presisi Cukup - Biru
               'rgba(0, 123, 255, 1)', // Presisi Kurang - Kuning
            ],
            borderColor: [
               'rgba(255, 99, 132, 1)',
               'rgba(54, 162, 235, 1)',
               'rgba(255, 206, 86, 1)',
            ],
            borderWidth: 1
         }]
      },
      options: {
         scales: {
            y: {
               beginAtZero: true
            }
         }
      }
   });
</script>
</body>

</html>