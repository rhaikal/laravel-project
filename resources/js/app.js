require("./bootstrap");

feather.replace({ "aria-hidden": "true" });

var harga = document.getElementById("price");
if (harga) {
    harga.addEventListener("keyup", function (e) {
        if (harga.value > 0) {
            harga.addEventListener("blur", function (e) {
                harga.value = "Rp. " + formatAngka(this.value);
            });
        }

        harga.value = formatAngka(this.value);
    });
}

function formatAngka(angka) {
    return angka
        .replace(/[^,\d]/g, "")
        .replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        .toString();
}
