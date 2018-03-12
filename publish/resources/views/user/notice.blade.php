@extends('layouts.profile')
@section('profile_content')
    @foreach($notices_unlooked as $notice)
        @if($notice->noticeable_type == 'App\Models\Comment')
            {!! Helper::renderNoticeComment($notice) !!}
        @elseif($notice->noticeable_type == 'App\Models\UserHasFriend')
            {!! Helper::renderNoticeFollow($notice) !!}
        @elseif($notice->noticeable_type == 'App\Models\UserHasTwitLikes')
            {!! Helper::renderNoticeLikes($notice) !!}
        @endif
    @endforeach
    <div class="status-online text-right">
        Старые уведомления
    </div>
    @foreach($notices_looked as $notice)
        @if($notice->noticeable_type == 'App\Models\Comment')
            {!! Helper::renderNoticeComment($notice) !!}
        @elseif($notice->noticeable_type == 'App\Models\UserHasFriend')
            {!! Helper::renderNoticeFollow($notice) !!}
        @elseif($notice->noticeable_type == 'App\Models\UserHasTwitLikes')
            {!! Helper::renderNoticeLikes($notice) !!}
        @endif
    @endforeach
@stop
