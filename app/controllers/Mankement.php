<?php
class Mankement extends Controller
{
    private $mankementModel;
    public function __construct()
    {
        $this->mankementModel = $this->model('Mankementen');
    }
    public function index($AutoId = 2)
    {
        $result = $this->mankementModel->getMankement();
        $rows = '';

        foreach ($result as $mankement) {
            $rows .= "<tr>
           <td>$mankement->Datum</td>
           <td>$mankement->Mankement</td>
       </tr>";
        }

        $data = [
            'title' => "Overzicht Mankementen",
            'Email' => "manhoi@gmail.com",
            'Kenteken' => "TH-78-KL --- Ferrari",
            'AutoId' => $AutoId,
            'rows' => $rows
        ];
        $this->view('mankement/index', $data);
    }
    public function create($AutoId = NUll)
    {
        $data = [
            'title' => 'Invoeren Mankement',
            'Kenteken' => "TH-78-KL --- Ferari",
            'AutoId' => $AutoId,
            'MankementError' => ''
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $data = [
                'title' => 'Invoeren Mankement',
                'Kenteken' => "TH-78-KL --- Ferari",
                'AutoId' => $_POST['AutoId'],
                'Mankement' => $_POST['Mankement'],
                'MankementError' => ''
            ];
            $data = $this->validatecreateForm($data);
            if (empty($data['MankementError'])) {
                $result = $this->mankementModel->create($_POST);

                if ($result) {
                    $data['title'] = "<p>Het nieuwe mankement is toegevoegd</p>";
                } else {
                    echo "<p>Het nieuwe mankement is niet toegevoegd</p><br><h1>";
                }
                header('Refresh:2 url=' . URLROOT . '/mankement/index');
                echo "<p>U wordt over 5 seconden terug gestuurd naar het overzicht</p>Het nieuwe mankement is toegevoegd</h1>";
            } else {
                header('Refresh:5 url=' . URLROOT . '/mankement/create/' . $data['AutoId']);
            }
        }
        $this->view('mankement/create', $data);
    }

    private function validatecreateForm($data)
    {
        if (strlen($data['Mankement']) > 50) {
            $data['MankementError'] = "Het nieuwe mankement is meer dan 50 tekens lang en is niet toegevoegd, probeer het opnieuw";
        } elseif (empty($data['Mankement'])) {
            $data['MankementError'] = "U bent verplicht om de mankement invullen";
        }

        return $data;
    }
}
