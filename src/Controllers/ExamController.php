<?php
require_once __DIR__ . '/../Models/Empleado.php';
require_once __DIR__ . '/../Models/Persona.php';
require_once __DIR__ . '/../Models/UsuarioRepo.php';
require_once __DIR__ . '/../Models/RepoInterface.php';
class ExamController extends Controller
{
    public function index()
    {
        $topics = $this->getTopics();

        return $this->render('exam', [
            'title' => 'Examen POO (Sferea)',
            'topics' => $topics
        ]);
    }

    public function run()
    {
        $e = $_GET['e'] ?? '';
        $out = "";

        switch ($e) {
            case 'constructor':
                $p = new Persona("César");
                $out = "Se creó Persona con nombre: " . $p->nombre;
                break;

            case 'metodo':
                $p = new Persona("César");
                $out = $p->saludar();
                break;

            case 'herencia':
                $emp = new Empleado("César", "Dev PHP", 1500);
                $out = $emp->info();
                break;

            case 'excepcion':
                try {
                    $edad = -1;
                    if ($edad < 0) {
                        throw new Exception("La edad no puede ser negativa");
                    }
                    $out = "Edad OK";
                } catch (Exception $ex) {
                    $out = "Catch: " . $ex->getMessage();
                }
                break;

            case 'interfaz':
                $repo = new UsuarioRepo(); // ✅ implementa RepoInterface
                $out = "Usuarios: " . json_encode($repo->all()) . "\n";
                $out .= "Usuario id=2: " . $this->nombreUsuarioPorId($repo, 2);
                break;

            case 'abstracta':
                $emp = new Empleado("César", "Dev PHP", 1500);
                $out = "Pago del empleado: " . $emp->calcularPago();
                break;

            case 'this_super':
                $out = "En PHP: this = \$this (objeto actual). 'super' no existe como en Java; se usa parent:: para llamar al padre.";
                break;

            default:
                $out = "Ejemplo no encontrado. Regresa y da clic en Ejecutar.";
                break;
        }

        return "<p><a href='/'>← Regresar</a></p><pre>" . htmlspecialchars($out) . "</pre>";
    }

    // ✅ AQUÍ se “usa” la interfaz de verdad:
    // este método NO depende de UsuarioRepo, depende del CONTRATO RepoInterface
    private function nombreUsuarioPorId(RepoInterface $repo, int $id): string
    {
        $u = $repo->findById($id);
        return $u ? $u["nombre"] : "no existe"; // 👈 ojo: tu array usa "nombre"
    }

    private function getTopics(): array
    {
        return [
            [
                "id" => "constructor",
                "title" => "1) Constructor",
                "def" => "Método especial que se ejecuta al crear un objeto. Sirve para inicializar propiedades.",
                "code" => "class Persona {\n  public \$nombre;\n  public function __construct(\$nombre){\n    \$this->nombre = \$nombre;\n  }\n}\n\$p = new Persona('César');"
            ],
            [
                "id" => "metodo",
                "title" => "2) Método",
                "def" => "Función dentro de una clase. Define el comportamiento del objeto.",
                "code" => "public function saludar(){\n  return 'Hola mi nombre es ' . \$this->nombre;\n}"
            ],
            [
                "id" => "herencia",
                "title" => "3) Herencia",
                "def" => "Una clase hija hereda de una clase padre usando extends. Puede reutilizar y extender su comportamiento.",
                "code" => "class Trabajador extends Persona {}\nclass Empleado extends Trabajador {}"
            ],
            [
                "id" => "excepcion",
                "title" => "4) Excepción",
                "def" => "Error controlado. Se lanza con throw y se maneja con try/catch.",
                "code" => "try {\n  throw new Exception('Error');\n} catch(Exception \$e){\n  echo \$e->getMessage();\n}"
            ],
            [
                "id" => "interfaz",
                "title" => "5) Interfaz",
                "def" => "Contrato que obliga a una clase a implementar métodos. Permite programar contra el contrato y no contra una clase.",
                "code" => "interface RepoInterface {\n  public function all(): array;\n  public function findById(int \$id): ?array;\n}\nclass UsuarioRepo implements RepoInterface { /* ... */ }"
            ],
            [
                "id" => "abstracta",
                "title" => "6) Clase abstracta",
                "def" => "No se puede instanciar. Sirve como base y obliga a implementar métodos abstractos.",
                "code" => "abstract class Trabajador extends Persona {\n  abstract public function calcularPago(): float;\n}\nclass Empleado extends Trabajador {\n  public function calcularPago(): float { return 1500; }\n}"
            ],
            [
                "id" => "this_super",
                "title" => "7) This y Super",
                "def" => "En PHP, this es \$this. 'super' como Java no existe; para el padre se usa parent::",
                "code" => "\$this->nombre = 'César';\nparent::__construct(\$nombre);"
            ],
        ];
    }
}
