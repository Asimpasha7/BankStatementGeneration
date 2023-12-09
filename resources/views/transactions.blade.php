<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions PDF</title>
</head>
<body>
    <h1>Transaction List</h1>

    <table border="1">
        <thead>
            <tr>
                <th>User Email</th>
                <th>Date of Transaction</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>

          
            @foreach ($transactions as $transaction)
                <tr>
                    <td>{{ $transaction['user_email'] }}</td>
                    <td>{{ $transaction['date_of_transaction'] }}</td>
                    <td>{{ $transaction['amount'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
