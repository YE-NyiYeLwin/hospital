<?php

//data.php

$connect = mysqli_connect('localhost','root','','db_draft');

if(isset($_POST["action"]))
{

    if($_POST["action"] == 'fetch')
    {
        $query = "
        SELECT dp.Name, COUNT(d.ID) AS Total 
        FROM dbdoctor d,dbdepartment dp
        WHERE d.DepartmentID=dp.ID
        GROUP BY DepartmentID
        ";

        $result = $connect->query($query);

        $data = array();

        foreach($result as $row)
        {
            $data[] = array(
                'DepartmentID'      =>  $row["Name"],
                'total'         =>  $row["Total"],
                'color'         =>  '#' . rand(100000, 999999) . ''
            );
        }

        echo json_encode($data);
    }
    if($_POST["action"] == 'pie')
    {
        $query = "
        SELECT dp.companyname, COUNT(d.ID) AS Total 
        FROM dbproduct d,dbsupplier dp
        WHERE d.suppliername=dp.ID
        GROUP BY suppliername
        ";

        $result = $connect->query($query);

        $data = array();

        foreach($result as $row)
        {
            $data[] = array(
                'companyname'      =>  $row["companyname"],
                'total'         =>  $row["Total"],
                'color'         =>  '#' . rand(100000, 999999) . ''
            );
        }

        echo json_encode($data);
    }
    if($_POST["action"] == 'bar')
    {
        $query = "
        SELECT date, SUM(totalprice) AS Total 
        FROM dbsale
        GROUP BY date LIMIT 7
        ";

        $result = $connect->query($query);

        $data = array();

        foreach($result as $row)
        {
            $data[] = array(
                'date'      =>  $row["date"],
                'total'         =>  $row["Total"],
                'color'         =>  '#' . rand(100000, 999999) . ''
            );
        }

        echo json_encode($data);
    }
    if($_POST["action"] == 'bar2')
    {
        $query = "
        SELECT date, SUM(ID) AS Total 
        FROM dbappointment
        GROUP BY date LIMIT 7
        ";

        $result = $connect->query($query);

        $data = array();

        foreach($result as $row)
        {
            $data[] = array(
                'date'      =>  $row["date"],
                'total'         =>  $row["Total"],
                'color'         =>  '#' . rand(100000, 999999) . ''
            );
        }

        echo json_encode($data);
    }
}

?>