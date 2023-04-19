require('./bootstrap');


import "admin-lte/plugins/jquery/jquery";
import "admin-lte/plugins/bootstrap/js/bootstrap.bundle";
import "admin-lte/dist/js/adminlte";

const select = document.getElementById("inputGroupSelect01");
  const cinField = document.getElementById("cin-field");
  const technicienField = document.getElementById("technicien-field");

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
  });