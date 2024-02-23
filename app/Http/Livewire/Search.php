<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class Search extends Component
{
    public $searchTerm;
    public $articles = [];
    public $pinnedArticles  = [];

    public function search()
    {
        $response = Http::get(route('news'), ['q' => $this->searchTerm]);
        $articles = collect($response->json());
        $this->articles = [];
        $this->articles = $this->filterResults($articles);
    }

    public function render()
    {
        return view('livewire.search');
    }

    public function pinArticle($articleId)
    {
        $result = collect($this->articles);

        // add to the pinned items
        $article = $result->firstWhere('id', $articleId);
        if ($article) {
            $this->pinnedArticles[] = $article;
        }

        $this->articles = $this->filterById($result, $articleId);
    }

    public function unpinArticle($articleId)
    {
        $result = collect($this->pinnedArticles);
        // add to the pinned items
        $pinnedArticle = $result->firstWhere('id', $articleId);
        if ($pinnedArticle) {
            $this->articles[] = $pinnedArticle;
        }

        $this->pinnedArticles = $this->filterById($result, $articleId);
    }

    private function filterById($data, $articleId) {
        return $data->reject(function ($item) use ($articleId) {
            return $item['id'] === $articleId;
        });
    }

    private function filterResults($data)
    {
        $targetIds = collect($this->pinnedArticles);

        return $data->reject(function ($item) use ($targetIds) {
            return $targetIds->contains('id', $item['id']);
        });
    }


}
