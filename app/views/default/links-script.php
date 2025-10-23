 <!-- jQuery 3 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script src="html/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="html/bower_components/jquery-ui/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge("uibutton", $.ui.button);
    </script>
    <!-- Bootstrap 3.3.7 -->
    <script src="html/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Morris.js charts -->
    <script src="html/bower_components/raphael/raphael.min.js"></script>
    <script src="html/bower_components/morris.js/morris.min.js"></script>
    <!-- Sparkline -->
    <script src="html/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- jvectormap -->
    <script src="html/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
    <script src="html/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="html/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="html/bower_components/moment/min/moment.min.js"></script>
    <script src="html/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- datepicker -->
    <script src="html/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="html/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
    <!-- Slimscroll -->
    <script src="html/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <!-- FastClick -->
    <script src="html/bower_components/fastclick/lib/fastclick.js"></script>
    <!-- AdminLTE App -->
    <script src="html/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="html/dist/js/pages/dashboard.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="html/dist/js/demo.js"></script>
    <script>
  $(document).on("click", ".btnEditarCliente", function () {
  // Abrir modal
  $("#modalEditarCliente").modal("show");

  // Llenar campos del formulario
  $("#dni_cliente").val($(this).data("dni"));
  $("#nombres_cliente").val($(this).data("nombres"));
  $("#apellidos_cliente").val($(this).data("apellidos"));
  $("#correo_cliente").val($(this).data("correo"));
  $("#telefono_cliente").val($(this).data("telefono"));
  $("#lugar_nacimiento").val($(this).data("lugar"));
  $("#fecha_nacimiento").val($(this).data("fecha"));
  $("#estado_civil").val($(this).data("estado"));

  // Cambiar texto y acción del formulario
  $("#accion_cliente").val("editar");
  $("#titulo_modal_cliente").text("Editar Cliente");
  $("#btn_guardar_cliente").text("Actualizar");
});

</script>
