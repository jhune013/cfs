var sr_table_request = null;
var datatableAjaxCall = null;
var jobs_table  =   null;
var load_html        = '<div class="paper sr-container h-full"><div class="paper-title paper-title-border flex flex-flow-wrap flex-center"><div class="paper-title"><p class="p1 mt-0 pt-3 pl-3">Service Details</p> </div></div><div class="p-5 align-center requests-details"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="126" height="126" viewBox="0 0 126 126"><defs><clipPath id="clip-path"><rect id="Rectangle_1022" data-name="Rectangle 1022" width="126" height="126" transform="translate(1151.5 473.5)" fill="#888" stroke="#707070" stroke-width="1"/></clipPath></defs><g id="Mask_Group_74" data-name="Mask Group 74" transform="translate(-1151.5 -473.5)" clip-path="url(#clip-path)"><g id="tap" transform="translate(1169.06 473)"><path id="Path_922" data-name="Path 922" d="M.444,57.194a6.573,6.573,0,0,0,1.9,7.32C6.353,68.524,14.595,83,18.674,93.2c2.784,6.958,8.9,13.787,13.535,18.292a10.422,10.422,0,0,1,3.111,7.451v.768a6.3,6.3,0,0,0,6.3,6.3H75.207a6.3,6.3,0,0,0,6.3-6.3v-6.449a1.926,1.926,0,0,1,.56-1.429C89.815,104.748,89.9,92.92,89.9,92.421V59.186a8.621,8.621,0,0,0-7.786-8.731,8.393,8.393,0,0,0-4.81,1.144V48.334a8.349,8.349,0,0,0-12.686-7.182,8.3,8.3,0,0,0-12.507-6.347V31.329a16.584,16.584,0,0,0,8.4-14.485,16.8,16.8,0,0,0-33.59,0,16.585,16.585,0,0,0,8.4,14.485v33.8a23.226,23.226,0,0,1-1,7.321,2.122,2.122,0,0,1-1.514,1.411,2.023,2.023,0,0,1-1.889-.5,29.84,29.84,0,0,1-4.341-5.2c-3.643-5.45-12.81-15.63-18.548-15.63A8.224,8.224,0,0,0,.444,57.194Zm30.677-40.35a12.6,12.6,0,1,1,25.192,0,12.469,12.469,0,0,1-4.2,9.4v-9.4a8.4,8.4,0,1,0-16.795,0v9.4A12.472,12.472,0,0,1,31.121,16.844ZM23.076,70.493a34.11,34.11,0,0,0,4.961,5.93,6.212,6.212,0,0,0,5.79,1.51,6.328,6.328,0,0,0,4.472-4.14,27.343,27.343,0,0,0,1.22-8.664V16.844a4.2,4.2,0,0,1,8.4,0V60.93a2.1,2.1,0,1,0,4.2,0V42.036a4.2,4.2,0,0,1,8.4,0V60.93a2.1,2.1,0,1,0,4.2,0v-12.6a4.2,4.2,0,0,1,8.4,0v14.7a2.1,2.1,0,0,0,4.2,0v-4.2a4.163,4.163,0,0,1,1.232-2.967,4.248,4.248,0,0,1,3.275-1.221,4.471,4.471,0,0,1,3.89,4.543V92.42c0,.1-.107,10.5-6.474,16.317a6.126,6.126,0,0,0-1.923,4.525v6.449a2.1,2.1,0,0,1-2.1,2.1H41.618a2.1,2.1,0,0,1-2.1-2.1v-.768a14.652,14.652,0,0,0-4.385-10.464c-3.557-3.453-9.918-10.237-12.559-16.841-4.321-10.8-12.869-25.7-17.261-30.1-1-1-1.334-1.923-.994-2.746a4.14,4.14,0,0,1,3.708-2.068c2.853,0,10.589,7.073,15.048,13.762Zm0,0" transform="translate(-0.025 -0.011)" fill="#888"/><path id="Path_923" data-name="Path 923" d="M100.873,110.732a2.1,2.1,0,0,0,2.1-2.1v-12.6a2.1,2.1,0,0,0-4.2,0v12.6A2.1,2.1,0,0,0,100.873,110.732Zm0,0" transform="translate(-21.492 -20.421)" fill="#888"/><path id="Path_924" data-name="Path 924" d="M98.192,129.168a2.1,2.1,0,0,0,1.484-.615,8.523,8.523,0,0,0,2.715-5.683,2.073,2.073,0,0,0-2.049-2.069,2.111,2.111,0,0,0-2.15,2.021,4.619,4.619,0,0,1-1.485,2.763,2.1,2.1,0,0,0,1.485,3.584Zm0,0" transform="translate(-20.909 -26.261)" fill="#888"/><path id="Path_925" data-name="Path 925" d="M57.954,149.1h2.1a2.1,2.1,0,1,0,0-4.2h-2.1a2.1,2.1,0,1,0,0,4.2Zm0,0" transform="translate(-12.162 -31.501)" fill="#888"/><path id="Path_926" data-name="Path 926" d="M71.366,149.1h14.7a2.1,2.1,0,1,0,0-4.2h-14.7a2.1,2.1,0,0,0,0,4.2Zm0,0" transform="translate(-15.077 -31.501)" fill="#888"/><path id="Path_927" data-name="Path 927" d="M32.061,34.76a2.1,2.1,0,0,0,1.531-3.537,20.942,20.942,0,0,1-.92-27.747A2.1,2.1,0,1,0,29.437.8a25.144,25.144,0,0,0,1.095,33.3,2.1,2.1,0,0,0,1.53.661Zm0,0" transform="translate(-5.164 0)" fill="#888"/><path id="Path_928" data-name="Path 928" d="M79.8,29.2a2.1,2.1,0,0,0,2.825-.911A25.106,25.106,0,0,0,79.626.8a2.1,2.1,0,1,0-3.235,2.674,20.911,20.911,0,0,1,2.5,22.9A2.1,2.1,0,0,0,79.8,29.2Zm0,0" transform="translate(-16.514 0)" fill="#888"/></g></g></svg><p>Select a Service Request ID</p></div></div>';

