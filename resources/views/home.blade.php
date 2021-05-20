@extends('layouts.app')

@section('css')
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
    </style>
@endsection
@section('content')
    <div class="box">
        <div class="messages">
            {{--  --}}
            <div class="item owner">
                hello
            </div>
            {{--  --}}
            <div class="item guest">
                hi
            </div>
        </div>
        <form method="POST" action="#">
            <input type="text" name="message" placeholder="Aa"> <input type="submit" value="send">
        </form>
    </div>
    
@endsection
