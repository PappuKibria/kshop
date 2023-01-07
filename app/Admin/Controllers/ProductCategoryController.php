<?php

namespace App\Admin\Controllers;

use App\Models\ProductCategory;
use App\Http\Controllers\Controller;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ProductCategoryController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header(trans('Product Category'))
            ->description(trans('Details'))
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header(trans('admin.detail'))
            ->description(trans('admin.description'))
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header(trans('admin.edit'))
            ->description(trans('admin.description'))
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header(trans('admin.create'))
            ->description(trans('admin.description'))
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ProductCategory);

        $grid->id('ID');
        $grid->name('name');
        $grid->status('status');
        $grid->prority('priority');
        $grid->created_by('created_by');
        $grid->updated_by('updated_by');
        $grid->created_at(trans('admin.created_at'));
        $grid->updated_at(trans('admin.updated_at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(ProductCategory::findOrFail($id));

        $show->id('ID');
        $show->name('name');
        $show->status('status');
        $show->prority('priority');
        $show->created_by('created_by');
        $show->updated_by('updated_by');
        $show->created_at(trans('admin.created_at'));
        $show->updated_at(trans('admin.updated_at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ProductCategory);

//        $form->display('ID');
        $form->text('name', 'Name');
        $form->select('status', 'Status')->options([1=>'Active', 0=>'Inactive']);
        $form->text('priority', 'priority');



        $form->isCreating(function (Form $form){
            $form->hidden('created_by', 'created_by')->default(Admin::user()->id);
            $form->hidden(trans('admin.created_at'));
        });

        $form->isEditing(function ($form){
            $form->hidden('updated_by', 'updated_by')->default(Admin::user()->id);
            $form->hidden(trans('admin.updated_at'));
        });

        return $form;
    }
}
