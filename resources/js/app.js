require("./bootstrap");

feather.replace({ "aria-hidden": "true" });

const harga = document.getElementById("price");
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

const image = document.querySelector("#image");
if (image) {
    image.addEventListener("change", function (e) {
        previewImage();
    });
}

function formatAngka(angka) {
    return angka
        .replace(/[^,\d]/g, "")
        .replace(/\B(?=(\d{3})+(?!\d))/g, ".")
        .toString();
}

function previewImage() {
    const imgPreview = document.querySelector(".img-preview");

    imgPreview.style.display = "block";

    const blob = URL.createObjectURL(image.files[0]);
    imgPreview.src = blob;
}
