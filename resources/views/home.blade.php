@extends('layouts.app')

@section('header-scripts')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.0.1/socket.io.js" integrity="sha512-q/dWJ3kcmjBLU4Qc47E4A9kTB4m3wuTY7vkFJDTZKjTs8jhyGQnaUrxa0Ytd0ssMZhbNua9hE+E7Qv1j+DyZwA==" crossorigin="anonymous"></script> --}}
@endsection

@section('css')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <style>
        .box {
            width: 400px;
            padding: 20px;
        }
        .messages {
            padding: 10px 0px;
            background-color: #f8f9fa;
            
        }
        .messages .item {
            box-shadow: 0px 0px 6px #0004;
            background-color: #f8f9fa;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 10px;
        
            width: calc(100% - 40px);
        }
        .messages .item.owner {
            margin-left: 40px;
        }
        .messages .item.guest {
            margin-right: 40px;
            background-color: green;
            color: #f8f9fa
        }
        .messages .item.temp {
            background-color: grey!important;
        }
        .messages .item.error {
            background-color: red!important;
            color: #fff;
        }
    </style>
@endsection
@section('content')
    <div class="box">
        <div class="messages" id="messages">
            <div class="item owner">
                hello
            </div>
            <div class="item guest">
                hi
            </div>
        </div>
        <form id="message-from">
            <input type="hidden" name="receiver_id" value="4">
            <input type="text" name="message" placeholder="Aa">
            <input type="submit" value="send">
        </form>

        <script src='/js/app.js'></script>
        <script src='/js/chat.js'></script>
        <script>
            Echo.channel('channel-name')
            .listen('TestEvent', e => {
                console.log(e)
            })
            const user = {!! json_encode(Auth::user()) !!}
        </script>
    </div>
    
@endsection
