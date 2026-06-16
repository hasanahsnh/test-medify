<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script>
    var start_date = '';
    var end_date = '';
    var data_per_fetch = 500;
    var data_fetched = 0;

    $(document).ready(function() {
        $('#table').DataTable({
            searching: false,
            order: [[0, 'desc']],
        });
        $('#table-kategori').DataTable({
            searching: false,
            order: [[0, 'asc']],
        });
        getData();
        getDataKategori();
    });

    $('.btn-get-data').click(function() {
        getData();
    });

    $('.btn-get-data-kategori').click(function() {
        getDataKategori();
    });

    function getData(){
        
        $('#loading-filter').show();
        var dataTableObj = $('#table').DataTable();
        var filter_kode = $('#filter-kode').val()
        var filter_nama = $('#filter-nama').val()
        var filter_harga_min = $('#filter-harga-min').val()
        var filter_harga_max = $('#filter-harga-max').val()
        dataTableObj.clear().draw();

        $.ajax({
            url: '{{url("master-items/search")}}',
            dataType: 'json',
            tryCount: 0,
            retryLimit: 3,
            data: 'kode=' + filter_kode + '&nama=' + filter_nama + '&hargamin=' + filter_harga_min + '&hargamax=' + filter_harga_max,
            success: function(results) {
                var data = results.data

                $.each(data, function(index, item) {
                    array_temp = [];
                    var harga_jual = item.harga_beli + item.harga_beli * item.laba / 100;
                    harga_jual = Math.round(harga_jual)
                    var kode = item.kode;

                    var html = `<a href="{{url('master-items/view/')}}/` + kode + `" class="btn btn-primary">View</a>`

                    $.each(item, function(obj_name, obj_value) {
                        if (obj_name == 'laba') return false;
                        array_temp.push(obj_value)
                    })
                    array_temp.push(harga_jual)
                    array_temp.push(item.supplier)
                    array_temp.push(html)


                    dataTableObj.row.add(array_temp).draw(true);
                });
                $('#loading-filter').hide();
            },
            error: function(xhr, textStatus, errorThrown) {
                this.tryCount++;
                if (this.tryCount <= this.retryLimit) {
                    $.ajax(this);
                    return;
                }
                alert('Terjadi kesalahan server, tidak dapat mengambil data')
                $('#loading-filter').hide();

                return;
            }
        })
    }

    function getDataKategori() {
        $('#loading-filter-kategori').show();
        var dataTableObj = $('#table-kategori').DataTable();
        var filter_kode = $('#filter-kode-kategori').val();
        var filter_nama = $('#filter-nama-kategori').val();
        dataTableObj.clear().draw();

        $.ajax({
            url: '{{ url("category-items/search") }}',
            dataType: 'json',
            tryCount: 0,
            retryLimit: 3,
            data: 'kode=' + filter_kode + '&nama=' + filter_nama,
            success: function(results) {
                var data = results.data;

                $.each(data, function(index, item) {
                    var html = `<a href="{{ url('category-items/view/') }}/${item.kode_kategori_item}" class="btn btn-primary">View</a>`;

                    dataTableObj.row.add([
                        item.kode_kategori_item,
                        item.nama_kategori_item,
                        html
                    ]).draw(true);
                });
                $('#loading-filter-kategori').hide();
            },
            error: function(xhr, textStatus, errorThrown) {
                this.tryCount++;
                if (this.tryCount <= this.retryLimit) {
                    $.ajax(this);
                    return;
                }
                alert('Terjadi kesalahan server, tidak dapat mengambil data');
                $('#loading-filter-kategori').hide();
            }
        });
    }
</script>

<script>
    document.getElementById('inputFoto').addEventListener('change', function(e) {
        const file = e.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const preview = document.getElementById('preview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            // kalau file dibatalkan, sembunyikan preview
            document.getElementById('preview').style.display = 'none';
        }
    });
</script>