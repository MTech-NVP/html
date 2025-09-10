$(document).ready(function() {
    $('#approve_drop').change(function() {
        var selectedValue = $(this).val();
        if (selectedValue) {
            // Construct the URL to fetch the image
            var imageUrl = 'approved_data.php?id=' + selectedValue;
            $('#signa_approved').attr('src', imageUrl);
            $('#approved_print').attr('src', imageUrl);
            $('#approved').show();
        } else {
            $('#approved').show();
        }
    });
});

$(document).ready(function() {
    $('#check_dropdown').change(function() {
        var selectedValue = $(this).val();
        if (selectedValue) {
            // Construct the URL to fetch the image
            var imageUrl = 'checked_sign.php?id=' + selectedValue;
            $('#signa_checked').attr('src', imageUrl);
            $('#checked_print').attr('src', imageUrl);
            $('#checked').show();
        } else {
            $('#checked').show();
        }
    });
});

$(document).ready(function() {
    $('#prepared_dropdown').change(function() {
        var selectedValue = $(this).val();
        if (selectedValue) {
            // Construct the URL to fetch the image
            var imageUrl = 'prepared_sign.php?id=' + selectedValue;
            $('#signa_prepared').attr('src', imageUrl);
            $('#prepared').show();
        } else {
            $('#prepared').show();
        }
    });
});

