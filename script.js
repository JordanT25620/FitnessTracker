$(document).ready(function(){

    /* workout.php log form */
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

    /* weight.php log form */
    $("#logWeightBtn").click(function(){
        $("#logWeightBtnDiv").hide();
        $("#logWeightForm").css("display", "block");
    });
    
});