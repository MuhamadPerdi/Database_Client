
$(document).ready(function () {
    $('input').each(function (i, obj) {
        var data = $(this).val().trim()
        $(this).val(data)
    });
});


function readURL(input, element) {
    if (input.files && input.files[0]) {
        $(`#${element[1]}`).remove();
        const reader = new FileReader();
        reader.onload = function (e) {
            $(`#${element[0]}`).after(`<div id="${element[1]}"><img src="${e.target.result}" style="margin-top: 10px;width:200px;height:auto"></div>`);
        }
        reader.readAsDataURL(input.files[0])
    }
}

$(`#file`).change(function () {
    readURL(this, ['file', 'preview'])
})
$(`#file1`).change(function () {
    readURL(this, ['file1', 'preview1'])
})
$(`#file2`).change(function () {
    readURL(this, ['file2', 'preview2'])
})
$(`#file3`).change(function () {
    readURL(this, ['file3', 'preview3'])
})
$(`#file4`).change(function () {
    readURL(this, ['file4', 'preview4'])
})
$(`#file5`).change(function () {
    readURL(this, ['file5', 'preview5'])
})
$(`#file6`).change(function () {
    readURL(this, ['file6', 'preview6'])
})
$(`#file10`).change(function () {
    readURL(this, ['file10', 'preview10'])
})

$(`#file20`).change(function () {
    readURL(this, ['file20', 'preview20'])
})

const HandleErrorCustom = (e) => {
    try {
        var _error = JSON.parse(e.responseText)
        if (_error.message == 'CSRF token mismatch.') {
            setTimeout(() => {
                location.reload();
            }, 2900);
            return 'Token kadaluwarsa, halaman akan dimuat ulang secara otomatis dalam 3 detik / anda bisa merefresh halaman secara langsung'
        } else if (_error.message == '' && e.statusText == 'Not Found') {
            return 'Alamat URL / Fungsi tidak ditemukan!'
        }
        return _error.message;
    } catch (error) {
        var ex = e.responseText
        ex = ex.replace(`{"`, `#JSON_SEPARATOR#{"`)
        ex = ex.split(`#JSON_SEPARATOR#`)
        var _error = JSON.parse(ex[1])
        return _error.message;
    }
};

var freezeClic = false

var disableClick = (data) => {
    freezeClic = data;
};

document.addEventListener("click", freezeClicFn, true);
function freezeClicFn(e) {
    if (freezeClic) {
        e.stopPropagation();
        e.preventDefault();
    }
}

const swalWaitingg = () => {

    disableClick(1)

    Swal.fire({
        text: 'Tunggu proses selesai',
        icon: 'question',
        iconHtml: '<i class="fas fa-hourglass-half"></i>',
        showCancelButton: false,
        showConfirmButton: false,
    });
};

const swalLauncherr = (e) => {
    Swal.fire({
        title: (e.success == true) ? 'Berhasil!' : 'Gagal!',
        text: e.message,
        icon: (e.success == true) ? 'success' : 'error',
        showConfirmButton: false,
        timer: (e.success == true) ? 1500 : 3000,
    });
};

function CityFromProvince() {
    var count = $('#province_id option:selected').length;
    var cek = $('#province_id').val();
    var sub = $('#city_id');
    if (count > 1 || count == 0) {
        $('#city_id').prop('disabled', true);
    } else {
        sub.removeAttr('disabled');
        $.ajax({
            url: UrlPo + "get-city/" + cek,
            type: "GET",
            dataType: "json",
            success: function (data) {
                sub.empty()
                sub.append('<option value="">- Pilih - </option>');
                $.each(data, function (key, value) {
                    sub.append('<option value="' + value.id + '">' + value.name +
                        '</option>');
                });
            }
        });
    }
}
function SubdistrictFromCity() {
    var count = $('#city_id option:selected').length;
    var cek = $('#city_id').val();
    var sub = $('#subdistrict_id');
    if (count > 1 || count == 0) {
        $('#subdistrict_id').prop('disabled', true);
    } else {
        sub.removeAttr('disabled');
        $.ajax({
            url: UrlPo + "get-subdistrict/" + cek,
            type: "GET",
            dataType: "json",
            success: function (data) {
                sub.empty()
                sub.append('<option value="">- Pilih - </option>');
                $.each(data, function (key, value) {
                    sub.append('<option value="' + value.id + '">' + value.name +
                        '</option>');
                });
            }
        });
    }
}

function SubFromCategory() {
    var count = $('#category_id option:selected').length;
    var cek = $('#category_id').val();
    var sub = $('#sub_id');
    if (count > 1 || count == 0) {
        $('#sub_id').prop('disabled', true);
    } else {
        sub.removeAttr('disabled');
        $.ajax({
            url: UrlPo + "get-sub/" + cek,
            type: "GET",
            dataType: "json",
            success: function (data) {
                sub.empty()
                sub.append('<option value="">- Pilih - </option>');
                $.each(data, function (key, value) {
                    sub.append('<option value="'+ value.id + '">' + value.title +
                        '</option>');
                });
            }
        });
    }
}