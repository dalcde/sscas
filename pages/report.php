<script src="pages/report.js" type="text/javascript"></script>
<div>
  Generate report:
  <table>
    <tr>
      <td>Show by</td>
      <td>
        <span id="show-by">
          <input type="radio" id="show-by-all" value="all" name="show-by" checked="checked"><label for="show-by-all">All</label></input>
          <input type="radio" id="show-by-class" value="class" name="show-by"><label for="show-by-class">Class</label></input>
          <input type="radio" id="show-by-house" value="house" name="show-by"><label for="show-by-house">House</label></input>
        </span>
      </td>
    </tr>
    <tr>
      <td>Show</td>
      <td>
        <span id="show">
          <input type="checkbox" id="present" name="checkbox"><label for="present">Present</label></input>
          <input type="checkbox" id="late" name="checkbox"><label for="late">Late</label></input>
          <input type="checkbox" id="absent" name="checkbox"><label for="absent">Absent</label></input>
        </span>
      </td>
    </tr>
    <tr>
      <td>Output format</td>
      <td>
        <span id="format">
          <input type="radio" id="pdf" value="pdf" name="format" checked="checked"><label for="pdf">PDF</label></input>
          <input type="radio" id="csv" value="csv" name="format"><label for="csv">CSV</label></input>
        </span>
      </td>
    </tr>
    <tr>
      <td colspan="2">
        <input id="generate-button" type="button" value="Generate"></input>
      </td>
    </tr>
  </table>
</div>
