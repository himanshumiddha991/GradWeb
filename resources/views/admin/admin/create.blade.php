<x-admin-layout>
    <x-slot name="header">
        <a class="navbar-brand" href="#pablo">
            {{ Auth::guard('admin')->user()->name }} {{ __('table') }}
        </a>
    </x-slot>

    <div class="panel-header panel-header-sm"></div>

    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Create User</h4>
                    </div>
                    <div class="card-body">
                        <!-- form or fields go here -->
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card card-plain">
                    <div class="card-header">
                        <h4 class="card-title"></h4>
                        <form action="{{ route('admin.admin.store') }}" method="POST">
                            @csrf
                            <input name="name" placeholder="name" required>
                            <input name="email" type="email" placeholder="email" required>
                            <input name="password" type="password" placeholder="password" required>
                            <input name="password_confirmation" type="password" placeholder="confirm password" required>
                            <select name="role" required>
                                @foreach($roles as $id => $role)
                                    <option value="{{ $role }}">{{ ucfirst($role) }}</option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-default">Create Admin</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
