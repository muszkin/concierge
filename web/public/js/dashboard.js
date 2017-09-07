$('#turned-saas').on('shown.bs.modal',function(){
    $.post("/turned-saas-modal",function(data){
        $('#turned-saas-body').html(data);
        $('#turned-saas-save').on('click',function(){
            $(this).remove();
            var note = $('#note').val();
            $.post('/turned-saas-save',{
                note: note,
                date: $('#turned-saas-date').data('DateTimePicker').date().format('YYYY-MM-DD HH:mm:ss'),
                license_id:getLicenseId(),
                crm_license_id:getCrmLicenseId(),
                crm_client_id:getCrmClientId()
            },function(data){
                if (data.success){
                    $('#turned-saas').modal('hide');
                    call_list(currdate);
                    unassignedList();
                    conciergeLog();
                }
            },"json");
        });
    });
});
$('#turned-saas').on('hide.bs.modal',function(){
    $('#turned-saas-body').html("");
});

$('#lost').on('shown.bs.modal',function(){
    $.post("/client-lost-modal",function(data){
        $('#lost-body').html(data);
        $('#lost-save').on('click',function(){
            $(this).remove();
            var note = $('#note').val();
            $.post('/client-lost-save',{
                note: note,
                license_id:getLicenseId(),
                crm_license_id:getCrmLicenseId(),
                crm_client_id:getCrmClientId()
            },function(data){
                if (data.success){
                    $('#lost').modal('hide');
                    call_list(currdate);
                    unassignedList();
                    conciergeLog();
                }
            },"json");
        });
    });
});
$('#lost').on('hide.bs.modal',function(){
    $('#lost-body').html("");
});

$('#not-answered').on('shown.bs.modal', function(){
    $.post("/not-answered-modal",function(data){
        $('#not-answered-body').html(data);
        $('#not-answered-save').on('click',function(){
            $(this).remove();
            $.post("/not-answered-save",{
                date: $('#not-answered-date').data('DateTimePicker').date().format('YYYY-MM-DD HH:mm:ss'),
                license_id:getLicenseId(),
                crm_license_id:getCrmLicenseId(),
                crm_client_id:getCrmClientId()
            },function(data){
                if (data.success){
                    $('#not-answered').modal('hide');
                    call_list(currdate);
                    unassignedList();
                    conciergeLog();
                }
            },"json");
        });
    })
});

$('#not-answered').on('hide.bs.modal',function () {
    $('#not-answered-body').html("");
});

$('#not-related').on('shown.bs.modal',function(ev){
    ev.stopPropagation();
    $.post('/not-related-modal',function(data){
        $('#not-related-body').html(data);
        $('#not-related-save').on('click',function(){
           $(this).remove();
           var note = $('#note').val();
           $.post('/not-related-save',{
               note: note,
               license_id:getLicenseId(),
               crm_license_id:getCrmLicenseId(),
               crm_client_id:getCrmClientId()
           },function(data){
               if (data.success){
                   $('#not-related').modal('hide');
                   call_list(currdate);
                   unassignedList();
               }
           },"json");
        });
    })
});

$('#not-related').on('hide.bs.modal',function(){
   $('#not-related-body').html("");
});

$('#postpone-modal').on('hide.bs.modal',function(){
    $('#postpone-body').html("");
});
$('#postpone-modal').on('shown.bs.modal',function(ev){
    ev.stopPropagation();
    $.post('/postpone-modal',function(data){
        $('#postpone-body').html(data);
        $('#postpone-save').on('click',function(){
            $(this).remove();
            var date = $('#postpone-date').data('DateTimePicker').date().format("YYYY-MM-DD HH:mm:ss");
            var note = $('#note').val();
            var timeMatters = (($('#time-matters').is(':checked'))?1:0);
            $.post('/postpone-save',{
                date: date,
                time_matters: timeMatters,
                note: note,
                license_id:getLicenseId(),
                crm_license_id:getCrmLicenseId(),
                crm_client_id:getCrmClientId()
            },function(data){
                if (data.success){
                    $('#postpone-modal').modal('hide');
                    call_list(currdate);
                    unassignedList();
                    conciergeLog();
                }
            },"json");
        });
    });
});

function getLang()
{
    if (navigator.languages != undefined)
        return navigator.languages[0];
    else
        return navigator.language;
}

