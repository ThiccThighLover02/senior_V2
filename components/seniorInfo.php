<?php
include '../database/db_connect.php'; //import so we can access the db
include '../queries/requests_queries.php'; //queries for the requests
include '../queries/senior_queries.php'; //queries for the seniors
$html = "";
if (isset($_GET['id']) && $_GET['info'] === 'profile') {
    $senior = getOneSenior($conn, $_GET['id']);
    $birth_date = new DateTime($senior['date_birth']);
    $joined = new DateTime($senior['account_created']);
    $other_health = unserialize($senior['health']);
    $contact1 = str_pad($senior['cell_no'], 13, "+63", STR_PAD_LEFT);
    $contact2 = str_pad($senior['emergency_no'], 13, "+63", STR_PAD_LEFT);

    $html .= <<<HTML
    
    <div class="text-start">
        <a id="return" class="btn btn-lg btn-outline-primary border-0 text-dark" href="./admin_senior.php"><i class="fa-solid fa-arrow-left"></i> Return</a>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex flex-column align-items-center">
                <img style="width: 30%" class="img-thumbnail mb-2" src="../assets/seniors/profile/{$senior['id_pic']}" alt="senior_profile">
                <h2>{$senior['first_name']} {$senior['last_name']}</h2>
                <p>Joined on {$joined->format("F Y")}</p>
            </div>
    
        </div>
        <div class="row">
            <div class="col">
                <!-- These are the tabs for the profile -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                    </li>
                    <li class="nav-item  " role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Contact Info</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Health Info</button>
                    </li>
                </ul>
            </div>
            <!-- These are the content of each tab -->
            <div class="tab-content p-2" id="tabContent">
                <!-- Home Tab starts here -->
                <div class="tab-pane fade active" role="tabpanel" id="home">
                    <div class="row">
                        <div class="col-6 d-flex flex-column text-start">
                            <h3 class="text-primary m-0">Address</h3>
                            <p>{$senior['purok_no']}, {$senior['barangay_name']}, {$senior['municipality_name']}, {$senior['province_name']} </p>
                        </div>
                        <div class="col-6 text-start">
                            <h3 class="text-primary m-0">Birthdate</h3>
                            <p>{$birth_date->format("M d, Y")}</p>
                        </div>
                        <div class="col-6 text-start">
                            <h3 class="text-primary m-0">Birthplace</h3>
                            <p>{$senior['birth_place']}</p>
                        </div>
                        <div class="col-6 text-start">
                            <h3 class="text-primary m-0">Gender</h3>
                            <p>{$senior['sex']}</p>
                        </div>
                        <div class="col-6 text-start">
                            <h3 class="text-primary m-0">Citizenship</h3>
                            <p>{$senior['citizenship']}</p>
                        </div>
                        <div class="col-6 text-start">
                            <h3 class="text-primary m-0">Age</h3>
                            <p>22 years old</p>
                        </div>
                        <div class="col-6 text-start">
                            <h3 class="text-primary m-0">Education</h3>
                            <p>{$senior['education_attainment']}</p>
                        </div>
                        <div class="col-6 text-start">
                            <h3 class="text-primary m-0">Religion</h3>
                            <p>{$senior['religion_name']}</p>
                        </div>
                        <div class="col-6 text-start">
                            <h3 class="text-primary m-0">Civil Status</h3>
                            <p>{$senior['civil_status']}</p>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" role="tabpanel" id="profile">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="text-primary">Contact Number</h3>
                            <p>{$contact1}</p>
                        </div>
                        <div class="col-6">
                            <h3 class="text-primary">Guardian's number</h3>
                            <p>{$contact2}</p>
                        </div>
                        <div class="col-6">
                            <h3 class="text-primary">Email Address</h3>
                            <p>{$senior['senior_email']}</p>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" role="tabpanel" id="contact">
                    <div class="row">
                        <div class="col-6">
                        <h3 class="text-primary">Blood Type</h3>
                            <p>{$senior['blood_type']}</p>
                        </div>
                        <div class="col-6">
                        <h3 class="text-primary">Physical Disability</h3>
                            <p>{$senior['physical_disability']}</p>
                        </div>
                        <div class="col-6">
                        <h3 class="text-primary">Health Conditions</h3>
                            <ul class="list-group">
    HTML;

                        foreach($other_health as $key => $health){
                            $html .= <<<HTML
                                <li class="list-group-item">{$health}</li>
                            HTML;
                        }

    $html .= <<<HTML
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    HTML;
    echo $html;
} elseif (isset($_GET['id']) && $_GET['info'] === 'request') { //if the information needed is from a request
    $id = $_GET['id']; //Get the id
    $request = getRequestInfo($conn, $id); //get all the info of the request from the id
    $contact1 = str_pad($request['cell_no'], 13, "+63", STR_PAD_LEFT);
    $contact2 = str_pad($request['emergency_no'], 13, "+63", STR_PAD_LEFT);
    $other_health = unserialize($request['health']);

    $html .= <<<HTML
    
    <div class="text-start">
        <a id="return" class="btn btn-lg btn-outline-primary border-0 text-dark" href="./admin_requests.php"><i class="fa-solid fa-arrow-left"></i> Return</a>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex flex-column align-items-center">
                <img style="width: 30%" class="img-thumbnail mb-2" src="../assets/seniors/profile/{$request['id_pic']}" alt="senior_profile">
                <h2>{$request['first_name']} {$request['last_name']}</h2>
            </div>
    
        </div>
        <div class="row">
            <div class="col">
                <!-- These are the tabs for the profile -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Home</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Contact Info</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button" role="tab" aria-controls="contact" aria-selected="false">Health Info</button>
                    </li>
                </ul>
            </div>
            <!-- These are the content of each tab -->
            <div class="tab-content p-2" id="tabContent">
                <!-- Home Tab starts here -->
                <div class="tab-pane fade active" role="tabpanel" id="home">
                    <div class="row">
                        <div class="col-6 d-flex flex-column text-start">
                            <h3 class="text-primary m-0">Address</h3>
                            <p>{$request['purok_no']}, {$request['barangay_name']}, {$request['municipality_name']}, {$request['province_name']} </p>
                        </div>
                        <div class="col-6 text-start">
                            <h3 class="text-primary m-0">Birthdate</h3>
                            <p>April 2, 2002</p>
                        </div>
                        <div class="col-6 text-start">
                            <h3 class="text-primary m-0">Birthplace</h3>
                            <p>{$request['birth_place']}</p>
                        </div>
                        <div class="col-6 text-start">
                            <h3 class="text-primary m-0">Gender</h3>
                            <p>{$request['sex']}</p>
                        </div>
                        <div class="col-6 text-start">
                            <h3 class="text-primary m-0">Citizenship</h3>
                            <p>{$request['citizenship']}</p>
                        </div>
                        <div class="col-6 text-start">
                            <h3 class="text-primary m-0">Age</h3>
                            <p>22 years old</p>
                        </div>
                        <div class="col-6 text-start">
                            <h3 class="text-primary m-0">Education</h3>
                            <p>{$request['education_attainment']}</p>
                        </div>
                        <div class="col-6 text-start">
                            <h3 class="text-primary m-0">Religion</h3>
                            <p>{$request['religion_name']}</p>
                        </div>
                        <div class="col-6 text-start">
                            <h3 class="text-primary m-0">Civil Status</h3>
                            <p>{$request['civil_status']}</p>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" role="tabpanel" id="profile">
                    <div class="row">
                        <div class="col-6">
                            <h3 class="text-primary">Contact Number</h3>
                            <p>{$contact1}</p>
                        </div>
                        <div class="col-6">
                            <h3 class="text-primary">Guardian's number</h3>
                            <p>{$contact2}</p>
                        </div>
                        <div class="col-6">
                            <h3 class="text-primary">Email Address</h3>
                            <p>{$request['senior_email']}</p>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" role="tabpanel" id="contact">
                    <div class="row">
                        <div class="col-6">
                        <h3 class="text-primary">Blood Type</h3>
                            <p>{$request['blood_type']}</p>
                        </div>
                        <div class="col-6">
                        <h3 class="text-primary">Physical Disability</h3>
                            <p>None</p>
                        </div>
                        <div class="col-6">
                        <h3 class="text-primary">Health Conditions</h3>
                            <ul class="list-group">
    HTML;
    foreach($other_health as $key => $health){
        $html .= <<<HTML
            <li class="list-group-item">{$health}</li>
        HTML;
    }
    $html .= <<<HTML
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    HTML;
    echo $html;
}
