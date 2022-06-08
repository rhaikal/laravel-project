require("./bootstrap");

feather.replace({ "aria-hidden": "true" });

var harga = document.getElementById("price");
if (harga) {
    window.addEventListener("load", function (e) {
        harga.value = "Rp. " + formatAngka(harga.value);
    });

    harga.addEventListener("keyup", function (e) {
        harga.value = formatAngka(this.value);

        if (harga.value) {
            harga.addEventListener("blur", function (e) {
                harga.value = "Rp. " + formatAngka(this.value);
            });
        }
    });
}

function formatAngka(angka) {
    return angka
        .replace(/[^,\d]/g, "")
        .replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        .toString();
}
