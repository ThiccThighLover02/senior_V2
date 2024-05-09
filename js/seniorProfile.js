import getData from "./service.js";
$(document).ready(function() {
    const urlParams = new URLSearchParams(window.location.search);
    let id = urlParams.get('id');
    let profileContainer = $("#profile-container");
    let spinner = $("#spinner");
    console.log(id);

    getData(`components/seniorInfo.php?id=${id}&info=profile`)
    .then(response => response.text())
    .then(data => {
        spinner.hide();
        profileContainer.removeClass("d-flex justify-content-center align-items-center");
        profileContainer.html(data);
    })
    .catch(err => {
        alert(err);
    })

    $("#view-attach").click(function() {
        alert("you want to view the attachments?")
    })

    $("#print-id").click(function() {
        alert("you want to print id?")
    })

    $("#print-info").click(function() {
        alert("you want to print information?")
    })
});