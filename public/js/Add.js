

function next() {

var x = document.getElementsByClassName("tabU")[0];
var y = document.getElementsByClassName("tabH")[0];
var z = document.getElementById("prevBtn");
var n = document.getElementById("nextBtn");
var s = document.getElementById("sub");
var icon = document.getElementsByClassName("step")[0];

x.style.display = "none";
y.style.display = "inline";
z.style.display = "inline";
n.style.display = "none";
s.style.display = "inline";
icon.className = "finish";
}

function prev() {

var x = document.getElementsByClassName("tabU")[0];
var y = document.getElementsByClassName("tabH")[0];
var z = document.getElementById("prevBtn");
var n = document.getElementById("nextBtn");
var s = document.getElementById("sub");

var icon = document.getElementsByClassName("finish")[0];

x.style.display = "inline";
y.style.display = "none";
z.style.display = "none";
n.style.display = "inline";
s.style.display = "none";
icon.className = "step";
}
