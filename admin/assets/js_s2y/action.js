document.getElementById('pagestring').innerHTML = "<strong>Scissors2 You </strong>Actie";

function deleteAction() {
    $id = document.getElementById("actid").value;
    $actname = document.getElementById("acttitle").value;

    if ($id == '') {
        swal({
            title: "Fout!",
            text: "Geen artikel gevonden met deze ID!",
            type: "error",
            dangerMode: true,
        })
    }
    else {
        swal({
            title: "Wil je verder gaan?",
            text: 'Wilt u "' + $actname + ' (' + $id + ')" verwijderen?',
            type: "warning",
            showCancelButton: true,
            showConfirmButton: true,
            cancelButtonText: 'Annuleer',
            confirmButtonText: 'Verwijder',
            dangerMode: true,
        })
            .then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: '/admin/assets/functions/process.php',
                        data: $('#artform').serialize() + "&class=act&action=del"

                    })
                        .done(function (data) {

                            dt = JSON.parse(data);
                            document.getElementById("responseH").innerHTML = dt['string'];

                            if (dt['redirect']) {
                                window.setTimeout(function () {
                                    window.location = "../actions.php";
                                }, 1500);
                            }

                        });
                    return false;
                }
            });
    }
}

function saveAction() {
    $.ajax({
        type: 'POST',
        url: '/admin/assets/functions/process.php',
        data: $('#artform').serialize() + "&class=act&action=save"
    })
        .done(function (data) {
            dt = JSON.parse(data);
            document.getElementById("responseH").innerHTML = dt['string'];

            if (dt['id'] != '') {
                document.getElementById("actid").value = dt['id'];
            }

            jQuery(document).ready(function () {
                window.scroll({top: 0, left: 0, behavior: 'smooth' });
            });
            $('#response').html(data);

        });
    return false;
}