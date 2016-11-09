'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

/* ----------Canvas-Responsive----------*/
/*-----------Canvas-----------------*/

var sTimer = void 0;
var cellsNumb = void 0;
var config = void 0;
var validTab = 0;
var comptage = void 0;
var renderTab = [];
var initialiseur = 0;
var gridSize = void 0;
var containerSize = void 0;
var canvasGrid = void 0;
var mecanics = void 0;
var v = 1;
var comptageTab = [];
function init() {
  config = new Config();
  canvasGrid = new CanvasGrid();
  mecanics = new Mecanics();
  gridSize = document.getElementById('celullarGrid');

  /*
  let testInterval = setInterval(canvasGrid.setup, 300)
  setTimeout(function(){clearInterval(testInterval);},30000) */
  canvasGrid.setup();
}

var CanvasGrid = function () {
  function CanvasGrid(cells1) {
    _classCallCheck(this, CanvasGrid);

    this.cells1 = cells1;
  }

  _createClass(CanvasGrid, [{
    key: 'setup',
    value: function setup() {
      /* cadre externe */
      comptage = 0;
      cellsNumb = document.getElementById('cellsNum').value;
      var contain = document.getElementById('canvasContainer');
      var cadre = document.getElementById('celullarGrid');
      var ctx = cadre.getContext("2d");
      var heightC = contain.offsetHeight;
      var widthC = contain.offsetWidth;
      cadre.width = contain.offsetWidth;
      cadre.height = contain.offsetHeight;
      ctx.beginPath();
      ctx.moveTo(0, 0);
      ctx.lineTo(widthC, 0);
      ctx.lineTo(widthC, heightC);
      ctx.lineTo(0, heightC);
      ctx.lineTo(0, 0);
      ctx.fillStyle = "white";
      ctx.fillStroke = "black";
      ctx.stroke();
      ctx.fill();
      ctx.closePath();
      /* cellules individuelles */
      /* initialisation des cellules ET mise en place du tableau qui sera render plus tard */
      if (validTab == 1) {
        renderTab = [];
      }
      for (var i = heightC / cellsNumb; i < heightC - heightC / cellsNumb; i += heightC / cellsNumb) {
        for (var s = widthC / cellsNumb; s < widthC - widthC / cellsNumb; s += widthC / cellsNumb) {
          comptage++;
          if (initialiseur == 0) {
            mecanics.fillGrid();
          } else {
            mecanics.gameOfLife();
          }
        }
      }
      validTab = 1;
      comptage = 0;
      initialiseur = 1;
      for (var i = heightC / cellsNumb; i < heightC - heightC / cellsNumb; i += heightC / cellsNumb) {
        for (var s = widthC / cellsNumb; s < widthC - widthC / cellsNumb; s += widthC / cellsNumb) {
          comptage++;
          if (renderTab[comptage - 1] == 1) {
            ctx.beginPath();
            ctx.moveTo(s, i);
            ctx.lineTo(s + widthC / cellsNumb, i);
            ctx.lineTo(s + widthC / cellsNumb, i - widthC / cellsNumb);
            ctx.lineTo(s, i - heightC / cellsNumb);
            ctx.lineTo(s, i);
            ctx.fillStyle = "black";
            ctx.fillStroke = "black";
            ctx.stroke();
            ctx.fill();
            ctx.closePath();
            comptageTab[comptage - 1].etat = 1;
          } else if (renderTab[comptage - 1] == 0) {
            ctx.beginPath();
            ctx.moveTo(s, i);
            ctx.lineTo(s + widthC / cellsNumb, i);
            ctx.lineTo(s + widthC / cellsNumb, i - heightC / cellsNumb);
            ctx.lineTo(s, i - heightC / cellsNumb);
            ctx.lineTo(s, i);
            ctx.fillStyle = "white";
            ctx.fillStroke = "black";
            ctx.stroke();
            ctx.fill();
            ctx.closePath();
            comptageTab[comptage - 1].etat = 0;
          }
        }
      }
    }
  }]);

  return CanvasGrid;
}();

var Config = function () {
  function Config(timerSpeed, gameType) {
    _classCallCheck(this, Config);

    this.timerSpeed = 300;
    this.gameType = gameType;
  }

  _createClass(Config, [{
    key: 'reconfiguration',
    value: function reconfiguration() {
      initialiseur = 0;
      canvasGrid.setup();
    }
  }, {
    key: 'startTimer',
    value: function startTimer() {
      clearInterval(sTimer);
      this.timerSpeed = 300;
      sTimer = setInterval(canvasGrid.setup, this.timerSpeed);
    }
  }, {
    key: 'stopTimer',
    value: function stopTimer() {
      clearInterval(sTimer);
    }
  }, {
    key: 'slowTimer',
    value: function slowTimer() {
      this.timerSpeed = this.timerSpeed * 1.5;
      clearInterval(sTimer);
      sTimer = setInterval(canvasGrid.setup, this.timerSpeed);
    }
  }, {
    key: 'fastTimer',
    value: function fastTimer() {
      this.timerSpeed = this.timerSpeed / 1.5;
      clearInterval(sTimer);
      sTimer = setInterval(canvasGrid.setup, this.timerSpeed);
    }
  }, {
    key: 'saveConfig',
    value: function saveConfig() {
      var saves = XMLHttpRequest();
    }
  }]);

  return Config;
}();

