document.getElementById('pagestring').innerHTML = "<strong>Scissors2 You </strong>Prijs simulatie";

function calcPrice() {
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
            alert('Error was: ' + status);
        } else {
            var originList = response.originAddresses;
            var actionDiv = document.getElementById('simulate_action');

            var kmDiv = document.getElementById('total_km');
            var kmprijsDiv = document.getElementById('total_km_price');
            var totalprice1Div = document.getElementById('total_price1');
            var totalprice2Div = document.getElementById('total_price2');



            kmDiv.innerHTML = '';
            kmprijsDiv.innerHTML = '';

            for (var i = 0; i < originList.length; i++) {
                var results = response.rows[i].elements;
                if (results[0].status == 'NOT_FOUND') {
                    var message = 'Adres niet gevonden!';
                    kmDiv.value = message;
                    kmprijsDiv.value = message;
                    totalprice1Div.value = message;
                    totalprice2Div.value = message;

                } else {
                    for (var j = 0; j < results.length; j++) {
                        var $total_km = results[j].distance.text.replace(" km", "");
                        var $total_km_price = (parseFloat($total_km.replace(",", ".") )* 0.25).toFixed(2);
                        var $artfound = false;
                        kmDiv.value = $total_km + " km";
                        kmprijsDiv.value = "€ " + $total_km_price;

                        articles.forEach(function (art) {
                            var actionSelected = actionDiv.options[actionDiv.selectedIndex].value;
                            if (art.id == actionSelected) {

                                if (art.price1 == "") {
                                    totalprice1Div.value = "";
                                } else {
                                    var $totalPrice1 = parseFloat($total_km_price) + parseFloat(art.price1);
                                    if (art.price1_comment == "") {
                                        totalprice1Div.value = "€ " + $totalPrice1;
                                    } else {
                                        totalprice1Div.value = art.price1_comment + " : €" + $totalPrice1;
                                    }
                                }

                                if (art.price2 == "") {
                                    totalprice2Div.value = "";
                                } else{
                                    var $totalPrice2 = parseFloat($total_km_price) + parseFloat(art.price2);
                                    if (art.price2_comment == "") {
                                        totalprice2Div.value = "€ " + $totalPrice2;
                                    } else {
                                        totalprice2Div.value = art.price2_comment + " : €" + $totalPrice2;
                                    }
                                }

                                $artfound = true;
                            }
                        });

                        if ($artfound == false) {
                            totalprice1Div.value = "Artikel niet gevonden.";
                            totalprice2Div.value = "Artikel niet gevonden.";
                        }
                    }
                }
            }
        }
    })
    ;
}