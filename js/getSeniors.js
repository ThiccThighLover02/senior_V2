// Import jQuery and DataTables
import getData from './service.js';

// Initialize DataTable
$(document).ready(function() {
  let tableContainer = $("#table-container");
  let spinner = $("#spinner");

  getData('/components/tables.php?table=seniors')
  .then(response => response.text())
  .then(data => {
    spinner.hide();
    tableContainer.removeClass("d-flex justify-content-center");
    tableContainer.html(data);
    $("#senior-table").DataTable({
      responsive: true
    });
  })
  .catch(err => console.log(err))

  tableContainer.on("click", "#view-senior", function(){
    let buttonValue = $(this).data("senior-id");
    console.log(buttonValue);
    window.location.href = `../admin/admin_view_senior.php?id=${buttonValue}`;
  });
    
});