function _serviceRequest(attr, url, SRStatus, target) {
    sr_table_request = $(attr).DataTable( {
        lengthMenu     : [[25, 50, 100, 200, 9999999], [25, 50, 100, 200, "All"]],
        iDisplayLength : 25,
        responsive     : true,
        ordering       : _order(attr),
        searching      : _search(attr),
        bFilter        : _bFilter(attr),
        paging         : _paging(attr),
        pagingType     : 'full',
        dom            : '<<t>p<i>>',
        language       : {
            zeroRecords     : "No data yet available yet.",
            processing      : "Retrieving data...",
            paginate: {
                previous: '«',
                next: '»',
            }
        },
        processing     : true,
        serverSide     : true,
        ajax           : {
            url         :   url,
            data        :   function (d) {
                d.status = SRStatus;
            },
            beforeSend: function() {
                if ($('.paper-load').length > 0) {
                    $('.paper-load').addClass('paper-load-show');
                    $('.requests-sr').addClass('paper-fold paper-load-show');
                }
            }
         
        },
        createdRow: function(row, data, dataIndex) {
            $(row).addClass('requests-link link ' + target);
            $(row).attr('data-sr', data[0]);
        },
        columnDefs  : [
            {
                targets     : '_all',
                createdCell : function (td, cellData, rowData, row, col) {
                    if (col == 1) {
                        $(td).css({
                            'text-align' : 'right',
                            'width': '245px'
                        });
                    }

                    $(td).css({
                        'border-top' : 'none',
                        'padding'    : '5px 12px'
                    });
                }
            }
        ],
        initComplete: function( settings, json ) {
            $('.requests-title').html(capitalizeFirstLetter(SRStatus) + ' Requests');
            $('.dataTables_info').addClass('p-4 text-center');
            $('.service-request-status[data-status="' + SRStatus + '"]').addClass('tab-active');
        },
        drawCallback : function() {
           processInfo(this.api().page.info());
        }
    });

    function processInfo(info) {
        var pageInfo = 
            '<li class="paginate_button page-item active font-bold">' +
                '<span class="page-link">' +
                    (info.page + 1) + ' / ' + info.pages +
                '<span>' +
            '</li>';

        $(pageInfo).insertBefore('#service-request-table_next');
    }

    sr_table_request.on('processing.dt', function (e, settings, processing) {
        if (processing) {
            $('.requests-sr').addClass('paper-fold paper-load-show');
            $('.requests-details').html(load_html);
        } else {
            $('.requests-sr').removeClass('paper-fold paper-load-show');
        }
    });
}

