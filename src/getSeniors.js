// Import jQuery and DataTables
import getData from './service.js';
import jszip from 'jszip';
import pdfmake from 'pdfmake';
import DataTable from 'datatables.net-bs5';
import 'datatables.net-buttons-bs5';
import 'datatables.net-buttons/js/buttons.colVis.mjs';
import 'datatables.net-buttons/js/buttons.html5.mjs';
import 'datatables.net-buttons/js/buttons.print.mjs';
import 'datatables.net-responsive-bs5';
import 'datatables.net-scroller-bs5';
import 'datatables.net-searchpanes-bs5';

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
    let table = new DataTable('#senior-table', {
      info: false,
      ordering: false,
      paging: false
    });
  })
  .catch(err => console.log(err))

  tableContainer.on("click", "#view-senior", function(){
    let buttonValue = $(this).data("senior-id");
    console.log(buttonValue);
    window.location.href = `../admin/admin_view_senior.php?id=${buttonValue}`;
  });
    
});