var Mecanics = function () {
  function Mecanics(tabY, tabX) {
    _classCallCheck(this, Mecanics);

    this.tabY = tabY;
    this.tabX = tabX;
  }

  _createClass(Mecanics, [{
    key: 'gameOfLife',
    value: function gameOfLife() {
      if (comptageTab[comptage - 1].etat == 0) {
        var verifTab = [];
        if (comptageTab[comptage - 1 + (cellsNumb - 2) + 1] != undefined) {
          verifTab.push(comptageTab[comptage - 1 + (cellsNumb - 2) + 1].etat);
        }
        if (comptageTab[comptage - 1 + (cellsNumb - 2)] != undefined) {
          verifTab.push(comptageTab[comptage - 1 + (cellsNumb - 2)].etat);
        }
        if (comptageTab[comptage - 1 + (cellsNumb - 2) - 1] != undefined) {
          verifTab.push(comptageTab[comptage - 1 + (cellsNumb - 2) - 1].etat);
        }
        if (comptageTab[comptage] != undefined) {
          verifTab.push(comptageTab[comptage].etat);
        }
        if (comptageTab[comptage - 1 - (cellsNumb - 2) + 1] != undefined) {
          verifTab.push(comptageTab[comptage - 1 - (cellsNumb - 2) + 1].etat);
        }
        if (comptageTab[comptage - 1 - (cellsNumb - 2)] != undefined) {
          verifTab.push(comptageTab[comptage - 1 - (cellsNumb - 2)].etat);
        }
        if (comptageTab[comptage - 1 - (cellsNumb - 2) - 1] != undefined) {
          verifTab.push(comptageTab[comptage - 1 - (cellsNumb - 2) - 1].etat);
        }
        if (comptageTab[comptage - 2] != undefined) {
          verifTab.push(comptageTab[comptage - 2].etat);
        }
        var resultatsFiltre = verifTab.filter(function (verifTab) {
          return verifTab == 1;
        });
        if (resultatsFiltre.length == 3) {
          renderTab.push(1);
        } else {
          renderTab.push(0);
        }
      } else if (comptageTab[comptage - 1].etat == 1) {
        var _verifTab = [];
        if (comptageTab[comptage - 1 + (cellsNumb - 2) + 1] != undefined) {
          _verifTab.push(comptageTab[comptage - 1 + (cellsNumb - 2) + 1].etat);
        }
        if (comptageTab[comptage - 1 + (cellsNumb - 2)] != undefined) {
          _verifTab.push(comptageTab[comptage - 1 + (cellsNumb - 2)].etat);
        }
        if (comptageTab[comptage - 1 + (cellsNumb - 2) - 1] != undefined) {
          _verifTab.push(comptageTab[comptage - 1 + (cellsNumb - 2) - 1].etat);
        }
        if (comptageTab[comptage] != undefined) {
          _verifTab.push(comptageTab[comptage].etat);
        }
        if (comptageTab[comptage - 1 - (cellsNumb - 2) + 1] != undefined) {
          _verifTab.push(comptageTab[comptage - 1 - (cellsNumb - 2) + 1].etat);
        }
        if (comptageTab[comptage - 1 - (cellsNumb - 2)] != undefined) {
          _verifTab.push(comptageTab[comptage - 1 - (cellsNumb - 2)].etat);
        }
        if (comptageTab[comptage - 1 - (cellsNumb - 2) - 1] != undefined) {
          _verifTab.push(comptageTab[comptage - 1 - (cellsNumb - 2) - 1].etat);
        }
        if (comptageTab[comptage - 2] != undefined) {
          _verifTab.push(comptageTab[comptage - 2].etat);
        }
        var _resultatsFiltre = _verifTab.filter(function (verifTab) {
          return verifTab == 1;
        });
        if (_resultatsFiltre.length == 2 || _resultatsFiltre.length == 3) {
          renderTab.push(1);
        } else {
          renderTab.push(0);
        }
      }
    }
  }, {
    key: 'fillGrid',
    value: function fillGrid() {
      var hasard = Math.floor(Math.random() * 100);
      var startPercentage = document.getElementById('cellsVal').value;
      if (hasard <= startPercentage) {
        renderTab.push(1);
        comptageTab.push({ ident: comptage - 1, etat: 1 });
      } else {
        renderTab.push(0);
        comptageTab.push({ ident: comptage - 1, etat: 0 });
      }
    }
  }]);

  return Mecanics;
}();
