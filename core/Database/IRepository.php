<?php

namespace Core\Database;

interface IRepository
{
    public function get($id);
    public function getAll();
    public function create($data);
    // public function update($id, $data);
    public function delete($id);
}