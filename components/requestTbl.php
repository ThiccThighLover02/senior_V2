<?php
include '../database/db_connect.php';
include '../queries/senior_queries.php';

$senior_row = getAllSeniors($conn); //get all the seniors from the database

$html = "";

$html .= <<<HTML
<table class="table table-striped table-bordered" id="senior-table">
    <thead>
        <tr>
            <th>Request No.</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
HTML;

foreach ($senior_row as $senior) {
    $senior_id = str_pad($senior['senior_id'], 6, "0", STR_PAD_LEFT);
    $html .= <<<HTML
        <tr>
            <td class="text-center align-middle">72</td>
            <td class="text-center align-middle">Carlson San Nicolas Magtalas has sent a request</td>
            <td class="text-center align-middle"><button class="btn btn-primary">View Request</button></td>
        </tr>
    HTML;
}

$html .= <<<HTML
        
    </tbody>
</table>
HTML;

echo $html;
