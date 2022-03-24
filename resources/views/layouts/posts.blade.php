<div class="panel" id="PostId{{ $post->id }}">
    <div class="panel-heading">
        <img src="{{ $post->user->getAvatarImagePath() }}" class="pull-left img-circle" height="45px">
        <span class="info"><a href="{{ route('profile.view', ['id' => $post->user->id]) }}"
                              class="darker_link"><b>{{ $post->user->getFullName() }}</b></a></span>
        @if ($post->user_id == Auth::user()->id)
            {!! Form::open(['method' => 'DELETE', 'action' => ['PostsController@destroy', $post->id]]) !!}
            <span class="info" style="color: #9d9d9d"><i><small>{{ $post->created_at->diffForHumans() }} - <button
                                type="button" data-toggle="modal" data-target="#confirmDelete" data-title="Delete Post"
                                data-message="Bạn chắc chắn muốn xóa bài viết này?"><i class="fa fa-trash-o"
                                                                                             aria-hidden="true"></i> Xóa</button></small></i></span>
            {!! Form::close() !!}
        @else
            <span class="info"
                  style="color: #9d9d9d"><i><small>{{ $post->created_at->diffForHumans() }}</small></i></span>
        @endif
    </div><!-- heading -->
    <div class="panel-body">
        <p class="post_content">{{ $post->body }}</p>
        @foreach ($post->images as $img)
            <p><a href="{{ asset($post->imagePath($img)) }}" data-lightbox="PostImage{{ $post->id }}"
                  data-title="{{ $post->body }}"><img class="img-responsive img-center"
                                                      src="{{ asset($post->imagePath($img)) }}"></a></p>
        @endforeach
        <hr>
        <span>
		<a class="pointer likePost" data-id="{{ $post->id }}"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>
			<span id="LikeText{{ $post->id }}">
			@if (Auth::user()->likedPost($post->id))
                    Đã thích
                @else
                    Thích
                @endif
			</span>
		</a>
		</span>

        <a><span class="pointer savePost" data-id="{{ $post->id }}"><i class="fa fa-floppy-o" aria-hidden="true"></i>
		<span id="SaveText{{ $post->id }}">
			@if (Auth::user()->savedPost($post->id))
                Đã lưu
            @else
                Lưu
            @endif
		</span>
		</span></a>
        <span><i class="fa fa-commenting-o" aria-hidden="true"></i> Bình luận</span>

        <span class="pull-right" id="PostLikes{{ $post->id }}">{{ $post->infoStatus() }}</span>
    </div><!-- body -->
    <div class="panel-footer">
        @if ($post->comments()->count())
            @foreach ($post->comments as $comment)
                @include('layouts.comments')
            @endforeach
        @endif
        <div id="newComment">
            {!! Form::open(['method' => 'POST', 'action' => ['CommentsController@store']]) !!}
            <div class="input-group">
                {!! Form::hidden('post_id', $post->id) !!}
                {!! Form::text('body', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => 'Viết bình luận của bạn..']) !!}
                <span class="input-group-btn">
					{{ Form::button('<i class="fa fa-location-arrow" aria-hidden="true"></i> Đăng bài viết', array('class'=>'btn btn-signature', 'type'=>'submit')) }}
				</span>
            </div><!-- /input-group -->
            {!! Form::close() !!}
        </div>
    </div><!-- Footer -->
</div>

@section('scripts')
    <script type="text/javascript">
        $('.savePost').click(function () {
            var id = $(this).attr("data-id");

            $.ajax({
                type: "POST",
                url: "{{ route('save.post') }}",
                data: {id: id, _token: '{{ Session::token() }}'},
                success: function (response) {
                    if (response == 1) {
                        $("#SaveText" + id).text('Đã lưu');
                    } else {
                        $("#SaveText" + id).text('Lưu');
                    }
                }
            });
        });

        $('.likePost').click(function () {

            var id = $(this).attr("data-id");
            var url = "{{ route('post.like') }}";
            var token = '{{ Session::token() }}';


            var urlStatus = "{{ route('post.info') }}";
            $.ajax({
                type: "POST",
                url: url,
                data: {id: id, _token: token},
                success: function (result) {
                    if (result == 1) {
                        $("#LikeText" + id).text('Đã thích');
                    } else {
                        $("#LikeText" + id).text('Thích');
                    }

                    $.ajax({
                        type: "POST",
                        url: urlStatus,
                        data: {id: id, _token: token},
                        success: function (result) {
                            $('#PostLikes' + id).text(result);
                        }
                    });
                }
            });
        });
    </script>
@endsection