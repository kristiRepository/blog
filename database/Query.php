<?php



class Query
{

    protected $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function insert($table_name,$attributesArray,$valuesArray)
    {   
        $attributesString=implode(',',$attributesArray);
        $bindArray=array_map(function($attributesArray){
            return ":".$attributesArray;
        },$attributesArray);
        
        $bindString=implode(',',$bindArray);
        $query = "INSERT INTO ".$table_name."(".$attributesString.") values(".$bindString.")";
        $statment = $this->pdo->prepare($query);
        $i=0;
        foreach($bindArray as $bindValue){
            $statment->bindParam($bindValue, $valuesArray[$i], PDO::PARAM_STR);
            $i++; 
        }
       
        $statment->execute();
    }

    public function select($table,$attribute,$attrName)
    {
    $query = "SELECT * FROM ".$table." WHERE {$attrName}='$attribute' ";
        $statment = $this->pdo->prepare($query);
        $statment->execute();
        $results = $statment->fetchAll();
        return $results;
    }

    public function update($table,$attributeChange,$attributeChangeValue,$attrCondition1,$attrCondition2){
        $query="UPDATE ".$table." SET ".$attributeChange." ='$attributeChangeValue' WHERE ".$attrCondition1."='$attrCondition2' ";
        $statment = $this->pdo->prepare($query);
        $statment->execute();
    }

    public function all($table)
    {
        $query = "SELECT * FROM ".$table."";
        $statment = $this->pdo->prepare($query);
        $statment->execute();
        $categories = $statment->fetchAll(PDO::FETCH_CLASS, ucfirst($table));
        return $categories;
    }

    public function delete($table,$attrCondition1,$attrConditionValue){
        $query="DELETE FROM ".$table." WHERE ".$attrCondition1."=".$attrConditionValue." ";
        $statment = $this->pdo->prepare($query);
        $statment->execute();
    }
    public function count($table,$attrCondition1,$attrConditionValue)
    {
        $query = "SELECT COUNT(id) as number   FROM ".$table." WHERE ".$attrCondition1."=".$attrConditionValue." ";
        $statment = $this->pdo->prepare($query);
        $statment->execute();
        $number = $statment->fetchAll();
        return intVal($number[0]['number']);
    }
   






}