import jszip from "jszip";
import pdfmake from "pdfmake/build/pdfmake";
import pdfFonts from "pdfmake/build/vfs_fonts";
import DataTable from "datatables.net-bs5";
import "datatables.net-buttons-bs5";
import "datatables.net-buttons/js/buttons.colVis.mjs";
import "datatables.net-buttons/js/buttons.html5.mjs";
import "datatables.net-buttons/js/buttons.print.mjs";
import "datatables.net-responsive-bs5";
import "datatables.net-scroller-bs5";
import "datatables.net-searchpanes-bs5";

//Thse are the stylings for the dataTables
import "datatables.net-bs5/css/dataTables.bootstrap5.min.css";
import "datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css";
import "datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css";
import "datatables.net-scroller-bs5/css/scroller.bootstrap5.min.css";
import "datatables.net-searchpanes-bs5/css/searchPanes.bootstrap5.min.css";

import 'bootstrap-icons/font/bootstrap-icons.css'; //bootstrap icons

pdfmake.vfs = pdfFonts.pdfMake.vfs;
function initializeTable(selector, configurations = {}) {
  let table = new DataTable(selector, configurations) 
  return table;
}

export default initializeTable;
