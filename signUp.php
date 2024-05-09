<?php
$link = 'home';
include './links.php'; //import the links
include './database/db_connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src=<?php echo $jquery ?>></script>
    <link rel="stylesheet" href=<?php echo $bootstrap_css ?>>
    <title>Login</title>
</head>

<body class="bg-light">
    <?php
    $active_nav = "login";
    include './components/navBar.php'
    ?>
    <div class="container pt-4">
        <div class="container">
            <div class="row d-flex">
                <div class="col-lg-6">
                    <div class="bg-white rounded-3 p-3">
                        <form id="login-form" class="d-flex flex-column" novalidate>
                            <h1 class=" text-center">Sign Up</h1>
                            <!-- Full Name -->
                            <div class="d-flex flex-column gap-3 mb-3">
                                <h3 class="">Full Name:</h3>
                                <div>
                                    <input id="firstName" name="first_name" type="text" class="form-control form-control-lg" placeholder="First Name" minlength="2" oninput="validateInput(this, 'text')" required>
                                    <span id="firstNameFeedback" class="invalid-feedback"></span>
                                </div>
                                <div>
                                    <input id="midName" name="mid_name" type="text" class="form-control form-control-lg" placeholder="Middle Name" minlength="2" oninput="validateInput(this, 'text')">
                                    <span class="invalid-feedback" id="midNameFeedback"></span>
                                </div>
                                <div>
                                    <input id="lastName" name="last_name" type="text" class="form-control form-control-lg" placeholder="Last Name" minlength="2" oninput="validateInput(this, 'text')" required>
                                    <span id="lastNameFeedback" class="invalid-feedback"></span>
                                </div>
                                <div>
                                    <select name="extension" id="extension" class="form-select form-select-lg" required>
                                        <option value="" hidden>Suffix</option>
                                        <option value="">None</option>
                                        <option value="Jr.">Jr.</option>
                                        <option value="Sr.">Sr.</option>
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                        <option value="III">III</option>
                                        <option value="IV">IV</option>
                                        <option value="V">V</option>
                                    </select>
                                    <span id="extensionFeedback" class="invalid-feedback">Select an option</span>
                                </div>
                            </div>
                            <!-- Address -->
                            <div class="d-flex flex-column gap-3 mb-3">
                                <h3 class="">Permanent Address</h3>
                                <!-- Purok -->
                                <div>
                                    <select name="purok" id="purok" class="form-select form-select-lg" required>
                                        <option value="" hidden>Purok</option>
                                        <?php
                                        include './queries/form_queries.php';
                                        //declare all the values that we are going to use for the select elements
                                        $purok_row = getPurok($conn);
                                        $barangay_row = getBarangay($conn);
                                        $municipality_row = getMunicipality($conn);
                                        $province_row = getProvince($conn);
                                        foreach ($purok_row as $purok) {
                                        ?>
                                            <option value="<?= $purok['purok_id'] ?>"><?= $purok['purok_no'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <span class="invalid-feedback">Required</span>
                                </div>
                                <!-- Barangay -->
                                <div>
                                    <select name="barangay" id="barangay" class="form-select form-select-lg" required>
                                        <option value="" hidden>Barangay</option>
                                        <?php
                                        foreach ($barangay_row as $barangay) {
                                        ?>
                                            <option value="<?= $barangay['barangay_id'] ?>"><?= $barangay['barangay_name'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <span class="invalid-feedback">Required</span>
                                </div>
                                <!-- Municipality -->
                                <div>
                                    <select name="municipality" id="municipality" class="form-select form-select-lg" required>
                                        <option value="" hidden>Municipality</option>
                                        <?php
                                        foreach ($municipality_row as $municipality) {
                                        ?>
                                            <option value="<?= $municipality['municipality_id'] ?>"><?= $municipality['municipality_name'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <span class="invalid-feedback">Required</span>
                                </div>
                                <!-- Province -->
                                <div>
                                    <select name="province" id="province" class="form-select form-select-lg" required>
                                        <option value="" hidden>Province</option>
                                        <?php
                                        foreach ($province_row as $province) {
                                        ?>
                                            <option value="<?= $province['province_id'] ?>"><?= $province['province_name'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <span class="invalid-feedback">Required</span>
                                </div>
                            </div>

                            <!-- Birth Information -->
                            <div class="d-flex flex-column gap-3 mb-3">
                                <h3 class="">Birth Information</h3>
                                <div>
                                    <input name="birth_date" id="birthDate" type="date" class="form-control form-control-lg" oninput="validateInput(this, 'date')" required>
                                    <span id="birthDateFeedback" class="invalid-feedback">Required</span>
                                </div>
                                <div>
                                    <input name="birth_place" id="birthPlace" type="text" class="form-control form-control-lg" placeholder="Birth Place" oninput="validateInput(this, 'required')" required>
                                    <span class="invalid-feedback" id="birthPlaceFeedback">Required</span>
                                </div>
                                <div>
                                    <input name="citizenship" id="citizenship" type="text" class="form-control form-control-lg" placeholder="Citizenship" minlength="2" oninput="validateInput(this, 'text')" required>
                                    <span id="citizenshipFeedback" class="invalid-feedback"></span>
                                </div>
                                <div>
                                    <select name="sex" id="" class="form-select form-select-lg" required>
                                        <option value="" hidden>Sex</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                    <span class="invalid-feedback">Required</span>
                                </div>
                            </div>
                            <!-- Health Information -->
                            <div class="d-flex flex-column mb-3">
                                <h3 class="">Health Information</h3>
                                <div class="mb-3">
                                    <select name="blood_type" id="blood-type" class="form-select form-select-lg" required>
                                        <option value="" hidden>Blood Type</option>
                                        <?php
                                        $blood_row = getBlood($conn);
                                        foreach ($blood_row as $blood) {
                                        ?>
                                            <option value="<?= $blood['blood_id'] ?>"><?= $blood['blood_type'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <span class="invalid-feedback">Required</span>
                                </div>
                                <!-- Physical Disability -->
                                <div class="mb-3">
                                    <select name="physical_disability" id="physical-disability" class="form-select form-select-lg" required>
                                        <option value="" hidden>Physical Disability</option>
                                        <?php
                                        $physical_row = getPhysical($conn);
                                        foreach ($physical_row as $physical) {
                                        ?>
                                            <option value="<?= $physical['physical_id'] ?>"><?= $physical['physical_disability'] ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                    <span class="invalid-feedback">Required</span>
                                </div>
                                <div class="form-check">
                                    <input name="other_health" id="other-health" value="Hypertension" type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label ">Hypertension</label>
                                </div>
                                <div class="form-check">
                                    <input name="other_health" id="other-health" value="Arthritis/Gout" type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label ">Arthritis/Gout</label>
                                </div>
                                <div class="form-check">
                                    <input name="other_health" id="other-health" value="Coronary Heart Disease" type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label ">Coronary Heart Disease</label>
                                </div>
                                <div class="form-check">
                                    <input name="other_health" id="other-health" value="Diabetes" type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label ">Diabetes</label>
                                </div>
                                <div class="form-check">
                                    <input name="other_health" id="other-health" value="Chronic Heart Disease" type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label ">Chronic Heart Disease</label>
                                </div>
                                <div class="form-check">
                                    <input name="other_health" id="other-health" value="Alzheimer/Dementia" type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label ">Alzheimer's/Dementia</label>
                                </div>
                                <div class="form-check">
                                    <input name="other_health" id="other-health" value="Chronic Obstructive Pulmonary Diesease" type="checkbox" class="form-check-input">
                                    <label for="" class="form-check-label ">Chronic Obstructive Pulmonary Disease</label>
                                </div>
                            </div>
                            <!-- Education   -->
                            <div class="d-flex flex-column mb-3">
                                <h3 class="">Highest Educational Attainment</h3>
                                <select name="education" id="" class="form-select form-select-lg" required>
                                    <option value="" hidden>Educational Attainment</option>
                                    <?php
                                    $education_row = getEducation($conn);
                                    foreach ($education_row as $education) {
                                    ?>
                                        <option value="<?= $education['education_id'] ?>"><?= $education['education_attainment'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <span class="invalid-feedback">Required</span>
                            </div>
                            <!-- Email -->
                            <div class="d-flex flex-column mb-3">
                                <h3 class="">Senior Email Address</h3>
                                <input name="senior_email" id="seniorEmail" type="email" class="form-control form-control-lg" placeholder="Email Address" oninput="validateInput(this, 'email')" required>
                                <span class="invalid-feedback" id="seniorEmailFeedback"></span>
                            </div>
                            <!-- Contact number -->
                            <div class="d-flex flex-column gap-3 mb-3">
                                <h3 class="">Contact Number</h3>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">+63</span>
                                    <input type="text" name="cell_no" id="contact1" class="form-control form-control-lg" placeholder="" required>
                                </div>
                                <span id="contact1Feedback" class="invalid-feedback"></span>
                            </div>
                            <!-- guardian info -->
                            <div class="d-flex flex-column gap-3 mb-3">
                                <h3 class="">Guardian Information</h3>
                                <div>
                                    <input type="text" name="guardian_first" id="guardFirst" class="form-control form-control-lg" placeholder="First Name" minlength="2" oninput="validateInput(this, 'text')" required>
                                    <span class="invalid-feedback" id="guardFirstFeedback"></span>
                                </div>
                                <div>
                                    <input type="text" name="guardian_mid" id="guardMid" class="form-control form-control-lg" placeholder="Middle Name" minlength="2" oninput="validateInput(this, 'text')" required>
                                    <span class="invalid-feedback" id="guardMidFeedback"></span>
                                </div>
                                <div>
                                    <input type="text" name="guardian_last" id="guardLast" class="form-control form-control-lg" placeholder="Last Name" minlength="2" oninput="validateInput(this, 'text')" required>
                                    <span class="invalid-feedback" id="guardLastFeedback"></span>
                                </div>
                                <div>
                                    <select name="guardian_extension" id="guardExtension" class="form-select form-select-lg" required>
                                        <option value="" hidden>Suffix</option>
                                        <option value="">None</option>
                                        <option value="Jr.">Jr.</option>
                                        <option value="Sr.">Sr.</option>
                                        <option value="I">I</option>
                                        <option value="II">II</option>
                                        <option value="III">III</option>
                                        <option value="IV">IV</option>
                                        <option value="V">V</option>
                                    </select>
                                    <span id="guardExtensionFeedback" class="invalid-feedback">Required</span>
                                </div>
                                <div>
                                    <input type="text" name="guardian_no" id="guardianNo" class="form-control form-control-lg" placeholder="Contact Number" required>
                                    <span class="invalid-feedback" id="guardianNoFeedback"></span>
                                </div>
                            </div>
                            <!-- religion -->
                            <div class="d-flex flex-column mb-3">
                                <h3 class="">Religion</h3>
                                <select name="religion" id="religion" class="form-select form-select-lg" required>
                                    <option value="" hidden>Choose an option</option>
                                    <?php
                                    $religion_row = getReligion($conn);
                                    foreach ($religion_row as $religion) {
                                    ?>
                                        <option value="<?= $religion['religion_id'] ?>"><?= $religion['religion_name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <span class="invalid-feedback">Required</span>
                            </div>
                            <!-- Civil Status -->
                            <div class="d-flex flex-column mb-3">
                                <h3 class="">Civil Status</h3>
                                <select name="civil_stat" id="religion" class="form-select form-select-lg" required>
                                    <option value="" hidden>Choose an option</option>
                                    <?php
                                    $civil_row = getCivil($conn);
                                    foreach ($civil_row as $civil) {
                                    ?>
                                        <option value="<?= $civil['civil_id'] ?>"><?= $civil['civil_status'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <span class="invalid-feedback">Required</span>
                            </div>
                            <!-- Pictures -->
                            <div class="d-flex flex-column mb-3">
                                <h3 class="">Picture and Certificates</h3>
                                <div class="file-container mb-2">
                                    <label class="form-label fs-5" for="id-pic">2x2 Picture</label>
                                    <input type="file" class="form-control form-control-lg" name="id_pic" id="id-pic" accept="image/jpeg, image/png" required>
                                    <span class="invalid-feedback">Required</span>
                                </div>
                                <div class="file-container mb-2">
                                    <label class="form-label fs-5" for="id-pic">Birth Certificate</label>
                                    <input type="file" class="form-control form-control-lg" name="birth_certificate" id="birth-certificate" accept="image/jpeg, image/png" required>
                                    <span class="invalid-feedback">Required</span>
                                </div>
                                <div class="file-container mb-2">
                                    <label class="form-label fs-5" for="id-pic">Barangay Certificate</label>
                                    <input type="file" class="form-control form-control-lg" name="barangay_certificate" id="barangay-certificate" accept="image/jpeg, image/png" required>
                                    <span class="invalid-feedback">Required</span>
                                </div>
                            </div>
                            <button id="submit-button" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">

                </div>
            </div>
        </div>
    </div>
</body>
<script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

<script type="module" src="./js/signUp.js"></script>

</html>