<div class="card">
    <table class="table card-table table-vcenter">
        <tr>
            <th>Title</th>
            <th class="text-right d-table-cell"></th>
        </tr>
        @forelse($items as $index => $item)
        <tr>
            <td>
                {{ $item->title ?: 'N/A' }}
            </td>
            <td class="text-right d-table-cell">
                @permission('posts-edit')
                @include('varbox::buttons.edit', ['url' => route('admin.posts.edit', ['post' => $item->id])])
                @endpermission
                @permission('posts-delete')
                @include('varbox::buttons.delete', ['url' => route('admin.posts.destroy', ['post' => $item->id])])
                @endpermission
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="10">No records found</td>
        </tr>
        @endforelse
    </table>
</div>