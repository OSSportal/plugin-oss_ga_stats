<table class="table table-bordered">
    <thead>
    <tr>
        <th></th>
        @foreach($collection->columns() as $column)
            <th>{{ $column }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($collection as $row)
        <tr>
            <th>{{ $row->header() }}</th>
            @foreach($collection->columns() as $column)
                <td>{{ $row->getCol($column)->value() }}</td>
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>