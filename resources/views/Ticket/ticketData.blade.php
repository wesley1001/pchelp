@extends('body')
@section('main')

    <section class="pad1r">
        <div class="borderd8 bsd2">
     
            <p class="orderTitle clearfix borderTd8">
                <span class="fl">申报</span>
                <span class="fr">{{$ticket->created_at}}</span>
            </p>
            <div class="padTB1rLR2r Bg_ee color60 font13">
                <p>报修人: {{$ticket->name}}</p>
                <p>院区：
                  @if(($ticket->area)==0){{'东区'}}
                  @elseif (($ticket->area)==1){{'西区'}}
                  @endif
                </p>
                <p>宿舍号：{{ $ticket->address }}</p>
                <p>手机：{{ $ticket->number }}</p>
                <p>报修内容：{{ $ticket->problem }}</p>
            </div>
            @if(($ticket->state)==1)
            <p class="orderTitle clearfix">
                <span class="fl">受理</span>
                <span class="fr">2015-03-30 19:52:30</span>
            </p>
            <div class="padTB1rLR2r Bg_ee color60 font13">
                <p>受理人：微信报修系统</p>
                <p>处理说明：后勤报修平台已受理</p>
                <p>状态：已受理</p>
            </div>
            <p class="orderTitle clearfix">
                处理状态
            </p>
            <div class="mar1r font13 pr Bg_ee">
                <select class="selectDown">
                    <option value="好评">好评</option>
                    <option value="中评">中评</option>
                    <option value="差评">差评</option>
                </select>
                <span class="downBtn"></span>
            </div>
            <p class="orderTitle clearfix">
                处理说明
            </p>
            <div class="pad1r Bg_ee color60 font13 borderBd8">
                <textarea rows="5" class="multiInput font13" placeholder=""></textarea>
            </div>
            @else
            @endif 
      
            
        </div>
        <input type="submit" class="mainBtn marTB1r font14 color2f">
    </section>
@stop