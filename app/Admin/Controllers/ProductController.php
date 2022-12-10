<?php

namespace App\Admin\Controllers;

use App\Models\Product;
use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;

class ProductController extends Controller
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
        $grid = new Grid(new Product);

//        $grid->id('ID');
        $grid->column('category.name','Category');
        $grid->column('subcategory.name','Sub Category');
        $grid->column('name','Title');
        $grid->column('price','Price');
        $grid->column('special_price','Offer Price');
        $grid->column('total_rating','Total Rating');
        $grid->column('rate_amount','Rate Amount');
        $grid->column('photo','Photo')->image(admin_asset('uploads'), 100, 100);
        $grid->column('description','Description');
        $grid->column('manufacturer','Manufacturer');
        $grid->column('short_description','Short Description');
        $grid->column('stock','Stock');
        $grid->column('speciality','Speciality');
        $grid->column('wish_amount','Wish Amount');
//        $grid->column('photo2','Photo2');
//        $grid->column('photo3','Photo3');
//        $grid->column('photo4','Photo4');
//        $grid->column('photo5','Photo5');

        $grid->column('priority','Priority');
        $grid->column('status','Status')->using([1=>'Active', 0=>'Inactive']);
        $grid->column('creator.name','Create By');
        $grid->column('updator.name','Update By');
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
        $show = new Show(Product::findOrFail($id));

        $show->id('ID');
        $show->category_id('category_id');
        $show->status('status');
        $show->prority('priority');
        $show->created_by('created_by');
        $show->updated_by('updated_by');
        $show->name('name');
        $show->subcategory_id('subcategory_id');
        $show->price('price');
        $show->total_rating('total_rating');
        $show->rate_amount('rate_amount');
        $show->photo('photo');
        $show->description('description');
        $show->manufacturer('manufacturer');
        $show->short_description('short_description');
        $show->stock('stock');
        $show->speciality('speciality');
        $show->wish_amount('wish_amount');
        $show->photo2('photo2');
        $show->photo3('photo3');
        $show->photo4('photo4');
        $show->photo5('photo5');
        $show->special_price('special_price');
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
        $subcategories = ProductSubCategory::where('status', 1)->pluck('name','id');

        $form = new Form(new Product);
//        $form->display('ID');
        $form->select('category_id', 'Category')->options($categories)->load('subcategory_id', '/api/getSubCategory')->rules('required');
        $form->select('subcategory_id', 'Sub Category')->required();
        $form->text('name', 'Title');

        $form->currency('price', 'Price')->symbol('৳')->required();
        $form->currency('special_price', 'Offer Price')->symbol('৳');
//        $form->text('total_rating', 'Total');
//        $form->text('rate_amount', 'rate_amount');
        $form->image('photo', 'Photo')->move('products',str_replace('.','',microtime(true)).'.jpg')->required();
        $form->image('photo2', 'photo2')->move('products',str_replace('.','',microtime(true)).'.jpg');
        $form->image('photo3', 'photo3')->move('products',str_replace('.','',microtime(true)).'.jpg');
        $form->image('photo4', 'photo4')->move('products',str_replace('.','',microtime(true)).'.jpg');
        $form->image('photo5', 'photo5')->move('products',str_replace('.','',microtime(true)).'.jpg');
        $form->text('short_description', 'Short Description');
        $form->textarea('description', 'Description');
        $form->text('manufacturer', 'Manufacturer');
        $form->number('stock', 'Available Stock');
        $form->text('speciality', 'Speciality');
//        $form->text('wish_amount', 'wish_amount');
        $form->text('priority', 'Priority');
        $form->select('status', 'Status')->options([1=>'Active', 0=>'Inactive']);
        $form->hidden('created_by', 'created_by')->default(Admin::user()->id);
        $form->hidden('updated_by', 'updated_by')->default(Admin::user()->id);
        $form->hidden(trans('admin.created_at'));
        $form->hidden(trans('admin.updated_at'));

        return $form;
    }
}
