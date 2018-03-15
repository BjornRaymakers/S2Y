document.getElementById('pagestring').innerHTML = "<strong>Scissors2 You </strong>Klanten";

$(document).ready(function() {
    fillClientTable();
});

function updateClientTable() {
    let table = document.getElementById('clientMainTable').getElementsByTagName('tbody')[0];
    let criteria = document.getElementById('clientCriteriaField').value.toLowerCase();

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
    let table = document.getElementById('clientMainTable').getElementsByTagName('tbody')[0];
    $("#clientMainTable tbody tr").remove();

    clients.sort(dynamicSort("id"));
    clients.reverse();

    for (index = 0; index < clients.length; ++index) {
        let insertrow = table.insertRow(0);

        let c0 = insertrow.insertCell(0);
        let c1 = insertrow.insertCell(1);
        let c2 = insertrow.insertCell(2);
        let c3 = insertrow.insertCell(3);
        let c4 = insertrow.insertCell(4);
        let c5 = insertrow.insertCell(5);

        c0.innerHTML = "<a href='client?id=" + clients[index].id + "' class='icon'><i class='fab fa-sistrix'/></a>";
        c1.innerHTML = clients[index].id;
        c2.innerHTML = clients[index].fullname;
        c3.innerHTML = clients[index].street + " " + clients[index].housenumber + ", " + clients[index].pcode + " " + clients[index].city;
        c4.innerHTML = clients[index].telephone;
        c5.innerHTML = clients[index].email;

    }

}