<?php

namespace App\Models;

class DataLayer {

    public function listProjects($filters = [])
    {
        $query = Project::with(['category', 'association', 'user']);
        
        // Apply filters if provided
        if (!empty($filters)) {
            if (isset($filters['search'])) {
                $query->search($filters['search']);
            }
            if (isset($filters['category_id'])) {
                $query->byCategory($filters['category_id']);
            }
            if (isset($filters['association_id'])) {
                $query->byAssociation($filters['association_id']);
            }
            if (isset($filters['location'])) {
                $query->byLocation($filters['location']);
            }
            if (isset($filters['status'])) {
                $query->byStatus($filters['status']);
            }
        }
        
        return $query->get();
    }

    public function getFeaturedProjects($limit = 6)
    {
        // Recupera progetti pubblicati in ordine casuale
        return Project::where('status', 'published')
                    ->inRandomOrder()
                    ->limit($limit)
                    ->get();
    }

    public function findAuthorById($id) {
        return User::find($id)->where('role', 'project_admin')->first();
    }

    public function findProjectById($id) {
        return Project::find($id);
    }

    public function addProject($data) {
        $project = new Project();
        $project->fill($data);
        $project->save();
        return $project;
    }

    public function editProject($id, $data) {
        $project = Project::find($id);
        if ($project) {
            $project->fill($data);
            $project->save();
            return $project;
        }
        return null;
    }

    public function deleteProject($id) {
        $project = Project::find($id);
        if ($project) {
            $project->delete();
            return true;
        }
        return false;
    }

    public function listCategories() {
        return Category::orderBy('tag', 'asc')->get();
    }

    public function listAssociations() {
        return Association::orderBy('name', 'asc')->get();
    }
  
}