
//Return Product
document.getElementById("UH_cdept").onclick = function() {
document.getElementById("UH_idept").style.display = "none";
document.getElementById("UH_sdept").disabled = false;
document.getElementById("UH_idept").disabled = true;
document.getElementById("UH_sdept").style.display = "block";
document.getElementById("UH_cdept").style.display = "none";
}

document.getElementById("UH_cdes").onclick = function() {
document.getElementById("UH_ides").style.display = "none";
document.getElementById("UH_sdes").disabled = false;
document.getElementById("UH_ides").disabled = true;
document.getElementById("UH_sdes").style.display = "block";
document.getElementById("UH_cdes").style.display = "none";
}