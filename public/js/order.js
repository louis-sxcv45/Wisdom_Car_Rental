
document.addEventListener('DOMContentLoaded', function () {
    const bankRadio = document.getElementById('bank');
    const bankSelection = document.getElementById('bank-selection');

    // Tambahkan event listener untuk memantau perubahan pada opsi pembayaran
    bankRadio.addEventListener('change', function () {
        // Jika opsi pembayaran berubah menjadi "Bank", tampilkan elemen pilihan bank
        if (bankRadio.checked) {
            bankSelection.style.display = 'block';
        } else {
            // Jika opsi pembayaran berubah menjadi "Cash on Delivery", sembunyikan elemen pilihan bank
            bankSelection.style.display = 'none';
        }
    });
});
