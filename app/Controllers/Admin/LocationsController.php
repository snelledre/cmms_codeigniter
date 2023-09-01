<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Modules\Breadcrumbs\Breadcrumbs;
use App\Models\LocationModel;
use App\Entities\Location;
use Mpdf\Mpdf;

class LocationsController extends BaseController
{
    public $breadcrumb;
    private $model;
    private $title;

    public function __construct()
    {
        $this->model = New LocationModel();
        $this->title = 'Locaties';
        $this->breadcrumb = new Breadcrumbs();
        $this->breadcrumb->add('Cmms', '/');
        $this->breadcrumb->add('Locaties', url_to("locations"));
    }

    public function index()
    {
        $this->breadcrumb->add('Lijst', ' ');

        if($this->request->getGet('q')) {
            $q = $this->request->getGet('q');
            $locations = $this->model->getLocationByName($q);
        } else {
            $locations = $this->model->paginate(10, 'page');;
        }

        $data = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumb->render(),
            'locations' => $locations,
            'pager' => $this->model->pager
        ];

        echo view('Admin/Locations/index', $data);
    }

    public function new()
    {
        $this->breadcrumb->add('Nieuw', ' ');

        $data = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumb->render(),
            'location' => new Location(),
        ];

        echo view('Admin/Locations/new', $data);
    }

    public function create()
    {
        $location = new Location($this->request->getPost());

        if ($this->model->save($location)) {

            return redirect()->route('locations', [$this->model->insertID])
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
            'location' => $this->getLocationOr404($id),
        ];

        echo view('Admin/Locations/show', $data);
    }

    public function edit($id = null)
    {
        $this->breadcrumb->add('Bewerken', ' ');

        $data = [
            'title' => $this->title,
            'breadcrumbs' => $this->breadcrumb->render(),
            'location' => $this->getLocationOr404($id),
        ];

        echo view('Admin/Locations/edit', $data);
    }

    public function update($id = null)
    {
        $location = $this->getLocationOr404($id);

        $post = $this->request->getPost();

        $location->fill($post);

        if ( ! $location->hasChanged()) {
            return redirect()->route('locations_show', [$id])
                ->with('warning', 'Er zijn geen wijzigingen toegevoegd.');
        }

        if ($this->model->save($location)) {
            return redirect()->route('locations_show', [$id])
                ->with('info', 'Record is gewijzigd.');
        } else {
            return redirect()->Back()
                ->with('errors', $this->model->errors())
                ->withInput();
        }
    }

    public function delete($id = null)
    {
        $location= $this->getLocationOr404($id);

        if ($this->request->getMethod() === 'post') {

            $this->model->delete($id);

            return redirect()->route('locations')
                ->with('info', 'Record verwijderd.');
        }

        return view('Admin/Locations/delete', [
            'location' => $location
        ]);
    }

    private function getLocationOr404($id = null)
    {
        $location = $this->model->getLocationById($id);

        if ($location === null) {

            throw new \CodeIgniter\Exceptions\PageNotFoundException('Kan de record met ID niet vinden.');

        }

        return $location;
    }

    function htmlToPDF($id){

        $data = [
            'title' => $this->title,
            'location' => $this->getLocationOr404($id),
        ];

        $mpdf = new Mpdf(['mode' => 'utf-8', 'format' => 'A4-P']);
        $html = view('Admin/Locations/html_to_pdf', $data);
        $mpdf->WriteHTML($html);
        $this->response->setHeader('Content-Type', 'application/pdf');
        $mpdf->Output('arjun.pdf','I');
    }
}
