$(document).ready(function(){
    var clickedButton   =   '';

    function empty(value) {
        return ( $.trim( value ) == '' );
    }

    $(document).on('click', 'button[type=submit], input[type=submit]', function(){
        clickedButton   =   $(this);
    });

    $(document).on('submit', '.form', function(e) {
        console.log('ajax');
        
        var f   =   $(this);
        var b   =   clickedButton;

        var t   =   b.text();
        var dt  =   b.data('type');

        if (b.hasClass('btn-disabled')) return false;
        
        if (f.find('.loader')) {
            f.find('.loader').removeClass('hide');
        }

        b.attr('disabled', true);
        b.addClass('btn-disabled', true);

        if (b.find('.btn-content').length > 0) {        
            $('.book-spinner').removeClass('hide');
            $('.btn-content').text('Loading');
        } else {
            b.text('Loading...');
        }

        $('.alert-validation').remove();
        $('.form-error').remove();

        $.ajax({
            type: f.attr('method'),
            url: f.attr('action'),
            data: f.serialize(),
            dataType: 'json',
            success: function(result) {
                if (result.success == true) {

                    if (typeof result.text != 'undefined') {
                        var success = $('<div class="alert alert-success alert-validation" />').html(result.text);
                        success.insertBefore(f);
                        $('html, body').animate({scrollTop:$(f).offset().top - 200}, 500);
                        // b.removeClass('btn-disabled').text(t);
                        // b.removeAttr('disabled');
                    } 

                    if (result.action == 'redirect') {
                        if (typeof result.slow != 'undefined') {
                            setTimeout(function() {
                                window.location = result.url;
                            }, 2500);
                        } else {
                            setTimeout(function() {
                                window.location = result.url;
                            }, 1000);
                        }
                    }

                } else {

                    b.removeClass('btn-disabled').text(t);
                    b.removeAttr('disabled');

                    if (!empty(result.text.data)) {
                        $.each(result.text.data, function(key, data){
                            $(data.attr_class).parents('.form-parent').append('<span class="form-error">' + data.message + '</span>');
                        });
                    } else {
                        if (!empty(result.text)) {
                            var danger = $('<div class="alert alert-warning alert-validation" />').html(result.text);
                            danger.insertBefore(f);
                        }
                    }

                    if (!empty(result.text.data)) {
                        if (result.text.data.length < 1) {
                            var danger = $('<div class="form-error align-right mr-4" />').html('Please complete the required fields.');
                            danger.insertBefore(b);
                        }
                    }
                }

                if (result.action == 'redirect') {
                    if (typeof result.slow != 'undefined') {
                        setTimeout(function() {
                            window.location = result.url;
                        }, 2500);
                    } else {
                        setTimeout(function() {
                            window.location = result.url;
                        }, 1000);
                    }
                }
            }
        });

        return false;
    });

    $('#sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });


    $("body").on('click', '.toggle-password', function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#txt_password");
        
        if (input.attr("type") === "txt_password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "txt_password");
        }
    });


    if ($('#table-id').length == 1) {
        $('#table-id').DataTable({
            "order": [[ 1, "asc" ]],
            "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
                "iDisplayLength": 25
        });
    }

});