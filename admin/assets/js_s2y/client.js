document.getElementById('pagestring').innerHTML = "<strong>Scissors2 You </strong>Klant";

function deleteClient() {
    $customer = document.getElementById("custid").value;
    $customerfirstname = document.getElementById("firstname").value;
    $customerlastname = document.getElementById("lastname").value;

    if ($customer == '') {
        swal({
            title: "Fout!",
            text: "Geen klant gevonden met deze ID!",
            type: "error",
            dangerMode: true,
        })
    }
    else {
        swal({
            title: "Wil je verder gaan?",
            text: 'Wilt u "' + $customerfirstname + " " + $customerlastname + "' verwijderen?",
            type: "question",
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
                        data: $('#clientform').serialize() + "&class=client&action=del"

                    })
                        .done(function (data) {

                            dt = JSON.parse(data);
                            document.getElementById("responseH").innerHTML = dt['string'];

                            if (dt['redirect']) {
                                window.setTimeout(function () {
                                    window.location = "clients.php";
                                }, 1500);
                            }

                        });
                    return false;
                }
            });
    }
}

function saveClient() {
    $.ajax({
        type: 'POST',
        url: '/admin/assets/functions/process.php',
        data: $('#clientform').serialize() + "&class=client&action=save"
    })
        .done(function (data) {
            dt = JSON.parse(data);
            document.getElementById("responseH").innerHTML = dt['string'];

            if (dt['id'] != '') {
                document.getElementById("custid").value = dt['id'];
            }
            jQuery(document).ready(function () {
                window.scroll({top: 0, left: 0, behavior: 'smooth' });
            });
            $('#response').html(data);

        });
    return false;
}

function calcDistance() {
    var bounds = new google.maps.LatLngBounds;
    var markersArray = [];

    var selectBox = document.getElementById("citys");
    var city = selectBox.options[selectBox.selectedIndex].text;
    var street = document.getElementById('street').value;

    var start = 'Kempenstraat, Lummen, Belgium';
    var destination = street + ', ' + city + ', Belgium';

    var service = new google.maps.DistanceMatrixService;
    service.getDistanceMatrix({
        origins: [start],
        destinations: [destination],
        travelMode: 'DRIVING',
        unitSystem: google.maps.UnitSystem.METRIC,
        avoidHighways: false,
        avoidTolls: false
    }, function (response, status) {
        if (status !== 'OK') {
            swal({
                title: "Fout!",
                text: status,
                type: "error",
                dangerMode: true,
            })
        } else {
            var originList = response.originAddresses;
            var outputDiv = document.getElementById('total_km');
            outputDiv.innerHTML = '';

            for (var i = 0; i < originList.length; i++) {
                var results = response.rows[i].elements;
                if (results[0].status == 'NOT_FOUND') {
                    outputDiv.value = "Addres niet gevonden!";
                } else {
                    for (var j = 0; j < results.length; j++) {
                        outputDiv.value = results[j].distance.text.replace(" km", "");
                    }
                }
            }
        }
    });
}

function updateClientTable() {
    var table = document.getElementById('clientMainTable').getElementsByTagName('tbody')[0];
    var criteria = document.getElementById('clientCriteriaField').value.toLowerCase();

    clients.sort(dynamicSort("id"));
    clients.reverse();

    if (criteria.length > 2) {
        $("#clientMainTable tbody tr").remove();
        for (index = 0; index < clients.length; ++index) {
            var completeAddressString = clients[index].street + " " + clients[index].housenumber + ", " +
                clients[index].pcode + " " + clients[index].city;

            if (clients[index].fullname.toLowerCase().includes(criteria) ||
                completeAddressString.toLowerCase().includes(criteria) || clients[index].telephone.includes(criteria)) {
                var insertrow = table.insertRow(0);

                var c0 = insertrow.insertCell(0);
                var c1 = insertrow.insertCell(1);
                var c2 = insertrow.insertCell(2);
                var c3 = insertrow.insertCell(3);
                var c4 = insertrow.insertCell(4);
                var c5 = insertrow.insertCell(5);

                c0.innerHTML = "<a href='client?id=" + clients[index].id + "' class='icon'><i class='fab fa-sistrix'/></a>";
                c1.innerHTML = clients[index].id;
                c2.innerHTML = clients[index].fullname;
                c3.innerHTML = completeAddressString;
                c4.innerHTML = clients[index].telephone;
                c5.innerHTML = clients[index].email;
            }
        }
    } else {
        fillClientTable();
    }

}

function fillClientTable() {
    var table = document.getElementById('clientMainTable').getElementsByTagName('tbody')[0];
    $("#clientMainTable tbody tr").remove();

    clients.sort(dynamicSort("id"));
    clients.reverse();

    for (index = 0; index < clients.length; ++index) {
        var insertrow = table.insertRow(0);

        var c0 = insertrow.insertCell(0);
        var c1 = insertrow.insertCell(1);
        var c2 = insertrow.insertCell(2);
        var c3 = insertrow.insertCell(3);
        var c4 = insertrow.insertCell(4);
        var c5 = insertrow.insertCell(5);

        c0.innerHTML = "<a href='client?id=" + clients[index].id + "' class='icon'><i class='fab fa-sistrix'/></a>";
        c1.innerHTML = clients[index].id;
        c2.innerHTML = clients[index].fullname;
        c3.innerHTML = clients[index].street + " " + clients[index].housenumber + ", " + clients[index].pcode + " " + clients[index].city;
        c4.innerHTML = clients[index].telephone;
        c5.innerHTML = clients[index].email;

    }

}