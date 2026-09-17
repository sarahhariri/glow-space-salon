   <x-admin.admin-layout>
   <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div
            class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">About Images Management</h1>

        </div>

        <form method="POST" action="{{ route('admin.aboutImages.add') }}" enctype="multipart/form-data">
      
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image">
                @error('image')
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @enderror
            </div>
          
            <button type="submit" class="btn btn-primary">Add Images</button>
        </form>

        <div class="table-responsive small">
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        
                        <th scope="col">Image</th>
                     
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse($aboutImages as $image)
                        <tr>
                           
                            <td><img src="{{ asset('assets/images/about/' . $image->image) }}" width="100px" height="100px">
                            </td>
                         
                            <td class="text-nowrap">
                                <div class="btn-group btn-group-sm shadow-sm" role="group"
                                    aria-label="Slider actions">
                                    <form method="POST" action="{{ route('admin.aboutImages.delete', $image) }}">
                                        <button type="submit" class="btn btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No about image yet</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>
   </x-admin.admin-layout>