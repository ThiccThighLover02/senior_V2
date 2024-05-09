import getData from "./service.js";

$(document).ready(function () {
  let signUpForm = $("#login-form");
  let currDate = new Date();
  
  //setup minimum date (at least 100 years)
  let minDate = new Date(currDate);
  minDate.setFullYear(currDate.getFullYear() - 100);
  const minString = minDate.toISOString().split('T')[0];

  //setup maximun date (at least 60 years)
  let maxDate = new Date(currDate);
  maxDate.setFullYear(currDate.getFullYear() - 60);
  const maxString = maxDate.toISOString().split('T')[0];

  $("#birthDate").attr('max', maxString);

  signUpForm.submit(function (event) {
    // Check the validity of each input element
    $(this).addClass("was-validated"); //add was-validated to the class
    var isValid = true;

    $(this)
      .find("input, select, textarea")
      .each(function () {
        if (!this.checkValidity()) {
          isValid = false;
          return false; // Stop the loop if an invalid input is found
        }
      });

    // If any input is invalid, prevent form submission
    if (!isValid) {
      event.preventDefault();
      event.stopPropagation();
    } else {
      event.preventDefault();
      console.log("submitted")
      let formData = new FormData(this);

      let profilePic = $("#id-pic")[0].files[0]; //We have to handle the image cuz serialize doesn't get this boooo!
      let birthCertificate = $("#birth-certificate")[0].files[0]; //We have to handle the image cuz serialize doesn't get this boooo!
      let barangayCertificate = $("#barangay-certificate")[0].files[0]; //We have to handle the image cuz serialize doesn't get this boooo!

      formData.append("id_pic", profilePic); //append to form data
      formData.append("birth_certificate", birthCertificate); //append to form data
      formData.append("barangay_certificate", barangayCertificate); //append to form data
      formData.append("action", "request"); //push this object to the data array

      getData("queries/senior_request.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => {
          if (!response.ok) {
            console.log("this shit is not ok");
          }
          return response.json();
        })
        .then((data) => {
          const {success, message} = data;
          console.log(data);
          if (success) {
            alert(
              "Request has been made, once approved the credentials will be sent via email."
            );
            window.location.href = "../new_systemV2/login.php";
          } else {
            alert(message);
          }
          console.log(success, message);
        });
    }
  });

  window.validateInput = function (input, type) {
    const feedbackElement = $(`#${input.id}Feedback`);
    switch (type) {
      case "text":
        validateTextInput(input, feedbackElement);
        break;

      case "date":
        validateDateInput(input, feedbackElement);
        break;

      case "email":
        validateEmailInput(input, feedbackElement);
        break;

      case "contact1":
        validateContactInput(input, feedbackElement);
        break;

      case "contact2":
        validateGuardianContact(input, feedbackElement);
        break;
    }
  };

  function validateTextInput(input, feedbackElement) {
    if (!input.checkValidity()) {
      let minLength = input.minLength;
      if (input.value.length < minLength) {
        feedbackElement.text("Must be more than 2 characters");
      }
    }
  }

  function validateDateInput(input, feedbackElement) {
    const today = new Date();
    const birthDate = new Date(input.value);

    let age = today.getFullYear() - birthDate.getFullYear();
    const monthDiff = today.getMonth() - birthDate.getMonth();

    // If the birth month is greater than the current month or if both are the same
    // but the birth day is greater than the current day, decrement age
    if (
      monthDiff < 0 ||
      (monthDiff === 0 && today.getDate() < birthDate.getDate())
    ) {
      age--;
    }
    console.log(age);
    if (input.value == "") {
      feedbackElement.text("required");
      input.setCustomValidity("required");
    } else if (age < 60) {
      feedbackElement.text("You are not old enough");
      input.setCustomValidity("You are not old enough");
    } else {
      input.setCustomValidity("");
    }
  }

  function validateEmailInput(input, feedbackElement) {
    if (!input.checkValidity()) {
      feedbackElement.text("Please input valid email");
    }
  }

  function validateContactInput(input, feedbackElement) {
    let regex = /^9\d{9}$/;
    console.log(input.value.match(regex));
    if (!input.checkValidity()) {
      feedbackElement.text("Required");
    } else if (!regex.test(input.value)) {
      console.log(regex.test(input.value));
      feedbackElement.text("Invalid Contact Number");
      input.setCustomValidity("Invalid Contact Number");
    }
  }

  function validateGuardianContact(input, feedbackElement) {
    let regex = /^9\d{9}$/;
    if (!input.checkValidity()) {
      feedbackElement.text("Required");
    } else if (!regex.test(input.value)) {
      feedbackElement.text("Invalid Contact Number");
      input.setCustomValidity("Invalid Contact Number");
    } else {
      input.setCustomValidity("");
    }
  }
});
