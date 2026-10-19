<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Role</title>
</head>
<body>
    <h1>Kelola Role Pengguna</h1>

    @if (session('status'))
        <p style="color: green">{{ session('status') }}</p>
    @endif

    @if ($errors->any())
        <ul style="color: red">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <table border="1" cellpadding="6">
        <tr>
            <th>Username</th>
            <th>Role sekarang</th>
            <th>Ubah role</th>
        </tr>
        @foreach ($users as $u)
            <tr>
                <td>{{ $u->username }}</td>
                <td>{{ $u->role }}</td>
                <td>
                    <form method="POST" action="{{ route('admin.users.role.update', $u) }}">
                        @csrf
                        @method('PATCH')
                        <select name="role">
                            <option value="customer">customer</option>
                            <option value="staff">staff</option>
                        </select>
                        <button type="submit">Simpan</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
</body>
</html>