function _datatableAjaxCall(attr, url,  position, lengthFiltering) {

    if (typeof position == 'undefined') {
        position = '<lfr<t>ip>';
    }

    if (typeof lengthFiltering == 'undefined') {
        lengthFiltering = [[25, 50, 100, 200, 500], [25, 50, 100, 200, 500]];
    }

    datatableAjaxCall = $(attr).DataTable( {
        lengthMenu  :   lengthFiltering,
        responsive  :   true,
        ordering    :   _order(attr),
        searching   :   _search(attr),
        bFilter     :   _bFilter(attr),
        paging      :   _paging(attr),
        dom         :   position,
        processing  :   true,
        serverSide  :   true,
        ajax        :   url,
        language    : {
            zeroRecords     : "No data yet available yet.",
            processing      : "",
            paginate: {
                previous: '«',
                next: '»',
            }
        },
        createdRow: function(row, data, dataIndex) {
            if ($('#jobChat-table').length > 0) {
                $(row).addClass('jobchat-link link');
                $(row).attr('data-thread', data[1]);
                $(row).attr('data-trackno', data[0]);
                $(row).attr('data-url', base_url+'/support/fetch_messages');
            }
        },
        columnDefs  : [
            {
                targets     : [0],
                createdCell : function (td, cellData, rowData, row, col) {
                    $(td).css({
                        'text-align' : 'left'
                    });

                    if ($('#jobChat-table').length > 0) {
                        $(td).addClass('font-15');
                        $(td).css({
                            'padding'    : '5px 12px'
                        });
                    }
                }
            }
        ],
        initComplete: function( settings, json ) {
            if ($('#jobChat-table').length > 0) {
                $('.dataTables_info').addClass('p-4');
                $('.dataTables_info').css('text-align','center');
            }
        }
    });
}

if ($('#service-request-table').length > 0) {

    $('.service-request-status').each(function(){
        var status = $(this).data('status');
        var url    = $(this).data('url');
        var target = $(this).data('target');
        if ($(this).hasClass('tab-active')) {
            $('.requests-sr').addClass('paper-fold paper-load-show');
            $('.requests-details').html(load_html);
            _serviceRequest('#service-request-table', url, status, target);
        }
    });

    $(document).on('click','.service-request-status', function() {
        var status = $(this).data('status');
        var url    = $(this).data('url');
        var target = $(this).data('target');
        
        $('.tab-link').removeClass('tab-active');

        if (sr_table_request != null) {
            sr_table_request.destroy(); 
        }

        _serviceRequest('#service-request-table', url, status, target);
    });
}

