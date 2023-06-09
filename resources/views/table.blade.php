<table id="example" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Username</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Kartu</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->username }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->gender }}</td>
                <td>{{ $item->kartu }}</td>
            </tr>
        @endforeach
    </tbody>
</table>

@push('script')
<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>
@endpush