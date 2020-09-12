<div class="card">
    <table class="table card-table table-vcenter" data-orderable="{{ empty(request()->all()) ? 'true' : 'false' }}"
        data-order-url="{{ route('admin.posts.order') }}" data-order-model="{{ \App\Post::class }}"
        data-order-token="{{ csrf_token() }}">
        <tr class="nodrag nodrop">
            <th class="sortable" data-sort="title">
                <i class="fa fa-sort mr-2"></i>Title
            </th>
            <th class="text-right d-table-cell"></th>
        </tr>
        @forelse($items as $index => $item)
        <tr id="{{ $item->id }}">
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