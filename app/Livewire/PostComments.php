<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;

class PostComments extends Component
{
    use WithPagination;
    public Post $post;
    #[Rule("required|min:1|max:200")]
    public string $comment;
    public function postComment()
    {
        if (auth()->guest()) {
            return;
        }
        $this->validateOnly("comment");
        $this->post->comments()->create([
            "user_id" => auth()->id(),
            "content" => $this->comment
        ]);
        $this->reset("comment");
    }
    #[Computed()]
    public function comments()
    {
        return $this?->post?->comments()->latest()->paginate(5);
    }
    public function render()
    {
        return view('livewire.post-comments');
    }
}
