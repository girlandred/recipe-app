<?php

namespace App\Http\Livewire\Specifications;

use App\Models\Specification;
use Livewire\Component;

class Index extends Component
{
    public $search;

    protected $queryString = ['search' => ['except' => '']];

    public function render()
    {
        $specifications = Specification::with('recipes')->where('name', 'like', '%' . $this->search . '%')->orderBy('name')->paginate(25);

        return view('livewire.specifications.index', compact('specifications'));
    }
}
