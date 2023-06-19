<?php

namespace Core;

use PDO;

class ORM
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Database::connect_to_db();
    }

    public function create($table, $array)
    {
        $keys = array_keys($array);
        $values = array_values($array);
        $keysStr = implode(', ', $keys);
        $placeholders = implode(', ', array_map(function ($key) {
            return ":{$key}";
        }, $keys));

        $query = $this->pdo->prepare("INSERT INTO {$table} ({$keysStr}) VALUES ({$placeholders})");
        return $query->execute(array_combine($keys, $values));
    }

    public function read($table, $id)
    {
        $query = $this->pdo->prepare("SELECT * FROM {$table} WHERE id = :id");
        $query->execute([':id' => $id]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function update($table, $id, $array)
    {
        $keys = array_keys($array);
        $setStr = implode(', ', array_map(function ($key) {
            return "{$key} = :{$key}";
        }, $keys));

        $query = $this->pdo->prepare("UPDATE {$table} SET {$setStr} WHERE id = :id");
        $params = array_merge([':id' => $id], $array);
        return $query->execute($params);
    }

    public function delete($table, $id)
    {
        echo "DELETE $table ($id)";
        $query = $this->pdo->prepare("DELETE FROM {$table} WHERE id = :id");
        return $query->execute([':id' => $id]);
    }

    private function findById($array, $id)
    {
        $i = 0;
        foreach ($array as $element) {
            if ($element['id'] == $id) {
                return $i;
            }
            $i++;
        }
        return -1;
    }

    public function findAll($table, $params = [], $relations = [])
    {
        $where = isset($params['WHERE']) ? "WHERE " . $params['WHERE'] : '';
        $orderBy = isset($params['ORDER BY']) ? "ORDER BY " . $params['ORDER BY'] : '';
        $limit = isset($params['LIMIT']) ? "LIMIT " . $params['LIMIT'] : '';

        $query = $this->pdo->prepare("SELECT * FROM {$table} {$where} {$orderBy} {$limit}");
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($relations as $relationType => $table2) {
            if ($relationType == 'manyToOne') {
                $query = $this->pdo->prepare("SELECT * FROM {$table2}");
                $query->execute();
                $resultRelation = $query->fetchAll(PDO::FETCH_ASSOC);

                foreach ($resultRelation as $item) {
                    $table1Id = $item["id_{$table}"];
                    $indexToInsert = $this->findById($result, $table1Id);

                    if ($indexToInsert >= 0) {
                        $result[$indexToInsert][$table2][] = $item;
                    }
                }
            } else if ($relationType == 'oneToMany') {
                $query = $this->pdo->prepare("SELECT * FROM {$table2}");
                $query->execute();
                $resultRelation = $query->fetchAll(PDO::FETCH_ASSOC);

                foreach ($result as &$item) {
                    $table2Id = $item["id_{$table2}"];
                    $table2Index = $this->findById($resultRelation, $table2Id);

                    if ($table2Index >= 0) {
                        $item[$table2] = $resultRelation[$table2Index];
                    }
                }
            } else if ($relationType == 'manyToMany') {
                $table_join = ($table < $table2) ? "{$table2}_{$table}" : "{$table}_{$table2}";
                $query = $this->pdo->prepare("SELECT id_{$table}, $table2.* FROM {$table_join} LEFT JOIN $table2 ON {$table_join}.id_{$table2} = $table2.id");
                $query->execute();
                $resultJoin = $query->fetchAll(PDO::FETCH_ASSOC);

                foreach ($resultJoin as $item2) {
                    $table1Id = $item2["id_{$table}"];
                    $indexToInsert = $this->findById($result, $table1Id);

                    if ($indexToInsert >= 0) {
                        unset($item["id_{$table}"]);
                        $result[$indexToInsert]["$table2"][] = $item2;
                    }
                }
            }
        }

        return $result;
    }

    // public function find($table, $params = [], $relations = [])
    // {
    //     $where = isset($params['WHERE']) ? "WHERE " . $params['WHERE'] : '';
    //     $orderBy = isset($params['ORDER BY']) ? "ORDER BY " . $params['ORDER BY'] : '';
    //     $limit = isset($params['LIMIT']) ? "LIMIT " . $params['LIMIT'] : '';
    //     $join = "";

    //     $query = $this->pdo->prepare("SELECT * FROM {$table} {$where} {$orderBy} {$limit}");
    //     $query->execute();
    //     $result = $query->fetch(PDO::FETCH_ASSOC);

    //     foreach ($relations as $relationType => $table2) {

    //         if ($relationType == 'manyToOne') {
    //             $query = $this->pdo->prepare("SELECT * FROM {$table2} WHERE id_{$table} = {$result['id']}");
    //             $query->execute();
    //             $resultRelation = $query->fetchAll(PDO::FETCH_ASSOC);

    //             foreach ($resultRelation as $item) {
    //                 $result[$table2][] = $item;
    //             }
    //         } else if ($relationType == 'oneToMany') {
    //             $query = $this->pdo->prepare("SELECT * FROM {$table2}");
    //             $query->execute();
    //             $resultRelation = $query->fetchAll(PDO::FETCH_ASSOC);

    //             foreach ($result as &$item) {
    //                 $table2Id = $item["id_{$table2}"];
    //                 $table2Index = $this->findById($resultRelation, $table2Id);

    //                 if ($table2Index >= 0) {
    //                     $item[$table2] = $resultRelation[$table2Index];
    //                 }
    //             }
    //         } else if ($relationType == 'manyToMany') {
    //             $table_join = ($table < $table2) ? "{$table}_{$table2}" : "{$table2}_{$table}";
    //             $query = $this->pdo->prepare("SELECT id_{$table}, $table2.* FROM {$table_join} LEFT JOIN $table2 ON {$table_join}.id_{$table2} = $table2.id");
    //             $query->execute();
    //             $resultJoin = $query->fetchAll(PDO::FETCH_ASSOC);

    //             foreach ($resultJoin as $item) {
    //                 $table1Id = $item["id_{$table}"];
    //                 $indexToInsert = $this->findById($result, $table1Id);

    //                 if ($indexToInsert >= 0) {
    //                     unset($item["id_{$table}"]);
    //                     $result[$indexToInsert][$table2][] = $item;
    //                 }
    //             }
    //         }
    //     }

    //     return $result;
    // }
}
