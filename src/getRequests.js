import getData from "./service.js";
import initializeTable from "./table.js";

$(document).ready(function () {
  let tableContainer = $("#table-container");
  let spinner = $("#spinner");

  getData("components/tables.php?table=requests")
    .then((response) => response.json())
    .then((data) => {
      let {success, htmlData, seniors} = data;
      spinner.hide(); //remove the spinner
      tableContainer.removeClass("d-flex justify-content-center"); //remove the classes
      tableContainer.html(htmlData); //print the data in the tableContainer
      if(success){
        console.log(seniors);
      }
      initializeTable("#senior-table", {
        responsive: true,
        scrollCollapse: true,
        scrollY: "255px",
      });
      console.log("this should be working though");
      // $("#senior-table").DataTable({
      //   //initialize the table
      //   responsive: true,
      //   scrollCollapse: true,
      //   scrollY: "255px",
      // });
    })
    .catch((err) => {
      console.log(`This is the error: ${err}`);
    });

  tableContainer.on("click", "#view-info", function () {
    let infoData = $(this).data("button-id");
    console.log(infoData);
    window.location.href = `../admin/admin_view_request.php?id=${infoData}&info=request`;
  });
});
