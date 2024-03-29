@if ($messages->count())

	@foreach ($messages as $msg)
		<li class="@if ($msg->user_id == $user->id) right @else left @endif clearfix"><span class="chat-img @if ($msg->user_id == $user->id) pull-right @else pull-left @endif">
		    <a href="@if ($msg->user_id == $user->id) {{ route('profile.view',['id' => $user->id]) }} @else {{ route('profile.view',['id' => $friend->id]) }} @endif"><img src="@if ($msg->user_id == $user->id) {{ $user->getAvatarImagePath() }} @else {{ $friend->getAvatarImagePath() }} @endif" alt="User Avatar" class="img-circle" /></a>
		</span>
		    <div class="chat-body clearfix">
		        <div class="header">
		        @if ($msg->user_id == $user->id)
		        	<small class=" text-muted"><span class="glyphicon glyphicon-time"></span>{{ $msg->created_at->diffForHumans() }} @if ($msg->read == 1) - <i class="fa fa-check" aria-hidden="true"></i> @endif</small>
		            <a href="{{ route('profile.view', ['id' => $user->id]) }}"><strong class="pull-right primary-font">{{ $user->getFullName() }}</strong></a>
		        @else
		        	<a href="{{ route('profile.view', ['id' => $friend->id]) }}"><strong class="primary-font">{{ $friend->getFullName() }}</strong> <small class="pull-right text-muted"></a>
		            <span class="glyphicon glyphicon-time"></span>{{ $msg->created_at->diffForHumans() }}@if ($msg->read == 1) - <i class="fa fa-check" aria-hidden="true"></i> @endif</small>
		        @endif
		        </div>
		        <p>
		            {{ $msg->msg }}
		        </p>
		    </div>
		</li>
	@endforeach
@else
	<p>Bắt đầu cuộc trò chuyện với {{ $friend->getFullName() }}</p>
	@if ($friend->id == 1)
		<p>Có vẻ đó là một người bạn đáng mến! ;)</p>
	@endif
	@if ($friend->bot == 1)
		<p>Lưu ý rằng đây chỉ là một AI... :|</p>
	@endif
@endif