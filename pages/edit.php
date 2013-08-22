<?php
  admin_only();
?>
<script src="pages/edit.js" type="text/javascript"></script>
<table border="0">
  <tr>
    <td style="vertical-align: top">
      <table border="0">
        <tr>
          <td>Student ID:</td><td>
          <form name="input" id="input">
            <input type="tel" id="REGNO"/>
          </form>
        </td>
        </tr>
        <tr>
          <td>English Name:</td>
          <td id="ENNAME"></td>
        </tr>
        <tr>
          <td>Chinese Name:</td>
          <td id="CHNAME"></td>
        </tr>
        <tr>
          <td>Class:</td>
          <td id="CLASSCODE"></td>
        </tr>
        <tr>
          <td>Class Number:</td>
          <td id="CLASSNO"></td>
        </tr>
        <tr>
          <td>House:</td>
          <td id="SCHHOUSE"></td>
        </tr>
        <tr>
          <td>Gender:</td>
          <td id="SEX"></td>
        </tr>
        <tr>
          <td style="vertical-align: top">Timestamp:</td>
          <td>
            <input type="text" id="date-entry" /> <br />
            <input type="text" id="time-entry"/> <br />
            <input type="button" id="edit" value="Edit" /> <br />
            <input type="button" id="remove" value="Remove entry" />
          </td>
        </tr>
      </table>
    </td>
    <td id="photo">
    </td>
  </tr>
</table>
