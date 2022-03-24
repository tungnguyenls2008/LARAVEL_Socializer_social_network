<p>
	@if (Auth::user()->isFriendsWith($user))
		@if(!empty($profileView))
			<a class="btn btn-signature removeFriend" data-id="{{ $user->id }}">
  				<i class="fa fa-trash-o fa-lg"></i> Hủy kết bạn
  			</a>
		@else
			<span class="red_link pointer"><i class="fa fa-user-times fa-stack-1x removeFriend" aria-hidden="true"  data-id="{{ $user->id }}" title="Hủy kết bạn"></i></span>
		@endif
		
	@else
		@if (Auth::user()->hasFriendRequestPending($user))
			@if(!empty($profileView))
				<a class="btn btn-signature cancelFriend" data-id="{{ $user->id }}">
	  				<i class="fa fa-user-times fa-lg"></i> Hủy yêu cầu kết bạn
	  			</a>
			@else
				<span class="orange_link pointer"><i class="fa fa-user-times fa-stack-1x cancelFriend" data-id="{{ $user->id }}" aria-hidden="true" title="Hủy yêu cầu kết bạn"></i></span>
			@endif
		@else
			@if (Auth::user()->hasFriendRequestPendingFrom($user))
				@if(!empty($profileView))
					<a class="btn btn-signature acceptFriend" data-id="{{ $user->id }}">
		  				<i class="fa fa-user-plus fa-lg"></i> Chấp nhận yêu cầu kết bạn
		  			</a>
				@else
					<span class="green_link pointer"><i class="fa fa-user-plus fa-stack-1x acceptFriend" data-id="{{ $user->id }}" aria-hidden="true" title="Chấp nhận yêu cầu kết bạn"></i></span>
				@endif
			@else
				@if(!empty($profileView))
					<a class="btn btn-signature addFriend" data-id="{{ $user->id }}">
		  				<i class="fa fa-user-plus fa-lg"></i> Thêm bạn
		  			</a>
				@else
					<span class="darker_link pointer"><i class="fa fa-user-plus fa-stack-1x addFriend" data-id="{{ $user->id }}" aria-hidden="true" title="Thêm bạn"></i></span>
				@endif
			@endif
		@endif
	@endif
</p>