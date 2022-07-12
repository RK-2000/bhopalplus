<script src="{{ asset('public/backend/assets/vendors/js/vendor.bundle.base.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page -->
<script src="{{ asset('public/backend/assets/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('public/backend/assets/vendors/progressbar.js/progressbar.min.js') }}"></script>
<script src="{{ asset('public/backend/assets/vendors/jvectormap/jquery-jvectormap.min.js') }}"></script>
<script src="{{ asset('public/backend/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<script src="{{ asset('public/backend/assets/vendors/owl-carousel-2/owl.carousel.min.js') }}"></script>
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{ asset('public/backend/assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('public/backend/assets/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('public/backend/assets/js/misc.js') }}"></script>
<script src="{{ asset('public/backend/assets/js/settings.js') }}"></script>
<script src="{{ asset('public/backend/assets/js/todolist.js') }}"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="{{ asset('public/backend/assets/js/dashboard.js') }}"></script>
<script src="{{ asset('public/backend/assets/vendors/select2/select2.min.js') }}"></script>
<script src="{{ asset('public/backend/assets/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-toast-plugin/1.3.2/jquery.toast.min.js"
    integrity="sha512-zlWWyZq71UMApAjih4WkaRpikgY9Bz1oXIW5G0fED4vk14JjGlQ1UmkGM392jEULP8jbNMiwLWdM8Z87Hu88Fw=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script> 
    $(document).ready(function() {
        $('#myTable').DataTable();

        setTimeout(function() {
            $(".alert").hide();
        }, 5000);
    });
    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(editor => {
            console.log(editor);
        })
        .create(document.querySelector('#ckeditor'))
        .then(ckeditor => {
            console.log(ckeditor);
        })
        .catch(error => {
            console.error(error);
        });
</script>
<script>
    ClassicEditor
        .create(document.querySelector('#ckeditor'))
        .then(ckeditor => {
            console.log(ckeditor);
        })
        .catch(error => {
            console.error(error);
        });
</script>
<script>
    $(document).ready(function() {



        var maxField = 10; //Input fields increment limitation
        var addButton = $('.add_button'); //Add button selector
        var wrapper = $('.field_wrapper'); //Input field wrapper
        var fieldHTML =
            '<div><div class="form-group"><label for="youtune">Youtube Link</label><input type="url" name="youtube_link[]" class="form-control" value=""/><a href="javascript:void(0);" class="remove_button"><i class="mdi mdi-minus-box" style="color: red;"></i></a></div></div>'; //New input field html 
        var x = 1; //Initial field counter is 1

        //Once add button is clicked
        $(addButton).click(function() {
            var data = $(this).attr("data-id");
            //Check maximum number of input fields
            if (x < maxField) {

                x++; //Increment field counter
                $(wrapper).append(fieldHTML); //Add field html
            }
        });

        //Once remove button is clicked
        $(wrapper).on('click', '.remove_button', function(e) {
            e.preventDefault();
            $(this).parent('div').remove(); //Remove field html
            x--; //Decrement field counter
        });



        $('#password, #password_two').on('keyup', function() {
            if ($('#password').val() == $('#password_two').val()) {
                $('#message').html('Matching').css('color', 'green');
            } else
                $('#message').html('Not Matching').css('color', 'red');
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }

    });

    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
