<?php

interface RepoInterface
{
    public function all(): array;
    public function findById(int $id): ?array;
}
