<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Post;
use Livewire\Attributes\Computed;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class PostList extends Component
{
    use WithPagination;

    #[Url()]
    public $sort = "desc";
    #[Url()]
    public $search = "";
    #[Url()]
    public $category = "";
    public function setSort($sort)
    {
        $this->resetPage();
        $this->sort = $sort === "asc" ? "asc" : "desc";
    }
    #[On("search")]
    public function updateSearch($search)
    {
        $this->search = $search;
        $this->resetPage();
    }
    public function clearFilters()
    {
        $this->resetPage();
        $this->search = "";
        $this->category = "";
    }
    #[Computed()]
    public function posts()
    {
        return Post::published()
            ->where("title", "ilike", "%{$this->search}%")
            ->when($this->activeCategory, function ($query) {
                $query->withCategory($this->category);
            })
            ->orderBy("published_at", $this->sort)
            ->paginate(5);
    }
    #[Computed()]
    public function activeCategory()
    {
        return Category::where("slug", $this->category)->first();
    }
    public function render()
    {
        return view('livewire.post-list');
    }
}
