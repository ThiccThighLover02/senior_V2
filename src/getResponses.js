import getData from "./service.js";
$(document).ready(function () {
  let cardContainer = $("#card-container"); //this is the card container, to hold the contents for the posts
  let createPost = $("#create-post"); //this is the button used to create a post
  let modalBody = $("#modal-body"); //This is the modal body, where we will put the content in
  let modal = $("#modalId"); //this is the modal that we are using
  let spinner = $("#spinner"); //this is for the loader or spinner
  let spinnerModal = $("#spinner-modal");

  //This is used to fetch the posts from activity_tbl in newsFeedCards.php
  spinner.show(); // we will show the spinner
  getData("components/newsFeedCards.php")
    .then((response) => response.text())
    .then((data) => {
      spinner.hide();
      cardContainer.html(data);
    })
    .catch((error) => {
      console.error("Error fetching data:", error);
      throw error; // Re-throw the error to propagate it to the caller
    });

  //used to edit the post
  cardContainer.on("click", "#edit", function () {
    spinnerModal.show();
    let cardValue = $(this).data("card-id");
    getData(`components/newsFeedCards.php?id=${cardValue}&modal=true`)
      .then((response) => response.text())
      .then((data) => {
        spinnerModal.hide(); //hide loading circle
        modalBody.removeClass(
          "d-flex align-items-center justify-content-center"
        );
        modalBody.html(data);
      })

      .catch((err) => {
        alert(`there has been an error ${err}`);
      });
    $("#modal-text").html(cardValue);
    modal.modal("show");
  });

  //functions here will edit the post
  modal.on("click", "#update-button", function () {
    if (confirm("Update this post?")) {
      $("#edit-form").submit();
    }
  });

  modal.on("submit", "#edit-form", function (event) {
    let formId = $(this).data("form-id");

    event.preventDefault();
    const formArr = $(this).serializeArray();
    formArr.push(
      { name: "action", value: "update" },
      { name: "id", value: formId }
    );

    getData("queries/createData.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(formArr),
    })
      .then((response) => {
        if (!response.ok) {
          console.log("deym sum wrong");
        }
        return response.json();
      })
      .then((data) => {
        let { message } = data;
        console.log(message);
        $("#modalId").modal("hide");
      })
      .catch((err) => {
        console.log(err);
      });
  });

  //used to create a post
  createPost.click(function () {
    spinnerModal.hide(); //hide loading circle
    modalBody.removeClass("d-flex align-items-center justify-content-center");
    fetch("http://localhost/new_systemV2/components/createPostModal.php")
      .then((response) => response.text())
      .then((data) => {
        modalBody.html(data);
        modal.modal("show");
      })
      .catch((err) => {
        console.log(err);
      });
  });

  modal.on("click", "#create-post", function () {
    $("#create-form").submit();
  });

  modal.on("submit", "#create-form", function (event) {
    let formData = new FormData(this);
    let image = $("#image")[0].files[0]; //We have to handle the image cuz serialize doesn't get this boooo!

    formData.append("image", image);
    formData.append("action", "post"); //push this object to the data array

    console.log(formData);

    //use fetch api to send the data to getData.php
    getData("queries/createPost.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => {
        if (!response.ok) {
          console.log("this shit");
        }
        return response.json();
      })
      .then((res) => {
        console.log(res);
        console.log("request to create sent");
      })
      .catch((err) => {
        console.log(err);
      });
    event.preventDefault(); //prevent the submission of the form
  });
});
