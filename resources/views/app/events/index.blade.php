@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row timeline">
            <div class="col-md-3">
                <div class="col-md-12 profile">
                    <div class="profile-img text-center">
                        <a href="{{ route('profile.view', ['id' => Auth::user()->id]) }}">
                            <img src="{{ Auth::user()->getAvatarImagePath() }}" height="100px" class="img-circle">
                        </a>
                        <p>{{ Auth::user()->getFullName() }}</p>
                    </div>
                    <ul class="nav nav-pills nav-stacked links">
                        <li role="presentation" @if ($active == 'index') class="active" @endif><a
                                    href="{{ route('index') }}"><i class="fa fa-fw fa-user" aria-hidden="true"></i> Tin tức</a></li>
                        <li role="presentation"><a href="#"><i class="fa fa-fw fa-envelope" aria-hidden="true"></i>
                                Tin nhắn</a></li>
                        <li role="presentation"><a href="{{ route('photos', ['id' => Auth::user()->id]) }}"><i
                                        class="fa fa-fw fa-picture-o" aria-hidden="true"></i> Ảnh</a></li>
                        <li role="presentation"><a href="{{ route('friends', ['id' => Auth::user()->id]) }}"><i
                                        class="fa fa-fw fa-users" aria-hidden="true"></i> Bạn bè</a></li>
                        <li role="presentation" @if ($active == 'events') class="active" @endif><a
                                    href="{{ route('events.index') }}"><i class="fa fa-fw fa-calendar"
                                                                          aria-hidden="true"></i> Sự kiện</a></li>
                        <li role="presentation"><a href="{{ route('saved') }}"><i class="fa fa-fw fa-floppy-o"
                                                                                  aria-hidden="true"></i> Đã lưu</a></li>
                    </ul>
                </div>
            </div> <!-- profile -->
            <div class="col-md-9 Events">
                <h1 class="text-center">{{ $event->title }}</h1>
            </div>
        </div>
    </div>


@stop