$(document).ready(function(){
    $("#logWorkoutBtn").click(function(){
        $("#logWorkoutBtnDiv").hide();
        $("#cardioOrLiftForm").css("display", "block");
    });

    $("#cardioOrLiftForm").on("change", function() {
        var selectedText = $(this).find(':selected').text();
        if(selectedText == "Cardio"){
            $("#cardioOrLiftForm").hide();
            $("#cardioForm").show();
        } else {
            $("#cardioOrLiftForm").hide();
            $("#liftForm").show();
        }
    });
    
});