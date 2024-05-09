<?php
    if($link === 'home'){ //if it's in the home page, these are the default links
        $bootstrap_css = "./styles/new_custom.scss";
        $bootstrap_js = './node_modules/bootstrap/dist/js/bootstrap.min.js';
        $jquery = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js";
        $dataTables = '<link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.5/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/fh-4.0.1/r-3.0.2/sc-2.4.1/sp-2.3.1/sr-1.4.1/datatables.min.css" rel="stylesheet">
 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.5/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/fh-4.0.1/r-3.0.2/sc-2.4.1/sp-2.3.1/sr-1.4.1/datatables.min.js"></script>';
    }
    elseif($link === 'users'){
        $bootstrap_css = "../styles/new_custom.scss";
        $bootstrap_js = '../node_modules/bootstrap/dist/js/bootstrap.min.js';
        $jquery = "https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js";
        $dataTables = '<link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.5/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/fh-4.0.1/r-3.0.2/sc-2.4.1/sp-2.3.1/sr-1.4.1/datatables.min.css" rel="stylesheet">
 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.5/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/fh-4.0.1/r-3.0.2/sc-2.4.1/sp-2.3.1/sr-1.4.1/datatables.min.js"></script>';
    }
?>