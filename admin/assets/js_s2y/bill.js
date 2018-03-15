document.getElementById('pagestring').innerHTML = "<strong>Scissors2 You </strong>Factuur";

function deleteBill() {
    $id = document.getElementById("billid").innerText;
    $appid = document.getElementById("appid").innerText;

    if ($id === '') {
        swal({
            title: "Fout!",
            text: 'Geen factuur gevonden met deze ID!',
            type: "error",
            dangerMode: true
        });
    }
    else if ($appid === '') {
        swal({
            title: "Fout!",
            text: 'Geen afspraak gevonden met deze ID!',
            type: "error",
            dangerMode: true
        });
    }
    else {
        swal({
            title: "Wil je verder gaan?",
            text: 'Wilt u factuur ' + $id + ' verwijderen?',
            type: "question",
            showCancelButton: true,
            showConfirmButton: true,
            cancelButtonText: 'Annuleer',
            confirmButtonText: 'Verwijder',
            dangerMode: true
        })
            .then((result) => {
                if (result.value) {
                    $.ajax({
                        type: 'POST',
                        url: '/admin/assets/functions/process.php',
                        data: "&class=bill&action=del&id=" + $id + "&appid=" + $appid
                    })
                        .done(function (data) {
                            dt = JSON.parse(data);

                            jQuery(document).ready(function () {
                                window.scroll({top: 0, left: 0, behavior: 'smooth' });
                            });

                            if (dt['redirect']) {
                                window.setTimeout(function () {
                                    window.location = "bills.php";
                                }, 1500);
                            }

                        });
                    return false;
                }
            });
    }
}