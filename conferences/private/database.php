<?php 
  namespace db;
  require_once("db_credentials.php");

  use PDO;
  class db{
    private $db;

    function __construct($host=DB_HOST, $db_name=DB_NAME, $username=DB_USER, $password=DB_PASS){
      try{
        $this->db = new PDO("mysql:host={$host};dbname={$db_name}", DB_USER, DB_PASS);
        $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      }
      catch (PDOException $e){
        error_500();
      }
    }

    function get_conferences(){
      $sql = <<<SQL
        SELECT * FROM `conferences`
        ORDER BY date;
      SQL;
      
      $query = $this->db->query($sql);

      return $query->fetchAll();
    }

    function get_conference($id){
      $sql = <<<SQL
              SELECT * FROM `conferences`
        WHERE id='{$id}'
      SQL;

      $query = $this->db->query($sql);
      return $query->fetch();
    }

    function update_conference($conf){
      $sql = <<<SQL
        UPDATE `conferences` SET
          title=:title,
          date=:date,
          lat=:lat,
          lng=:lng,
          country=:country
        WHERE id=:id
      SQL;

      $query = $this->db->prepare($sql);
      print_r($conf);

      $query = $query->execute($conf);
      return $query;
    }

    function delete_conference($id){
      $sql = <<<SQL
        DELETE FROM `conferences`
        WHERE id='{$id}'
      SQL;

      $query = $this->db->query($sql);
      return $query;
    }

    function create_conference($conf){
      $sql = <<<SQL
        INSERT INTO `conferences` (id, title, date, lat, lng, country)
        VALUES (@uuid:=UUID(), :title, :date, :lat, :lng, :country) 
      SQL;
      $query = $this->db->prepare($sql);
      if (!$conf['lat'] || !$conf['lng']){
        $conf['lat'] = null;
        $conf['lng'] = null;
      }

      $query = $query->execute($conf);

      $sql = "SELECT @uuid";
      $query = $this->db->query($sql);
      return $query->fetch();
    }
  }