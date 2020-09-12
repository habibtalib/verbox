<?php

namespace App\Http\Controllers\Admin;

use App\Filters\Admin\PostFilter;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PostsController as FrontPostsController;
use App\Http\Requests\Admin\PostRequest;
use App\Post;
use App\Sorts\Admin\PostSort;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Varbox\Traits\CanCrud;
use Varbox\Traits\CanDraft;
use Varbox\Traits\CanOrder;
use Varbox\Traits\CanPreview;

class PostsController extends Controller
{
    use CanCrud;
    use CanOrder;
    use CanDraft;
    use CanPreview;

    /**
     * @var Post
     */
    protected $model;

    /**
     * Get the model to be drafted.
     *
     * @return string
     */
    protected function draftModel(): string
    {
        return Post::class;
    }

    /**
     * Get the url to redirect after drafting/publishing.
     *
     * @param Model $model
     * @return string
     */
    protected function draftRedirectTo(Model $model): string
    {
        return route('admin.posts.edit', $model->id);
    }

    /**
     * Get the form request to validate the draft upon.
     *
     * @return string|null
     */
    protected function draftRequest(): ?string
    {
        return PostRequest::class;
    }

    /**
     * @param Post $model
     * @return void
     */
    public function __construct(Post $model)
    {
        $this->model = $model;

        view()->share('_model', $this->model);
    }

    /**
     * @param Request $request
     * @param PostFilter $filter
     * @param PostSort $sort
     * @return mixed
     */
    public function csv(Request $request, PostFilter $filter, PostSort $sort)
    {
        $items = $this->model/*->withDrafts()*/
            ->filtered($request->all(), $filter)
            ->sorted($request->all(), $sort)
            ->get();

        return $this->model->exportToCsv($items);
    }

    /**
     * @param Request $request
     * @return \Illuminate\View\View
     * @throws \Exception
     */
    public function index(Request $request, PostFilter $filter, PostSort $sort)
    {
        return $this->_index(function () use ($request, $filter, $sort) {
            if (count($request->all()) == 0) {
                // fetch records in order when no filtering / sorting is applied
                $this->items = $this->model->withDrafts()->ordered()->get();
            } else {
                $this->items = $this->model->withDrafts()->query()
                    ->filtered($request->all(), $filter)
                    ->sorted($request->all(), $sort)
                    ->paginate(config('varbox.crud.per_page', 30));

            }

            $this->title = 'Posts';
            $this->view = view('admin.posts.index');
            $this->vars = [
                'users' => $this->getUsers(),
            ];
        });
    }

    /**
     * @return \Illuminate\View\View
     * @throws \Exception
     */
    public function create()
    {
        return $this->_create(function () {
            $this->title = 'Add Post';
            $this->view = view('admin.posts.add');
            $this->vars = [
                'users' => $this->getUsers(),
            ];
        });
    }

    /**
     * @param PostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function store(PostRequest $request)
    {
        return $this->_store(function () use ($request) {
            $this->item = $this->model->create($request->all());
            $this->redirect = redirect()->route('admin.posts.index');
        }, $request);
    }

    /**
     * @param Post $post
     * @return \Illuminate\View\View
     * @throws \Exception
     */
    public function edit(Post $post)
    {
        return $this->_edit(function () use ($post) {
            $this->item = $post;
            $this->title = 'Edit Post';
            $this->view = view('admin.posts.edit');
            $this->vars = [
                'users' => $this->getUsers(),
            ];
        });
    }

    /**
     * @param PostRequest $request
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function update(PostRequest $request, Post $post)
    {
        return $this->_update(function () use ($post, $request) {
            $this->item = $post;
            $this->redirect = redirect()->route('admin.posts.index');

            $this->item->update($request->all());
            // $this->item->saveBlocks($request->input('blocks') ?: []);

        }, $request);
    }

    /**
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        return $this->_destroy(function () use ($post) {
            $this->item = $post;
            $this->redirect = redirect()->route('admin.posts.index');

            $this->item->delete();
        });
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection
     */
    protected function getUsers()
    {
        return User::excludingAdmins()->alphabetically()->get();
    }

    /**
     * Get the model to be previewed.
     *
     * @return string
     */
    protected function previewModel(): string
    {
        return Post::class;
    }

    /**
     * Get the controller where to dispatch the preview.
     *
     * @param Model $model
     * @return Model
     */
    protected function previewController(Model $model): string
    {
        return FrontPostsController::class;
    }

    /**
     * Get the action where to dispatch the preview.
     *
     * @param Model $model
     * @return Model
     */
    protected function previewAction(Model $model): string
    {
        return 'show';
    }

    /**
     * Get the form request to validate the preview upon.
     *
     * @return string|null
     */
    protected function previewRequest(): ?string
    {
        return PostRequest::class;
    }
}