if ($('#jobChat-table').length > 0) {
    var myUrl = $('#jobChat-table').data('url');

    var length = [[15, 30, 50, 70, 100], [15, 30, 50, 70, 100]];

    var object = {
            url : myUrl,
            data: function(d) {
                d.search = $('input[name="search"]').val();
            },
            beforeSend: function(d) {
                $('#jobChat-table_processing').css('margin-left','-3rem !important');
            }
        };

    _datatableAjaxCall('#jobChat-table', object, '<<t>p<i>>', length);

    $('input[name="search"]').on('keyup', function(){
        datatableAjaxCall.ajax.reload();
    });
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

$(document).ready(function() {
    if ($('#tech-balances').length > 0) {
        var myurl = $('#tech-balances').data('url');
        var object = {
            url : myurl,
            data: function(d) {
                d.daterange = $('input[name="daterange"]').val();
                d.search = $('input[name="search"]').val();
                if ($('#tech-balances').length > 0) {
                    if ($('.dataTables_length').length > 0) {
                        $('.dataTables_length').addClass('mt-n55');
                    }
                }
            }
        };
        _datatableAjaxCall('#tech-balances', object, '<lf<rt>ip>');

        $('input[name="daterange"]').on('change', function(){
            datatableAjaxCall.ajax.reload();
        });

        $('input[name="search"]').on('keyup', function(){
            datatableAjaxCall.ajax.reload();
        });
    }

    if ($('#tech-earnings').length > 0) {
        var myurl = $('#tech-earnings').data('url');
        var object = {
            url : myurl,
            data: function(d) {
                d.month = $('select[name="month"] option:selected').val();
                d.year = $('select[name="year"] option:selected').val();
            }
        };
        _datatableAjaxCall('#tech-earnings', object, '<f<rt>ip>')
    }

    $(document).on('change', '.month', function(){
        if (datatableAjaxCall != null) {
            datatableAjaxCall.clear();
            datatableAjaxCall.destroy();
        }
        var myurl = $('#tech-earnings').data('url');
        var object = {
            url : myurl,
            data: function(d) {
                d.month = $('select[name="month"] option:selected').val();
                d.year = $('select[name="year"] option:selected').val();
            }
        };
        _datatableAjaxCall('#tech-earnings', object, '<f<rt>ip>')
    });

    $(document).on('change', '.year', function(){
        if (datatableAjaxCall != null) {
            datatableAjaxCall.clear();
            datatableAjaxCall.destroy();
        }
        var myurl = $('#tech-earnings').data('url');
        var object = {
            url : myurl,
            data: function(d) {
                d.month = $('select[name="month"] option:selected').val();
                d.year = $('select[name="year"] option:selected').val();
            }
        };
        _datatableAjaxCall('#tech-earnings', object, '<f<rt>ip>')
    });
});

function earningAjax(y, m) {
    $.ajax({
        type: 'POST',
        url: base_url + '/earnings',
        data: {'year' : y, 'month' : m},
        dataType: 'json',
        beforeSend: function() {
            $('.paper').addClass('paper-load-show');
        },
        success: function(result) {
            if (result.success) {
                $('#datatables').dataTable().fnDestroy();
                $('#datatables tbody').html(result.text);
                $('#datatables').DataTable({
                    responsive: true,
                    ordering: false,
                    searching: false,
                    bLengthChange: false,
                    bDestroy: true
                });
            } else {
                $('#datatables').dataTable().fnDestroy();
                $('#datatables tbody').html(result.text);
            }

            $('.paper').removeClass('paper-load-show');
        }
    });
}

$(document).ready(function() {
    var ajaxURL = $(this).find('tbody').data('url');
    var order   = $(this).find('tbody').data('order');
    var search  = $(this).find('tbody').data('search');
    var length  = $(this).find('tbody').data('length');

    var table = $('#datatables-ajax').DataTable({
        responsive: true,
        destroy: true,
        iDisplayLength: 25,
        processing: true,
        serverSide: true,
        ajax: { 
            url: base_url + ajaxURL
        },
        language: {
            zeroRecords: "No records found.",
        },
        ordering:      typeof order  != 'undefined' ? (order  == "1" ? true : false) : false,
        searching:     typeof search != 'undefined' ? (search == "1" ? true : false) : false,
        bLengthChange: typeof length != 'undefined' ? (length == "1" ? true : false) : false
    });
});

if ($('#home_master_table').length > 0) {
    function requests_status_table($this, pusher)
    {
        var sr     = $this.data('sr');
        var b      = $this;
        var status = b.data('status');
        var link   = b.data('url');
        var target = b.data('target');
        
        var order   =   typeof $('#home_master_table').find('tbody').data('order') != 'undefined' ? ($('#home_master_table').find('tbody').data('order') == "1" ? true : false) : false;
        var search  =   typeof $('#home_master_table').find('tbody').data('search') != 'undefined' ? ($('#home_master_table').find('tbody').data('search') == "1" ? true : false) : false;
        var bFilter =   typeof $('#home_master_table').find('tbody').data('bfilter') != 'undefined' ? ($('#home_master_table').find('tbody').data('bfilter') == "1" ? true : false) : false;
        var paging  =   typeof $('#home_master_table').find('tbody').data('paging') != 'undefined' ? ($('#home_master_table').find('tbody').data('paging') == "1" ? true : false) : false;
        var url     =   link;

        $('.tab-link').removeClass('tab-active');
        b.addClass('tab-active');     

        if (pusher) {
            $('.requests-sr').html('');
            $('.requests-sr').hide();
            $('.requests-sr-load').removeClass('paper-load');
            $('.requests-sr-load').addClass('paper-fold');
        }       

        var load_html   =   '';
        var colorColumn =   10;
        var columnDef   =   {};

        if (status == 'new') {
            load_html   =   '<table id="home_master_table" class="table table-bordered dt-responsive nowrap table-service-request w-full"><thead><tr><th>Job ID</th><th>Service Date</th><th>Submit Date</th><th>Appliance</th><th>Count</th><th>Type</th><th>Service Type</th><th>Brand</th><th>Warranty</th><th>City</th></tr></thead><tbody data-search="0" data-length="0" data-ordering="0" data-paging="1" class="overview-table"></tbody></table>';
            columnDef   =   Datatable_ellipsis([4,5,6,7,8], 15);
        } else if (status == 'pending') {
            load_html   =   '<table id="home_master_table" class="table table-bordered dt-responsive nowrap table-service-request w-full"><thead><tr><th>Job ID</th><th>Service Date</th><th>Assigned Tech</th><th>Assigned Date</th><th>Appliance</th><th>Count</th><th>Type</th><th>Service Type</th><th>Brand</th><th>Warranty</th><th>City</th></tr></thead><tbody data-search="0" data-length="0" data-ordering="0" data-paging="1" class="overview-table"></tbody></table>';
            colorColumn =   11;
            columnDef   =   Datatable_ellipsis([4,5,6,7,8,9], 15);
        } else if (status == 'completed') {
            load_html   =   '<table id="home_master_table" class="table table-bordered dt-responsive nowrap table-service-request w-full"><thead><tr><th>Job ID</th><th>Service Date</th><th>Completed Date</th><th>Appliance</th><th>Count</th><th>Type</th><th>Service Type</th><th>Brand</th><th>Warranty</th><th>City</th></tr></thead><tbody data-search="0" data-length="0" data-ordering="0" data-paging="1" class="overview-table"></tbody></table>';
            columnDef   =   Datatable_ellipsis([4,5,6,7,8], 15);
        } else if (status == 'cancelled') {
            load_html   =   '<table id="home_master_table" class="table table-bordered dt-responsive nowrap table-service-request w-full"><thead><tr><th>Job ID</th><th>Service Date</th><th>Rejected Date</th><th>Appliance</th><th>Count</th><th>Type</th><th>Service Type</th><th>Brand</th><th>Warranty</th><th>City</th></tr></thead><tbody data-search="0" data-length="0" data-ordering="0" data-paging="1" class="overview-table"></tbody></table>';
            columnDef   =   Datatable_ellipsis([4,5,6,7,8], 15);
        }

        if (pusher) {
            $('.requests-sr').html(load_html);
        }
        
        $('#home_master_table').DataTable().clear().destroy();

        if (typeof status !== 'undefined') {
            if (status.length > 0) {
                $('.requests-title').text(ucfirst(status) + ' Requests');
            }
        }

        home_master_table       =   $('#home_master_table').DataTable( {
            lengthMenu  :   [[25, 50, 100, 200, 9999999], [25, 50, 100, 200, "All"]],
            sDom        :   'lfr<"datatable_fixed_height"t>ip',
            ordering    :   order,
            searching   :   search,

            bFilter     :   bFilter,
            paging      :   paging,
            language    : {
                zeroRecords     : "No data yet available yet.",
                processing      : ""
            },
            processing  :   true,
            serverSide  :   true,
            ajax        :   {
                url         :   url,
                data        :   function (d) {
                    d.status        =   status;
                    d.select        =   $('#home-master-dropdown').val();
                    d.txt_search    =   $('#home-master-search').val();
                }                    
            },
            columnDefs  : [
                {
                    targets     : '_all',
                    createdCell : function (td, cellData, rowData, row, col) {
                        $(td).css({
                            'white-space': 'nowrap',
                            'text-align' : 'left'
                        });
                    }
                },
                columnDef
            ],
            rowCallback : function(row, data, index) {
                $('td', row).css({
                    'background-color'  : data[colorColumn],
                    'cursor'            : 'pointer'
                });

                $('td', row).hover(function(){
                    $('td', row).css('background-color', '#F6F6F6');
                    }, function(){
                    $('td', row).css("background-color", data[colorColumn]);
                });
            },
            drawCallback     :   function() {
                if (pusher) {
                    $('.requests-sr-load').addClass('paper-load');
                    $('.requests-sr-load').removeClass('paper-fold');
                    $('.requests-sr').show();
                }
            }
        });

        

        return false;
    }

    requests_status_table($('.requests-status-table.tab-active'), true);
}


// remove session every loading
if (sessionStorage.getItem('jobs-table-refresh') != null) {
    sessionStorage.removeItem('jobs-table-refresh')
}
if ($('#jobs_table').length > 0) {
   
    function job_request_table($this, pusher)
    {
        var b      = $this;
        var sr     = $this.data('sr');
        var status = b.data('status');
        var link   = b.data('url');
        var target = b.data('target');
        
        var order   =   typeof $('#jobs_table').find('tbody').data('order') != 'undefined' ? ($('#jobs_table').find('tbody').data('order') == "1" ? true : false) : false;
        var search  =   typeof $('#jobs_table').find('tbody').data('search') != 'undefined' ? ($('#jobs_table').find('tbody').data('search') == "1" ? true : false) : false;
        var bFilter =   typeof $('#jobs_table').find('tbody').data('bfilter') != 'undefined' ? ($('#jobs_table').find('tbody').data('bfilter') == "1" ? true : false) : false;
        var paging  =   typeof $('#jobs_table').find('tbody').data('paging') != 'undefined' ? ($('#jobs_table').find('tbody').data('paging') == "1" ? true : false) : false;
        var url     =   link;
    
        $('.tab-link').removeClass('tab-active');
        b.addClass('tab-active');     

        if (pusher) {
            $('.requests-sr').html('');
            $('.requests-sr').hide();
            $('.requests-sr-load').removeClass('paper-load');
            $('.requests-sr-load').addClass('paper-fold');
        }       

        var load_html   =   '';
        var colorColumn =   9;
        var columnDef   =   {};

        if (status == 'new') {
            load_html   =   '<table id="jobs_table" class="table dt-responsive nowrap table-service-request w-full"><thead class=""><tr style="display:none;"><th></th><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th></tr></thead><tbody data-search="0" data-length="0" data-ordering="0" data-paging="1" class="jobs-table"></tbody></table>';
        } else if (status == 'pending') {
            load_html   =   '<table id="jobs_table" class="table dt-responsive nowrap table-service-request w-full"><thead class=""><tr style="display:none;"><th></th><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th></tr></thead><tbody data-search="0" data-length="0" data-ordering="0" data-paging="1" class="jobs-table"></tbody></table>';
        } else if (status == 'completed') {
            load_html   =   '<table id="jobs_table" class="table dt-responsive nowrap table-service-request w-full"><thead class=""><tr style="display:none;"><th></th><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th></tr></thead><tbody data-search="0" data-length="0" data-ordering="0" data-paging="1" class="jobs-table"></tbody></table>';

        } else if (status == 'cancelled') {
            load_html   =   '<table id="jobs_table" class="table dt-responsive nowrap table-service-request w-full"><thead class=""><tr style="display:none;"><th></th><th>1</th><th>2</th><th>3</th><th>4</th><th>5</th><th>6</th><th>7</th><th>8</th><th>9</th></tr></thead><tbody data-search="0" data-length="0" data-ordering="0" data-paging="1" class="jobs-table"></tbody></table>';

        }

        if (pusher) {
            $('.requests-sr').html(load_html);
        }
      
        $('#jobs_table').DataTable().clear().destroy();
        
        if (typeof status !== 'undefined') {
            if (status.length > 0) {
                $('.requests-title').text(ucfirst(status) + ' Requests');
            }
        }


        jobs_table = $('#jobs_table').DataTable( {
            lengthMenu  :   [[25, 50, 100, 200, 9999999], [25, 50, 100, 200, "All"]],
            sDom        :   '<<t>p<i>>',
            ordering    :   order,
            searching   :   search,
            bFilter     :   bFilter,
            paging      :   paging,
            tabIndex    :   -1,
            language    : {
                zeroRecords     : "No data available yet.",
                processing      : ""
            },
            processing  :   true,
            serverSide  :   true,
            ajax        :   {
                url         :   url,
                data        :   function (d) {
                    d.status    =   status;
                    d.field     =   $('.job-filter').val();
                    d.search    =   $('.job-search').val();
                }                    
            },
            columnDefs  : [
                {
                    targets     : '_all',
                    createdCell : function (td, cellData, rowData, row, col) {
                        $(td).css({
                            'white-space': 'nowrap',
                            'text-align' : 'left'
                        });
                    }
                },
                columnDef
            ],
            rowCallback : function(row, data, index) {
                $(row).find('td:first-child').css({
                    'border-left'  : '15px solid ' + data[colorColumn],
                    'border-radius': '6px 0px 0px 6px'
                });
            },
            drawCallback     :   function() {
                if (pusher) {
                    $('.requests-sr-load').addClass('paper-load');
                    $('.requests-sr-load').removeClass('paper-fold');
                    $('.requests-sr').show();
                }
            },
            responsive: {
                details: {
                    type: 'column'
                }
            },
            initComplete: function(settings, json) {

                if (sessionStorage.getItem('jobs-table-refresh') != null) {
                    if (typeof json.headersCount != null) {
                        $('.strong-new').html(json.headersCount.new)
                        $('.strong-pending').html(json.headersCount.pending)
                        $('.strong-completed').html(json.headersCount.completed)
                        $('.strong-cancelled').html(json.headersCount.cancelled)
                    }
                }
            }
        });

        return true;
    }

    job_request_table($('.requests-status.tab-active'), true);

    $(document).on('click','.requests-status', function() {
        job_request_table($(this), true);
    });

    $(document).on('click', '.rescehdule-modal-close', function() {
        $('.rescehdule').removeClass('modal-reveal');
    })

    $(document).on('click', '.cancel-request', function() {
        $('.cancel-sr').removeClass('modal-reveal');
    })

    $(document).on('click', '.backjob-cancel', function() {
        $('.backjob-request').removeClass('modal-reveal');
    })

    $(document).on('click', '.refresh-sr', function() {
        sessionStorage.setItem('jobs-table-refresh', true);
        job_request_table($('.requests-status.tab-active'), true);
    })

    $(document).on('change','.job-filter', function(e) {
        placeHolder(e.target.value)
        if ($('.job-search').val() != '') {
            job_request_table($('.requests-status.tab-active'), true);
        }
    })

    function placeHolder(val) {

        var pHolder = null;
        switch (val) {
            case 'appliance':
                pHolder = 'Ex. aircon';
                break;
            case 'service':
                pHolder = 'Ex. cleaning';
                break;
            case 'city':
                pHolder = 'Ex. Pasig';
                break;
            case 'client-name':
                pHolder = 'Ex. Juan Dela Cruz';
                break;
            default:
                pHolder = 'Ex. 1234567';
                break;
        }

        $('.job-search').attr('placeholder', pHolder);
    }

    $(document).on('keyup','.job-search', function(e) {
        if (e.which !== 32) {
            if (e.which == 13) {
                sessionStorage.setItem('jobs-table-refresh', true);
                job_request_table($('.requests-status.tab-active'), true);
            }
        }
    })
}


if ($('#maintenance-table').length > 0) {
    $(document).ready(function() {
        var ajaxURL = $(this).find('tbody').data('url');
        var order   = $(this).find('tbody').data('order');
        var search  = $(this).find('tbody').data('search');
        var length  = $(this).find('tbody').data('length');

        var table = $('#maintenance-table').DataTable({
            sDom        :   '<<t>p<i>>',
            responsive: true,
            destroy: true,
            iDisplayLength: 25,
            processing: true,
            serverSide: true,
            ajax: { 
                url: base_url + ajaxURL
            },
            language: {
                zeroRecords: "No records found.",
            },
            ordering:      typeof order  != 'undefined' ? (order  == "1" ? true : false) : false,
            searching:     typeof search != 'undefined' ? (search == "1" ? true : false) : false,
            bLengthChange: typeof length != 'undefined' ? (length == "1" ? true : false) : false
        });
    });
}