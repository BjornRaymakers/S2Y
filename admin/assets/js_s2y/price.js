document.getElementById('pagestring').innerHTML = "<strong>Scissors2 You </strong>Prijslijst";

function deleteArticle() {
    $id = document.getElementById("priceid").value;
    $artname = document.getElementById("article").value;

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
            text: 'Wilt u "' + $artname + ' (' + $id + ')" verwijderen?',
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
                        data: $('#artform').serialize() + "&class=article&action=del"

                    })
                        .done(function (data) {

                            dt = JSON.parse(data);
                            document.getElementById("responseH").innerHTML = dt['string'];

                            if (dt['redirect']) {
                                window.setTimeout(function () {
                                    window.location = "../pricelist.php";
                                }, 1500);
                            }

                        });
                    return false;
                }
            });
    }
}

function saveArticle() {
    $.ajax({
        type: 'POST',
        url: '/admin/assets/functions/process.php',
        data: $('#artform').serialize() + "&class=article&action=save"
    })
        .done(function (data) {
            dt = JSON.parse(data);
            document.getElementById("responseH").innerHTML = dt['string'];

            if (dt['id'] != '') {
                document.getElementById("priceid").value = dt['id'];
            }

            jQuery(document).ready(function () {
                window.scroll({top: 0, left: 0, behavior: 'smooth' });
            });
            $('#response').html(data);

        });
    return false;
}