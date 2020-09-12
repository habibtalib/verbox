<?php

namespace App\Http\Controllers\Admin;

use App\Filters\Admin\PostFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Varbox\Traits\CanCrud;

class PostsController extends Controller
{
    use CanCrud;

    /**
     * @var Post
     */
    protected $model;

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
     * @return \Illuminate\View\View
     * @throws \Exception
     */
    public function index(Request $request, PostFilter $filter)
    {
        return $this->_index(function () use ($request, $filter) {
            $this->items = $this->model->query()
                ->filtered($request->all(), $filter)
                ->paginate(config('varbox.crud.per_page', 30));

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
}