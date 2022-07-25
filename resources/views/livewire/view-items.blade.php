<div>
    <table class="table table-dark">
    <thead>
        <tr>
            @foreach($cols as $key => $col)
                <th scope="col">{{ $key }}</th>
                
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($rows as $row_key => $row)
        <tr>
        @foreach($cols as $col_key => $col)
        <td>{{ $row_key.$col_key }}</td>
        @endforeach
        </tr>
        @endforeach
    </tbody>
    </table>
</div>
