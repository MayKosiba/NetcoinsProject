<!DOCTYPE html>
<htmL>
    <head>
        <style>
            table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
            }

            td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
            }

            tr:nth-child(even) {
            background-color: #dddddd;
            }
        </style>
    </head>
    <body>
        <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Job</th>
        </tr>
        @foreach ($employees as $emp)
        <tr>
            <td>{{ $emp['firstName'] }}</td>
            <td>{{ $emp['lastName'] }}</td>
            <td>{{ $emp['email'] }}</td>
            <td>{{ $emp['address'] }}</td>
            <td>{{ $emp['job'] }}</td>
        </tr>
        @endforeach
        </table>
    </body>
</html>