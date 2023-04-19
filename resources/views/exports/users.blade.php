<table>
    <thead>
    <tr>
        <th>Имя</th>
        <th>Фамилия</th>
        <th>Отчество</th>
        <th>Пароль</th>
        <th>Страна</th>
        <th>Город</th>
        <th>Телефон</th>
        <th>Email</th>
        <th>Статус</th>
        @foreach(\App\Models\User::PROFILE as $profile)
            <th>{{ $profile['name'] }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr>
            <td>{{ $user->firstname }}</td>
            <td>{{ $user->lastname }}</td>
            <td>{{ $user->patronymic }}</td>
            <td>{{ $user->password }}</td>
            <td>{{ $user->country }}</td>
            <td>{{ $user->city }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->activeValue }}</td>
            @foreach(\App\Models\User::PROFILE as $key=>$profile)
                @if($key == 'calculation_period')
                    <td>{{ \Illuminate\Support\Arr::get($profile,'type_admin_value.'.\Illuminate\Support\Arr::get($user->profile,$key)) }}</td>
                @else
                    <td>{{ \Illuminate\Support\Arr::get($user->profile,$key) }}</td>
                @endif
            @endforeach
        </tr>
    @endforeach
    </tbody>
</table>
