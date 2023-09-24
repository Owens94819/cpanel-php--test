<?php
//test
   require_once("lib/db.php");
   create_table(DB_TABLE);
   $DB_TABLE=DB_TABLE;

   $record=new Record();
   $record->first_name = 'John';
   $record->last_name = 'Doe';
   $record->password = 'hashed_password';
   $record->age = 30;
   $record->date = '1993-09-24';
   // if (!Record::has('first_name','john', DB_TABLE)) {
   //     Record::create($record, DB_TABLE);
   // }
?>

<h1>FORM</h1>
<form method="POST" action="./user" id="form">
    <input type="text" name="first_name" id="first_name" placeholder="first name"><br>
    <input type="text" name="last_name" id="last_name" placeholder="last name"><br>
    <input type="text" name="age" id="age" placeholder="age"><br>
    <input type="password" name="password" id="password" placeholder="password"><br>
    <input type="date" name="date" id="date" hidden placeholder="date"><br>
    <input type="submit" value="Submit" id="submit">
</form>

<script>
   form.onsubmit=function(){
      date.value = formatDateToYYYYMMDD(new Date())
   }
   function formatDateToYYYYMMDD(date) {
  // Ensure the input is a Date object
  if (!(date instanceof Date)) {
    date = new Date(date);
  }

  const year = date.getFullYear();
  const month = String(date.getMonth() + 1).padStart(2, '0');
  const day = String(date.getDate()).padStart(2, '0');

  return `${year}-${month}-${day}`;
}

</script>