<?php 
   require_once("../lib/db.php");
        print_r($_POST);

$init=null;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $length = sizeof($_POST);
    // echo $length;

    if ($length>0) {
        foreach ($_POST as $val) {
        if (empty($val)||strlen($val)<2) {
            $init=false;
            break;
        }
        }
    }else{
        $init=false;
    }

    if($init !== false){
        $first_name= $_POST["first_name"];
        $last_name= $_POST["last_name"];
        $age= $_POST["age"];
        $password= $_POST["password"];
        $date= $_POST["date"];


        $record=new Record();
        $record->first_name = $first_name;
        $record->last_name = $last_name;
        $record->password = $password;
        $record->age = $age;
        $record->date = $date;
        if (!Record::has('first_name',$first_name, DB_TABLE)) {
            Record::create($record, DB_TABLE);
        }
        $init= true;
    }
}
?>

<?php if($init):?>
    <h1>Welcome <?php echo $first_name?> </h1>
<?php else:?>
    <h1>something went wrong!</h1>
<?php endif?>