<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    @if(!is_null(Auth::user()))
    嗨！{{Auth::user()->name}}
    @else
    嗨！陌生人 <br />
    @endif
    @if(is_null(Auth::user()))
    <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">登入</a>
    <a href="{{ route('register') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">註冊</a>
    @else
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a href="route('logout')" onclick="event.preventDefault();
            this.closest('form').submit();">
            {{ __('登出') }}
        </a>
    </form>@endif
    <br />
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Content</th>
                <th>Create Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $message)
            <tr>
                <td>{{ $message->user->name }}</td>
                <td>{{ $message->content }}</td>
                <td>{{ $message->created_at }}</td>
                @if(!is_null(Auth::user()))
                @if(Auth::user()->id == $message->user->id)
                <td>
                    <form method="POST" action="{{ route('update') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{$message->id}}" />
                        <input type="text" name="content" />
                        <a href="route('update')" onclick="event.preventDefault();
                            this.closest('form').submit();">
                            {{ __('編輯') }}
                        </a>
                    </form>
                </td>
                <td>
                    <form method="POST" action="{{ route('delete') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{$message->id}}" />
                        <a href="route('delete')" onclick="event.preventDefault();
                            this.closest('form').submit();">
                            {{ __('刪除') }}
                        </a>
                    </form>
                </td>
                @endif
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
    @if(!is_null(Auth::user()))
    <form action="http://127.0.0.1:8000/sendMessage" method="post">
        @csrf
        <input type="hidden" name="user_id" class="form-control form-inline" id="user_id" value="{{ Auth::user()->id}}" />
        <input type="text" name="content" class="form-control form-inline" id="content" />
        <button type="submit">送出</button>
    </form>
    @endif
</body>

</html>