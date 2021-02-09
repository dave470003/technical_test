@if (count($invoices))
    <table class="table">
        <thead>
            <tr>
                <th>Invoice ID</th>
                <th>Location</th>
                <th>Date</th>
                <th>Status</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->getId() }}</td>
                    <td>{{ $invoice->getLocationName() }}</td>
                    <td>{{ $invoice->getDate(true) }}</td>
                    <td>{{ $invoice->getStatus() }}</td>
                    <td>{{ $invoice->getValue(true) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    No records to display.
@endif
