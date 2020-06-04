var Userfunction = function() {

    var list = function() {
        $('body').on("click", ".deleteuser", function() {
            var id = $(this).attr('data-id');
            setTimeout(function() {
                $('.yes-sure:visible').attr('data-id', id);
            }, 500);

        });
        $('body').on("click", ".reactivateuser", function() {
            var id = $(this).attr('data-id');
            setTimeout(function() {
                $('.reactivate-yes-sure:visible').attr('data-id', id);
            }, 500);

        });


        $('body').on('click', '.yes-sure', function() {
            var id = $(this).attr('data-id');

            var data = { id: id, _token: $('#_token').val() };
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "user-ajaxAction",
                data: { 'action': 'deleteUser', 'data': data },
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });
        });

        $('body').on('click', '.reactivate-yes-sure', function() {
            var id = $(this).attr('data-id');

            var data = { id: id, _token: $('#_token').val() };
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "user-ajaxAction",
                data: { 'action': 'reactivateUser', 'data': data },
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });
        });

        $('body').on("change", ".user_type", function() {
            var id = $(this).attr('data-id');
            var val = $(this).val();

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "user-ajaxAction",
                data: { 'action': 'changeusertype', 'id': id, 'val': val },
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });

        });

        $('body').on("change", ".user_type_staff", function() {
            var id = $(this).attr('data-id');
            var val = $(this).val();

            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "staff-ajaxAction",
                data: { 'action': 'changeusertypestaff', 'id': id, 'val': val },
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });

        });


        $('body').on("change", ".admin_verify_status", function() {
            var id = $(this).attr('data-id');
            var val = $(this).val();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "user-ajaxAction",
                data: { 'action': 'changeadminverify', 'id': id, 'val': val },
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });

        });

        $('body').on("change", ".email_verify_status", function() {
            var id = $(this).attr('data-id');
            var val = $(this).val();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "user-ajaxAction",
                data: { 'action': 'changeemailverify', 'id': id, 'val': val },
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });

        });
        $('body').on("change", ".addressVerify", function() {
            var id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "user-ajaxAction",
                data: { 'action': 'addressVerify', 'id': id },
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });

        });

        $('body').on("change", ".staff_verify_status", function() {
            var id = $(this).attr('data-id');
            var val = $(this).val();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "staff-ajaxAction",
                data: { 'action': 'changestaffverify', 'id': id, 'val': val },
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });

        });

        $('body').on("change", ".wip_status", function() {
            var id = $(this).attr('data-id');
            var val = $(this).val();
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "user-ajaxAction",
                data: { 'action': 'changewipstatus', 'id': id, 'val': val },
                success: function(data) {
                    handleAjaxResponse(data);
                }
            });

        });

        $('body').on("click", ".generate_passcode", function() {
            var id = $(this).attr('data-id');
            setTimeout(function() {
                $('.passcode-yes-sure').show();
                $('.passcode-yes-sure:visible').attr('data-id', id);
            }, 500);

        });

        $('body').on('click', '.passcode-yes-sure', function() {
            $('.passcode-yes-sure').hide();
            var id = $(this).attr('data-id');

            var data = { id: id, _token: $('#_token').val() };
            $.ajax({
                type: "POST",
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val(),
                },
                url: baseurl + "user-ajaxAction",
                data: { 'action': 'generate-passcode', 'data': data },
                dataType: 'json',
                success: function(data) {

                    $('#divPasscode' + id).html(data['pass_code']);
                    $('#passcodeModel').modal('hide');


                }
            });
        });
    }

    return {
        init: function() {
            list();
        },

    }
}();