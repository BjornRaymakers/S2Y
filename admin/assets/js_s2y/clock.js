setInterval(updateClock, 1000);

function updateClock() {
    now = new Date();
    document.getElementById('datetimestr').innerHTML = now.toDateString() + " " + now.toLocaleTimeString();
}