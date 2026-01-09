<?php

require_once __DIR__ . '/RepoInterface.php';

class UsuarioRepo implements RepoInterface
{
    private $users = [
        ["id" => 1, "nombre" => "Ana"],
        ["id" => 2, "nombre" => "Luis"],
    ];

    public function all(): array
    {
        return $this->users;
    }

    public function findById(int $id): ?array
    {
        foreach ($this->users as $u) {
            if ($u["id"] === $id) return $u;
        }
        return null;
    }
}
