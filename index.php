<?php

session_start();

require_once('config/DatabaseClass.php');

$database = new DatabaseClass();

    $msg = '';
    $err = 'No data available in table';
    
    if(isset($_POST['submit'])) {
        $filename = $_FILES['file']['name'];
        $fileTmpName = $_FILES['file']['tmp_name'];
        $path = 'files/'.$filename;

        $sql = "INSERT INTO filedownload (filename) VALUES (:filename)";
        $stmt = $database->Insert($sql, ['filename' => $filename]);

        if ($stmt) {
            move_uploaded_file($fileTmpName, $path);
            $msg = 'Uploaded Successfully';
        }
    }
?>

<?php
include_once('shared/header.php');
?>

<div class="container-fluid">
    <form class="form-inline" action="index.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="file" class="m-2">File: </label>
            <input type="file" class="form-control m2" name="file" id="file" />
        </div>
        <button type="submit" class="btn btn-primary m-2" name="submit">Upload</button>
    </form>
</div>
<h3 class="m-3">FILES</h3>
<?php
    if ($msg) {
        ?>
<div class="alert alert-success text-center" role="alert">
    <?php echo $msg ?>
</div>
<?php
    }
    ?>
<table class="table striped bordered hover">
    <thead>
        <tr>
            <th>#</th>
            <th>File name</th>
            <th>Uploaded Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $statement = "SELECT * FROM filedownload";
        $result = $database->Read($statement);
        $i = 1;
        foreach ($result as $singlefile) {
        ?>
        <tr>
            <td><?php echo $i ?></td>
            <td><?php echo $singlefile['filename']; ?></td>
            <td><?php echo $singlefile['added_on']; ?></td>
            <td>
                <a class="btn btn-success m-1"
                    href="download.php?file=<?php echo $singlefile['filename']; ?>">Download</a>
                <?php
                    if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != '')
                    {
                ?>
                <a class="btn btn-danger m-1" href="delete.php?file=<?php echo $singlefile['filename']; ?>">Delete</a>
                <?php
                    }else {
                ?>
                <a class="btn btn-danger m-1" style="opacity: 0.5;" href="login.php">Delete</a>
                <?php
                    }
                ?>
            </td>
        </tr>
        <?php
                $i++;
            }
        ?>
    </tbody>
</table>


<?php
include_once('shared/footer.php');
?>