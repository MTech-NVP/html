$(document).ready(function(){
    $('#downtime_data').submit(function(e){
        e.preventDefault();

        $.ajax({
            url:'down_time_form.php',
            data: $(this).serialize(),
            type:'POST',
            success:function(resp){
               // $('#error_msg').html(resp);
                  $('keyb-downtime').hide();

           }
         }
        )
    })
})

