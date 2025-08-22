<?php
function generateBookingReference() {
    return strtoupper(substr(md5(uniqid()), 0, 8));
}

function calculateTotalPrice($flightPrice, $accommodationPrice, $adventurePrice, $transportPrice) {
    return $flightPrice + $accommodationPrice + $adventurePrice + $transportPrice;
}

function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>