@if (count($invoiceSumsByLocation))
    <table class="table">
        <thead>
            <tr>
                <th>Status</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoiceSumsByLocation as $data)
                <tr>
                    <td>{{ ucfirst($data->status) }}</td>
                    <td>£{{ $data->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    No records to display.
@endif
