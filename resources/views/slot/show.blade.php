@extends('layouts.app')
@push('styles')
    <style type="text/css">
        .bd {
            text-align: center;
        }

        .container {
            margin: 0 auto;
            width: 266px;
        }

        .slot-wrapper {
            width: 40%;
            margin: 20px auto;
            text-align: center;
            gap: 1px;
            border: 10px solid #6a0243;
            background: #c00000;
            padding: 10px 0px 60px 0px;
            border-radius: 60px;
        }

        @media (max-width: 1250px) {
            .slot-wrapper {
                width: 100%;
            }

        }

        .slot-title {
            font-weight: bolder;
            font-size: 40px;
            color: #ff9a00;
            text-shadow: 2px 0 #0043b4, -2px 0 #0043b4, 0 2px #0043b4, 0 -2px #0043b4,
                1px 1px #0043b4, -1px -1px #0043b4, 1px -1px #0043b4, -1px 1px #0043b4;
        }

        .slot {
            background: url("img/reel_normal.png") repeat-y;
            /*Taken from http://www.swish-designs.co.uk*/
            width: 80px;
            height: 80px;
            float: left;
            border: 2px solid #b42929;
            backdrop-filter: grayscale(100%) opacity(50%);
            border-radius: 15px;
            background-position: 0 4px;
        }

        .motion {
            background: url("img/reel_blur.png") repeat-y;
            /*Taken from http://www.swish-designs.co.uk*/
        }

        button {
            display: block;
            width: 138px;
            height: 33px;
            margin: 20px 60px;
            font-size: 16px;
            cursor: pointer;
            appearance: none;
            color: #fff;
            border: none;
            background: #2f0640;
        }

        #result {
            margin: 20px 0;
            font-size: 18px;
            font-weight: bold;
            height: 22px;
        }

        .credits {
            font-size: 15px;
            margin-top: 20px;
        }

        .credits .browsers {
            font-style: italic;
            font-size: 14px;
            color: #777;
            margin-top: 4px;
        }

        .clear {
            clear: both;
        }

        #control {
            margin: 0px auto;
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">{{ __('Traga monedas') }}</div>

                    <div class="card-body">
                        <div class="hd">
                        </div>
                        <div class="bd">
                            <h1>Has tu apuesta</h1>
                            <div class="container">
                                <div class="slot-wrapper">
                                    <h2 class="slot-title">BIG WIN</h2>
                                    <div class="items-center d-flex justify-content-center">
                                        <div id="slot1" class="slot"></div>
                                        <div id="slot2" class="slot"></div>
                                        <div id="slot3" class="slot"></div>
                                        <div class="clear"></div>
                                    </div>
                                    <input id="bet" class="mx-auto w-50 form-control mt-5 mb-2" type="number"
                                        placeholder="Inserta tu apuesta"></input>
                                    <span id="bet-alert" class="text-warning " hidden>Ingresa tu apuesta</span>
                                    <div id="result"></div>
                                </div>
                            </div>
                            <div><button id="control">Iniciar</button></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('scripts')
    <script type="module" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
    <script type="module" src="js/jquery.spritely.js"></script>
    <script type="module" src="js/jquery.backgroundPosition.js"></script>
    <script type="module" src="js/slot.js"></script>
    <script>
        function saveBets(bet_number, won) {
            window.axios.post('/slot/bets', {
                bet_number,
                won
            });
        }
    </script>

    {{-- <script type="module">
        const usersElement = document.getElementById('users');
        const messagesElement = document.getElementById('messages');
        Echo.join('chat')
            .here((users) => {
                users.forEach((user,index) => {
                    let element = document.createElement('li');
                    element.setAttribute('id', user.id);
                    element.setAttribute('onclick', 'greetUser("'+user.id+'")')
                    element.innerText= user.name;
                    usersElement.appendChild(element);
                });

            })
            .joining((user) => {
                let element = document.createElement('li');
                element.setAttribute('id', user.id);
                element.setAttribute('onclick', 'greetUser("'+user.id+'")')
                element.innerText= user.name;
                usersElement.appendChild(element);
            })
            .leaving((user) => {
                let element = document.getElementById(user.id);
                usersElement.removeChild(element);
            }).listen('MessageSent',(e)=>{
                let element = document.createElement('li');
                element.innerText= e.user.name+': '+e.message;
                messagesElement.appendChild(element);
            });

            const sendElement = document.getElementById('send');
            const messageElement = document.getElementById('message');

            sendElement.addEventListener('click', (e)=>{
                e.preventDefault();
                window.axios.post('/chat/message',{
                    message: messageElement.value
                });
                messageElement.value = '';
            })
            Echo.private('chat.greet.{{ auth()->user()->id }}').listen('GreetingSent', (e) => {
                let element = document.createElement('li');
                element.innerText = e.message;
                element.classList.add('text-success')
                messagesElement.appendChild(element);
            })
            </script>
    <script>
        function greetUser(id) {
            window.axios.post('chat/greet/' + id)
        }
    </script> --}}
@endpush
