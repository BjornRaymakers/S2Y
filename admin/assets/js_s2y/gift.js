document.getElementById('pagestring').innerHTML = "<strong>Scissors2 You </strong>Cadeaubonnen";

function deleteGift() {
    $id = document.getElementById("giftuid").value;

    if ($id == '') {
        swal({
            title: "Fout!",
            text: "Geen cadeaubon gevonden met deze UID!",
            type: "error",
            dangerMode: true,
        })
    }
    else {
        swal({
            title: "Wil je verder gaan?",
            text: 'Wilt u "' + $id + '" verwijderen?',
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
                        data: "&id=" + $id + "&class=gift&action=del"

                    })
                        .done(function (data) {

                            dt = JSON.parse(data);
                            document.getElementById("responseH").innerHTML = dt['string'];

                            if (dt['redirect']) {
                                window.setTimeout(function () {
                                    window.location = "gifts.php";
                                }, 1500);
                            }

                        });
                    return false;
                }
            });
    }
}

function saveGift() {
    $.ajax({
        type: 'POST',
        url: '/admin/assets/functions/process.php',
        data: $('#giftform').serialize() + "&class=gift&action=save"
    })
        .done(function (data) {
            dt = JSON.parse(data);
            document.getElementById("responseH").innerHTML = dt['string'];

            if (dt['id'] != '') {
                document.getElementById("giftUid").value = dt['id'];
            }

            jQuery(document).ready(function () {
                window.scroll({top: 0, left: 0, behavior: 'smooth' });
            });
            $('#response').html(data);

        });
    return false;
}