<?php

namespace App\Controller;

use \App\Core\Controller;
use \App\Core\ResponseAdapter;
use \App\Core\View;
use \App\Exceptions\AccessException;
use \App\Exceptions\NotFoundException;
use \App\Forms\AdminAddUserForm;
use \App\Forms\ArticleEditForm;
use \App\Forms\ArticleSwitchPublicationForm;
use \App\Forms\CommentEditForm;
use \App\Forms\CommentSwitchPublicationForm;
use \App\Forms\FilterForm;
use \App\Forms\PageEditForm;
use \App\Forms\PageSwitchPublicationForm;
use \App\Forms\RolesEditFrom;
use \App\Forms\SettingsForm;
use \App\Forms\SubscribeDeleteForm;
use \App\Forms\UserSwitchLockOutForm;
use \App\Models\Article;
use \App\Models\Comment;
use \App\Models\Page;
use \App\Models\Setting;
use \App\Models\Subscribe;
use \App\Models\User;
use \App\Modules\ModelPagination;
use \App\Modules\ModelRequestHelper;
use \App\Observers\AddArticleObserver;

class AdminController extends Controller
{
    private const ACTIVE = 1;
    private const NOT_ACTIVE = 0;
    
    public function index()
    {
        return new View('admin.index', [
            'title' => 'Админка',
            'usersCount' => \App\Models\User::withTrashed()->count(),
            'commentsCount' => \App\Models\Comment::count(),
            'articlesCount' => \App\Models\Article::withTrashed()->count(),
            'subscribesCount' => \App\Models\Subscribe::count(),
        ]);
    }

    public function allArticles()
    {
        $articles = Article::withTrashed()->orderBy('created_at', 'desc');
        $pagination = new ModelPagination($articles);
        if (isset($_GET['on_page'])) {
            $paginationLimit = $pagination->getAdminLimit();
        }

        $modelWithPagination = $pagination->simplePaginate($paginationLimit ?? ModelPagination::DEFAULT_ADMIN);
        $form = new ArticleSwitchPublicationForm();
        $filterForm = new FilterForm();

        return new View('admin.article.all', ['articles' => $modelWithPagination, 'pagination' => $pagination->paginationCount(), 'form' => $form, 'filterForm' => $filterForm]);
    }

    public function settings()
    {
        $settings = Setting::find(Setting::GENERAL_SETTINGS);
        $form = new SettingsForm();
        $form->setModel($settings);

        return new View('admin.settings.index', ['form' => $form, 'form' => $form]);
    }

    public function editSettings(array $request)
    {
        $settings = Setting::find(Setting::GENERAL_SETTINGS);
        $form = new SettingsForm();
        $form = new SettingsForm($request, $settings::VALIDATE);

        $messages = (new ModelRequestHelper($request, $form, $settings, 'edit'))->run();

        return (new ResponseAdapter($messages))->json();
    }

    public function pages()
    {
        $form = new PageSwitchPublicationForm();

        return new View('admin.page.all', ['pages' => Page::withTrashed()->orderBy('created_at', 'desc')->get(), 'form' => $form]);
    }

    public function subscribes()
    {
        $form = new SubscribeDeleteForm();

        return new View('admin.subscribes.index', ['subscribes' => Subscribe::all(), 'form' => $form]);
    }

    public function comments()
    {
        $comments = Comment::orderBy('created_at', 'desc');
        $pagination = new ModelPagination($comments);
        if (isset($_GET['on_page'])) {
            $paginationLimit = $pagination->getAdminLimit();
        }

        $modelWithPagination = $pagination->simplePaginate($paginationLimit ?? ModelPagination::DEFAULT_ADMIN);
        $form = new CommentSwitchPublicationForm();
        $filterForm = new FilterForm();

        return new View('admin.comments.index', ['comments' => $modelWithPagination, 'pagination' => $pagination->paginationCount(), 'form' => $form, 'filterForm' => $filterForm]);
    }

    public function article(int $id)
    {
        if ($article = Article::withTrashed()->find($id)) {
            $form = new ArticleEditForm();
            $form->setModel($article);

            return new View('admin.article.current', ['article' => $article, 'form' => $form]);
        }

        throw new NotFoundException(MSG_NOT_FOUND, 404);
    }

    public function addArticle()
    {
        $form = new ArticleEditForm();

        return new View('admin.article.add', ['form' => $form]);
    }

    public function addUser()
    {
        $form = new AdminAddUserForm();

        return new View('admin.user.add', ['form' => $form]);
    }

    public function page(int $id)
    {
        if ($page = Page::withTrashed()->find($id)) {
            $form = new PageEditForm();
            $form->setModel($page);

            return new View('admin.page.current', ['page' => $page, 'form' => $form]);
        }

        throw new NotFoundException(MSG_NOT_FOUND, 404);
    }

    public function addPage()
    {
        $form = new PageEditForm();

        return new View('admin.page.add', ['form' => $form]);
    }

