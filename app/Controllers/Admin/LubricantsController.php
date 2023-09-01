<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Modules\Breadcrumbs\Breadcrumbs;
use App\Models\LubricantModel;
use App\Entities\Lubricant;
use Mpdf\Mpdf;

class LubricantsController extends BaseController
{
    public $breadcrumb;
    private $model;
    private $title;

    public function __construct()
    {
        $this->model = New LubricantModel();
        $this->title = 'Smeermiddelen';
        $this->breadcrumb = new Breadcrumbs();
        $this->breadcrumb->add('Cmms', '/');
        $this->breadcrumb->add('Smeermiddelen', url_to("lubricants"));
    }

    public function index()
    {        
        $this->breadcrumb->add('Lijst', ' ');

        $data = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumb->render(),
            'lubricants' => $data = $this->model->findAll(),
        ];

        echo view('Admin/Lubricants/index', $data);
    }

    public function new()
    {
        $this->breadcrumb->add('Nieuw', ' ');

        $data = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumb->render(),
            'lubricant' => new Lubricant(),
        ];

        echo view('Admin/Lubricants/new', $data);
    }

    public function create()
    {
        $lubricant = new Lubricant($this->request->getPost());

        if ($this->model->save($lubricant)) {

            return redirect()->route('lubricants_show', [$this->model->insertID])
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
            'lubricant' => $this->getLubricantOr404($id),
        ];

        echo view('Admin/Lubricants/show', $data);
    }

    public function edit($id = null)
    {
        $this->breadcrumb->add('Bewerken', ' ');

        $data = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumb->render(),
            'lubricant' => $this->getLubricantOr404($id),
        ];

        echo view('Admin/Lubricants/edit', $data);
    }

    public function update($id = null)
    {
        $lubricant = $this->getLubricantOr404($id);

        $post = $this->request->getPost();

        $lubricant->fill($post);

        if ( ! $lubricant->hasChanged()) {
            return redirect()->route('lubricants_show', [$id])
                ->with('warning', 'Er zijn geen wijzigingen toegevoegd.');
        }

        if ($this->model->save($lubricant)) {
            return redirect()->route('lubricants_show', [$id])
                ->with('info', 'Record is gewijzigd.');
        } else {
            return redirect()->Back()
                ->with('errors', $this->model->errors())
                ->withInput();
        }
    }

    public function delete($id = null)
    {
        $lubricant= $this->getLubricantOr404($id);

        if ($this->request->getMethod() === 'post') {

            $this->model->delete($id);

            return redirect()->route('lubricants')
                ->with('info', 'Record verwijderd.');
        }

        return view('Admin/Lubricants/delete', [
            'jobtype' => $lubricant
        ]);
    }

    private function getLubricantOr404($id = null)
    {
        $task = $this->model->getLubricantById($id);

        if ($task === null) {

            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kan de record met ID niet vinden.');

        }

        return $task;
    }

    function htmlToPDF($id){

        $data = [
            'title' => $this->title,
            'lubricant' => $this->getLubricantOr404($id),
        ];

        $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        $html = view('Admin/Lubricants/html_to_pdf', $data);
        $mpdf->WriteHTML($html);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('arjun.pdf','I');
    }
}
