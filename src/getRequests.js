import getData from "./service.js";
import DataTable from 'datatables.net-bs5';
import 'datatables.net-buttons-bs5';
import 'datatables.net-buttons/js/buttons.colVis.mjs';
import 'datatables.net-buttons/js/buttons.html5.mjs';
import 'datatables.net-buttons/js/buttons.print.mjs';
import 'datatables.net-responsive-bs5';
import 'datatables.net-scroller-bs5';
import 'datatables.net-searchpanes-bs5';

$(document).ready(function () {
  let tableContainer = $("#table-container");
  let spinner = $("#spinner");

  getData("components/tables.php?table=requests")
    .then((response) => response.text())
    .then((data) => {
      spinner.hide(); //remove the spinner
      tableContainer.removeClass("d-flex justify-content-center"); //remove the classes
      tableContainer.html(data); //print the data in the tableContainer
      // $("#senior-table").DataTable({
      //   //initialize the table
      //   responsive: true,
      //   scrollCollapse: true,
      //   scrollY: "255px",
      // });
    })

  tableContainer.on("click", "#view-info", function () {
    let infoData = $(this).data("button-id");
    console.log(infoData);
    window.location.href = `../admin/admin_view_request.php?id=${infoData}&info=request`;
  });
});
