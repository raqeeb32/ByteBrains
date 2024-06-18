$(document).ready(function (){
    $("#stuemail").on("blur Keypress",function (){
        var stuemail=$("#stuemail").val();
        var reg=/^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;

        $.ajax({
            url:"student/addstudent.php",
            // dataType:"json",
            method:"POST",
            data: {
                checkemail:"checkemail",
                stuemail:stuemail
            },
            success:function(data){
                if(data!=0){
                    $("#statusMsq2").html('<small style="color:red;margin-left:1px;">email Already exist</small>');
                    $("#signupbtn").attr("disabled",true);
                }
                else if(!reg.test(stuemail)){
                    $("#statusMsq2").html('<small style="color:red;margin-left:1px;">Invalid email</small>');
                    $("#signupbtn").attr("disabled",true);       
                 }
                 else{
                    $("#signupbtn").attr("disabled",false);
                 }
            },

        });
    });
});
function addstu() {
    var stuname = $("#stuname").val();
    var stuemail = $("#stuemail").val();
    var stupass = $("#stupass").val();
    var reg=/^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    if (stuname.trim() == "") {
        $("#statusMsq1").html('<small style="color:red;margin-left:1px;">Name should be filled</small>');
        $("#stuname").focus();
        return false;
    }
    else if(stuemail.trim() == ""){
        $("#statusMsq2").html('<small style="color:red;margin-left:1px;">email should be empty</small>');
        $("#stuemail").focus();
        return false;
    }
    else if(stupass.trim() == ""){
        $("#statusMsq3").html('<small style="color:red;margin-left:1px;">password should be empty</small>');
        $("#stupass").focus();
        return false;
    }
    else {
        $.ajax({
            url: 'student/addstudent.php',
            dataType: "json",
            method: "post",
            data: {
                stuname: stuname,
                stuemail: stuemail,
                stupass: stupass
            },
            success: function (data) {
                if (data == 'inserted') {
                    alert("registered");
                    clearstuRegForm();
                }
                else {
                    alert("not registered");
                }
            },
        });
    }

}
// empty all fields
function clearstuRegForm(){
    $("#sturegForm").trigger("reset");
    $("#statusMsg1").html(" ");
    $("#statusMsg2").html(" ");
    $("#statusMsg3").html(" ");
}
//ajax call to check login
// function checkStuLogin() {
//     var email = $("#email").val().trim();
//     var password = $("#password").val().trim();

//     if (email === "" || password === "") {
//         alert("Enter credentials");
//         return false;
//     }

//     $.ajax({
//         url: 'student/addstudent.php',
//         method: "POST",
//         data: {
//             checkLogEmail: "checkLogEmail",
//             email: email,
//             password: password
//         },
//         dataType: "json", // Expect JSON response
//         success: function (data) {
//             // Handle different response scenarios
//             if (data === 'success') {
//                 alert('Login successful');
//                 // Redirect to another page or perform other actions on successful login
//             } else if (data === 'failure') {
//                 alert('Invalid email or password');
//             } else if (data === "error") {
//                 alert("An error occurred. Please try again later.");
//             } else {
//                 // Unexpected response, handle accordingly
//                 alert("Unexpected response from server");
//             }
//         },
//         error: function (xhr, status, error) {
//             // Handle AJAX errors
//             alert("AJAX Error: " + error);
//         }
//     });
// }
// function checkLogin(){
//     var stuLogEmail = $("#stuLogEmail").val();
//     var stuLogPass = $("#stuLogpass").val();
//         $.ajax({
//             url: 'student/addstudent.php',
//             method:"POST",
//             data:{
//                 checkLogEmail:"checkLogmail",
//                 stuLogEmail:stuLogEmail,
//                 stuLogPass:stuLogPass,
//             },
//             success: function(data){
//                 console.log(data);
//             },

//         });

// }

