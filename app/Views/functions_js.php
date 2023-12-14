<script>
    setTimeout(() => {
        $('.sukses').fadeOut();
    }, 1200);


    const loading = (req = true) => {
        if (req === true) {
            $('.waiting').show()
        } else {
            $('.waiting').fadeOut()
        }
    }

    const sukses = () => {
        $('.sukses').show();
        setTimeout(() => {
            $('.sukses').fadeOut();
        }, 1200);
    }

    const gagal = (alert) => {
        $('.textGagal').text(alert);
        $('.gagal').fadeIn();
    }

    const rupiah = (angka, prefix) => {

        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;

        return prefix == undefined ? 'Rp. ' + rupiah : prefix + ' ' + rupiah;
    }
    const angka = (angka, prefix) => {

        let number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        return rupiah;
    }

    async function post(url = '', data = {}) {
        loading(true);
        const response = await fetch("<?= base_url(); ?>" + url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(data),
        });
        loading(false);
        return response.json(); // parses JSON response into native JavaScript objects
    }
    const str_replace = (search, replace, subject) => {
        return subject.split(search).join(replace);
    }

    const upper_first = (str) => {
        let arr = str.split(" ");
        for (var i = 0; i < arr.length; i++) {
            arr[i] = arr[i].charAt(0).toUpperCase() + arr[i].slice(1);

        }

        let res = arr.join(" ");

        return res;
    }

    <?php if (settings()['panduan'] == 1) : ?>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
    <?php endif; ?>


    const confirm = (controller, tabel, message, method, id, job_id) => {

        $('#' + controller + '_' + id).modal('hide');
        let html = '';
        html += '<div class="body_alert">';
        html += '<div class="d-flex justify-content-between gap-3">';
        html += message;
        html += '<section class="d-flex gap-1">';
        html += '<span class="btn_act_grey"><a href="" class="cancel_confirm"><i class="fa-solid fa-circle-minus text_grey"></i></a></span>';
        html += '<span class="btn_act_success"><a href="" class="delete" data-controller="' + controller + '" data-tabel="' + tabel + '" data-message="' + message + '" data-method="' + method + '" data-id="' + id + '" data-job_id="' + job_id + '"><i class="fa-solid fa-circle-check text_success"></i></a></span>';
        html += '</section>';
        html += '</div>';
        html += '</div>';
        $('.modal_confirm').html(html);
        $('.modal_confirm').show();
    }

    const hapus = (controller, method, tabel, id, job_id) => {

        post(controller + '/' + method, {
                id,
                job_id,
                tabel
            })
            .then(res => {
                if (res.status == '200') {
                    sukses();
                    if (method == 'delete_pengeluaran') {
                        get_crew_in_job(res.data, job_id);
                    } else {
                        setTimeout(() => {
                            location.reload();
                        }, 1000);

                    }

                } else {
                    gagal(res.message);
                }

            })
    }


    const update_check = (controller, method, tabel, col, id) => {
        post(controller + '/' + method, {
                id,
                tabel,
                col
            })
            .then(res => {
                if (res.status == '200') {
                    sukses();
                    setTimeout(() => {
                        location.reload();
                    }, 1000);

                } else {
                    gagal(res.message);
                }

            })
    }


    const area = (order, col, indonesia_id, id) => {
        let html = '';
        if (order == 'add') {
            html += '<input type="text" name="' + col + '" class="form-control indonesia ' + order + '_' + col + '" data-order="' + order + (order == 'update' ? '_' + id : '') + '" data-col="' + col + '" data-indonesia_id="' + indonesia_id + '" data-id="' + id + '" placeholder="' + upper_first(col) + '" required>';
            html += '<label>Kelurahan</label>';
            html += '<ul class="p-1 dropdown-menu body_' + order + '_' + col + '" style="font-size:small;">';

            html += '</ul>';


            html += '<div class="body_feedback_' + order + '_' + col + ' invalid-feedback"></div>';

            $('.' + order + '_' + col).html(html);

        }
    }


    const indonesia = (order, col, val, indonesia_id, id) => {
        let kecamatan = $('.update_kecamatan_' + id).val();
        post('indonesia', {
                order,
                indonesia_id,
                kecamatan,
                col,
                val,
                id
            })
            .then(res => {
                if (res.status == '200') {
                    let html = '';

                    html += '<li class="text-center text-dark" style="border-bottom:1px solid black;"><a class="dropdown-item cancel_indonesia" data-order="' + order + '" data-col="' + col + '" data-id="' + id + '" href="#"><i class="fa-solid fa-xmark"></i> Cancel</a></li>'
                    if (res.data.length == 0) {
                        html += '<li class="text-danger" style="font-style:italic;"><i class="fa-solid fa-circle-exclamation"></i> Data tidak ditemukan!</li>';
                    } else {
                        for (let d = 0; d < res.data.length; d++) {
                            html += '<li><a class="dropdown-item insert_indonesia" data-id="' + id + '" data-indonesia_id="' + res.data[d].id + '" data-order="' + order + '" data-col="' + col + '" href="#">' + upper_first(res.data[d].name.toLowerCase()) + '</a></li>';
                        };
                    }
                    if (order == 'add') {
                        $('.body_' + order + '_' + col).html(html);
                        $('.body_' + order + '_' + col).addClass('d-block');
                        $('.body_' + order + '_' + col).removeClass('d-none');
                    } else {
                        $('.body_' + order + '_' + col + '_' + id).html(html);
                        $('.body_' + order + '_' + col + '_' + id).addClass('d-block');
                        $('.body_' + order + '_' + col + '_' + id).removeClass('d-none');
                    }

                } else {
                    gagal(res.message);
                }

            })
    }
    const insert_indonesia = (order, col, val, indonesia_id, id) => {
        if (order == 'add') {
            $('.' + order + '_' + col).val(val);
            $('.body_' + order + '_' + col).html('');
            $('.body_' + order + '_' + col).removeClass('d-block');
            $('.body_' + order + '_' + col).addClass('d-none');

            if (col == 'kecamatan') {
                area(order, 'kelurahan', indonesia_id, id);
            }
        } else {
            $('.' + order + '_' + col + '_' + id).val(val);
            $('.body_' + order + '_' + col + '_' + id).html('');
            $('.body_' + order + '_' + col + '_' + id).removeClass('d-block');
            $('.body_' + order + '_' + col + '_' + id).addClass('d-none');
        }

    }

    const cancel_indonesia = (order, col, val, id) => {
        if (order == 'add') {
            $('.body_' + order + '_' + col).html('');
            $('.body_' + order + '_' + col).removeClass('d-block');
            $('.body_' + order + '_' + col).addClass('d-none');
        } else {
            $('.body_' + order + '_' + col + '_' + id).html('');
            $('.body_' + order + '_' + col + '_' + id).removeClass('d-block');
            $('.body_' + order + '_' + col + '_' + id).addClass('d-none');
        }
    }


    const suara = (id, tabel, val) => {
        post('/suara', {
                id,
                tabel,
                val
            })
            .then(res => {
                if (res.status == '200') {
                    sukses();
                    setTimeout(() => {
                        location.reload();
                    }, 1000);

                } else {
                    gagal(res.message);
                }

            })
    }

    const update_suara_partai = (id, value) => {
        post('/election/update_suara_partai', {
                id,
                value
            })
            .then(res => {
                if (res.status == '200') {
                    sukses();
                    setTimeout(() => {
                        location.reload();
                    }, 1000);

                } else {
                    gagal(res.message);
                }

            })
    }
    const update_suara_caleg = (id, value) => {
        post('/election/update_suara_caleg', {
                id,
                value
            })
            .then(res => {
                if (res.status == '200') {
                    sukses();
                    setTimeout(() => {
                        location.reload();
                    }, 1000);

                } else {
                    gagal(res.message);
                }

            })
    }
</script>