<div class="form-container">
    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <div class="textarea-container">
            <textarea name="content" rows="3" class="w-full border rounded-md p-2" placeholder="What's on your mind?"></textarea>
        </div>
        <div class="flex items-center justify-center">
            <button type="submit" class="post-button">Post</button>
        </div>
    </form>
</div>

<style>
    .form-container {
        max-width: 600px;
        margin: 20px auto;
        background: #fff;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
        border-radius: 8px;
        padding: 20px;
    }

    .textarea-container {
        margin-bottom: 20px;
    }

    textarea {
        width: 100%;
        border: 1px solid #ccd0d5;
        border-radius: 4px;
        padding: 8px;
        font-size: 14px;
        resize: vertical;
    }

    .post-button {
        display: block;
        width: 100%;
        background-color: #4267B2;
        color: #fff;
        font-weight: bold;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
    }

    .post-button:hover {
        background-color: #365899;
    }
</style>
