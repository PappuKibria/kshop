<?php

namespace App\Admin\Controllers;

use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;

class ProductSubCategoryController extends Controller
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
            ->header(trans('admin.index'))
            ->description(trans('admin.description'))
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
        $grid = new Grid(new ProductSubCategory);

//        $grid->id('ID');
        $grid->column('category.name','Category');
        $grid->column('name','Name');
        $grid->column('status','Status')->using([1=>'Active', 0=>'Inactive']);
        $grid->column('priority','Priority');
        $grid->column('creator.name','Creator');
        $grid->column('updator.name','Updator');

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
        $show = new Show(ProductSubCategory::findOrFail($id));

        $show->id('ID');
        $show->category_id('category_id');
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
        $categories = ProductCategory::where('status', 1)->pluck('name','id');
        $form = new Form(new ProductSubCategory);

//        $form->display('ID');
        $form->select('category_id', 'Category')->options($categories);
        $form->text('name', 'name');
        $form->select('status', 'Status')->options([1=>'Active', 0=>'Inactive']);
        $form->text('priority', 'Priority');
        $form->hidden('created_by', 'created_by')->default(Admin::user()->id);
        $form->hidden('updated_by', 'updated_by')->default(Admin::user()->id);
        $form->hidden(trans('admin.created_at'));
        $form->hidden(trans('admin.updated_at'));

        return $form;
    }
}
