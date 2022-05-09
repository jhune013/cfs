$(document).ready(function(){
    var clickedButton   =   '';
    var base_url        = window.location.origin + "";

    function empty(value) {
        return ( $.trim( value ) == '' );
    }

    function Datatable_ellipsis (target, length){
        if (!empty(target) && !empty(length)) {
            return {
                targets     : target,
                render: function ( data, type, row ) {
                    return data.length > length ? data.substr( 0, length ) + '…' : data;
                }
            };
        } else {
            return '';
        }
    }

    function initiliazeDatatable(element) {
        if ($(element).length >= 1) {

            var $this   =   $(element);
            var $tbody  =   $this.find('tbody');

            var ordering    =   typeof $tbody.data('ordering') != 'undefined' ? ($tbody.data('ordering') == "1" ? true : false) : false;
            var search      =   typeof $tbody.data('search') != 'undefined' ? ($tbody.data('search') == "1" ? true : false) : false;
            var length      =   typeof $tbody.data('length') != 'undefined' ? ($tbody.data('length') == "1" ? true : false) : false;
            var paging      =   typeof $tbody.data('paging') != 'undefined' ? ($tbody.data('paging') == "1" ? true : false) : false;
            var sDom        =   typeof $tbody.data('sDom') != 'undefined' ? ($tbody.data('sDom') == "1" ? true : '') : '';
            var empty       =   typeof $tbody.data('empty') != 'undefined' ? $tbody.data('empty') : "No data available in table.";
            var ellipColumn =   typeof $tbody.data('ellipcolumn') != 'undefined' ? $tbody.data('ellipcolumn') : '';
            var columnDef   =   '';

            columnDef  =   Datatable_ellipsis(ellipColumn, 15);

            return $(element).DataTable({
                responsive      :   true,
                destroy         :   true,
                ordering        :   ordering,
                searching       :   search,
                bLengthChange   :   length,
                paging          :   paging,
                sDom            :   sDom,
                language        :   {
                    zeroRecords     : empty
                },
                columnDefs      :   [columnDef]
            });
        }
    }

// $('#editForm').on('submit',function(){
//         var create_id = $('#create_id').val();
//         var typeofsupport = $('#typeofsupport').val();
//         var issue_id = $('#issue_id').val();
//         var remark_id = $('#remark_id').val();
//         var status_id = $('#status_id').val();
//         var validity_id = $('#validity_id').val();
//         var priority_id = $('#priority_id').val();
//          var details = $('#details').val();                  
//         $.ajax({
//             type : "POST",
//             url  : "helpdesk/update",
//             dataType : "JSON",
//             data : {create_id:create_id, typeofsupport:typeofsupport, issue_id:issue_id, remark_id:remark_id, status_id:status_id, validity_id:validity_id, priority_id:priority_id, details:details},
//             success: function(data){
//                 $("#create_id").val("");
//                 $("#typeofsupport").val("");
//                 $('#issue_id').val("");
//                 $("#remark_id").val("");
//                 $('#status_id').val("");
//                 $("#validity_id").val("");
//                 $("#priority_id").val("");
//                 $("#details").val("");
//                 issues_list();
//             }  
//         });
//         return false;
//     });

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

//for login toggle password
    $("body").on('click', '.toggle-password', function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $("#txt_password");
        
        if (input.attr("type") === "txt_password") {
            input.attr("type", "password");
        } else {
            input.attr("type", "txt_password");
        }
    });


    // if ($('#table-id').length == 1) {
    //     $('#table-id').DataTable({
    //         "order": [[ 1, "asc" ]],
    //         "aLengthMenu": [[25, 50, 75, -1], [25, 50, 75, "All"]],
    //             "iDisplayLength": 25
    //     });
    // }

//for type of support dropdown
    $(document).on('change', 'select[name="typeofsupport"]', function(){
        var value   =   $(this).val();
        var _this   =   $(this);

        _this.attr('disabled', true);

        $.ajax({
            type: 'post',
            url: base_url + '/helpdesk/request_issue_types',
            dataType: 'json',
            data: {
                value   :   value
            },
            success: function (result) {
                if (!empty(result)) {
                    $('select[name="issue_name_type"]').html(result.issue_type_html);
                }


                _this.attr('disabled', false);
            },
            error: function () {
            }
        });
    });
    

    if ($('.summernote').length >= 1) {
        $('.summernote').summernote({
            height: 300,
            placeholder: 'Type here...',
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                 ['picture', ['picture']],
                ['table']
            ],
            callbacks: {
                onImageUpload: function(files) {
                    upload_image(files[0]);
                }
            }
        });

        function upload_image(file) {
            console.log('test');
            data = new FormData();
            data.append("file", file);

            $.ajax({
                data: data,
                type: "POST",
                url: base_url + "/helpdesk/upload_image",
                cache: false,
                contentType: false,
                processData: false,
                success: function(url) {
                    var image = $('<img>').attr('src', url);
                    $('#details').summernote("insertNode", image[0]);
                }
            });
          }
    }

    if ($('#issue_list_tbl').length == 1) {
        var issue_list_tbl    =   $('#issue_list_tbl').DataTable( {
            lengthMenu  :   [[25, 50, 100, 200, 500], [25, 50, 100, 200, 500]],
            // sDom        :   'l<"datatable_fixed_height"t>ip',
            ordering    :   false,
            searching   :   true,
            bFilter     :   false,
            paging      :   true,
            language    : {
                zeroRecords     : "No record",
                processing      : "Searching record..."
            },

            processing  :   true,
            serverSide  :   true,
            ajax        :   {
                url         :   base_url + "/helpdesk/issues_list",
                data        :   function ( d ) {
                }
            }
        });
    }







    // if ($('#userlist').length == 1) {
    //     var userlist    =   $('#userlist').DataTable( {
    //         lengthMenu  :   [[25, 50, 100, 200, 500], [25, 50, 100, 200, 500]],
    //         // sDom        :   'l<"datatable_fixed_height"t>ip',
    //         ordering    :   false,
    //         searching   :   true,
    //         bFilter     :   false,
    //         paging      :   true,
    //         language    : {
    //             zeroRecords     : "No record",
    //             processing      : "Searching record..."
    //         },

    //         processing  :   true,
    //         serverSide  :   true,
    //         ajax        :   {
    //             url         :   base_url + "/helpdesk/users_list",
    //             data        :   function ( d ) {
    //             }
    //         }
    //     });
    // }






});