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
        $('#example').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('data') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                {data: 'username', name: 'username', orderable: false},
                {data: 'email', name: 'email', orderable: false},
                {data: 'gender', name: 'gender', orderable: false},
                {data: 'kartu', name: 'kartu', orderable: false},
                {data: 'aksi', name: 'aksi', orderable: false},
            ]
        });
    });
</script>
@endpush