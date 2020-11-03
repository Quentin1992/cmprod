<?php
class ProjectsController extends ProjectsManager{

    private $targetDirectory = "public/images/frontend/projects/";

    //CREATE

    public function addProject($title, $description, $imageFile, $url, $category){
        $fileName = pathinfo($imageFile["name"],PATHINFO_FILENAME);
        $fileType = pathinfo($imageFile["name"],PATHINFO_EXTENSION);
        if($fileType == 'svg'){
            $targetFilePath = $this->targetDirectory . $fileName . ".svg";
            move_uploaded_file($imageFile['tmp_name'], $targetFilePath);
        }
        else {
            $targetFilePath = $this->targetDirectory . $fileName . ".webp";
            if ($fileType == 'jpeg' || $fileType == 'jpg')
                $image = imagecreatefromjpeg($imageFile['tmp_name']);
    	    elseif ($fileType == 'gif')
                $image = imagecreatefromgif($imageFile['tmp_name']);
    	    elseif ($fileType == 'png')
                $image = imagecreatefrompng($imageFile['tmp_name']);
            imagewebp($image, $targetFilePath, 100);
        }
        $project = new Project(null, $title, $description, $targetFilePath, $url, $category);
        $this->sendProject($project);
    }

    //READ

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
                'imageFile' => $project->imageFile(),
                'url' => $project->url(),
                'category' => $project->category()
            );
        }
        return json_encode($projectsData);
    }

    //UPDATE

    public function updateProject($id, $title, $description, $imageFile, $url, $category){
        $fileName = pathinfo($imageFile["name"],PATHINFO_FILENAME);
        $fileType = pathinfo($imageFile["name"],PATHINFO_EXTENSION);
        if($fileType == 'svg'){
            $targetFilePath = $this->targetDirectory . $fileName . ".svg";
            move_uploaded_file($imageFile['tmp_name'], $targetFilePath);
        }
        else {
            $targetFilePath = $this->targetDirectory . $fileName . ".webp";
            if ($fileType == 'jpeg' || $fileType == 'jpg')
                $image = imagecreatefromjpeg($imageFile['tmp_name']);
    	    elseif ($fileType == 'gif')
                $image = imagecreatefromgif($imageFile['tmp_name']);
    	    elseif ($fileType == 'png')
                $image = imagecreatefrompng($imageFile['tmp_name']);
            imagewebp($image, $targetFilePath, 100);
        }
        $project = new Project($id, $title, $description, $targetFilePath, $url, $category);
        $this->sendProjectUpdate($project);
    }

    //DELETE

    public function deleteProject($id){
        $this->sendProjectDeletion($id);
    }

}
