function updateimagefunction()
{
//    alert("test");
    $("#image").click();
}



function submitForm()
{
    //location.reload();
    var file_data = $('#image').prop('files')[0];
    var form_data = new FormData();
    //var ajid = 3;
    form_data.append('file', file_data);
    // console.log(ajid);                             
    $.ajax({
        url: baseurl + "editprofilepic", // point to server-side PHP script 
        dataType: 'JSON', // what to expect back from the PHP script, if anything
        headers: {
            'X-CSRF-TOKEN': $('input[name="_token"]').val(),
        },
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function (data) {
            //console.log(data);
            location.reload();
//            handleAjaxResponse(data);
            // alert(php_script_response); // display response from the PHP script, if any
        }
    });
}

// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
if (btn != null)
{
// When the user clicks the button, open the modal 
    btn.onclick = function () {
        modal.style.display = "block";
    }
}


// When the user clicks on <span> (x), close the modal
span.onclick = function () {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}