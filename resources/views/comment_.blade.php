<div class="container mx-auto max-w-3xl">
@if(session('comment'))
        <div class="text-white mt-10 px-6 py-4 border-0 rounded relative mb-4 bg-green-500">
            <span class="text-xl inline-block mr-5 align-middle">
                <i class="fas fa-check-circle"></i>
            </span>
            <span class="inline-block align-middle mr-8">
                Your comment has been added successfully!
            </span>
            <button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none" onclick="closeAlert(event)">
                <span>×</span>
            </button>
        </div>
    @endif
</div>

<div id="post-comment-form-div" class="flex-col hidden">
    <div class="container mx-auto max-w-3xl bg-blue-400 py-5 px-6 mb-0 rounded shadow-2xl">
        <form method="post" action="{{ $poem->path('comment') }}">
            @csrf
            <br/>
            <div>
                <textarea id="add-comment-input" class="w-full rounded-lg border-2 p-4 text-justify whitespace-pre-line focus:outline-none
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
                <button id="add-cancel-btn" type="button" class="text-white bg-blue-800 focus:outline-none hover:bg-blue-700 py-2 px-4 rounded">Cancel</button>
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
            <div class="flex flex-col break-words bg-blue-200 border border-2 rounded shadow-xl w-full p-6">
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
        const addCancelBtn = document.querySelector('#add-cancel-btn');
        const addCommentBtn = document.querySelector('#add-comment-btn');

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

        addCancelBtn.addEventListener('click', () => {
            commentsDiv.classList.toggle('hidden');
            commentsDiv.classList.toggle('flex');
            postCommentFormDiv.classList.toggle('hidden');
            postCommentFormDiv.classList.toggle('flex');
            commentBtn.removeAttribute("disabled");
        });

        addCommentBtn.addEventListener('click', () => {
            const addCommentInput = document.querySelector('#add-comment-input');

            if (addCommentInput.value() > 1) {
                postCommentFormDiv.classList.toggle('hidden');
                postCommentFormDiv.classList.toggle('flex');
                commentsDiv.classList.toggle('hidden');
                commentsDiv.classList.toggle('flex');
            }
        });

        function closeAlert(event){
            let element = event.target;
            while(element.nodeName !== "BUTTON"){
                element = element.parentNode;
            }
            element.parentNode.parentNode.removeChild(element.parentNode);
        }
    })
</script>

