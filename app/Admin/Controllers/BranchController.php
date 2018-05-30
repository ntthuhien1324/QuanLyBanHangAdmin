<?php

namespace App\Admin\Controllers;

use App\Models\Branch;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class BranchController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('Branch');
            $content->description('description');

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Branch::class, function (Grid $grid) {

            $grid->name('Branch Name')->sortable();
            $grid->address('Address');
            $grid->phone('Phone');
            $grid->email('Email');

            $grid->created_at('Create At');
            $grid->updated_at('Update At');

            $grid->filter(function($filter){

//                 Remove the default id filter
                $filter->disableIdFilter();

//                 Add a column filter
                $filter->like('name', 'Branch Name');
                $filter->like('address','Address');


            });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Branch::class, function (Form $form) {

            $form->hidden('id', 'ID');
            $form->text('name','Name')->rules('required');
            $form->text('address','Address')->rules('required');
            $form->mobile('phone','Phone');
            //xét rule unique:tên table, tên column
            $form->email('email','Email')->rules('unique:branch,email');

            $form->hidden('created_at', 'Created At');
            $form->hidden('updated_at', 'Updated At');
        });
    }
}
