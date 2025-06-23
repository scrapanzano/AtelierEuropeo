<?php

namespace App\Models;

class DataLayer {

    public function listProjects() {
        $projectsList = Project::orderBy('created_at', 'desc')->get();
        return $projectsList;
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
  
}