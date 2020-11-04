<?php
class ProjectsManager extends Database{

    //properties
    private $db;
    public function __construct(){
        $this->db = $this->setDbConnection();
    }

    public function sendProject($project){
        $sql = 'INSERT INTO projects(project_title, project_description, project_img_location, project_url, project_category) VALUES(:title, :description, :imageFile, :url, :category)';
        $query = $this->db->prepare($sql);
        $query->bindValue(':title', $project->title(), PDO::PARAM_STR);
        $query->bindValue(':description', $project->description(), PDO::PARAM_STR);
        $query->bindValue(':imageFile', $project->imageFile(), PDO::PARAM_STR);
        $query->bindValue(':url', $project->url(), PDO::PARAM_STR);
        $query->bindValue(':category', $project->category(), PDO::PARAM_STR);
        $query->execute();
    }

    public function goCountProjects($category){
        if($category == "video")
            $where = " WHERE project_category = 'video'";
        elseif($category == "motionDesign")
            $where = " WHERE project_category = 'motionDesign'";
        else $where = "";
        $sql = 'SELECT COUNT(*) AS number_of_projects FROM projects' . $where;
        $query = $this->db->query($sql);
        $data = $query->fetch(PDO::FETCH_ASSOC);
        return $data['number_of_projects'];
    }

    public function goGetProjects($category, $pageNumber, $projectsPerPage){
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
        $projects = [];
        $sql = 'SELECT * FROM projects' . $where . $limit;
        $query = $this->db->query($sql);
        while($data = $query->fetch(PDO::FETCH_ASSOC)){
            $projects[] = new Project($data['project_id'], $data['project_title'], $data['project_description'], $data['project_img_location'], $data['project_url'], $data['project_category']);
        }
        return $projects;
    }

    public function sendProjectUpdate($project){
        $sql = 'UPDATE projects SET project_title = :title, project_description = :description, project_img_location = :imageFile, project_url = :url, project_category = :category WHERE project_id = :id';
        $query = $this->db->prepare($sql);
        $query->bindValue(':title', $project->title(), PDO::PARAM_STR);
        $query->bindValue(':description', $project->description(), PDO::PARAM_STR);
        $query->bindValue(':imageFile', $project->imageFile(), PDO::PARAM_STR);
        $query->bindValue(':url', $project->url(), PDO::PARAM_STR);
        $query->bindValue(':category', $project->category(), PDO::PARAM_STR);
        $query->bindValue(':id', $project->id(), PDO::PARAM_INT);
        $query->execute();
    }

    public function sendProjectDeletion($id){
        $query = $this->db->exec('DELETE FROM projects WHERE project_id = ' . $id);
    }

}
