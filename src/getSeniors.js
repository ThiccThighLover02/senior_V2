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
      let { success, htmlData, seniors } = data;
      spinner.hide();
      tableContainer.removeClass("d-flex justify-content-center");
      if (success) {
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
            text: "<i class='bi bi-filetype-pdf'></i> PDF",
            className: "btn btn-info text-white rounded",
          },
          {
            extend: "spacer",
          },
          {
            extend: "spacer",
          },
          {
            text: "<i class='bi bi-file-earmark-excel'></i> Excel",
            className: "btn btn-info text-white rounded",
            action: function () {
              console.log("You have downloaded an excel file");
            },
          },
          {
            extend: "spacer",
          },
          {
            extend: "spacer",
          },
          {
            text: "<i class='bi bi-person-add'></i> Add Senior",
            className: "btn btn-info text-white rounded",
            action: function () {
              console.log("You have Added a senior");
            },
          },
        ],
        // Enable Bootstrap pagination
        pagingType: "full_numbers",
        language: {
          paginate: {
            previous: '<i class="bi bi-chevron-left"></i>',
            next: '<i class="bi bi-chevron-right"></i>',
          },
        },
      }); //initialize the table that we have imported
    })
    .catch((err) => console.log(err));

  // Add Bootstrap classes to the pagination buttons
  $(".dataTables_paginate .paginate_button").on("click", function () {
    $(".dataTables_paginate .paginate_button").removeClass(
      "btn-primary text-white"
    );
    $(this).addClass("btn-primary text-white");
  });

  // Style the active page number when the table is drawn
  table.on("draw", function () {
    const currentPage = table.page.info().page;
    $(
      `.dataTables_paginate .paginate_button[data-dt-idx=${currentPage}]`
    ).addClass("btn-primary text-white");
  });

  tableContainer.on("click", "#view-senior", function () {
    let buttonValue = $(this).data("senior-id");
    console.log(buttonValue);
    window.location.href = `../admin/admin_view_senior.php?id=${buttonValue}`;
  });
});
