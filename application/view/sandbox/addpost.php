Add post
<?php
    $this->view->setTitle($this->view->getTitle() . 'Add post');
    echo $message;
?>
<?php
    echo $form->startRender();
    echo $form->title;
    echo $form->text;
    echo $form->visible;
    echo $form->submit;
    echo $form->endRender();
?>

<?php
/*
<form action="http://www.example.com/myform.php" method="POST">
  <input type="text" name="textbox1" value="this is a text box">
  <input type="checkbox" name="checkbox1" value="foo">
  <input type="radio" name="group1" value="foo"> <input type="radio" name="group1" value="bar">
  <select name="selectbox1">
    <option value="foo">foo</option>
    <option value="bar">bar</option>
    <option value="baz">baz</option>
    <option value="quix">quix</option>
  </select>
  <select name="selectbox2" multiple size="3">
    <option value="foo">foo</option>
    <option value="bar">bar</option>
    <option value="baz">baz</option>
    <option value="quix">quix</option>
  </select>
  <textarea name="textbox2"></textarea>
  <input name="button1" type="button" value="foo bar!">
</form>
 */
?>