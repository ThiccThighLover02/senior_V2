// Import jQuery and DataTables
import getData from "./service.js";
import initializeTable from "./table.js";

// Initialize DataTable
$(document).ready(function () {
  let tableContainer = $("#table-container");
  let spinner = $("#spinner");
  console.log(
    "this server is working even after the after i opened the server"
  );

  getData("/components/tables.php?table=seniors")
    .then((response) => response.json())
    .then((data) => {
      let {success, htmlData, seniors} = data;
      spinner.hide();
      tableContainer.removeClass("d-flex justify-content-center");
      if(success){
        console.log(seniors);
      }
      tableContainer.html(htmlData);
      initializeTable("#senior-table", {
        responsive: true,
        scrollCollapse: true,
        scrollY: "255px",
        ordering: true,
        dom:
          '<"row mb-2"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>' +
          '<"row"<"col-sm-12"tr>>' +
          '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        buttons: [
          {
            extend: "pdf",
            text: "<i class='fa-regular fa-file-pdf'></i> PDF",
            className: "btn btn-info text-white rounded",
          },
          {
            extend: "spacer",
          },
          {
            extend: "spacer",
          },
          {
            extend: "excel",
            text: "<i class='fa-regular fa-newspaper'></i> download excel",
            className: "btn btn-info text-white",
          },
          {
            text: "Add Senior",
            className: "btn btn-info text-white rounded",
            action: function () {
              console.log("You have Added a senior");
            },
          },
        ],
      }); //initialize the table that we have imported
    })
    .catch((err) => console.log(err));

  tableContainer.on("click", "#view-senior", function () {
    let buttonValue = $(this).data("senior-id");
    console.log(buttonValue);
    window.location.href = `../admin/admin_view_senior.php?id=${buttonValue}`;
  });
});
