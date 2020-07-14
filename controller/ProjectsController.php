<?php
class ProjectsController extends ProjectsManager{

    private $targetDirectory = "public/images/frontend/projects/";

    public function addProject($title, $description, $imgLocation, $url, $category){
        $fileName = basename($imgLocation["name"]);
        $targetFilePath = $this->targetDirectory . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        move_uploaded_file($imgLocation['tmp_name'], $targetFilePath);
        $project = new Project(null, $title, $description, $targetFilePath, $url, $category);
        $this->sendProject($project);
    }

    public function getProjects($category){
        if($category == "video")
            $where = " WHERE project_category = 'video'";
        elseif($category == "motionDesign")
            $where = " WHERE project_category = 'motionDesign'";
        else $where = "";
        $projects = $this->goGetProjects($where);
        $projectsData = [];
        foreach ($projects as $project){
            $projectsData[] = $projectData = array(
                'id' => $project->id(),
                'title' => $project->title(),
                'description' => $project->description(),
                'imgLocation' => $project->imgLocation(),
                'url' => $project->url(),
                'category' => $project->category()
            );
        }
        return json_encode($projectsData);
    }

    public function updateProject($id, $title, $description, $imgLocation, $url, $category){
        $fileName = basename($imgLocation["name"]);
        $targetFilePath = $this->targetDirectory . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
        move_uploaded_file($imgLocation['tmp_name'], $targetFilePath);
        $project = new Project($id, $title, $description, $targetFilePath, $url, $category);
        $this->sendProjectUpdate($project);
    }

    public function deleteProject($id){
        $this->sendProjectDeletion($id);
    }

}
