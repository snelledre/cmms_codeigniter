<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Modules\Breadcrumbs\Breadcrumbs;
use App\Models\JobtypeModel;
use App\Entities\Jobtype;
use Mpdf\Mpdf;

class JobtypesController extends BaseController
{
    public $breadcrumb;
    private $model;
    private $title;

    public function __construct()
    {
        $this->model = New JobtypeModel();
        $this->title = 'Taak type';
        $this->breadcrumb = new Breadcrumbs();
        $this->breadcrumb->add('Cmms', '/');
        $this->breadcrumb->add('Taak type', url_to("jobtypes"));
    }

    public function index()
    {        
        $this->breadcrumb->add('Lijst', ' ');

        $data = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumb->render(),
            'jobtypes' => $data = $this->model->findAll(),
        ];

        echo view('Admin/Jobtypes/index', $data);
    }

    public function new()
    {
        $this->breadcrumb->add('Nieuw', ' ');

        $data = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumb->render(),
            'jobtype' => new Jobtype(),
        ];

        echo view('Admin/Jobtypes/new', $data);
    }

    public function create()
    {
        $jobtype = new Jobtype($this->request->getPost());

        if ($this->model->save($jobtype)) {

            return redirect()->route('jobtypes', [$this->model->insertID])
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
            'jobtype' => $this->getJobtypeOr404($id),
        ];

        echo view('Admin/Jobtypes/show', $data);
    }

    public function edit($id = null)
    {
        $this->breadcrumb->add('Bewerken', ' ');

        $data = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumb->render(),
            'jobtype' => $this->getJobtypeOr404($id),
        ];

        echo view('Admin/Jobtypes/edit', $data);
    }

    public function update($id = null)
    {
        $jobtype = $this->getJobtypeOr404($id);

        $post = $this->request->getPost();

        $jobtype->fill($post);

        if ( ! $jobtype->hasChanged()) {
            return redirect()->route('jobtypes_show', [$id])
                ->with('warning', 'Er zijn geen wijzigingen toegevoegd.');
        }

        if ($this->model->save($jobtype)) {
            return redirect()->route('jobtypes_show', [$id])
                ->with('info', 'Record is gewijzigd.');
        } else {
            return redirect()->Back()
                ->with('errors', $this->model->errors())
                ->withInput();
        }
    }

    public function delete($id = null)
    {
        $jobtype= $this->getJobtypeOr404($id);

        if ($this->request->getMethod() === 'post') {

            $this->model->delete($id);

            return redirect()->route('jobtypes')
                ->with('info', 'Record verwijderd.');
        }

        return view('Admin/Jobtypes/delete', [
            'jobtype' => $jobtype
        ]);
    }

    private function getJobtypeOr404($id = null)
    {
        $task = $this->model->getJobtypeById($id);

        if ($task === null) {

            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kan de record met ID niet vinden.');

        }

        return $task;
    }

    function htmlToPDF($id){

        $data = [
            'title' => $this->title,
            'jobtype' => $this->getJobtypeOr404($id),
        ];

        $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        $html = view('Admin/Jobtypes/html_to_pdf', $data);
        $mpdf->WriteHTML($html);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('arjun.pdf','I');
    }
}
