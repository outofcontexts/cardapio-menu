<?php
header('Content-Type: text/plain; charset=utf-8');
error_reporting(E_ALL);
ini_set('display_errors', 1);

class PratoDoCardapio {
    public $id;
    public $nome;
    public $descricao;
    public $tempo_preparo;
    public $preco;
    public $tipo;
}

class ConnectionFactory {
    public static function getConnection() {
        $host = 'localhost';
        $dbname = 'restaurante';
        $user = 'root';
        $pass = '1234';
        try {
            return new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        } catch (PDOException $e) {
            die("Erro na conexão: " . $e->getMessage());
        }
    }
}

class PratoDAO {
    private $conn;
    public function __construct() {
        $this->conn = ConnectionFactory::getConnection();
    }

    public function listarTodos() {
        $stmt = $this->conn->query("SELECT * FROM pratos ORDER BY tipo, nome");
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'PratoDoCardapio');
    }

    public function salvar(PratoDoCardapio $prato) {
        $sql = "INSERT INTO pratos (nome, descricao, tempo_preparo, preco, tipo) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $prato->nome,
            $prato->descricao,
            $prato->tempo_preparo,
            $prato->preco,
            $prato->tipo
        ]);
    }

    public function editar(PratoDoCardapio $prato) {
        $sql = "UPDATE pratos SET nome=?, descricao=?, tempo_preparo=?, preco=?, tipo=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $prato->nome,
            $prato->descricao,
            $prato->tempo_preparo,
            $prato->preco,
            $prato->tipo,
            $prato->id
        ]);
    }

    public function excluirPorIds(array $ids) {
        $in = implode(',', array_fill(0, count($ids), '?'));
        $stmt = $this->conn->prepare("DELETE FROM pratos WHERE id IN ($in)");
        return $stmt->execute($ids);
    }
}

function validarDados($dados) {
    $erros = [];
    if (!isset($dados['nome']) || trim($dados['nome']) === '') $erros[] = "Nome é obrigatório.";
    if (!isset($dados['descricao']) || trim($dados['descricao']) === '') $erros[] = "Descrição é obrigatória.";
    if (!isset($dados['tempo']) || !is_numeric($dados['tempo']) || $dados['tempo'] < 0) $erros[] = "Tempo inválido.";
    if (!isset($dados['preco']) || !is_numeric($dados['preco']) || $dados['preco'] < 0) $erros[] = "Preço inválido.";
    if (!isset($dados['tipo']) || !in_array($dados['tipo'], ['salgado', 'sobremesa'])) $erros[] = "Tipo inválido.";
    return $erros;
}

$dao = new PratoDAO();

// Adicionar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !isset($_GET['editar'])) {
    $erros = validarDados($_POST);
    if ($erros) {
        echo "Erros ao adicionar:\n";
        foreach ($erros as $e) echo "- $e\n";
        exit;
    }

    $prato = new PratoDoCardapio();
    $prato->nome = $_POST['nome'];
    $prato->descricao = $_POST['descricao'];
    $prato->tempo_preparo = $_POST['tempo'];
    $prato->preco = $_POST['preco'];
    $prato->tipo = $_POST['tipo'];

    $dao->salvar($prato) ? print("✅ Prato adicionado com sucesso.\n") : print("❌ Falha ao adicionar.\n");
    exit;
}

// Editar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['editar'])) {
    $id = (int) $_GET['editar'];
    $erros = validarDados($_POST);
    if ($erros) {
        echo "Erros ao editar:\n";
        foreach ($erros as $e) echo "- $e\n";
        exit;
    }

    $prato = new PratoDoCardapio();
    $prato->id = $id;
    $prato->nome = $_POST['nome'];
    $prato->descricao = $_POST['descricao'];
    $prato->tempo_preparo = $_POST['tempo'];
    $prato->preco = $_POST['preco'];
    $prato->tipo = $_POST['tipo'];

    $dao->editar($prato) ? print("✅ Prato editado com sucesso.\n") : print("❌ Falha ao editar.\n");
    exit;
}

// Remover múltiplos: ?remover=1,2,3
if (isset($_GET['remover'])) {
    $ids = explode(',', $_GET['remover']);
    $ids = array_filter($ids, fn($id) => is_numeric($id));
    if ($ids) {
        $dao->excluirPorIds($ids) ? print("🗑️ Pratos removidos: " . implode(', ', $ids) . "\n") : print("❌ Erro ao remover.\n");
    } else {
        echo "Nenhum ID válido informado para remoção.\n";
    }
    exit;
}

$pratos = $dao->listarTodos();
if (!$pratos) {
    echo "Nenhum prato cadastrado.\n";
    exit;
}

echo "=== CARDÁPIO ===\n\n";

$salgados = array_filter($pratos, fn($p) => $p->tipo === 'salgado');
$sobremesas = array_filter($pratos, fn($p) => $p->tipo === 'sobremesa');

echo "Salgados:\n";
foreach ($salgados as $p) {
    echo "- [{$p->id}] {$p->nome} ({$p->tempo_preparo} min, R$ " . number_format($p->preco, 2, ',', '.') . ")\n";
    echo "  {$p->descricao}\n\n";
}

echo "Sobremesas:\n";
foreach ($sobremesas as $p) {
    echo "- [{$p->id}] {$p->nome} ({$p->tempo_preparo} min, R$ " . number_format($p->preco, 2, ',', '.') . ")\n";
    echo "  {$p->descricao}\n\n";
}
?>