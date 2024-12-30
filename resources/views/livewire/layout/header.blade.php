<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>
    <!-- Page Header Start-->
    <div class="page-header">
        <div class="header-wrapper row m-0">
          
          
          
            <div class="nav-right col-xxl-7 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
                <ul class="nav-menus">  
                    <li class="language-nav">
                        <div class="translate_wrapper">
                        <div class="current_lang">
                            <div class="lang btn btn-primary btn-md">
                          {{ getValue('workspace', "id = ". Auth::user()->workspace_id)->workspace_name }}   
                            </div>
                        </div>
                        <div class="more_lang">
                        @php
                            $user = getValue('users', "id = ". Auth::user()->id);
                            $workspace = workspaceList();
                        @endphp
                        @if($user->workspace_id == 1)
                            @foreach ($workspace as $v)
                            <div class="lang" data-value="{{ $v->id }}" data-select-workspace><span class="lang-txt">{{ $v->workspace_name }}</span></div>
                            @endforeach
                         @endif

                        </div>
                        </div>
                    </li>                
                    <li class="profile-nav onhover-dropdown pe-0 py-0">
                        <div class="d-flex profile-media">
                            <div class="flex-grow-1"><span>{{Auth::user()->firstname}} {{Auth::user()->lastname}}</span>
                                <p class="mb-0">{{(Auth::user()->is_admin == 1)?'Admin':'User'}} <i class="middle fa-solid fa-angle-down"></i></p>
                            </div>
                        </div>
                        <ul class="profile-dropdown onhover-show-div">
                            <li>
                                <a href="javascript:void(0)" wire:click="logout" >
                                    <i data-feather="log-in"> </i> <span>Log out</span>
                                </a>
                              </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
