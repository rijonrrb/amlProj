

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

function r_next() {

var r_x = document.getElementsByClassName("r_tabU")[0];
var r_y = document.getElementsByClassName("r_tabH")[0];
var r_z = document.getElementById("r_prevBtn");
var r_n = document.getElementById("r_nextBtn");
var r_s = document.getElementById("r_sub");
var r_icon = document.getElementsByClassName("r_step")[0];

r_x.style.display = "none";
r_y.style.display = "inline";
r_z.style.display = "inline";
r_n.style.display = "none";
r_s.style.display = "inline";
r_icon.className = "r_finish";
}

function r_prev() {

var r_x = document.getElementsByClassName("r_tabU")[0];
var r_y = document.getElementsByClassName("r_tabH")[0];
var r_z = document.getElementById("r_prevBtn");
var r_n = document.getElementById("r_nextBtn");
var r_s = document.getElementById("r_sub");

var r_icon = document.getElementsByClassName("r_finish")[0];

r_x.style.display = "inline";
r_y.style.display = "none";
r_z.style.display = "none";
r_n.style.display = "inline";
r_s.style.display = "none";
r_icon.className = "r_step";
}
