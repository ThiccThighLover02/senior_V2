<?php
include '../database/db_connect.php';
include '../queries/requests_queries.php';
include '../queries/senior_queries.php';


$html = "";
if(isset($_GET['table']) && $_GET['table'] === 'seniors'){
    $senior_row = getAllSeniors($conn); //get all the seniors from the database
    $html .= <<<HTML
    <table class="table table-sm table-striped table-bordered" id="senior-table">
        <thead>
            <tr>
                <th>Senior No</th>
                <th>Status</th>
                <th>Name</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
    HTML;
    
    foreach ($senior_row as $senior) {
        $senior_id = str_pad($senior['senior_id'], 6, "0", STR_PAD_LEFT);
        $html .= <<<HTML
            <tr>
                <td class="text-center align-middle">{$senior_id}</td>
                <td class="text-center align-middle">{$senior['status']}</td>
                <td class="text-center align-middle">{$senior['first_name']} {$senior['last_name']}</td>
                <td class="d-grid"><button id="view-senior" data-senior-id={$senior['senior_id']} class="btn btn-primary">View Senior</button></td>
            </tr>
        HTML;
    }
    
    $html .= <<<HTML
            
        </tbody>
    </table>
    HTML;
    
    echo $html;
}
elseif(isset($_GET['table']) && $_GET['table'] === 'requests'){
    $request_row = getRequest($conn, "all");
    $html .= <<<HTML
<table class="table table-sm table-striped table-bordered" id="senior-table">
    <thead>
        <tr>
            <th>Request No.</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
HTML;

foreach ($request_row as $request) {
        $full_name = $request['first_name'] . " " . $request['last_name'];
        $html .= <<<HTML
        <tr>
            <td class="text-center align-middle">{$request['request_id']}</td>
            <td class="text-center align-middle">{$full_name} has sent a request</td>
            <td class="text-center align-middle"><button class="btn btn-primary" id="view-info" data-button-id={$request['request_id']} >View Request</button></td>
        </tr>
        HTML;
}

$html .= <<<HTML
        
    </tbody>
</table>
HTML;

echo $html;
}
