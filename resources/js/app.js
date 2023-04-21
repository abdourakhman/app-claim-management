require('./bootstrap');


import "admin-lte/plugins/jquery/jquery";
import "admin-lte/plugins/bootstrap/js/bootstrap.bundle";
import "admin-lte/dist/js/adminlte";

const select = document.getElementById("inputGroupSelect01");
  const cinField = document.getElementById("cin-field");
  const technicienField = document.getElementById("technicien-field");
  const typesTechnicien = document.getElementById("types");

  select.addEventListener("change", () => {
    const selectedValue = select.value;
    if (selectedValue === "client") {
      cinField.style.display = "block";
      technicienField.style.display = "none";
    } else if (selectedValue === "technicien") {
      cinField.style.display = "none";
      technicienField.style.display = "block";
    } else {
      cinField.style.display = "none";
      technicienField.style.display = "none";
    }
    typesTechnicien.innerText()
  });

  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });