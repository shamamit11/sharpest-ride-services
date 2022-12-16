
 function encodeImgtoBase64(element) {
    var img = element.files[0];
    var reader = new FileReader();
    reader.onloadend = function() {
        $("#btn_image_delete").removeClass('d-none');
        $("#logo").val(reader.result);
        $("#displayImg").attr("src", reader.result);
    }
    reader.readAsDataURL(img);
}

function encodeFavImgtoBase64(element) {
    var img = element.files[0];
    var reader = new FileReader();
    reader.onloadend = function() {
        $("#btn_image_delete1").removeClass('d-none');
        $("#favicon").val(reader.result);
        $("#displayFavImg").attr("src", reader.result);
    }
    reader.readAsDataURL(img);
}

$(document).ready(function () {
    $("#form").submit(function (e) {
        e.preventDefault();
        $('.btn-loading').prop('disabled', true)
        $('.btn-loading').html('<span class="spinner-border spinner-border-sm me-1" role="status" aria-hidden="true"></span> Loading...');
        $.ajax({
            type: 'post',
            url: $('#form').attr('action'),
            data: $("#form").serialize(),
            success: function (data) {
                $('.btn-loading').prop('disabled', false);
                $('.btn-loading').html('Submit');
                if (data.status_code == 201) {
                    toastr["success"](data.message);
                    window.location.href = app_url + '/appsettings';
                }
            },
            error: function (xhr) {
                $('.btn-loading').prop('disabled', false);
                $('.btn-loading').html('Submit');
                if (xhr.status == 422) {
                    var res = jQuery.parseJSON(xhr.responseText);
                    if (res.error == 'validation') {
                        var messageLength = res.message.length;
                        for (var i = 0; i < messageLength; i++) {
                            for (const [key, value] of Object.entries(res.message[i])) {
                                if (value) {
                                    $('div.error').show();
                                    $('#error_' + key).text(value);
                                }
                            }
                        }
                    }
                }
            }
        });
    });
});