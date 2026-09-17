<x-admin.admin-layout>
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">{{ isset($title) ? $title : 'Users' }}</h1>
        </div>
        <div class="table-responsive small">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                <div class="btn-group btn-group-sm shadow-sm gap-2" role="group"
                                    aria-label="Tag actions">
                                    @if($user->deleted_at)
                                    <form method="POST" action="{{ route('admin.users.restore', $user->id) }}">
                                        <button type="submit" class="btn btn-outline-primary" title="Restore" >
                                            <i class="bi bi-arrow-up"></i>
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.users.forceDelete', $user->id) }}">
                                        <button type="submit" class="btn btn-outline-danger" title="Force Delete">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                   
                                     @elseif($user->id != Auth::id())
                                    <form method="POST" action="{{ route('admin.users.makeAdmin', $user->id) }}">
                                        <button type="submit" class="btn btn-outline-{{$user->role == 'user' ? 'success' : 'danger'}}" title="{{$user->role == 'user' ? 'Make' : 'Remove'}} Admin">
                                            <i class="bi {{$user->role == 'user' ? 'bi-person-plus' : 'bi-person-slash'}}"></i>
                                        </button>
                                    </form>
                                        <form method="POST" action="{{ route('admin.users.delete', $user->id) }}">
                                            <button type="submit" class="btn btn-outline-danger" title="Delete">
                                                <i class="bi bi-trash3"></i>
                                            </button>
                                        </form>
                                    @endif

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
         
            @if(session('success'))
            <script>
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: '{{ session('success') }}',
                    showConfirmButton: false,
                    timer: 3000,            
                });
            </script>
          @endif
        </div>
    </main>
    
</x-admin.admin-layout>
