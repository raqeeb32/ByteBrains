$(document).ready(function(){
$(function(){
    $("#panel li").on("click",function(){
        $("#videoarea").attr({
        src:"../instructor/assets/".$(this).attr("movieURL"),
        });
    });
});
});