$(document).ready(function(){
    $('#create_plan').submit(function(e){
        e.preventDefault();

        $.ajax({
            url:'create_plan.php',
            data: $(this).serialize(),
            type:'POST',
            success:function(resp){
                $('#error_msg').html(resp);
            }
         }
        )
    })
})
