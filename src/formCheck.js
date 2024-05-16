$(document).ready(() => {
    let password = $('#password');
    $('#checked').click(function() {
        let isChecked = $(this).prop('checked');

        if (isChecked) {
            password.attr("type", "text");
        } else {
            password.attr("type", "password");
        }
    });

    $('#login-form').submit(function(event) {
        let formData = {
            username: $('#username').val(),
            password: $('#password').val()
        }
        console.log(formData);
        fetch('http://localhost/new_systemV2/queries/login_check.php', {
                method: "POST",
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(formData)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                // Handle response data directly here
                return response.json(); // Parse JSON response
            })
            .then(data => {
                let {success, message, user} = data;
                // Handle JSON data
                if(success){
                    if(user == "admin"){
                        window.location.href = "admin/admin_home.php";
                    }
                    else if(user == "senior"){
                        window.location.href = "localhost/new_systemV2/senior_home";
                    }
                }
                else{
                    alert(message);
                }
            })
            .catch((err) => {
                console.log(err);
            })

        event.preventDefault();
    })
});