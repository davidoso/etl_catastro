function foo() {

    $(document).ready(function() {
        $("button").click(function() {
            $.ajax({url: "js/hiworld.php", success: function(result) {
                $("#div1").html(result);
            }});
        });
    });

}