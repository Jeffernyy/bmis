<!-- Input Mask -->
<script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/inputmask/jquery.inputmask.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../plugins/jszip/jszip.min.js"></script>
<script src="../../plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<!-- Bootstrap -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- Select2 -->
<script src="../../plugins/select2/js/select2.full.min.js"></script>
<!-- bs-custom-file-input -->
<script src="../../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Ekko Lightbox -->
<script src="../../plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- SweetAlert2 -->
<script src="../../plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- jquery-validation -->
<script src="../../plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../../plugins/jquery-validation/additional-methods.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="../../plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- Application Script -->
<script src="../../app/js/dttbls.js"></script>

<!-- jQuery Mapael -->
<script src="../../plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../../plugins/raphael/raphael.min.js"></script>
<script src="../../plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../../plugins/jquery-mapael/maps/usa_states.min.js"></script>

<!-- ChartJS -->
<script src="../../plugins/chart.js/Chart.min.js"></script>
<script type="text/javascript">

  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })

  function checkMain(x) {
    var checked = $(x).prop('checked');
    $('.cbxMain').prop('checked', checked)
    $('tr:visible').each(function () {
      $(this).find('.chk_delete').each(function () {
        this.checked = checked;
      });
    });
  }

  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function (event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true,
        // this line is to limit the gallery to the current modal
        galleryParentSelector: '#viewModal' + $(this).closest('.modal').attr('id'),
      });
    });
  });

  $(document).ready(function () {
    $('.chk_delete').click(function () {
      if ($('.chk_delete:checked').length == $('.chk_delete').length) {
        $('.cbxMain').prop('checked', true);
      }
      else {
        $('.cbxMain').prop('checked', false);
      }
      $('#check-all').click(function () {
        $("input:checkbox").attr('checked', true);
      });
    });
    $('.no-print').hide();
  });

  /* auto select the first input that has autofocus attr */
  $(".modal").on("shown.bs.modal", function () {
    $(this).find("[autofocus]").focus();
  });

  $(".select2").select2();
  $("[data-mask]").inputmask();

  $(function () {
    bsCustomFileInput.init();
  });
</script>