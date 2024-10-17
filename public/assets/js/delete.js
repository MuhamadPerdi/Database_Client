"use strict";
function confirmDelete(route) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Anda tidak akan bisa mengembalikan data ini!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // Tampilkan pesan proses
            Swal.fire({
                title: 'Memproses...',
                text: 'Silakan tunggu sementara kami memproses permintaan Anda.',
                icon: 'info',
                allowOutsideClick: false,
                showConfirmButton: false,
            });

            // Tampilkan loading state
            Swal.showLoading();

            // Kirim permintaan penghapusan
            axios.post(route, {
                _method: 'DELETE',
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Ambil CSRF token
            }).then(response => {
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Data berhasil dihapus.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    // Refresh atau redirect halaman setelah penghapusan berhasil
                    location.reload();
                });
            }).catch(error => {
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat menghapus data.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            });
        }
    });
}