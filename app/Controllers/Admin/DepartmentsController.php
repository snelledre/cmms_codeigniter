<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Modules\Breadcrumbs\Breadcrumbs;
use App\Models\DepartmentModel;
use App\Entities\Department;
use Mpdf\Mpdf;

class DepartmentsController extends BaseController
{
    public $breadcrumb;
    private $model;
    private $title;

    public function __construct()
    {
        $this->model = new DepartmentModel();
        $this->title = 'Afdelingen';
        $this->breadcrumb = new Breadcrumbs();
        $this->breadcrumb->add('Cmms', '/');
        $this->breadcrumb->add('Afdelingen', url_to("departments"));
    }

    public function index()
    {
        $this->breadcrumb->add('Lijst', ' ');

        if($this->request->getGet('q')) {
            $q = $this->request->getGet('q');
            $departments = $this->model->getDepartmentByName($q);
        } else {
            $departments = $this->model->paginate(10, 'page');
        }
        
        $data = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumb->render(),
            'departments' => $departments,
            'pager' => $this->model->pager
        ];

        echo view('Admin/Departments/index', $data);
    }

    public function new()
    {
        $this->breadcrumb->add('Nieuw', ' ');

        $data = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumb->render(),
            'department' => new Department(),
        ];

        echo view('Admin/Departments/new', $data);
    }

    public function create()
    {
        $department = new Department($this->request->getPost());

        if ($this->model->save($department)) {

            return redirect()->route('departments', [$this->model->insertID])
                ->with('success', 'Record is toegevoegd.');
        } else {

            return redirect()->Back()
                ->with('errors', $this->model->errors())
                ->withInput();
        }
    }

    public function show($id = null)
    {
        $this->breadcrumb->add('Bekijken', ' ');

        $data = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumb->render(),
            'department' => $this->getDepartmentOr404($id),
        ];

        echo view('Admin/Departments/show', $data);
    }

    public function edit($id = null)
    {
        $this->breadcrumb->add('Bewerken', ' ');

        $data = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumb->render(),
            'department' => $this->getDepartmentOr404($id),
        ];

        echo view('Admin/Departments/edit', $data);
    }

    public function update($id = null)
    {
        $department = $this->getDepartmentOr404($id);

        $post = $this->request->getPost();

        $department->fill($post);

        if (!$department->hasChanged()) {
            return redirect()->route('departments_show', [$id])
                ->with('warning', 'Er zijn geen wijzigingen toegevoegd.');
        }

        if ($this->model->save($department)) {
            return redirect()->route('departments_show', [$id])
                ->with('info', 'Record is gewijzigd.');
        } else {
            return redirect()->Back()
                ->with('errors', $this->model->errors())
                ->withInput();
        }
    }

    public function delete($id = null)
    {
        $department = $this->getDepartmentOr404($id);

        if ($this->request->getMethod() === 'post') {

            $this->model->delete($id);

            return redirect()->route('departments')
                ->with('info', 'Record verwijderd.');
        }

        return view('Admin/Departments/delete', [
            'department' => $department
        ]);
    }

    private function getDepartmentOr404($id = null)
    {
        $department = $this->model->getDepartmentById($id);

        if ($department === null) {

            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kan de record met ID niet vinden.');
        }

        return $department;
    }

    function htmlToPDF($id)
    {

        $data = [
            'title' => $this->title,
            'department' => $this->getDepartmentOr404($id),
        ];

        $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        $html = view('Admin/Departments/html_to_pdf', $data);
        $mpdf->WriteHTML($html);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('arjun.pdf', 'I');
    }
}
