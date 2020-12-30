<div id="post-comment-form-div" class="flex-col hidden">
    <div class="container mx-auto max-w-3xl bg-blue-400 py-5 px-6 mb-0 rounded shadow-2xl">
        <form method="post" action="{{ $poem->path('comment') }}">
            @csrf
            <br/>
            <div>
                <textarea class="w-full rounded-lg border-2 p-4 text-justify whitespace-pre-line focus:outline-none
                          focus:border-blue-700 @error ('content') border border-red-500 @enderror"
                          name="comment" data-lpignore="true" rows="5" autocomplete="off"
                          placeholder="Enter comment here . . ." required>{{ old('content') }}</textarea>
            </div><br/>

            @error ('content')
            <div class="error-msg">
                {{ $message }}
            </div>
            @enderror

            <div class="flex justify-end space-x-6">
                <button id="cancel-btn" type="button" class="text-white bg-blue-800 focus:outline-none hover:bg-blue-700 py-2 px-4 rounded">Cancel</button>
                <button id="add-comment-btn" type="submit" class="text-white bg-blue-800 focus:outline-none hover:bg-blue-700 py-2 px-4 rounded">Add Comment</button>
            </div>
        </form>
    </div>
</div>

<div id="comments-div" class="flex-col hidden">
    <div class="flex justify-center"><h1 class="text-2xl font-thin mt-5 mb-5">Comments Section</h1></div>
    <div class="mt-1 border-t-2 border-gray-300"></div><br/><br/>
    <div class="flex justify-end">
        <button id="post-comment-btn" class="text-white bg-blue-800 focus:outline-none hover:bg-blue-700 py-2 px-4 rounded">Post a comment</button>
    </div><br/>

    @if($poem->comments->count() > 0)
        @foreach(($poem->comments->all()) as $comment)
            <div class="flex flex-col break-words bg-green-100 border border-2 rounded shadow-2xl w-full p-6">
                <p>
                <h3 class="font-bold mb-2">Comment By: {{ $comment->user->name }}</h3>
                </p>

                <p>
                <h3>On: {{ date('j M Y, H:i', strtotime($comment->created_at)) }}</h3>
                </p>

                <p class="text-justify whitespace-pre-line">
                    {{ $comment->comment }}
                </p>
            </div>
            <br/><br/><br/>
        @endforeach
    @else
        <div class="flex justify-center"><h1 class="text-2xl font-thin mt-5 mb-5">There are no comments on this poem</h1></div>
    @endif
</div>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        const commentBtn = document.querySelector('#comment-btn');
        const commentsDiv = document.querySelector('#comments-div');
        const postCommentBtn = document.querySelector('#post-comment-btn');
        const postCommentFormDiv = document.querySelector('#post-comment-form-div');
        const cancelBtn = document.querySelector('#cancel-btn');
        const addCommentBtn = document.querySelector('#add-comment-btn');
        const commentInput = document.querySelector('#comment-input');

        commentBtn.addEventListener('click', () => {
            commentsDiv.classList.toggle('hidden');
            commentsDiv.classList.toggle('flex');
        });

        postCommentBtn.addEventListener('click', () => {
            commentsDiv.classList.toggle('hidden');
            commentsDiv.classList.toggle('flex');
            postCommentFormDiv.classList.toggle('hidden');
            postCommentFormDiv.classList.toggle('flex');
            commentBtn.setAttribute("disabled", "disabled");
        });

        cancelBtn.addEventListener('click', () => {
            commentsDiv.classList.toggle('hidden');
            commentsDiv.classList.toggle('flex');
            postCommentFormDiv.classList.toggle('hidden');
            postCommentFormDiv.classList.toggle('flex');
            commentBtn.removeAttribute("disabled");
        });

        addCommentBtn.addEventListener('click', () => {
            if (commentInput.value() > 1) {
                postCommentFormDiv.classList.toggle('hidden');
                postCommentFormDiv.classList.toggle('flex');
                commentsDiv.classList.toggle('hidden');
                commentsDiv.classList.toggle('flex');
            }
        });
    })
</script>

