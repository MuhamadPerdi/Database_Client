/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 * 
 */

"use strict";

$(document).ready(function() {
    // Event listener untuk tombol toggle sidebar
    $('[data-toggle="sidebar"]').on('click', function() {
        $('.main-sidebar').toggleClass('collapsed');
        $('.main-content').toggleClass('expanded');
    });

    // Cek ukuran layar dan sesuaikan sidebar jika perlu
    $(window).on('resize', function() {
        if ($(window).width() <= 768) {
            $('.main-sidebar').addClass('collapsed');
        } else {
            $('.main-sidebar').removeClass('collapsed');
        }
    }).trigger('resize'); // Trigger resize event on page load
});

// document.addEventListener('DOMContentLoaded', function () {

//     // Function to prepare form submission
//     function prepareSubmit(event) {
//         event.preventDefault(); // Prevent default form submission
//         // Dynamically get the form
//         let form = document.getElementById('editPostForm') || document.getElementById('createPostForm');

//         if (!form) {
//             console.error('Form not found!'); // Add error handling in case no form is found
//             return;
//         }

//         // Show confirmation alert
//         Swal.fire({
//             title: 'Apakah data sudah benar?',
//             text: "Pastikan semua data sudah diisi dengan benar sebelum melanjutkan.",
//             icon: 'warning',
//             showCancelButton: true,
//             confirmButtonColor: '#3085d6',
//             cancelButtonColor: '#d33',
//             confirmButtonText: 'Ya, benar!',
//             cancelButtonText: 'Batal'
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 // Show processing spinner
//                 const swal = Swal.fire({
//                     title: 'Sedang Proses...',
//                     text: 'Menunggu proses penyimpanan data.',
//                     icon: 'info',
//                     allowOutsideClick: false,
//                     didOpen: () => {
//                         Swal.showLoading(); // Show loading spinner
//                     }
//                 });

//                 // Create FormData object
//                 let formData = new FormData(form);

//                 // Get the form's action URL
//                 let actionUrl = form.action;

//                 // Get the form's redirect URL from the data-redirect attribute
//                 let redirectUrl = form.getAttribute('data-redirect');

//                 // Get the entity name from the data-entity attribute
//                 let entityName = form.getAttribute('data-entity') || 'Data';

//                 // Send AJAX request
//                 fetch(actionUrl, {
//                     method: 'POST',
//                     body: formData,
//                     headers: {
//                         'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
//                         'Accept': 'application/json' // CSRF token from the form
//                     }
//                 })
//                 .then(response => {
//                     if (!response.ok) {
//                         throw response; // If response status is not OK, throw error to be handled
//                     }
//                     return response.json(); // Get JSON data from response
//                 })
//                 .then(data => {
//                     swal.close(); // Close loading spinner
//                     if (data.success) {
//                         Swal.fire({
//                             icon: 'success',
//                             title: 'Berhasil!',
//                             // Dynamically set the success message with the entity name
//                             text: data.message || `${entityName} telah berhasil diperbarui.`,
//                             confirmButtonColor: '#3085d6'
//                         }).then(() => {
//                             // Use the redirect URL from the server response if available, or fallback to the form's data-redirect attribute
//                             window.location.href = data.redirect || redirectUrl;
//                         });
//                     } else {
//                         // Display general error if success is false
//                         Swal.fire({
//                             icon: 'error',
//                             title: 'Gagal!',
//                             text: data.message || 'Terjadi kesalahan saat memperbarui data.',
//                             confirmButtonColor: '#d33'
//                         });
//                     }
//                 })
//                 .catch(error => {
//                     swal.close(); // Close loading spinner

//                     // Check if the error is a response object
//                     if (error instanceof Response) {
//                         error.json().then(errorData => {
//                             let errorMessage = 'Terjadi kesalahan saat menghubungi server.';

//                             // If the response contains validation errors, extract them
//                             if (errorData.errors) {
//                                 errorMessage = Object.values(errorData.errors).map(msgArray => msgArray.join(' ')).join(' ');
//                             } else if (errorData.message) {
//                                 errorMessage = errorData.message; // Use the message if available
//                             }

//                             Swal.fire({
//                                 icon: 'error',
//                                 title: 'Gagal!',
//                                 text: errorMessage,
//                                 confirmButtonColor: '#d33'
//                             });
//                         }).catch(() => {
//                             // In case the error response cannot be parsed as JSON
//                             Swal.fire({
//                                 icon: 'error',
//                                 title: 'Gagal!',
//                                 text: 'Terjadi kesalahan yang tidak diketahui.',
//                                 confirmButtonColor: '#d33'
//                             });
//                         });
//                     } else {
//                         // General network error handling
//                         Swal.fire({
//                             icon: 'error',
//                             title: 'Gagal!',
//                             text: 'Terjadi kesalahan saat menghubungi server.',
//                             confirmButtonColor: '#d33'
//                         });
//                         console.error('Error:', error); // Log error to console
//                     }
//                 });
//             }
//         });
//     }

//     // Attach the prepareSubmit function to your button's click event
//     let submitBtn = document.getElementById('submitBtn');
//     submitBtn.addEventListener('click', prepareSubmit);
// });


// 


 


