   <!--  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script> -->
  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
  -->
  <!-- </body>
</html> -->

  <!-- Main Footer -->
 <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      BEES DEV.
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; Beyond Errors for Easy Solution 2020.</strong> All rights reserved.
</footer>
  <!--  -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?=base_url();?>/plugins/jquery/jquery.min.js"></script>
<script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url();?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url();?>/stemp/js/adminlte.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?=base_url();?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?=base_url();?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?=base_url();?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?=base_url();?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?=base_url();?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?=base_url();?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?=base_url();?>/plugins/jszip/jszip.min.js"></script>
<script src="<?=base_url();?>/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?=base_url();?>/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?=base_url();?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?=base_url();?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?=base_url();?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Page specific script -->
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url();?>/stemp/js/demo.js"></script>
<script src="<?=base_url();?>/plugins/fullcalendar/main.min.js"></script>
<script src="<?=base_url();?>/plugins/moment/moment.min.js"></script>
<script src="<?=base_url();?>/plugins/myAlert/myAlerts.js"></script>
<script src='<?=base_url();?>/plugins/sweetalert2/sweetalert2.js'></script>

<!-- Page specific script -->

<script>

  $(function () {
    $("#example1").DataTable({
      "responsive": true, 
      "lengthChange": false, 
      "autoWidth": false,
      "ordering": true,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#students_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>

<script>
    let dateDropdown = document.getElementById('Year');

    let currentYear = new Date().getFullYear();
    let earliestYear = 2010;

    while (currentYear >= earliestYear) {
      let dateOption = document.createElement('option');
      dateOption.text = currentYear;
      dateOption.value = currentYear;
      dateDropdown.add(dateOption);
      currentYear -= 1;
    }
  </script>

<!-- time -->
  <script type="text/javascript">
    var timestamp = '<?=time();?>';
    function updateTime(){
    $('#time').html(Date(timestamp));
      timestamp++;
      }
     $(function(){
       setInterval(updateTime, 1000);
      });
  </script>


</body>
</html>
