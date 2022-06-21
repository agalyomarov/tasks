@extends('layout')

@section('title')
{{ $id }}
@endsection

@section('content')
<h1 class="h1">
    Добавить {{ $id }}
</h1>
 <form id="form" action="/add" method="post">
     @csrf
     <input type="hidden" value="{{ $id }}" name="type">
    <div class="mb-3">
      <label class="form-label">Название</label>
      <input type="text" class="form-control" placeholder="название" name="title">
    </div>
    <button type="submit "class="btn btn-primary">Добавить</button>
 </form>
 <ul class="list-group mt-5">
    <?php $array = json_decode($list, true); ?>
     @if($array['result']!=false)
        @foreach($array['result'] as $item)
            <li class="list-group-item">{{ $item['title'] }}</li>
        @endforeach
     @endif
    
     
</ul>
<div class="notice"><div class="notice__content"></div></div>
 <style>
    .notice__content {
        display: block;
        position: absolute;
        border-radius: 50px;
        font-size: 30px;
        background: rgba(0, 0, 0, 0.8);
        padding:55px;
        text-align: center;
        color: #fff;
        margin-top: 66px;
    }

    .notice {
        /* display: flex; */
        display: none;
        justify-content: center;
        align-items: center;
        position: fixed;
        top:0;
        left:0;
        width: 100%;
        height: 100%;
        opacity: 0.2;
    }
    .notice--vis {
      display: flex;
      animation: showBlock 2s linear forwards;
    }
    @keyframes showBlock {
      0% {opacity: 0;}
      20% {opacity: 1;}
      80% {opacity: 1;}
      100% {opacity: 0;}
    }
 </style>
 <script>
     document.querySelector('#form').addEventListener('submit', function (e) {
        e.preventDefault();
        const data = Object.fromEntries(new FormData(e.target).entries());
        sendData('/add', data)
        .then((response) => {

            if (response) {
                document.querySelector('.notice__content').innerText = 'Успешно добавлено';
                document.querySelector('.notice').classList.add('notice--vis');
                setTimeout(()=>{
                    document.querySelector('.notice').classList.remove('notice--vis');
                }, 2000);
            } else {
                document.querySelector('.notice__content').innerText = 'Ошибка';
                document.querySelector('.notice').classList.add('notice--vis');
                setTimeout(()=>{
                    document.querySelector('.notice').classList.remove('notice--vis');
                }, 2000);
            }
        })
        .catch((error) => {
            console.log(error);
            document.querySelector('.notice__content').innerText = 'Ошибка отправки';
            document.querySelector('.notice').classList.add('notice--vis');
            setTimeout(()=>{
                document.querySelector('.notice').classList.remove('notice--vis');
            }, 2000);
        });
    });
    
    
     
 </script>
@endsection