$('#concierge').on('hide.bs.modal',function () {
    $('#concierge-body').html("");
});
$('#concierge').on('shown.bs.modal',function(ev){
    $.post('/concierge-modal',{
        license_id:getLicenseId(),
        crm_license_id:getCrmLicenseId(),
        crm_client_id:getCrmClientId()
    },function(data){
        $('#concierge-body').html(data);
        $('#concierge-date').datetimepicker({
            daysOfWeekDisabled: [0, 6],
            locale: getLang(),
            inline: true,
            sideBySide: true
        });
        $(":radio").labelauty();
        $(":checkbox").labelauty();
        $('#concierge .modal-body h4').html($('#benefits .panel-heading').text());
        $('#concierge blockquote p').html($('#benefits p').html());
        $.each($('.single-questions .tag-box'), function () {
            if(!$('input:checked', this).val()){
                $('span',this).not('.tag-box label span').addClass('btn-warning');
            }
        });
        $.each($('.multi-questions .tag-box'), function () {
            if(!$('input:checked', this).val()){
                $('span',this).not('.tag-box label span').addClass('btn-warning');
            }
        });
        $('.single-questions .tag-box input').on('click',function(){
            if ($(this).is(':checked')){
                $(this).siblings('span').removeClass('btn-warning');
                $(this).checked = true;
                $(this).siblings(':checked').prop('checked',false);
                $(this).siblings('label').prop('aria-checked',false);
                $(this).prop('aria-checked',true);
            }
            if(!$(this).is(':checked')) {
                $(this).siblings('span').addClass('btn-warning');
                $(this).checked = false;
            }
        });
        $('.multi-questions .tag-box input').on('change', function() {
            if($('.multi-questions .tag-box input:checked').length > 0) {
                $(this).siblings('span').removeClass('btn-warning');
            }
            else{
                $(this).siblings('span').addClass('btn-warning');
            }
        });
        $('#save-concierge').on('click',function () {
                $('#save-concierge').remove();
                var data = $('#concierge-form').serializeArray();
                var timeMatters = (($('#time-matters').is(':checked'))?1:0);
                data.push({
                    name: "date",
                    value: $('#concierge-date').data('DateTimePicker').date().format('YYYY-MM-DD HH:mm:ss')
                });
                data.push({
                    name: "time_matters",
                    value: timeMatters
                });
                $.ajax({
                    url: "/save-concierge",
                    data: data,
                    processData: true,
                    dataType: 'json',
                    method:'POST',
                    success:function(d){
                        $('#concierge').modal('hide');
                        unassignedList();
                        call_list(currdate);
                        conciergeLog();
                    }
                });
        });
    });
});

moment().local();

var currdate = moment().format("YYYY-MM-DD");
$("#call-list span").text(currdate);



var team_id = 3;
$('#clock').countdown($('#clock').html(), function(event) {
    $(this).html(event.strftime('%D days %H:%M:%S'));
});

var currdate = moment().format("YYYY-MM-DD");
$("#call-list span").text(currdate);
var tommorow = moment(currdate, "YYYY-MM-DD").add(1,'days').format("YYYY-MM-DD");

var resetCacheNoConciergeList = false;