    public function addPagePost(array $request)
    {
        $messages = [];
        $page = new Page();
        $form = new PageEditForm($request, $page::EDIT_VALIDATE);

        $messages = (new ModelRequestHelper($request, $form, $page, 'add'))->run();

        if (isset($page->id)) {
            $messages['redirect'] = '/admin/pages/edit/' . $page->id;
        }

        return (new ResponseAdapter($messages))->json();
    }

    public function addUserPost(array $request)
    {
        $messages = [];
        $user = new User();
        $form = new AdminAddUserForm($request, $user::REG_VALIDATE);

        $messages = (new ModelRequestHelper($request, $form, $user, 'adminAdd'))->run();

        return (new ResponseAdapter($messages))->json();
    }

    public function comment(int $id)
    {
        if ($comment = Comment::find($id)) {
            if ($_SESSION['userId'] !== $comment->user->id) {
                throw new AccessException(MSG_FORBIDDEN, 403);
            }

            $form = new CommentEditForm();
            $form->setModel($comment);

            return new View('admin.comments.edit', ['comment' => $comment, 'form' => $form]);
        }

        throw new NotFoundException(MSG_NOT_FOUND, 404);
    }

    public function editArticle(int $id, array $request, array $files)
    {
        if ($article = Article::withTrashed()->find($id)) {
            $messages = [];
            $request['imageName'] = $files['image']['name'];
            $request['image'] = $files['image']['tmp_name'];
            $form = new ArticleEditForm($request, $article::EDIT_VALIDATE);
            $form->setModel($article);

            $messages = (new ModelRequestHelper($request, $form, $article, 'edit'))->run();

            return (new ResponseAdapter($messages))->json();
        }

        throw new NotFoundException(MSG_NOT_FOUND, 404);
    }

    public function addArticlePost(array $request, array $files)
    {
        $messages = [];
        $article = new Article();
        $article->attach(new AddArticleObserver());
        $request['imageName'] = $files['image']['name'];
        $request['image'] = $files['image']['tmp_name'];
        $form = new ArticleEditForm($request, $article::EDIT_VALIDATE);
        $form->setModel($article);

        $messages = (new ModelRequestHelper($request, $form, $article, 'add'))->run();

        if (isset($article->id)) {
            $messages['redirect'] = '/admin/articles/edit/' . $article->id;
        }

        return (new ResponseAdapter($messages))->json();
    }

    public function editPage(int $id, array $request)
    {
        if ($page = Page::withTrashed()->find($id)) {
            $messages = [];
            $form = new PageEditForm($request, $page::EDIT_VALIDATE);
            $form->setModel($page);

            $messages = (new ModelRequestHelper($request, $form, $page, 'edit'))->run();

            return (new ResponseAdapter($messages))->json();
        }

        throw new NotFoundException(MSG_NOT_FOUND, 404);
    }

    public function editComment(int $id, array $request)
    {
        if ($comment = Comment::find($id)) {
            if ($_SESSION['userId'] !== $comment->user->id) {
                throw new AccessException(MSG_FORBIDDEN, 403);
            }

            $messages = [];
            $form = new CommentEditForm($request, $comment::VALIDATE);
            $form->setModel($comment);

            $messages = (new ModelRequestHelper($request, $form, $comment, 'edit'))->run();

            return (new ResponseAdapter($messages))->json();
        }

        throw new NotFoundException(MSG_NOT_FOUND, 404);
    }

    public function toggleArticle(array $request)
    {
        $article = Article::withTrashed()->find($request['articleId']);
        if ($article->trashed()) {
            $article->restore();
        } else {
            $article->delete();
        }

        return (new ResponseAdapter([ARTICLE_SWITCH]))->json();
    }

    public function togglePage(array $request)
    {
        $page = Page::withTrashed()->find($request['pageId']);
        if ($page->trashed()) {
            $page->restore();
        } else {
            $page->delete();
        }

        return (new ResponseAdapter([PAGE_STATUS_SWITCH]))->json();
    }

    public function toggleComment(array $request)
    {
        $comment = Comment::find($request['commentId']);
        $comment->active = $comment->active ? self::NOT_ACTIVE : self::ACTIVE;
        $comment->save();

        return (new ResponseAdapter([COMMENT_STATUS_SWITCH]))->json();
    }

    public function deleteSubscribe(array $request)
    {
        Subscribe::find($request['subscribeId'])->delete();

        return (new ResponseAdapter([SUBSCRIBE_DELETE]))->json();
    }

    public function users()
    {
        $form = new RolesEditFrom();
        $switchForm = new UserSwitchLockOutForm();

        return new View('admin.user.index', ['users' => User::withTrashed()->get(), 'form' => $form, 'switchForm' => $switchForm]);
    }

    public function editUser(array $request)
    {
        if ($user = User::withTrashed()->find($request['userId'])) {
            if (isset($request['userSwitch'])) {
                return (new ResponseAdapter([$user->toggle()]))->json();
            }

            $messages = [];
            $form = new RolesEditFrom($request);
            $form->setModel($user);

            $messages = (new ModelRequestHelper($request, $form, $user, 'editRoles'))->run();

            return (new ResponseAdapter($messages))->json();
        }

        throw new NotFoundException(MSG_NOT_FOUND, 404);
    }
}
