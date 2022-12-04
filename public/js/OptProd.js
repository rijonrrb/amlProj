//Add product
document.getElementById("cProd").onclick = function() {
document.getElementById("iProd").style.display = "none";
document.getElementById("sProd").disabled = false;
document.getElementById("iProd").disabled = true;
document.getElementById("sProd").style.display = "block";
document.getElementById("cProd").style.display = "none";
}
//Re-Issue Product

document.getElementById("r_H_cdes").onclick = function() {
document.getElementById("r_H_ides").style.display = "none";
document.getElementById("r_H_sdes").disabled = false;
document.getElementById("r_H_ides").disabled = true;
document.getElementById("r_H_sdes").style.display = "block";
document.getElementById("r_H_cdes").style.display = "none";
}

//Return Product
document.getElementById("UH_cdes").onclick = function() {
document.getElementById("UH_ides").style.display = "none";
document.getElementById("UH_sdes").disabled = false;
document.getElementById("UH_ides").disabled = true;
document.getElementById("UH_sdes").style.display = "block";
document.getElementById("UH_cdes").style.display = "none";
}