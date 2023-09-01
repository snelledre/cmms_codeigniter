<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Modules\Breadcrumbs\Breadcrumbs;
use App\Models\CostcenterModel;
use App\Entities\Costcenter;
use Mpdf\Mpdf;

class CostcentersController extends BaseController
{
    public $breadcrumb;
    private $model;
    private $title;

    public function __construct()
    {
        $this->model = New CostcenterModel();
        $this->title = 'Kostenplaatsen';
        $this->breadcrumb = new Breadcrumbs();
        $this->breadcrumb->add('Cmms', '/');
        $this->breadcrumb->add('Kostenplaatsen', url_to("costcenters"));
    }

    public function index()
    {        
        $this->breadcrumb->add('Lijst', ' ');

        $data = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumb->render(),
            'costcenters' => $data = $this->model->findAll(),
        ];

        echo view('Admin/Costcenters/index', $data);
    }

    public function new()
    {
        $this->breadcrumb->add('Nieuw', ' ');

        $data = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumb->render(),
            'costcenter' => new Costcenter(),
        ];

        echo view('Admin/Costcenters/new', $data);
    }

    public function create()
    {
        $costcenter = new Costcenter($this->request->getPost());

        if ($this->model->save($costcenter)) {

            return redirect()->route('costcenters', [$this->model->insertID])
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
            'costcenter' => $this->getCostcenterOr404($id),
        ];

        echo view('Admin/Costcenters/show', $data);
    }

    public function edit($id = null)
    {
        $this->breadcrumb->add('Bewerken', ' ');

        $data = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumb->render(),
            'costcenter' => $this->getCostcenterOr404($id),
        ];

        echo view('Admin/Costcenters/edit', $data);
    }

    public function update($id = null)
    {
        $costcenter = $this->getCostcenterOr404($id);

        $post = $this->request->getPost();

        $costcenter->fill($post);

        if ( ! $costcenter->hasChanged()) {
            return redirect()->route('costcenters_show', [$id])
                ->with('warning', 'Er zijn geen wijzigingen toegevoegd.');
        }

        if ($this->model->save($costcenter)) {
            return redirect()->route('costcenters_show', [$id])
                ->with('info', 'Record is gewijzigd.');
        } else {
            return redirect()->Back()
                ->with('errors', $this->model->errors())
                ->withInput();
        }
    }

    public function delete($id = null)
    {
        $costcenter= $this->getCostcenterOr404($id);

        if ($this->request->getMethod() === 'post') {

            $this->model->delete($id);

            return redirect()->route('costcenters')
                ->with('info', 'Record verwijderd.');
        }

        return view('Admin/Costcenters/delete', [
            'costcenter' => $costcenter
        ]);
    }

    private function getCostcenterOr404($id = null)
    {
        $task = $this->model->getCostcenterById($id);

        if ($task === null) {

            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kan de record met ID niet vinden.');

        }

        return $task;
    }

    function htmlToPDF($id){

        $data = [
            'title' => $this->title,
            'costcenter' => $this->getCostcenterOr404($id),
        ];

        $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        $html = view('Admin/Costcenters/html_to_pdf', $data);
        $mpdf->WriteHTML($html);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('arjun.pdf','I');
    }
}
