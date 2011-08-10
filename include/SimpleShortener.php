<?php
require_once 'config.php';
		
class SimpleShortener
{
	var $db;
	
	function SimpleShortener()
	{
		try
		{
			$this->db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);	
		}
		catch (PDOException $e)
	    {
		    echo $e->getMessage();
	    }
	}
	
	function getUrl($base36)
	{
		$id = base_convert($base36, 36, 10);
		try
		{
			$stmt = $this->db->prepare('SELECT * FROM links WHERE id = :id');
			$stmt->bindParam(':id', $id);
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
			$stmt->execute();
			if ($row = $stmt->fetch()) return $row['longurl'];
		}
		catch (PDOException $e)
	    {
		    echo $e->getMessage();
	    }
		return null;
	}
	
	function create($longUrl)
	{
		try
		{
			$stmt = $this->db->prepare('INSERT INTO links(longurl) VALUES(:longurl)');
			$stmt->bindParam(':longurl', $longUrl);
			$stmt->execute();
			return base_convert($this->db->lastInsertId(), 10, 36);
		}
		catch (PDOException $e)
	    {
		    echo $e->getMessage();
	    }
		return null;
	}
		
	function update($base36, $longUrl)
	{
		$id = base_convert($base36, 36, 10);
		try
		{
			$stmt = $this->db->prepare('UPDATE links SET longurl = :longurl WHERE id = :id');
			$stmt->bindParam(':id', $id);
			$stmt->bindParam(':longurl', $longUrl);
			$count = $stmt->execute();
		}
		catch (PDOException $e)
	    {
		    echo $e->getMessage();
	    }
	    if ($count) return $base36;
	    return null;
	}
}
?>