function client_data(element){
    $(element).on('click',function(){
        $(element).parent().children('tr').removeClass('selected');
        $(this).addClass('selected');
        $('#client-data').hide();
        $('#cl-licenses').hide();
        $('#summary-box').hide();
        $('#last-concierge-data').hide();
        $('#log-history').hide();
        var clientid = $(this).data('client_id');
        var clientemail = $(this).data("user_email");
        $('#client-data').show();
        $('#cl-licenses').show();
        $('#benefits').height($('#client-data').height()+$('#cl-licenses').height()+20);

        $('#benefits').show();
        $("#client-data").LoadingOverlay("show", {
            color: "rgba(255, 255, 255, 1)"
        });
        $("#cl-licenses").LoadingOverlay("show", {
            color: "rgba(255, 255, 255, 1)"
        });
        $.ajax({
            url: '/client-data',
            method: 'POST',
            data: {
                client_id: clientid
            },
            success: function (data) {
                $("#client-data").LoadingOverlay("hide").html(data);
                makeCall();
                $('#send-email').on('click',function() {
                    var that = $(this);
                    $("#client-phone").parent().LoadingOverlay("show", {
                        color: "rgba(255, 255, 255, 1)"
                    });
                    $.post('/no-phone-send-email', {
                        crm_client_email: clientemail,
                        license_id:clientid
                    }, function (data) {
                        $('#client-phone').parent().LoadingOverlay('hide');
                        if (data.success) {
                            that.remove();
                            $('#client-phone').parent().append('Email sended');
                        } else {
                            that.remove();
                            $('#client-phone').parent().append('Error when sending email');
                        }
                    }, "json");
                });
            }
        });
        $.ajax({
            method: "POST",
            data: {
                email: clientemail,
                client_id: clientid
            },
            url: '/client-licenses',
            success: function (data) {
                $("#cl-licenses").LoadingOverlay("hide");
                $('#cl-licenses').show();
                $('#client-licenses tbody').html(data);
                resetCacheNoConciergeList = true;
                clientLicenses();
            }
        });
    });
}
function clientLicenses(){
    $('#client-licenses tbody tr').not('.disable').on('click',function(){
        var license_id = $(this).data('license');
        setLicenseId(license_id);
        setCrmClientId($(this).data('crm-client-id'));
        setCrmLicenseId($(this).data('crm-license-id'));
        var domain = $(this).data('domain');
        $.ajax({
            url: '/last-concierge',
            method: "POST",
            data:{
                license_id:license_id
            },
            success: function (data){
                $('#last-concierge-data').show();
                $('#last-concierge-data-value').html(data);
            }
        });
        conciergeLog();
        $.ajax({
            url:'/prospect-and-level',
            method: "POST",
            data:{
                license_id:license_id
            },
            success: function(data){
                $('#summary-box').show();
                $('#summary-domain').text(domain).parent().attr('href','http://' + domain);
                $('#prospect-status').html(data);
            }
        });
    });
}

function conciergeLog(){
    $.ajax({
        url:'/concierge-notes',
        method: "POST",
        data:{
            license_id:getLicenseId()
        },
        success: function(data){
            $('#log-history').show();
            $('#log-history-data').html(data);
        }
    });
}

function call_list(currdate){
    $("#call-list span").LoadingOverlay("show", {
        color: "rgba(255, 255, 255, 0.8)"
    });
    $.ajax({
        url: '/call-list',
        method: 'POST',
        data: {
            curdate: currdate
        },
        success: function(data){
            $("#call-list span").LoadingOverlay("hide");
            $('#call-list-data').html(data);
            cur_date();
            $('#call-list .list-group a').on('click', function(e) {
                $('#client-data').hide();
                $('#cl-licenses').hide();
                $('#summary-box').hide();
                $('#last-concierge-data').hide();
                $('#log-history').hide();
                e.preventDefault();
                var clientid = $(this).parent().data("client_id");
                var clientemail = $(this).parent().data("user_email");
                $('#client-data').show();
                $('#cl-licenses').show();
                $('#benefits').height($('#client-data').height()+$('#cl-licenses').height()+20);

                $('#benefits').show();
                $("#client-data").LoadingOverlay("show", {
                    color: "rgba(255, 255, 255, 1)"
                });
                $("#cl-licenses").LoadingOverlay("show", {
                    color: "rgba(255, 255, 255, 1)"
                });
                getClientData(clientid,clientemail);
            });
            $('#call-list button').on('click', function(e) {
                $(this).parent().remove();
            });
        }
    });
}

function getClientLicenses(clientid,clientemail){
    $.ajax({
        method: "POST",
        data:{
            client_id: clientid,
            email: clientemail
        },
        url: '/client-licenses',
        success: function(data){
            $("#cl-licenses").LoadingOverlay("hide");
            $('#cl-licenses').show();
            $('#client-licenses tbody').html(data);
            resetCacheNoConciergeList = false;
            clientLicenses();
        }
    });
}

function getClientData(clientid,clientemail){
    $.ajax({
        url: '/client-data',
        method: 'POST',
        data: {
            client_id: clientid
        },
        success: function (data) {
            $("#client-data").LoadingOverlay("hide").html(data);
            getClientLicenses(clientid,clientemail);
            makeCall();
            $('#send-email').on('click',function(){
                var that = $(this);
                $("#client-phone").parent().LoadingOverlay("show", {
                    color: "rgba(255, 255, 255, 1)"
                });
                $.post('/no-phone-send-email',{
                    crm_client_email:clientemail,
                    license_id:clientid
                },function (data) {
                    $('#client-phone').parent().LoadingOverlay('hide');
                    if (data.success){
                        that.remove();
                        $('#client-phone').parent().append('Email sended');
                    }else{
                        that.remove();
                        $('#client-phone').parent().append('Error when sending email');
                    }
                },"json");
            });
        }
    });
}


