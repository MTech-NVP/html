        // Fetch images from the backend
        $(document).ready(function(){
            $.ajax({
                url: '../src/controller/server_operator.php', // URL to your PHP script
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Populate dropdown with options
                    data.forEach(function(image) {
                        $('#imageSelect').append(new Option(image.name, image.image_data));
                    });
                }
            });

            // When the dropdown value changes, update the image
            $('#imageSelect').on('change', function(){
                var imageData = $(this).val();
                if(imageData) {
                    $('#displayedImage').attr('src', imageData).show();
                } else {
                    $('#displayedImage').hide();
                }
            });
        });

        $(document).ready(function(){
            $.ajax({
                url: '../src/controller/server_operator2.php', // URL to your PHP script
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Populate dropdown with options
                    data.forEach(function(image) {
                        $('#imageSelect2').append(new Option(image.name, image.image_data));
                    });
                }
            });

            // When the dropdown value changes, update the image
            $('#imageSelect2').on('change', function(){
                var imageData = $(this).val();
                if(imageData) {
                    $('#displayedImage2').attr('src', imageData).show();
                } else {
                    $('#displayedImage2').hide();
                }
            });

        });

        $(document).ready(function(){
            $.ajax({
                url: '../src/controller/server_operator.php', // URL to your PHP script
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    // Populate dropdown with options
                    data.forEach(function(image) {
                        $('#imageSelect3').append(new Option(image.name, image.image_data));
                    });
                }
            });

            // When the dropdown value changes, update the image
            $('#imageSelect3').on('change', function(){
                var imageData = $(this).val();
                if(imageData) {
                    $('#displayedImage3').attr('src', imageData).show();
                } else {
                    $('#displayedImage3').hide();
                }
            });
        });


