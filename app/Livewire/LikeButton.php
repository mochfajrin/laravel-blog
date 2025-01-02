<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\User;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class LikeButton extends Component
{
    #[Reactive]
    public Post $post;
    public function toggleLike()
    {
        if (auth()->guest()) {
            return $this->redirect("login", true);
        }
        $user = auth()->user();
        if ($user->hasLiked($this->post)) {
            return $user->likes()->detach($this->post);
        }
        $user->likes()->attach($this->post);
    }
    public function render()
    {
        return view('livewire.like-button');
    }
}
