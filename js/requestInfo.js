import getData from "./service.js";
$(document).ready(function () {
  //initialize the data to get the info for the request
  const urlParams = new URLSearchParams(window.location.search);
  let id = urlParams.get("id");
  let requestContainer = $("#profile-container");
  let spinner = $("#spinner");

  let buttonContainer = $("#button-container"); //this is the container for the buttons

  //this will fetch the data from the seniorInfo file
  getData(`/components/seniorInfo.php?id=${id}&info=request`)
    .then((response) => response.text())
    .then((data) => {
      spinner.hide();
      requestContainer.removeClass(
        "d-flex justify-content-center align-items-center"
      );
      requestContainer.html(data);
    })
    .catch((err) => {
      alert(err);
    });

  //all the functions for the buttons in the button container will go here

  buttonContainer.on("click", "#accept-senior", function () {
    let requestId = $(this).data("request-id");
    getData(`queries/create_senior.php?id=${requestId}&action=approve`)
      .then((response) => response.text())
      .then((data) => {
        alert(data);
        window.location.href = "./admin_requests.php";
      })
      .catch((err) => {
        alert(`Catched this ${err}`);
      });
  });

  buttonContainer.on("click", "#reject-senior", function () {
    let requestId = $(this).data("request-id");
    if (confirm("Reject this request?")) {
      getData(`queries/create_senior.php?id=${requestId}&action=reject`)
        .then((response) => {
          if (!response.ok) {
            alert("An error has occurred, try again");
          }
          return response.json();
        })
        .then((data) => {
          let { success, message } = data;
          if (success) {
            alert(message);
            window.location.href = "./admin_requests.php";
          }
        })
        .catch((err) => {
          alert(`Catched this ${err}`);
        });
    }
  });
});
