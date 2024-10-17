$('._form').submit(function(e) {
    e.preventDefault();

    const run = (e) => {
        swalWaiting(); // Tampilkan loading

        var formData = new FormData(this);

        $.ajax({
            url: this.action,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function(response) {
                Swal.close(); // Tutup loading
                swalLauncher(response); // Tampilkan SweetAlert berdasarkan respons
                console.log(response);

                if (response.url) {
                    setTimeout(() => {
                        window.location.replace(response.url); // Redirect
                    }, 1500);
                }
            },
            error: function(xhr) {
                Swal.close(); // Tutup loading
                var err = errorCustom(xhr); // Ambil pesan error kustom
                swalLauncher({ message: err }); // Tampilkan pesan error
            }
        });
        return false;
    };

    Swal.fire({
        title: 'Apakah data anda sudah benar?',
        text: "Pastikan data yang anda masukan sudah benar untuk disimpan.",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, data sudah benar',
        cancelButtonText: 'Tidak, saya akan cek lagi'
    }).then((result) => {
        if (result.isConfirmed) {
            run(e); // Jalankan fungsi run jika terkonfirmasi
        }
    });
});

function swalWaiting() {
    Swal.fire({
        title: 'Sedang memproses...',
        text: 'Mohon tunggu...',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading(); // Tampilkan loading
        }
    });
}

function swalLauncher(data) {
    Swal.fire({
        icon: data.success ? 'success' : 'error',
        title: data.success ? 'Berhasil!' : 'Gagal!',
        text: data.message,
    });
}

function errorCustom(xhr) {
    // Menangani error kustom
    return xhr.responseJSON?.message || 'Terjadi kesalahan.';
}
