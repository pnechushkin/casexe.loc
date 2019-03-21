$(document).ready(function () {
    console.log('test');
    $('.get-prize').click(function () {

        $.ajax({
            url: '/random-prize',
            type: 'get',
            dataType: 'json',
            // data: $('form').serialize(),
            headers: {'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')},
            beforeSend: function () {
                $('#result').empty();
                $('#result').hide();
            },
            success: function (res) {
                if (res.success) {
                    $('#result').html('<div class="alert alert-success">' + res.text + '</div>');
                } else {
                    $('#result').html('<div class="alert alert-danger">' + res.errors + '</div>');
                }
                $('#result').show();
            }
        }).done(function () {
            setTimeout(function () {
                $('#result').hide();
                $('#result').empty();
            }, 10000);
        }).fail(function () {
            console.log("error ajax");
        });
    });
});