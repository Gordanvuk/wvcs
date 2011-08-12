<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CS Project Management System</title>
</head>

<body>
<div align="center">
  <table width="518" border="0">
    <tr>
      <td width="508"><h1 align="center">CS Project Management System</h1></td>
    </tr>
  </table>
  <form id="form1" name="form1" method="post">
    <table width="600" border="0">
      <tr>
        <td><p>&nbsp;</p>
          <p>Task to do</p>
          <table width="300" border="0">
          <tr>
            <td><a href="project.php">Project A</a></td>
            <td><a href="task.php">Task A</a></td>
            <td>by 12 July</td>
            <td><select name="priority" size="1" id="priority">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
              </select></td>
          </tr>
          <tr>
            <td><a href="project.php">Project A</a></td>
            <td><a href="task.php">Task B</a></td>
            <td>by 16 July</td>
            <td><select name="priority2" size="1" id="priority2">
              <option>1</option>
              <option selected="selected">2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select></td>
          </tr>
          <tr>
            <td><a href="project.php">Project C</a></td>
            <td><a href="task.php">Task E</a></td>
            <td>by 23 Sep</td>
            <td><select name="priority3" size="1" id="priority3">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option selected="selected">4</option>
              <option>5</option>
            </select></td>
          </tr>
        </table></td>
        <td><p>Project leading</p>
          <table width="300" border="0">
            <tr>
              <td width="99"><a href="project.php">Project A</a></td>
              <td width="86">by 20 July</td>
              <td width="101">finished 50%</td>
            </tr>
            <tr>
              <td><a href="project.php">Project C</a></td>
              <td>by 28 July</td>
              <td>finished 23%</td>
            </tr>
        </table></td>
      </tr>
      <tr>
        <td><p>&nbsp;</p>
          <p>Task doing</p>
          <table width="300" border="0">
          <tr>
            <td><a href="project.php">Project A</a></td>
            <td><a href="task.php">Task F</a></td>
            <td>by 12 July</td>
            <td><label for="textfield"></label>
              <input name="textfield" type="text" disabled="disabled" id="textfield" value="60%" size="6" maxlength="3" /></td>
            <td><select name="priority4" size="1" id="priority4">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select></td>
          </tr>
          <tr>
            <td><a href="project.php">Project B</a></td>
            <td><a href="task.php">Task B</a></td>
            <td>by 14 July</td>
            <td><label for="textfield2"></label>
              <input name="textfield2" type="text" id="textfield2" value="20%" size="6" maxlength="3" /></td>
            <td><select name="priority4" size="1" id="priority5">
              <option>1</option>
              <option selected="selected">2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select></td>
          </tr>
        </table></td>
        <td><table width="300" border="0">
          <tr>
            <td width="99"><a href="project.php">Project A</a></td>
            <td width="86">by 20 July</td>
            <td width="101">finished 50%</td>
          </tr>
        </table>
          <table width="300" border="0">
            <tr>
            <td>&nbsp;&nbsp;&nbsp;<a href="task.php">Task F</a></td>
            <td>by 12 July</td>
            <td><label for="textfield2"></label>
              <input name="textfield3" type="text" disabled="disabled" id="textfield2" value="60%" size="6" maxlength="3" /></td>
            <td><select name="priority5" size="1" id="priority6">
              <option>1</option>
              <option>2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select></td>
          </tr>
          <tr>
            <td>&nbsp;&nbsp;&nbsp;<a href="task.php">Task B</a></td>
            <td>by 14 July</td>
            <td><label for="textfield3"></label>
              <input name="textfield3" type="text" id="textfield3" value="20%" size="6" maxlength="3" /></td>
            <td><select name="priority5" size="1" id="priority7">
              <option>1</option>
              <option selected="selected">2</option>
              <option>3</option>
              <option>4</option>
              <option>5</option>
            </select></td>
          </tr>
      </table></td>
      </tr>
      <tr>
        <td><p>&nbsp;</p>
          <p>Task waiting</p>
          <table width="300" border="0">
            <tr>
              <td><a href="project.php">Project A</a></td>
              <td><a href="task.php">Task H</a></td>
              <td>waiting for</td>
              <td><a href="task.php">Task D</a></td>
            </tr>
            <tr>
              <td><a href="project.php">Project A</a></td>
              <td><a href="task.php">Task F</a></td>
              <td>waiting for</td>
              <td><a href="task.php">Task E</a></td>
            </tr>
        </table></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><p>&nbsp;</p>
          <p>Task submitted</p>
          <table width="300" border="0">
            <tr>
              <td><a href="project.php">Project A</a></td>
              <td><a href="task.php">Task C</a></td>
              <td>ver 1</td>
              <td>20 Jun</td>
            </tr>
            <tr>
              <td><a href="project.php">Project A</a></td>
              <td><a href="task.php">Task A</a></td>
              <td>ver 5</td>
              <td>6 July</td>
            </tr>
        </table></td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </form>
<p><a href="test.php">Support</a> - <a href="test.php">Contact</a> - <a href="test.php">About</a></p>
</div>
<div align="center"></div>
</body>
</html>