function cur_date(){
    $('#curdate .fa-chevron-left').on('click', function() {
        currdate = moment(currdate, "YYYY-MM-DD").add(-1,'days').format("YYYY-MM-DD");
        $("#call-list span").text(currdate);
        call_list(currdate);
    });


    $('#curdate .fa-chevron-right').on('click', function() {
        currdate = moment(currdate, "YYYY-MM-DD").add(+1,'days').format("YYYY-MM-DD");
        $("#call-list span").text(currdate);
        call_list(currdate);
    });
}


$('.stacked-bar-graph').tooltip({
    selector: "[data-toggle=tooltip]",
    container: "body"
});

$('.action-buttons').tooltip({
    selector: "[data-tip=tooltip]",
    container: "body"
});


$(":radio").labelauty();
$(":checkbox").labelauty();

var noConciergeListData;

function setNoConciergeListaData(data)
{
    if (typeof data != 'object'){
        noConciergeListData = data;
        clearInterval(noConciergeListInterval);
        $('#unassigned-list').LoadingOverlay('hide');
        $('#unassigned-list').show();
        $('#unassigned-list').html(getNoConciergeListData());
        client_data('#no-concierge tr');
        $('#refresh-no-concierge-list-hard').on('click',function(){
            resetCacheNoConciergeList = true;
            unassignedList();
        });

        $('#refresh-no-concierge-list-soft').on('click',function(){
            resetCacheNoConciergeList = false;
            unassignedList();
        });
    }
}
function getNoConciergeListData()
{
    return noConciergeListData;
}

function clearCacheNoConciergeData()
{
    $.get("/no-concierge-list-reset",function(data){
        console.log(data);
    });
}

function getNoConciergeList()
{
    $.get("/no-concierge-list",function(data){
        setNoConciergeListaData(data);
    });
}

var noConciergeListInterval;

function unassignedList(){
    if (resetCacheNoConciergeList){
        clearCacheNoConciergeData();
    }
    $('#unassigned-list').hide();
    $('#unassigned-list').show();
    $("#unassigned-list").LoadingOverlay("show", {
        color: "rgba(255, 255, 255, 1)"
    });
    noConciergeListInterval = setInterval(function(){getNoConciergeList();},1000);
}



var license_Id,crmClientId,crmLicenseId = 0;

function setCrmClientId(crm_client_id){
    crmClientId = crm_client_id;
}
function getCrmClientId(){
    return crmClientId;
}

function setCrmLicenseId(crm_license_id){
    crmLicenseId = crm_license_id;
}

function getCrmLicenseId() {
    return crmLicenseId;
}

function setLicenseId(license_id){
    license_Id = license_id;
}

function getLicenseId(){
    return license_Id;
}

function init(){
    call_list(currdate);
    unassignedList();
}

function makeCall(){
    var call = '#makeCall';
    $(call).on('click',function(){
       $(call).off('click');
       var phone = $(this).data('phone');
       $(call).removeClass('btn-success');
       $(call).addClass('btn-info');
       $(call).text('Connecting...');
       $.post('/makeCall',{phone:phone},function(data){
           $(call).removeClass('btn-info');
           if (data.hasOwnProperty('errors')){
               $(call).addClass('btn-danger');
               $(call).text('api error info');
               var title = "";
               $.each(data.errors,function(index,element){
                   title =  title + element.message + "\n";
               });
               $(call).attr('title',title);
           }else {
               $(call).addClass('btn-warning');
               $(call).text('Hang Up');
               $(call).on('click',function(){
                   $(call).off('click');
                   $.post("/hangUpCall",function(data){
                       if (data.hasOwnProperty('errors')) {
                           $(call).addClass('btn-danger');
                           $(call).text('api error info');
                           var title = "";
                           $.each(data.errors, function (index, element) {
                               title = title + element.message + "\n";
                           });
                           $(call).attr('title', title);
                       }else{
                           $(call).addClass('btn-success');
                           $(call).removeClass('btn-warning');
                           makeCall();
                       }
                   },"json");
               });
           }
       },"json");
    });
}

$(document).ready(function(){
    init();
});
