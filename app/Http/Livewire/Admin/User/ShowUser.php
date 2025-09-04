<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ShowUser extends Component
{
  use WithPagination;

  /**
   * Properties
   *
   */
  protected $paginationTheme = 'bootstrap';
  public $search = '';

  /**
   * Hooks
   *
   */
  public function updatedSearch()
  {
    $this->resetPage();
  }

  /**
   * Render page
   *
   */
  public function render()
  {
    // Get all product categories
    $users = User::where('email', 'like', '%' . $this->search . '%')
      ->orderBy('id', 'desc')
      ->paginate(15);

    return view('livewire.admin.user.show-user', compact('users'));
  }
}
