<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Modules\Breadcrumbs\Breadcrumbs;
use App\Models\MachineModel;
use App\Entities\Machine;
use App\Models\LocationModel;
use Mpdf\Mpdf;

class MachinesController extends BaseController
{
    public $breadcrumb;
    private $model;
    private $locationmodel;
    private $title;

    public function __construct()
    {
        $this->model = New MachineModel();
        $this->locationmodel = New LocationModel();
        $this->title = 'Machines';
        $this->breadcrumb = new Breadcrumbs();
        $this->breadcrumb->add('Cmms', '/');
        $this->breadcrumb->add('Machines', url_to("machines"));
    }

    public function index()
    {
        $this->breadcrumb->add('Lijst', ' ');

        $data = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumb->render(),
            'machines' => $this->model->getMachines(),
        ];

        echo view('Admin/Machines/index', $data);
    }

    public function new()
    {
        $this->breadcrumb->add('Nieuw', ' ');

        $data = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumb->render(),
            'machine' => new Machine(),
            'locations' => $this->locationmodel->findAll(),
        ];

        echo view('Admin/Machines/new', $data);
    }

    public function create()
    {
        $machine = new Machine($this->request->getPost());

        if ($this->model->save($machine)) {

            return redirect()->route('machines', [$this->model->insertID])
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
            'machine' => $this->getMachineOr404($id),
        ];

        echo view('Admin/Machines/show', $data);
    }

    public function edit($id = null)
    {
        $this->breadcrumb->add('Bewerken', ' ');

        $data = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumb->render(),
            'machine' => $this->getMachineOr404($id),
            'locations' => $this->locationmodel->findAll(),
        ];

        echo view('Admin/Locations/edit', $data);
    }

    public function update($id = null)
    {
        $machine = $this->getMachineOr404($id);

        $post = $this->request->getPost();

        $machine->fill($post);

        if ( ! $machine->hasChanged()) {
            return redirect()->route('machines_show', [$id])
                ->with('warning', 'Er zijn geen wijzigingen toegevoegd.');
        }

        if ($this->model->save($machine)) {
            return redirect()->route('machines_show', [$id])
                ->with('info', 'Record is gewijzigd.');
        } else {
            return redirect()->Back()
                ->with('errors', $this->model->errors())
                ->withInput();
        }
    }

    public function delete($id = null)
    {
        $location= $this->getMachineOr404($id);

        if ($this->request->getMethod() === 'post') {

            $this->model->delete($id);

            return redirect()->route('machines')
                ->with('info', 'Record verwijderd.');
        }

        return view('Admin/Machines/delete', [
            'location' => $location
        ]);
    }

    private function getMachineOr404($id = null)
    {
        $machine = $this->model->getMachineById($id);

        if ($machine === null) {

            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kan de record met ID niet vinden.');

        }

        return $machine;
    }

    function htmlToPDF($id){

        $data = [
            'title' => $this->title,
            'machine' => $this->getMachineOr404($id),
        ];

        $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        $html = view('Admin/Machines/html_to_pdf', $data);
        $mpdf->WriteHTML($html);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('arjun.pdf','I');
    }
}
