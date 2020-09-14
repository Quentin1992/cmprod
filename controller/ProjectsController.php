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

    public function countProjects($category){
        if($category == "video")
            $where = " WHERE project_category = 'video'";
        elseif($category == "motionDesign")
            $where = " WHERE project_category = 'motionDesign'";
        else $where = "";
        return $this->goCountProjects($where);
    }

    public function getProjects($category, $pageNumber, $projectsPerPage){
        if($category == "video")
            $where = " WHERE project_category = 'video'";
        elseif($category == "motionDesign")
            $where = " WHERE project_category = 'motionDesign'";
        else $where = "";
        if($pageNumber != undefined){
            if($pageNumber > 1)
                $offset = " OFFSET " . $projectsPerPage * ($pageNumber - 1);
            else $offset = "";
            $limit = " LIMIT " . $projectsPerPage . $offset;
        } else $limit = " LIMIT " . $projectsPerPage;
        $projects = $this->goGetProjects($where, $limit);
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
