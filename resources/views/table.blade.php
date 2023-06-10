{{-- filter --}}
<label for="">Gender</label>
<select class="form-select" id="gender">
    <option selected value="">Pilih</option>
    <option value="Laki-Laki">Laki-Laki</option>
    <option value="Perempuan">Perempuan</option>
</select>
<br>
<label for="">Kartu</label>
<select class="form-select" id="kartu">
    <option selected value="">Pilih</option>
    <option value="im3">im3</option>
    <option value="3">3</option>
</select>
<br>
<button class="btn btn-danger" id="reset">Reset Filter</button>
<br><br><br>

{{-- table --}}
<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Kartu</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>

@push('script')
<script>
    $(document).ready(function () {
        // dataTables
        let table = $('#example').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('data') }}",
                data: function (d) {
                    d.gender = $('#gender').val();
                    d.kartu = $('#kartu').val();
                }
            },
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                {data: 'username', name: 'username', orderable: false},
                {data: 'email', name: 'email', orderable: false},
                {data: 'gender', name: 'gender', orderable: false},
                {data: 'kartu', name: 'kartu', orderable: false},
                {data: 'aksi', name: 'aksi', orderable: false},
            ]
        });

        // event Table
        $('#gender').change(function () {
            table.draw();
        });
        $('#kartu').change(function () {
            table.draw();
        });
        $('#reset').click(function() {
            $('#gender').val('').trigger('change');
            $('#kartu').val('').trigger('change');
        });
    });
</script>
@endpush