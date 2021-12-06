Blockly.inject('blocklyDiv', {
  toolbox: document.getElementById('toolbox'),
  scrollbars: false
});


Blockly.Blocks['text_move'] = {
  init: function() {
    this.appendValueInput('VALUE')
        .setCheck('String')
        .appendField('Move');
    this.setPreviousStatement(true);
    this.setColour(200);
  }
};

Blockly.Blocks['text_LEFT'] = {
  init: function() {
    this.appendValueInput('LEFT')
        .setCheck('String')
        .appendField('left');
     this.setOutput(true);
    this.setColour(210);

  }
};

Blockly.Blocks['text_RIGHT'] = {
  init: function() {
    this.appendValueInput('RIGHT')
        .setCheck('String')
        .appendField('right');
     this.setOutput(true);
    this.setColour(220);
  }
};

Blockly.Blocks['text_FORWARD'] = {
  init: function() {
    this.appendValueInput('FORWARD')
        .setCheck('String')
        .appendField('forward');
     this.setOutput(true);
    this.setColour(230);

  }
};

Blockly.Blocks['text_BACKWARD'] = {
  init: function() {
    this.appendValueInput('BACKWARD')
        .appendField('backward');
    this.setOutput(false);
//    this.setPreviousStatement(true, null);
    this.setNextStatement(true, null);
    this.setInputsInline(false);
    this.setColour(240);
  }
};

  function showCode() {
  // Generate Python code and display it.
  var code = Blockly.Python.workspaceToCode(workspace);
  console.log(code);
  alert("HELLOO");
}

function run(){
    var code = Blockly.JavaScript.workspaceToCode(workspace);
    console.log(code)
    $.post("/", code);
    alert("HELLOO");
};