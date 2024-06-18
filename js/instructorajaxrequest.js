// function addInst() {
//     var insName = $("#instructor_name").val();
//     var insEmail = $("#instructor_email").val();
//     var insPass = $("#instructor_pass").val();
//     var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;

//     if (insName.trim() == "") {
//         alert("Name should be filled");
//         return false;
//     } else if (insEmail.trim() == "") {
//         alert("Email should be filled");
//         return false;
//     } else if (insPass.trim() == "") {
//         alert("Password should be filled");
//         return false;
//     } else if (!reg.test(insEmail)) {
//         alert("Invalid email address");
//         return false;
//     } else {
//         $.ajax({
//             url: 'instructor/addinstructor.php',
//             dataType: "json",
//             method: "post",
//             data: {
//                 insSignup: "signup",
//                 insName: insName,
//                 insEmail: insEmail,
//                 insPass: insPass
//             },
//             success: function (data) {
//                 console.log("Response from server:", data); 
//                 if (data=="inserted") {
//                     alert("You are registered");
//                     // Optionally, clear form fields or provide further feedback to the user
//                 } else if (data == "failed") {
//                     alert("Registration failed");
//                 }
//             },
//             error: function (xhr, status, error) {
//                 alert("Error: " + xhr.responseText);
//             }
//         });
//     }
// }
