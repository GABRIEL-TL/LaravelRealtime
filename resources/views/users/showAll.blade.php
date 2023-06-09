@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Welcome') }}</div>

                    <div class="card-body">

                        <ul id="users">

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="module">
        window.axios.get('/api/users').then((response) => {
            const usersElement = document.getElementById('users');
            let users = response.data;
            users.forEach((user, index) => {
                let element = document.createElement('li');
                element.setAttribute('id', user.id);
                element.innerText = user.name;
                usersElement.appendChild(element)
            });
        })
        </script>
    <script type="module">
        Echo.channel('users')
        .listen('UserCreated', ({
            user
        }) => {
                const usersElement = document.getElementById('users');
                let element = document.createElement('li');
                element.setAttribute('id', user.id);
                element.innerText = user.name;
                usersElement.appendChild(element)

            })
            .listen('UserUpdated', ({
                user
            }) => {
                let element = document.getElementById(user.id);
                element.innerText = user.name;
            })
            .listen('UserDeleted', ({
                user
            }) => {
                let element = document.getElementById(user.id);
                element.parentNode.removeChild(element);

            });
    </script>
@endpush
