<?php

namespace Emeka\Fetcher\Helpers;

use Emeka\Fetcher\Base\BaseClass;
use Emeka\Fetcher\Database\Connections\Connect;

class Insert
{



    public function insert ( $table, $properties )
     {

        $sql = "INSERT INTO $table (";
        $insertColumns = "";
        $insertValues = "";
        $count = 0;

        foreach ($properties as $key => $value)
        {
            if($key === 'id')
            {
                continue;
            }
            ++$count;
            $insertColumns .= $key;
            $insertValues .= ":".$key;
            if( $count < count( $properties ) )
            {
                $insertValues .= ", ";
                $insertColumns .= ", ";
            }
        }

        $sql .= $insertColumns .") VALUES(". $insertValues .")";
        $connection = $this->connect();
        $statement = $connection->prepare($sql);

        foreach ($properties as $key => $value)
        {
            $statement->bindValue(":".$key, $value);
        }

        $statement->execute();
        return $sql;
    }

}
